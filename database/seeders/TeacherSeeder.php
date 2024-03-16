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
                "user_id" => 2,
                "profile_id" => 1,
                "latest_education" => "Sarjana",
            ],[
                "user_id" => 3,
                "profile_id" => 2,
                "latest_education" => "Sarjana",
            ],[
                "user_id" => 4,
                "profile_id" => 3,
                "latest_education" => "Magister",
            ],[
                "user_id" => 5,
                "profile_id" => 4,
                "latest_education" => "Doctor",
            ],[
                "user_id" => 16,
                "profile_id" => 15,
                "latest_education" => "Sarjana",
            ],[
                "user_id" => 17,
                "profile_id" => 16,
                "latest_education" => "Sarjana",
            ],[
                "user_id" => 18,
                "profile_id" => 17,
                "latest_education" => "Magister",
            ],[
                "user_id" => 19,
                "profile_id" => 18,
                "latest_education" => "Doctor",
            ],[
                "user_id" => 20,
                "profile_id" => 19,
                "latest_education" => "Magister",
            ],[
                "user_id" => 21,
                "profile_id" => 20,
                "latest_education" => "Doctor",
            ],
        ];

        foreach ($data as $value) {
            Teacher::insert([
                'user_id' => $value['user_id'],
                'profile_id'=> $value['profile_id'],
                'latest_education'=> $value['latest_education'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
