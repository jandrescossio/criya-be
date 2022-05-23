<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RetailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('retailers')->insert([
            ['name' => 'Amazon'],
            ['name' => 'Wayfair'],
            ['name' => 'Home Depot']
        ]);
    }
}
