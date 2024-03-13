<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
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
        $data = [
            [
                "email" => "admin@gmail.com",
                "password" => "admin123",
                "image" => "default.png",
                "role_id" => 1,
            ],[
                "email" => "teacher_1@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "teacher_2@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "teacher_3@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "teacher_4@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "student_1@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_2@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_3@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_4@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_5@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_6@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_7@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_8@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_9@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_10@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "teacher_5@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "teacher_6@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "teacher_7@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "teacher_8@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "teacher_9@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "teacher_10@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "teacher_11@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "teacher_12@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "email" => "student_11@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_12@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_13@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_14@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_15@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_16@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_17@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_18@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_19@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "email" => "student_20@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ]
        ];

        foreach ($data as $value) {
            User::insert([
                'email' => $value['email'],
                'password'=> Hash::make($value['password']),
                'image'=> $value['image'],
                'role_id'=> $value['role_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
