<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Mark;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        return $user->mobile;

        $director = Director::find(1);
        return  $director->user_id;//mobile
    }

    //جلب أولياء الأمور لمدير:
  public function show()
  {
   //   $director->load('p_Students');
  //    foreach ($director->parentStudents as $parent) {
         //echo $parent->name;
    //      return response()->json($director); // يعرض جميع المرتبطين مع الموجه بالعلاقة جميع أوليا الأمور

      //}
  }
  public function add_mark ()
  {
      Mark::create([
          'student_id' => 1,
          'director_id' => 2,
          'class_model_id' => 3,
          'subject_id' => 4,
          'mark' => 95
      ]);

  }
}
