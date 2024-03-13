<?php

namespace Database\Seeders;

use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::insert([
            'name' => 'SMA Santo Yusuf',
            'category_id' => 1,
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
