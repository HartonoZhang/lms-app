<?php

namespace Database\Seeders;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
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
                "name" => "Buddy",
                "user_id" => 6,
                "profile_id" => 5,
                "graduation_date" => null
            ],[
                "name" => "Luffy",
                "user_id" => 7,
                "profile_id" => 6,
                "graduation_date" => null
            ],[
                "name" => "Denny",
                "user_id" => 8,
                "profile_id" => 7,
                "graduation_date" => null
            ],[
                "name" => "Zeno",
                "user_id" => 9,
                "profile_id" => 8,
                "graduation_date" => null
            ],[
                "name" => "Hartono",
                "user_id" => 10,
                "profile_id" => 9,
                "graduation_date" => null
            ],[
                "name" => "Chung",
                "user_id" => 11,
                "profile_id" => 10,
                "graduation_date" => null
            ],[
                "name" => "Son",
                "user_id" => 12,
                "profile_id" => 11,
                "graduation_date" => null
            ],[
                "name" => "William",
                "user_id" => 13,
                "profile_id" => 12,
                "graduation_date" => null
            ],[
                "name" => "Jenny",
                "user_id" => 14,
                "profile_id" => 13,
                "graduation_date" => null
            ],[
                "name" => "Susan",
                "user_id" => 15,
                "profile_id" => 14,
                "graduation_date" => null
            ],
        ];

        foreach ($data as $value) {
            Student::insert([
                'user_id' => $value['user_id'],
                'name' => $value['name'],
                'profile_id' => $value['profile_id'],
                'graduation_date' => $value['graduation_date'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    
    }
}
