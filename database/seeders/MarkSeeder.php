<?php

namespace Database\Seeders;

use App\Models\Mark;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pr5 = ['1', '2', '3'];
        $pr4 = ['3', '2', '1'];
        $pr3 = ['3', '2', '1'];
        $pr2 = ['90', '50', '70'];
        $pr1 = ['3', '2', '1'];

        for ($i = 0; $i < 3; $i++) {
            Mark::query()->create([
                'student_id' => $pr5[$i],
                'director_id' => $pr4[$i],
                'the_class_id' => $pr3[$i],
                'subject_id' =>$pr1[$i],
                'mark' => $pr2[$i],
            ]);
        }
    }
}
