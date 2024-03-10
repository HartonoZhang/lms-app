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
            ],[
                'classroom_id' => 1,
                'student_id' => 3,
            ],[
                'classroom_id' => 1,
                'student_id' => 5,
            ],[
                'classroom_id' => 1,
                'student_id' => 7,
            ],[
                'classroom_id' => 1,
                'student_id' => 9,
            ],[
                'classroom_id' => 2,
                'student_id' => 1,
            ],[
                'classroom_id' => 2,
                'student_id' => 2,
            ],[
                'classroom_id' => 2,
                'student_id' => 3,
            ],[
                'classroom_id' => 2,
                'student_id' => 5,
            ],[
                'classroom_id' => 2,
                'student_id' => 7,
            ],[
                'classroom_id' => 2,
                'student_id' => 9,
            ],[
                'classroom_id' => 3,
                'student_id' => 2,
            ],[
                'classroom_id' => 3,
                'student_id' => 4,
            ],[
                'classroom_id' => 3,
                'student_id' => 6,
            ],[
                'classroom_id' => 3,
                'student_id' => 8,
            ],[
                'classroom_id' => 3,
                'student_id' => 10,
            ],
        ];

        foreach ($data as $value) {
            StudentClassroom::insert([
                'classroom_id'=> $value['classroom_id'],
                'student_id'=> $value['student_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
