<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        $user->email = 'admin@gmail.com';
        $user->image = 'default.png';
        $user->password = Hash::make('admin123');
        $user->role_id = 1;
        $user->save();

        $admin = new Admin();
        $admin->name = 'admin';
        $user->admin()->save($admin);
    }
}
