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
                'period_id' => '1',
                'asg' => 30,
                'exam' => 40,
                'project' => 30,
                'min_score' => 50,
            ],[
                'course_id' => 2,
                'name'=> 'Exam Room',
                'code'=> 'LK01',
                'student_capacity' => 30,
                'period_id' => '2',
                'asg' => 20,
                'exam' => 40,
                'project' => 40,
                'min_score' => 75,
            ],[
                'course_id' => 3,
                'name'=> 'VIP Class',
                'code'=> 'LI01',
                'student_capacity' => null,
                'period_id' => '3',
                'asg' => 25,
                'exam' => 35,
                'project' => 40,
                'min_score' => 35,
            ]
        ];

        foreach ($data as $value) {
            Classroom::insert([
                'course_id'=> $value['course_id'],
                'name'=> $value['name'],
                'code'=> $value['code'],
                'student_capacity'=> $value['student_capacity'],
                'asg' => $value['asg'],
                'exam' => $value['exam'],
                'project' => $value['project'],
                'min_score' => $value['min_score'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'period_id' => $value['period_id'],
            ]);
        }
    }
}
