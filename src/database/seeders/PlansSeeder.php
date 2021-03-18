<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->delete();
        $users = User::all();
        foreach ($users as $user) {
            Plan::create([
                'title' => 'Plan for user ' . $user->email,
                'user_id' => $user->id
            ]);
        }
    }
}
