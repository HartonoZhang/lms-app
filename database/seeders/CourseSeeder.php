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
                "name" => "Algebra"
            ],[
                "code" => "MATH",
                "name" => "Algebra II"
            ],[
                "code" => "MATH",
                "name" => "Matrix"
            ],[
                "code" => "COMP",
                "name" => "Algorithm and Programming"
            ],[
                "code" => "ART",
                "name" => "Drawing"
            ],[
                "code" => "ART",
                "name" => "Music"
            ],[
                "code" => "ART",
                "name" => "Teather"
            ],[
                "code" => "LAW",
                "name" => "Law & Policies"
            ],[
                "code" => "Law",
                "name" => "Public Relation"
            ],[
                "code" => "",
                "name" => "English"
            ],[
                "code" => "",
                "name" => "Basic Mathematic"
            ],[
                "code" => "",
                "name" => "Sports"
            ],[
                "code" => "",
                "name" => "History of Java"
            ],[
                "code" => "ART",
                "name" => "Sculpture"
            ],[
                "code" => "Math",
                "name" => "2D Shapes"
            ],[
                "code" => "ART",
                "name" => "Digital Drawing"
            ],[
                "code" => "COMP",
                "name" => "Introduction of Python Language"
            ],[
                "code" => "Cook",
                "name" => "Western Dish"
            ],[
                "code" => "Cook",
                "name" => "Asia Dish"
            ],[
                "code" => "COMP",
                "name" => "Introduction of Python Language II"
            ]
        ];

        foreach ($data as $value) {
            Course::insert([
                "code"=> $value["code"],
                "name"=> $value["name"],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
