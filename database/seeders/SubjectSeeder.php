<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pr8 = ['arabic', 'math', "english", 'physics', 'factory'];
        for ($i = 0; $i < 5; $i++) {
            Subject::query()->create([
                'subject' => $pr8[$i],
                ]);
        }
    }
}
