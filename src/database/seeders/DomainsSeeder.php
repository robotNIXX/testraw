<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domains')->delete();
        $domains = ['memory', 'reasoning', 'speed', 'attention'];
        foreach ($domains as $domain) {
            Domain::create([
                'title' => ucfirst($domain),
                'code' => $domain
            ]);
        }
    }
}
