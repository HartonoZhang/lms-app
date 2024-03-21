<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserRoleSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            AdminSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
            CourseSeeder::class,
            PeriodSeeder::class,
            ClassroomSeeder::class,
            TeacherClassroomSeeder::class,
            StudentClassroomSeeder::class,
            OrganizationCategorySeeder::class,
            OrganizationSeeder::class,
            SessionSeeder::class
        ]);
    }
}
