<?php

namespace Database\Seeders;

use App\Models\TeacherClassroom;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherClassroomSeeder extends Seeder
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
                'teacher_id' => 1,
            ],[
                'classroom_id' => 2,
                'teacher_id' => 2,
            ],[
                'classroom_id' => 2,
                'teacher_id' => 3,
            ],[
                'classroom_id' => 3,
                'teacher_id' => 3,
            ],[
                'classroom_id' => 3,
                'teacher_id' => 4,
            ],[
                'classroom_id' => 4,
                'teacher_id' => 1,
            ],[
                'classroom_id' => 4,
                'teacher_id' => 2,
            ],[
                'classroom_id' => 4,
                'teacher_id' => 3,
            ],[
                'classroom_id' => 4,
                'teacher_id' => 4,
            ],[
                'classroom_id' => 4,
                'teacher_id' => 5,
            ],[
                'classroom_id' => 4,
                'teacher_id' => 6,
            ],[
                'classroom_id' => 4,
                'teacher_id' => 7,
            ],[
                'classroom_id' => 4,
                'teacher_id' => 8,
            ],[
                'classroom_id' => 4,
                'teacher_id' => 9,
            ],[
                'classroom_id' => 4,
                'teacher_id' => 10,
            ],
        ];

        foreach ($data as $value) {
            TeacherClassroom::insert([
                'classroom_id'=> $value['classroom_id'],
                'teacher_id'=> $value['teacher_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
