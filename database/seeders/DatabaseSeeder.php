<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => 'avatar.png',
                'level'=>1,
            ],
            [
                'id' => 2,
                'name' => 'admin',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => 'avatar.png',
                'level'=>1,
            ],
        ]);
    }
}

