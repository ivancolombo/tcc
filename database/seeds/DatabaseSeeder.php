<?php

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
        DB::table('users')->insert([
            'name' => 'Ivan Colombo',
            'email' => 'ivan@email.com',
            'password' => Hash::make('12345678'),
            'tipo' => 'admin',
        ]);
    }
}
