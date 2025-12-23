<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // KEY unik
            [
                'name'     => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
                'approved' => 1,
            ]
        );
    }
}
