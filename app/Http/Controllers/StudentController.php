<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\P_student;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        return $user->mobile;

        $student = Student::find(1);
        return  $student->user_id;//mobile
    }

    public  function add_value_in_student()
    {
        // this is very clear code and funtastic but i dont use it because it up
        // in this i can entered the foreign key and son_name with relation
//        $parents = ParentStudent::pluck('id')->toArray(); // [1, 2, 3]
//        $names = ['خالد', 'سلمان', 'يوسف'];
//
//        foreach ($names as $index => $studentName) {
//            Student::create([
//                'name' => $studentName,
//                'parent_student_id' => $parents[$index],
//            ]);
//      }
    }


}
