<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pr1 = ["0999999991" ];//, '0999999992','0999999993','0999999994',"0999999995"
        $pr2 = ['119'];//, '339', "559",'779','999'];
        $pr3 = ['ad1'];//, 'ad2', "ad3",'ad4','ad5'];
        $pr4 = ['ad1'];//, 'ad2', "ad3",'ad4','ad5'];
        $pr5 = ['1']; //, '2' ,'3','4','5'];
        for ($i = 0; $i < 1; $i++) {
            Admin::query()->create([
                'mobile' => $pr1[$i],
                'password' => $pr2[$i],
                "firstname" => $pr3[$i],
                "lastname" => $pr4[$i],
                "user_id" => $pr5[$i],
                //"user_id" => $pr3[$i]
            ]);
        }
    }
}
