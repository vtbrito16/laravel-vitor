<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'vitor daniel',
                'username' => 'vtbrito',
                'email' => 'vtbrito2000@gmail.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('Senha1205'),
            ],
            [
                'name' => 'vendedor vendor',
                'username' => 'vendor',
                'email' => 'vendedorvtbritor@gmail.com',
                'role' => 'vendor',
                'status' => 'active',
                'password' => bcrypt('Senha1205'),
            ],
            [
                'name' => 'Cliente user',
                'username' => 'user',
                'email' => 'clientevtbrito@gmail.com',
                'role' => 'user',
                'status' => 'active',
                'password' => bcrypt('Senha1205'),
            ]
        ]);
    }
}
