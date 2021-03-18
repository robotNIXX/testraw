<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PlansSeeder::class);
        $this->call(DomainsSeeder::class);
        $this->call(SessionsSeeder::class);
        $this->call(ExercisesSeeder::class);
        $this->call(AssessmentsSeeder::class);
    }

}
