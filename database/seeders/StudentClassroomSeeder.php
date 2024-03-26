<?php

namespace Database\Seeders;

use App\Models\StudentClassroom;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentClassroomSeeder extends Seeder
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
                'classroom_id' => 1,
                'student_id' => 1,
                'asg' => 50,
                'project' => 60,
                'exam' => 70,
            ],[
                'classroom_id' => 1,
                'student_id' => 3,
                'asg' => 56,
                'project' => 55,
                'exam' => 74,
            ],[
                'classroom_id' => 1,
                'student_id' => 5,
                'asg' => 84,
                'project' => 55,
                'exam' => 35,
            ],[
                'classroom_id' => 1,
                'student_id' => 7,
                'asg' => 44,
                'project' => 65,
                'exam' => 75,
            ],[
                'classroom_id' => 1,
                'student_id' => 9,
                'asg' => 86,
                'project' => 88,
                'exam' => 88,
            ],[
                'classroom_id' => 2,
                'student_id' => 1,
                'asg' => 95,
                'project' => 99,
                'exam' => 2,
            ],[
                'classroom_id' => 2,
                'student_id' => 2,
                'asg' => 23,
                'project' => 99,
                'exam' => 10,
            ],[
                'classroom_id' => 2,
                'student_id' => 3,
                'asg' => 43,
                'project' => 76,
                'exam' => 47,
            ],[
                'classroom_id' => 2,
                'student_id' => 5,
                'asg' => 82,
                'project' => 94,
                'exam' => 67,
            ],[
                'classroom_id' => 2,
                'student_id' => 7,
                'asg' => 67,
                'project' => 78,
                'exam' => 89,
            ],[
                'classroom_id' => 2,
                'student_id' => 9,
                'asg' => 22,
                'project' => 33,
                'exam' => 44,
            ],[
                'classroom_id' => 3,
                'student_id' => 2,
                'asg' => 44,
                'project' => 33,
                'exam' => 12,
            ],[
                'classroom_id' => 3,
                'student_id' => 4,
                'asg' => 72,
                'project' => 72,
                'exam' => 89,
            ],[
                'classroom_id' => 3,
                'student_id' => 6,
                'asg' => 90,
                'project' => 0,
                'exam' => 0,
            ],[
                'classroom_id' => 3,
                'student_id' => 8,
                'asg' => 0,
                'project' => 0,
                'exam' => 100,
            ],[
                'classroom_id' => 3,
                'student_id' => 10,
                'asg' => 26,
                'project' => 0,
                'exam' => 25,
            ],
        ];

        foreach ($data as $value) {
            StudentClassroom::insert([
                'classroom_id'=> $value['classroom_id'],
                'student_id'=> $value['student_id'],
                'asg' => $value['asg'],
                'exam' => $value['exam'],
                'project' => $value['project'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
