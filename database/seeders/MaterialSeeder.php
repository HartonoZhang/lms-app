<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataMaterial = [
            [
                'session_id' => 1,
                'title' => 'Youtube',
                'value' => 'https://www.youtube.com',
                'is_file' => 0,
            ],
            [
                'session_id' => 1,
                'title' => 'Test File',
                'value' => 'test.txt',
                'is_file' => 0,
            ],
            [
                'session_id' => 1,
                'title' => 'Google',
                'value' => 'https://www.google.com',
                'is_file' => 1,
            ],
        ];

        foreach ($dataMaterial as $material) {
            Material::create($material);
        }
    }
}
