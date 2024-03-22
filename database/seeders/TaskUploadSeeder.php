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
                'file_upload' => 'test.txt',
                'upload_date' => now(),
                'status' => 'In Review',
            ]
        ];

        foreach ($data as $dt) {
            TaskUpload::create($dt);
        }
    }
}
