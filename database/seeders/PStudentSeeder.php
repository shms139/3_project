<?php

namespace Database\Seeders;

use App\Models\P_student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pr1 = ["0955555551" , '0955555552','0955555553','0955555554','0955555555'];
        $pr2 = ['115', '335', "555",'775','995'];
        $pr3 = ['p_s1', 'p_s2', "p_s3",'p_s4','p_s5'];
        $pr4 = ['p_s1', 'p_s2', "p_s3",'p_s4','p_s5'];
        $pr6 = ['son_p_s1', 'son_p_s2', "son_p_s3","son_p_s4","son_p_s5"];
        $pr7 = ['0955555551@gmail.com', '0955555552@gmail.com', "0955555553@gmail.com","0955555554@gmail.com","0955555555@gmail.com"];
        $pr5 = ['7', '8' ,'9','10','11'];
        for ($i = 0; $i < 5; $i++) {
            P_student::query()->create([
                'mobile' => $pr1[$i],
                'password' => $pr2[$i],
                "firstname" => $pr3[$i],
                "lastname" => $pr4[$i],
                "son_name" => $pr6[$i],
                "email" => $pr7[$i],

                "user_id" => $pr5[$i],
            ]);
        }
    }
}
