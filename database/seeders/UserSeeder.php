<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Josiah Matthews';
        $user->email = 'josiah.m@example.com';
        $user->password = Hash::make("password");
        $user->role = 'Waiter';
        $user->save();

        $user = new User();
        $user->name = 'Libby Herring';
        $user->email = 'libby.h@example.com';
        $user->password = Hash::make("password");
        $user->role = 'Chef';
        $user->save();

        $user = new User();
        $user->name = 'Hector Lamb';
        $user->email = 'hector.l@example.com';
        $user->password = Hash::make("password");
        $user->role = 'Manager';
        $user->save();
    }
}
