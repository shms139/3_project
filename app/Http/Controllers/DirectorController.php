<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Director_PStudent;
use App\Models\Mark;
use App\Models\P_student;
use App\Models\Student;
use App\Models\User;
use App\Models\WeeklyProgram;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        return $user->mobile;

        $director = Director::find(1);
        return $director->user_id;//mobile
    }

    //جلب أولياء الأمور لمدير:
    public function show()
    {
        //   $director->load('p_Students');     or   p_students::with->("director")
        //    foreach ($director->parentStudents as $parent) {
        //echo $parent->name;
        //      return response()->json($director); // يعرض جميع المرتبطين مع الموجه بالعلاقة جميع أوليا الأمور

        //}
    }

    public function add_mark()
    {
        Mark::create([
            'student_id' => 1,
            'director_id' => 2,
            'class_model_id' => 3,
            'subject_id' => 4,
            'mark' => 95
        ]);
    }

    public function registerParent_student(Request $request): JsonResponse
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:10'],
            'lastname' => ['required', 'string', 'max:10'],
            // 'address' => ['required', 'string'],
            // 'role' => ['required', 'in:manager,guide,student'],
            // 'discount' => ['required', 'boolean'],
            'son_name' => ['required', 'string'],
            // 'date' => ['required', 'date', 'after:2010-01-01', 'before:2020-12-31'],
            // 'the_class' => ['required', 'string', 'in:first,second,third,fourth,fifth'],
            'mobile' => ['required', 'unique:p_students,mobile'],
            'password' => ['required', 'string'],
            'user_id' => ['required'],
            // 'salary' => ['required', 'integer', 'min:300000', 'max:700000'],
            'email' => ['required', 'email'],
        ], [
            'mobile.unique' => "Mobile is not unique",
        ]);

        $user = P_student::query()->create([
            'firstname' => $request['firstname'],
            'lastname' => $request["lastname"],
            //   'address' => $request["address"],
            //   'role' => $request["role"],
            //    'discount' => $request['Discount'],
            'son_name' => $request["son_name"],
            //   'parents_name' => $request["parents_name"],
            // 'the_class' => $request["status"],
            //'date' => $request["date"],
            'mobile' => $request['mobile'],
            'password' => $request['password'],
            //   'subject' => $request['subject'],
            //  'salary'=>$request['salary'],
            'email' => $request["email"],
            'user_id' => $request['user_id'],

        ]);

        return response()////return $request=> username ,mobile and password only but return  $user =>will come all migrate of model ex: username , mobile  password and id and date
        ->json([
            'status' => 1,
            "date" => $user,
            "message" => "parent_Student created successfuly"
        ]);
    }

    public function registerStudent(Request $request): \Illuminate\Http\JsonResponse
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'firstname' => ['required', 'string', 'max:10'],
            'lastname' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string'],
            'parents_job' => ['required', 'string'],
            'parents_name' => ['required', 'string'],
            'date' => ['required', 'date', 'after:2010-01-01', 'before:2020-12-31'],
            'the_class' => ['required', 'string', 'in:first,second,third,fourth,fifth'],
            'mobile' => ['required', 'unique:students,mobile'],
            'password' => ['required'],
            'email' => ['required', 'email'],
            'director_id' => ['required'],
            'user_id' => ['required'],
            'p_student_id' => ['required'],
        ], [
            'mobile.unique' => "رقم الموبايل موجود مسبقاً",
        ]);

        $user = Student::query()->create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'address' => $request['address'],
            'parents_job' => $request['parents_job'],
            'parents_name' => $request['parents_name'],
            'the_class' => $request['the_class'],
            'date' => $request['date'],
            'mobile' => $request['mobile'],
            'password' => $request['password'],
            'email' => $request['email'],
            'director_id' => $request['director_id'],//لا يصح أن تضع بالداتا بيز أكثر من ثلاثة إلا إلا عندك بالداتا بز أكثر من ثلاثة
            'p_student_id' => $request['p_student_id'],// لا يصح أن تضع الجواب أكثر من خمسة إلا إذا عندك بالداتا بيز أكثر من خمسة آباء
            'user_id' => $request['user_id'],
        ]);


        return response()////return $request=> usernam ,mobile and password only butreturn  $user =>will come all migrate of model ex: username , mobile  password and id and date
        ->json([
            'status' => 1,
            "date" => $user,
            "message" => "Student created successfuly"
        ]);
    }

    public function index_students()
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        $stud = Student::all();//find(1);
        return response()->json([  //$this->sendResponse($produ,200);
            'success' => true,
            'data' => $stud,
            'message' => " The students ",
        ]);
    }

    public function show_student_details($id)
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        $show_det_st = Student::where("id", '=', $id)->get();
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

    // إضافة علامة لطالب
    public function addMark(Request $request): JsonResponse
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'director_id' => 'required|exists:directors,id',
            'the_class_id' => 'required|exists:the_classes,id',
            'mark' => 'required|integer|min:0|max:100',
//            'exam_date'  => 'required|date',
        ]);

        // التحقق من وجود العلامة مسبقًا
        $exists = Mark::where('student_id', $request->student_id)
            ->where('subject_id', $request->subject_id)
            ->where('the_class_id', $request->the_class_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'تم تسجيل علامة لهذا الطالب في هذه المادة وهذا الصف من قبل.'
            ], 409);
        }

        // إضافة العلامة إذا ما كانت موجودة

        $mark = Mark::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'the_class_id' => $request->the_class_id,
            'director_id' => $request->director_id,
            'mark' => $request->mark,
            //  'exam_date'  => $request->exam_date,
        ]);

        return response()->json([
            'success' => true,
            'data' => $mark,
            'message' => 'تمت إضافة العلامة بنجاح',
        ]);
    }

    // جلب علامات الطلاب حسب الصف والمادة


    public function getMarksByClassAndSubject($classId, $subjectId): JsonResponse
    {//  $studentIdو        ->where('student_id', $studentId)    شرط الصف

//        $marks = Mark::with('student') أحضر داتا العلمات و الطالب  with('student')
//            ->where('the_class_id', $classId)
//            ->where('subject_id', $subjectId)
//            ->get();
//
        $marks = Mark::where('the_class_id', $classId)
            ->where('subject_id', $subjectId)
            ->get();



        if ($marks->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'لا توجد علامات لهذه المادة في هذا الصف'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $marks,
            'message' => 'تم جلب العلامات بنجاح'
        ]);
    }

    public function getStudentDetailsByMark($markId): JsonResponse
    {
        $mark = Mark::with('student')->find($markId);

        if (!$mark) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على العلامة'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'student' => $mark->student, // تفاصيل الطالب المرتبط بالعلامة
            'mark'    => $mark->mark,
            'message' => 'تم جلب تفاصيل الطالب بنجاح'
        ]);
    }

    public function storeWeeklyProgram(Request $request): JsonResponse
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'director_id' => 'required|exists:directors,id',
            'the_class_id' => 'required|exists:the_classes,id',
            'program_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // صورة فقط
        ]);

        // رفع الصورة وتخزينها
        $imagePath = $request->file('program_image')->store('صور', 'public');
        // إنشاء سجل جديد
        $program = WeeklyProgram::create([
            'program_image' => $imagePath,
            'director_id' => $request->director_id,
            'the_class_id' => $request->the_class_id,
        ]);
        // رجوع استجابة JSON
        return response()->json([
            'success' => true,
            'message' => 'تمت إضافة البرنامج الأسبوعي بنجاح',
            'data' => $program
        ]);
    }
    public function indexWeeklyPrograms(): JsonResponse
    {
        // جلب كل البرامج مع روابط الصور الكاملة
        $programs = WeeklyProgram::all()->map(function($program) {
            $program->program_image_url = asset('storage/' . $program->program_image);
            return $program;
        });

        return response()->json([
            'success' => true,
            'message' => 'تم جلب البرامج الأسبوعية بنجاح',
            'data' => $programs
        ]);
    }

}
