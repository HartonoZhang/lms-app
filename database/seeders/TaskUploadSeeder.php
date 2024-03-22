<?php

namespace Database\Seeders;

use App\Models\TaskUpload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskUploadSeeder extends Seeder
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
                'task_id' => 1,
                'student_id' => 1,
                'title' => 'Jawaban asg 1',
                'answer_file' => 'test.txt',
            ]
        ];

        foreach ($data as $dt) {
            TaskUpload::create($dt);
        }
    }
}
