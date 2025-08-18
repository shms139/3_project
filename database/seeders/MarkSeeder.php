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
        $pr1 = ['1', '2', '3'   ,'1','2','3'  ,'1', '2', '3'  ,'1', '2', '3'];
        $pr3 = ['1', '1', '1'   ,'2','2','2'  ,'1', '1', '1'  ,'2', '2', '2'];
        $pr5 = ['1', '1', '1'   ,'1','1','1'  ,'2', '2', '2'  ,'2', '2', '2'];
        $pr4 = ['1', '2', '2'   ,'2','2','2'  ,'2', '2', '2'  ,'2', '2', '2'];
        $pr2 = ['90','50','70', '50','90','100'  ,'100','98','89',  '99','97','96'];

        for ($i = 0; $i < 12; $i++) {
            Mark::query()->create([
                'student_id'   => $pr1[$i],
                'director_id'  => $pr4[$i],
                'the_class_id' => $pr3[$i],
                'subject_id'   =>$pr5[$i],
                'mark'         => $pr2[$i],
            ]);
        }
    }
}
