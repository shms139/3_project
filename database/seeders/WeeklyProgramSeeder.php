<?php

namespace Database\Seeders;

use App\Models\WeeklyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeeklyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $p2 = ['1','2','3'];
        $pr1 = ['1','3','5']; // or $pr1 = 1; if it's an integer
        for ($i = 0; $i < 3; $i++) {

            WeeklyProgram::query()->create([
                'director_id' => $pr1[$i],
                "the_class_id" => $p2[$i],
            ]);
        }
    }
}
