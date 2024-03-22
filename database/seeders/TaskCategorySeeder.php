<?php

namespace Database\Seeders;

use App\Models\TaskCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskCategorySeeder extends Seeder
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
                'name' => 'Assignment'
            ],
            [
                'name' => 'Exam'
            ],
            [
                'name' => 'Project'
            ],
        ];

        foreach ($data as $dt) {
            TaskCategory::create($dt);
        }
    }
}
