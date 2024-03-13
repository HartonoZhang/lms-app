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
            ],[
                "name" => "Dobby",
                "user_id" => 22,
                "profile_id" => 21,
                "graduation_date" => null
            ],[
                "name" => "Marshal",
                "user_id" => 23,
                "profile_id" => 22,
                "graduation_date" => null
            ],[
                "name" => "Hendra",
                "user_id" => 24,
                "profile_id" => 23,
                "graduation_date" => null
            ],[
                "name" => "Setiawan",
                "user_id" => 25,
                "profile_id" => 24,
                "graduation_date" => null
            ],[
                "name" => "Vannes",
                "user_id" => 26,
                "profile_id" => 25,
                "graduation_date" => null
            ],[
                "name" => "Hendi",
                "user_id" => 27,
                "profile_id" => 26,
                "graduation_date" => null
            ],[
                "name" => "Laura",
                "user_id" => 28,
                "profile_id" => 27,
                "graduation_date" => null
            ],[
                "name" => "Jonathan",
                "user_id" => 29,
                "profile_id" => 28,
                "graduation_date" => null
            ],[
                "name" => "Andreas",
                "user_id" => 30,
                "profile_id" => 29,
                "graduation_date" => null
            ],[
                "name" => "Alif",
                "user_id" => 31,
                "profile_id" => 30,
                "graduation_date" => null
            ],[
                "name" => "Rizky",
                "user_id" => 32,
                "profile_id" => 31,
                "graduation_date" => null
            ],[
                "name" => "Madelyn",
                "user_id" => 33,
                "profile_id" => 32,
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
