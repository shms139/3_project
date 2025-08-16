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
        $pr4 = ['3', '2', '1'];
        $pr3 = ['تأخر', 'مشاغبة', 'علامة كاملة وتميز'];
        $pr1 = ['تأخر ثلث ساعة عن الحصة الأولى', 'ضبط يأكل أثناء الحصة الدراسية', 'أحرز العلامة التامة في مادة اللغة العربية'];
        $pr2 = ['2025/6/20', '2025/6/10', '2025/6/6'];

        for ($i = 0; $i < 3; $i++) {
            Chat::query()->create([
                'p_student_id' => $pr5[$i],
                'director_id' => $pr4[$i],
                'title' => $pr3[$i],
                'body' => $pr1[$i],
                "date" => $pr2[$i],
            ]);
        }
    }
}
