<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sessions')->delete();
        $plans = Plan::all();

        foreach ($plans as $plan) {
            for ($iDay = 20; $iDay > 0; $iDay--) {
                $date = Carbon::now()->addDays($iDay * -1)->toDateTimeString();
                Session::create([
                    'plan_id' => $plan->id,
                    'start_date' => $date
                ]);
            }
        }
    }
}
