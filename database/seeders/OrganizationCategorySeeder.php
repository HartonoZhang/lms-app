<?php

namespace Database\Seeders;

use App\Models\OrganizationCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrganizationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Sekolah'],
            ['name' => 'Kursus'],
            ['name' => 'Universitas']
        ];

        foreach ($data as $value) {
            OrganizationCategory::insert([
                'name'=> $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
