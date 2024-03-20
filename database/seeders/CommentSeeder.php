<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataComment = [
            [
                'thread_id' => 1,
                'user_id' => 3,
                'description' => 'baik pak',
            ],
            [
                'thread_id' => 2,
                'user_id' => 3,
                'description' => 'ok bu',
            ],
        ];

        foreach ($dataComment as $comment) {
            Comment::create($comment);
        }
    }
}
