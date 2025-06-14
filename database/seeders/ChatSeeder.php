<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pr5 = ['1', '2', '3'];
        $pr4 = ['3', '2', '1'];

        for ($i = 0; $i < 3; $i++) {
            Chat::query()->create([
                'p_student_id' => $pr5[$i],
                'director_id' => $pr4[$i],
            ]);
        }
    }
}
