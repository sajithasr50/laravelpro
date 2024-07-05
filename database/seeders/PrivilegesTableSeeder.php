<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonpriv = json_encode(["1","2","3"]);
        DB::table('privileges')->insert([
            'userid' => '1',
            'privilege' => $jsonpriv
       ]);
    }
}
