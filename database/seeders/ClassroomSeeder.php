<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
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
                'course_id' => 1,
                'name'=> 'Tutorial Class Only',
                'code'=> 'LH01',
                'student_capacity' => 10,
            ],[
                'course_id' => 2,
                'name'=> 'Exam Room',
                'code'=> 'LK01',
                'student_capacity' => 30,
            ],[
                'course_id' => 3,
                'name'=> 'VIP Class',
                'code'=> 'LI01',
                'student_capacity' => null,
            ]
        ];

        foreach ($data as $value) {
            Classroom::insert([
                'course_id'=> $value['course_id'],
                'name'=> $value['name'],
                'code'=> $value['code'],
                'student_capacity'=> $value['student_capacity'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
