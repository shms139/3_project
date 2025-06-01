<?php

namespace Database\Seeders;

use App\Models\Director_PStudent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectorPStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pr5 = ['1', '2', '3'];
        $pr4 = ['1', '2', '3'];

        for ($i = 0; $i < 3; $i++) {
            Director_PStudent::query()->create([
                'p_student_id' => $pr5[$i],
                'director_id' => $pr4[$i],
            ]);
        }
    }
}
