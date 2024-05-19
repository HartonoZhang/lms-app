<?php

namespace Database\Seeders;

use App\Models\ExpSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpSettinngSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpSetting::insert([
            'exp_bronze' => 5000,
            'exp_silver' => 10000,
            'exp_gold' => 15000,
            'exp_purple' => 20000,
            'exp_emerald' => 25000,
            'do_quest' => 50,
            'do_asg' => 100,
            'do_exam' => 1000,
            'do_project' => 1500,
            'create_task' => 250,
            'create_question' => 50
        ]);
    }
}
