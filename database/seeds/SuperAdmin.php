<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Md. Mahadi Hassan Razib',
            'email' => 'agun21st@outlook.com',
            'password' => Hash::make('AgunRaz0172834621@@'),
            'role' => ('Super_Admin'),
            'status' => ('Active'),

        ]);
        User::create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager2020'),
            'role' => ('Admin'),
            'status' => ('Active'),

        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user2020'),
            'role' => ('User'),
            'status' => ('Active'),

        ]);
    }
}
