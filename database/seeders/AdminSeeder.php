<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
                "user_id"=> 1,
            ]
        ];

        foreach ($data as $value) {
            Admin::insert([
                'user_id' => $value['user_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
