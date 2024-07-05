<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'role' => '1',
            'password' => '$2y$12$keNf54pXyjIE7d0vT2QsVek2UeLxXqHrlQjDUYAZ62766D1GuRN/K',
        ]);

    }
}
