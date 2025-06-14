<?php

namespace Database\Seeders;

use App\Models\P_student;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

//


        $pr1 = ["0911111111", '0911111112', '0911111113', '0911111114', '0911111115'];
        $pr2 = ['111', '331', "551", '771', '991'];
        $pr3 = ['st1', 'st2', "st3", 'st4', 'st5'];
        $pr4 = ['st1', 'st2', "st3", 'st4', 'st5'];
        $pr6 = ['2020/5/5', '2020/5/7', "2020/5/9", '2020/5/11', '2020/5/13'];
        $pr7 = ['damascus', 'hamaa', "halap", 'homs', 'idlibe'];
        $pr9 = ['first', 'second', "third", "fourth", 'fifth'];
        $pr11 = ['psn1', 'psn2', "psn3", 'psn4', 'psn5'];
        $pr8 = ['teacher', 'doctor', "dentist", 'physical', 'factors'];
        $pr10 = ['0911111111@gmail.com', '0911111112@gmail.com', '0911111113@gmail.com', "0911111114@gmail.com", '0911111115@gmail.com'];
        $pr5 = ['12', '13', '14', '15', '16'];
        $pr12 = ['1', '2', '4', '5', '3'];


//        $parentIds = P_student::pluck('id'); // يعيد Collection من IDs فقط
//
//        foreach ($parentIds as $parentId) {
//            Student::create([
//                'p_student_id' => $parentId,
//            ]);
//        }

//        $parents = P_student::all();
//
//        foreach ($parents as $parent) {
//            Student::create([
//                'p_student_id' => $parent->id,
//            ]);
//        }

//        $parentIds = P_student::pluck('id'); // Get all parent IDs
//
//        for ($i = 0; $i < 5; $i++) {
//            Student::create([
//                'p_student_id' => $parentIds[$i] ?? null, // Safely get parent ID or null
//                'mobile' => $pr1[$i],
//                'password' => $pr2[$i],
//                'firstname' => $pr3[$i],
//                'lastname' => $pr4[$i],
//                'user_id' => $pr5[$i],
//                'date' => $pr6[$i],
//                'address' => $pr7[$i],
//                'the_class' => $pr9[$i],
//                'parents_job' => $pr8[$i],
//            ]);
//        }

        $parentIds = P_student::pluck('id'); // Get all parent IDs

        for ($i = 0; $i < 5; $i++) {
            Student::query()->create([
                'mobile' => $pr1[$i],
                'password' => $pr2[$i],
                'email' => $pr10[$i],
                "firstname" => $pr3[$i],
                "lastname" => $pr4[$i],
                "user_id" => $pr5[$i],
                "date" => $pr6[$i],
                "address" => $pr7[$i],
                "the_class" => $pr9[$i],
                "parents_job" => $pr8[$i],
                "parents_name" => $pr11[$i],
                'director_id' => $pr12[$i],
                'p_student_id' => $parentIds[$i] ?? null, // Safely get parent ID or null
            ]);
        }
    }
}
