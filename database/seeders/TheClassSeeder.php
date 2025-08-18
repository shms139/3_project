<?php

namespace Database\Seeders;

use App\Models\TheClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TheClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $pr5 = ['1', '2' ,'3'];
        $pr1 = ['first','second','third','fourth','fifth'];

        for ($i = 0; $i < 5; $i++) {
            TheClass::query()->create([
//                'class_ann_id' => $pr5[$i],
                'name' => $pr1[$i],
            ]);
        }
    }
}
