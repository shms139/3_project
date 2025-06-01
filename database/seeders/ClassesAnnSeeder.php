<?php

namespace Database\Seeders;

use App\Models\Classes_Ann;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesAnnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pr5 = ['1', '2', '3'];
        $pr4 = ['1', '2', '3'];

        for ($i = 0; $i < 3; $i++) {
            Classes_Ann::query()->create([
                'announcement_id' => $pr5[$i],
                'the_class_id' => $pr4[$i],
            ]);
        }
    }

}
