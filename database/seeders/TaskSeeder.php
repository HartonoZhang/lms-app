<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
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
                'task_category_id' => 1,
                'description' => 'Buatlah sebuah aplikasi menggunakan laravel',
                'deadline' => '2024-03-20 12:00:00',
                'question_file' => 'test.txt',
                'title' => 'Tugas 1',
            ],
            [
                'classroom_id' => 1,
                'teacher_id' => 1,
                'task_category_id' => 2,
                'description' => 'Buatlah 10 aplikasi menggunakan laravel',
                'deadline' => '2024-06-20 12:00:00',
                'question_file' => 'test.txt',
                'title' => 'Mid Exam',
            ],
        ];

        foreach ($data as $dt) {
            Task::create($dt);
        }
    }
}
