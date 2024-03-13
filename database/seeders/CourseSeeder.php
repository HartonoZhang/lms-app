<?php

namespace Database\Seeders;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
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
                "code" => "MATH",
                "name" => "Algebra",
                "min_score" => 75,
            ],[
                "code" => "MATH",
                "name" => "Algebra II",
                "min_score" => 75,
            ],[
                "code" => "MATH",
                "name" => "Matrix",
                "min_score" => 50,
            ],[
                "code" => "COMP",
                "name" => "Algorithm and Programming",
                "min_score" => 65,
            ],[
                "code" => "ART",
                "name" => "Drawing",
                "min_score" => 45,
            ],[
                "code" => "ART",
                "name" => "Music",
                "min_score" => 50,
            ],[
                "code" => "ART",
                "name" => "Teather",
                "min_score" => 77,
            ],[
                "code" => "LAW",
                "name" => "Law & Policies",
                "min_score" => 55,
            ],[
                "code" => "Law",
                "name" => "Public Relation",
                "min_score" => 70,
            ],[
                "code" => "",
                "name" => "English",
                "min_score" => 60,
            ],[
                "code" => "",
                "name" => "Basic Mathematic",
                "min_score" => 50,
            ],[
                "code" => "",
                "name" => "Sports",
                "min_score" => 45,
            ],[
                "code" => "",
                "name" => "History of Java",
                "min_score" => 65,
            ],[
                "code" => "ART",
                "name" => "Sculpture",
                "min_score" => 44,
            ],[
                "code" => "Math",
                "name" => "2D Shapes",
                "min_score" => 67,
            ],[
                "code" => "ART",
                "name" => "Digital Drawing",
                "min_score" => 76,
            ],[
                "code" => "COMP",
                "name" => "Introduction of Python Language",
                "min_score" => 50,
            ],[
                "code" => "Cook",
                "name" => "Western Dish",
                "min_score" => 55,
            ],[
                "code" => "Cook",
                "name" => "Asia Dish",
                "min_score" => 65,
            ],[
                "code" => "COMP",
                "name" => "Introduction of Python Language II",
                "min_score" => 60,
            ]
        ];

        foreach ($data as $value) {
            Course::insert([
                "code"=> $value["code"],
                "name"=> $value["name"],
                "min_score"=> $value["min_score"],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}