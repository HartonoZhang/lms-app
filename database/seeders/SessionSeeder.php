<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Material;
use App\Models\Session;
use App\Models\Thread;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSession = [
            [
                'classroom_id' => 1,
                'title' => 'Intro to course 1',
                'description' => 'desc 1',
                'start_time' => '2024-03-29 12:00:00',
                'end_time' => '2024-03-29 13:00:00',
                'value' => 'Ruang 1',
                'is_online' => false,
            ],
            [
                'classroom_id' => 1,
                'title' => 'Intro to course 2',
                'description' => 'desc 2',
                'start_time' => '2024-04-01 12:00:00',
                'end_time' => '2024-04-01 13:00:00',
                'value' => 'https://www.youtube.com',
                'is_online' => true,
            ],
            [
                'classroom_id' => 1,
                'title' => 'Intro to course 3',
                'description' => 'desc 3',
                'start_time' => '2024-04-02 12:00:00',
                'end_time' => '2024-04-02 13:00:00',
                'value' => 'Ruang 1',
                'is_online' => false,
            ],
            [
                'classroom_id' => 1,
                'title' => 'Intro to course 4',
                'description' => 'desc 4',
                'start_time' => '2024-04-03 12:00:00',
                'end_time' => '2024-04-03 13:00:00',
                'value' => 'Ruang 1',
                'is_online' => false,
            ],
            [
                'classroom_id' => 1,
                'title' => 'Intro to course 5',
                'description' => 'desc 5',
                'start_time' => '2024-04-04 12:00:00',
                'end_time' => '2024-04-04 13:00:00',
                'value' => 'Ruang 1',
                'is_online' => false,
            ],
        ];

        foreach ($dataSession as $session) {
            Session::create($session);
        }
    }
}
