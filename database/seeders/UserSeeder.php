<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $pr1 = ["0999999991@gmail.com",
            "0977777771@gmail.com","0977777772@gmail.com","0977777773@gmail.com","0977777774@gmail.com","0977777775@gmail.com",
            "0955555551@gmail.com","0955555552@gmail.com","0955555553@gmail.com","0955555554@gmail.com","0955555555@gmail.com",
            "0911111111@gmail.com","0911111112@gmail.com","0911111113@gmail.com","0911111114@gmail.com","0911111115@gmail.com"];
        $pr2 = ['119',
            "117",'337','557','777',
            '997','115','335','555', '775','995',
            '111','331','551','771','991'];

        $pr3 = ["manager",
            'director','director','director','director',"director",
            "p_student",'p_student','p_student','p_student','p_student',
            'student','student','student','student',"student"];
        for ($i = 0; $i < 16; $i++) {
            User::query()->create([
                'email' => $pr1[$i],
                'password' => $pr2[$i],
                "role" => $pr3[$i]
            ]);
        }

        //'0999999992','0999999993','0999999994','0999999995',      , '339','559','779','999'        'manager','manager','manager','manager',

    }
}
