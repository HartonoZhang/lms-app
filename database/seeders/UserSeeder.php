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
        User::insert([
            [
                'name' => 'Admin 1',
                'email' => 'admin@gmail.com',
                'image' => 'default.png',
                'password' => Hash::make('admin123'),
                'role_id' => 1
            ]
        ]);
    }
}
