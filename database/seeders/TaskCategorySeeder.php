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
                'classroom_id' => 1,
                'name' => 'Assignment'
            ],
            [
                'classroom_id' => 1,
                'name' => 'Exam'
            ],
        ];

        foreach ($data as $dt) {
            TaskCategory::create($dt);
        }
    }
}
