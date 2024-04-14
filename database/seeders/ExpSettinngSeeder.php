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
            'exp_bronze' => 0,
            'exp_silver' => 0,
            'exp_gold' => 0,
            'exp_purple' => 0,
            'exp_emerlad' => 0,
            'do_quest' => 0,
            'do_asg' => 0,
            'do_exam' => 0,
            'do_project' => 0,
            'create_task' => 0,
            'create_question' => 0
        ]);
    }
}
