<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user for the system

        DB::table('users')->insert([
            'name'      => 'admin',
            'email'     => 'admin@website.com',
            'password'  => Hash::make('12345678'),
            'is_admin'  => true
        ]);

        // Create regular user (non-admin) for the system

        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'test@website.com',
            'password' => Hash::make('12345678'),
            'is_admin' => false
        ]);

        User::factory()->count(10)->create();
    }
}
