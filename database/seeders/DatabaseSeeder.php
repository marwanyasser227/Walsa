<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  \App\Models\User::factory(5)->create();


        //! 001 => admin account
        \App\Models\User::factory()->create([
            'name' => 'MarwanYasser',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'isAdmin' => 1,
            'phone' => '01074392440',

        ]);
    }
}
