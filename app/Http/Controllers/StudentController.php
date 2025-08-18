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

    public function index_students()
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        $stud = Student::all();//find(1);
        return response()->json([  //$this->sendResponse($produ,200);
            'success' => true,
            'data'    => $stud,
            'message' => " The students ",
        ]);
    }


    public function show_student_details($id)
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        $show_det_st = Student::where("id",'=', $id)->get();
        //   dd($show_det_st);
        return response()->json([
            'success' => true,
            'data' => $show_det_st,
            'message' => " The details of the student ",
        ]);
    }
    public function destroy($id)
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        // البحث عن الطالب
        $student = Student::where("id", $id)->delete();
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'الطالب غير موجود'
            ], 404);
        }
        // الحذف
        //   $student->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الطالب بنجاح'
        ]);
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
