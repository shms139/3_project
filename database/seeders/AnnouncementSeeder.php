<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pr1 = ["واستغلوا أوقاتكم" ,'بروا أمهاتكم وآبائكم','2025\5\5'];
        $pr2 = ['2024/5/5', '2024/5/7', "2024/5/9"];
        $pr5 = ['1', '1' ,'1'];
        $pr3 = ["نصائح" ,'طرق النجاح ',' تاريخ برنامج الامتحانات '];


        for ($i = 0; $i < 3; $i++) {
            Announcement::query()->create([
                "title" =>$pr3[$i],
                'body' => $pr1[$i],
                'date' => $pr2[$i],
                "admin_id" => $pr5[$i]
            ]);
        }
    }
}
