<?php

namespace Database\Seeders;

use App\Models\Period;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
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
                'name' => '2020, Odd Semester'
            ],[
                'name' => '2020, Even Semester'
            ],[
                'name' => '2020, Short Semester'
            ],[
                'name' => '2021, Odd Semester'
            ],[
                'name' => '2021, Even Semester'
            ],[
                'name' => '2021, Short Semester'
            ],[
                'name' => '2022, Odd Semester'
            ]
        ];
        foreach ($data as $value) {
            Period::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
