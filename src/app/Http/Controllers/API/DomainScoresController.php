<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DomainScoresController extends Controller
{
    public function history($domain)
    {
        $user = User::first();

        $sessions = $user->sessions->pluck('id');
        $exercises = DB::table('exercises', 'ex')
            ->join('session_exercises as se', 'ex.id', '=', 'se.exercise_id')
            ->join('sessions as s', 'se.session_id', '=', 's.id')
            ->whereIn('se.session_id', $sessions)
            ->where('se.is_completed', true)
            ->orderBy('s.start_date', 'DESC')
            ->limit(12)->get(['ex.*', 's.start_date']);

        $assessments = DB::table('assessments', 'ast')
            ->join('user_assessments as ua', 'ast.id', '=', 'ua.assessment_id')
            ->join('domains as dm', 'ast.domain_id', '=', 'dm.id')
            ->where('ua.user_id', $user->id)
            ->where('dm.code', $domain)
            ->orderBy('ua.start_date', 'DESC')
            ->limit(12)->get('ast.*', 'ua.start_date');


        $result = [];

        $exercises->each(function ($item, $key) use (&$result, $domain) {
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $item->start_date)->format('Y-m-d');
            $item = (array)$item;
            if (!isset($result[$start_date])) {
                $result[$start_date] = [
                    'score' => 0,
                    'date' => ''
                ];
            }
            $result[$start_date]['score'] += round($item['score'] * 100 / $item["{$domain}_weight"]);
            $result[$start_date]['date'] = Carbon::createFromFormat('Y-m-d', $start_date)->timestamp;
        });

        $assessments->each(function ($item, $key) use (&$result, $domain) {
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $item->start_date)->format('Y-m-d');
            if (!isset($result[$start_date])) {
                $result[$start_date] = [
                    'score' => 0,
                    'date' => ''
                ];
            }
            $result[$start_date]['score'] += $item->score;
            $result[$start_date]['date'] = Carbon::createFromFormat('Y-m-d', $start_date)->timestamp;
        });

        if (count($result) > 12) {
            array_splice($result, 12);
        }

        return array_values($result);

    }
}
