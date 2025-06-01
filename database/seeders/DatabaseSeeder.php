<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            DirectorSeeder::class,
            PStudentSeeder::class,
            StudentSeeder::class,
            DirectorPStudentSeeder::class,
            AnnouncementSeeder::class,
            TheClassSeeder::class,
            ClassesAnnSeeder::class,
            WeeklyProgramSeeder::class,
        ]);
    }
}
