<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Provider\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user1 = User::create([
            'name' => Person::firstNameMale(),
            'email' => 'test1@test.com',
            'password' => Hash::make('test')
        ]);
        $user2 = User::create([
            'name' => Person::firstNameFemale(),
            'email' => 'test2@test.com',
            'password' => Hash::make('test')
        ]);
    }
}
