<?php

namespace Database\Seeders;

use App\Models\Thread;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataThread = [
            [
                'session_id' => 1,
                'user_id' => 2,
                'title' => 'Announcement',
                'description' => 'tesssssssssssssssssss',
            ],
            [
                'session_id' => 1,
                'user_id' => 2,
                'title' => 'Announcement 2',
                'description' => 'tesssssssssssssssssss2',
            ],
        ];

        foreach ($dataThread as $thread) {
            Thread::create($thread);
        }
    }
}
