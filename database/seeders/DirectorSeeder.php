<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $pr1 = ["0977777771" , '0977777772','0977777773','0977777774','0977777775'];
        $pr2 = ['117', '337', "557",'777','997'];
        $pr3 = ['dir1', 'dir2', "dir3",'di4','di5'];
        $pr4 = ['dir1', 'dir2', "dir3",'di4','di5'];
          $pr8 = ['0977777771@gmail.com', '0977777772@gmail.com', "0977777773@gmail.com",'0977777774@gmail.com','0977777775@gmail.com'];
        $pr6 = ['2020/5/5', '2020/5/7', "2020/5/9",'2020/5/11','2020/5/13'];
        $pr7 = ['damascus', 'hamaa', "halap",'homs','idlibe'];
        $pr5 = ['2', '3' ,'4','5','6'];

        for ($i = 0; $i < 5; $i++) {
            Director::query()->create([
                'mobile' => $pr1[$i],
                'email' => $pr8[$i],
                'password' => $pr2[$i],
                "firstname" => $pr3[$i],
                "lastname" => $pr4[$i],
                "date" => $pr6[$i],
                "address" => $pr7[$i],
                "user_id" => $pr5[$i],
            ]);
        }


    }
}
