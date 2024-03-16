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
                "name" => "Luffy",
                "email" => "admin@gmail.com",
                "password" => "admin123",
                "image" => "default.png",
                "role_id" => 1,
            ],[
                "name" => "Sanji",
                "email" => "teacher_1@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Zoro",
                "email" => "teacher_2@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Nami",
                "email" => "teacher_3@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Robin",
                "email" => "teacher_4@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Usshop",
                "email" => "student_1@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Franky",
                "email" => "student_2@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Brook",
                "email" => "student_3@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Chopper",
                "email" => "student_4@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Akainu",
                "email" => "student_5@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Flash",
                "email" => "student_6@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Saitama",
                "email" => "student_7@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Goku",
                "email" => "student_8@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Hinata",
                "email" => "student_9@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Naruto",
                "email" => "student_10@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Sasuke",
                "email" => "teacher_5@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Vegeta",
                "email" => "teacher_6@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Paimon",
                "email" => "teacher_7@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Aether",
                "email" => "teacher_8@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Tanjiro",
                "email" => "teacher_9@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Nezuko",
                "email" => "teacher_10@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Ichinose",
                "email" => "teacher_11@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Eren",
                "email" => "teacher_12@gmail.com",
                "password" => "teacher123",
                "image" => "default.png",
                "role_id" => 2,
            ],[
                "name" => "Mikasa",
                "email" => "student_11@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Armin",
                "email" => "student_12@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "John",
                "email" => "student_13@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Levi",
                "email" => "student_14@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Kenny",
                "email" => "student_15@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Poo",
                "email" => "student_16@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Kakashi",
                "email" => "student_17@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Jiraiya",
                "email" => "student_18@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Minato",
                "email" => "student_19@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ],[
                "name" => "Kushina",
                "email" => "student_20@gmail.com",
                "password" => "student123",
                "image" => "default.png",
                "role_id" => 3,
            ]
        ];

        foreach ($data as $value) {
            User::insert([
                'name' => $value['name'],
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
