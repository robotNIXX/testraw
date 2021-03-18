<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\Domain;
use App\Models\Session;
use App\Models\User;
use App\Models\UserAssessment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assessments')->delete();
        DB::table('user_assessments')->delete();
        $domains = Domain::all();
        $users = User::all();
        for ($index = 0; $index < 8; $index++) {
            $cIndex = $index > 3 ? $index - 4 : $index;
            $assessment = Assessment::create([
                'title' => "Assessment for {$domains[$cIndex]->title} #{$index}",
                'domain_id' => $domains[$cIndex]->id,
                'score' => rand(0, 10000)
            ]);
        }
        $aIndex = 0;
        $assessments = Assessment::all();
        for ($iDay = 20; $iDay > 0; $iDay -= 2) {
            $uIndex = $aIndex % 2 == 0;
            $date = Carbon::now()->addDays($iDay * -1)->toDateTimeString();
            if (isset($assessments[$aIndex])) {
                UserAssessment::create([
                    'assessment_id' => $assessments[$aIndex]->id,
                    'user_id' => $users[$uIndex]->id,
                    'is_completed' => true,
                    'start_date' => $date
                ]);
            }
            $aIndex++;
        }
    }
}
