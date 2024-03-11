<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
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
                "name" => "Sarah",
                "user_id" => 2,
                "profile_id" => 1,
                "latest_education" => "Sarjana",
            ],[
                "name" => "Wahyu",
                "user_id" => 3,
                "profile_id" => 2,
                "latest_education" => "Sarjana",
            ],[
                "name" => "Diana",
                "user_id" => 4,
                "profile_id" => 3,
                "latest_education" => "Magister",
            ],[
                "name" => "Wesley",
                "user_id" => 5,
                "profile_id" => 4,
                "latest_education" => "Doctor",
            ],
        ];

        foreach ($data as $value) {
            Teacher::insert([
                'user_id' => $value['user_id'],
                'name'=> $value['name'],
                'profile_id'=> $value['profile_id'],
                'latest_education'=> $value['latest_education'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
