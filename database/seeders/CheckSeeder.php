<?php

namespace Database\Seeders;

use App\Models\Check;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pr5 = ['1', '2', '3'];
        $pr4 = ['1', '2', '3'];
        $pr3 = ['2012/2/2', '2012/1/1', '2013/2/3'];
        $pr2 = ['حاضر', 'غائب', 'متأخر'];

        for ($i = 0; $i < 3; $i++) {
            Check::query()->create([
                'student_id' => $pr5[$i],
                'director_id' => $pr4[$i],
                'date' => $pr3[$i],
                'status' => $pr2[$i],
            ]);
        }
    }
}
