<?php

namespace App\Http\Controllers;

use App\Models\Check;
use App\Models\Director;
use App\Models\Director_PStudent;
use App\Models\Mark;
use App\Models\P_student;
use App\Models\Student;
use App\Models\User;
use App\Models\WeeklyProgram;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
    public function dashboard()
    {
        return view('director.dashboard');
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

    public function registerParent_student(Request $request): RedirectResponse
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }

        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:10'],
            'lastname' => ['required', 'string', 'max:10'],
            'son_name' => ['required', 'string'],
            'mobile' => ['required', 'unique:p_students,mobile'],
            'password' => ['required', 'string'],
            'user_id' => ['required'],
            'email' => ['required', 'email'],
        ], [
            'mobile.unique' => "Mobile is not unique",
        ]);

        $user = P_student::query()->create([
            'firstname' => $request['firstname'],
            'lastname' => $request["lastname"],
            'son_name' => $request["son_name"],
            'mobile' => $request['mobile'],
            'password' => bcrypt($request['password']), // 🔐 تشفير الباسورد
            'email' => $request["email"],
            'user_id' => $request['user_id'],
        ]);

        // إرجاع المستخدم للداشبورد مع رسالة نجاح
        return redirect()->route('director.dashboard')
            ->with('success', "✅ تم تسجيل ولي أمر الطالب {$user->firstname} {$user->lastname} بنجاح!");
    }

    public function registerStudent(Request $request): RedirectResponse | JsonResponse
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        $validated =   $request->validate([
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
        $formats = ['Y-m-d', 'd-m-Y', 'd/m/Y'];// هذا بالبوستمان كيف ما بعتت التاريخ يقبله
        foreach ($formats as $format) {
            try {
                $validated['date'] = Carbon::createFromFormat($format, $validated['date'])->format('Y-m-d');
                break;
            } catch (\Exception $e) {
                // تجاهل وحاول بالصيغة التالية
            }
        }

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

        // إذا الطلب جاي من API (Postman)
        if ($request->wantsJson()) {
            return response()////return $request=> usernam ,mobile and password only butreturn  $user =>will come all migrate of model ex: username , mobile  password and id and date
            ->json([
                'status' => 1,
                "date" => $user,
                "message" => "Student created successfuly"
            ]);
        }
        return redirect()->route('director.students.create')->with('success', 'تم تسجيل الطالب بنجاح ✅');

    }

    public function index_students(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }

        $students = Student::all();

        // إذا الطلب جاي من API (Postman)
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $students,
                'message' => "The students",
            ]);
        }
        // إذا الطلب من الويب
        return view('director.students-index', compact('students'));
    }

    public function show_student_details(Request $request, $id)
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }

        $student = Student::with('marks')->findOrFail($id);

        // إذا API (Postman)
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $student,
                'message' => "The details of the student",
            ]);
        }

        // إذا الطلب من الويب
        return view('director.student-details', compact('student'));
    }

    public function destroy(Request $request, $id): \Illuminate\Http\JsonResponse | \Illuminate\Http\RedirectResponse
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }

        $student = Student::find($id);

        if (!$student) {
            // API
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'الطالب غير موجود'
                ], 404);
            }
            // ويب
            return redirect()->route('director.students.index')->with('error', 'الطالب غير موجود ❌');
        }
        $student->delete();
        // API
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الطالب بنجاح ✅'
            ]);
        }
        // ويب
        return redirect()->route('director.students.index')->with('success', 'تم حذف الطالب بنجاح ✅');
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

    public function getAllMarksByStudentInClass($studentId, $classId): JsonResponse
    {
        // جلب العلامات مع بيانات الطالب والمواد
        $marks = Mark::with( 'subject')
            ->where('student_id', $studentId)
            ->where('the_class_id', $classId)
            ->get();

        if ($marks->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'لا توجد علامات لهذا الطالب في هذا الصف'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $marks,
            'message' => 'تم جلب جميع علامات الطالب بنجاح'
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
        $validated =  $request->validate([
            'director_id' => 'required|exists:directors,id',
            'the_class_id' => 'required|exists:the_classes,id',
            'program_image' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // يسمح بصور و PDF
        ]);
        $formats = ['Y-m-d', 'd-m-Y', 'd/m/Y'];// هذا بالبوستمان كيف ما بعتت التاريخ يقبله
        foreach ($formats as $format) {
            try {
                $validated['date'] = Carbon::createFromFormat($format, $validated['date'])->format('Y-m-d');
                break;
            } catch (\Exception $e) {
                // تجاهل وحاول بالصيغة التالية
            }
        }

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

    // حفظ التفقد
    public function store_check(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'student_id'  => 'required|exists:students,id',
            'director_id' => 'required|exists:directors,id',
            'date'        => 'required|date',
            'status'      => 'required|in:حاضر,غائب,متأخر',
        ]);

        $formats = ['Y-m-d', 'd-m-Y', 'd/m/Y'];
        foreach ($formats as $format) {
            try {
                $validated['date'] = \Carbon\Carbon::createFromFormat($format, $validated['date'])->format('Y-m-d');
                break;
            } catch (\Exception $e) {
                // تجاهل وحاول بالصيغة التالية
            }
        }

        $check = Check::create($validated);

        // إذا الطلب API
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حفظ التفقد بنجاح',
                'data'    => $check,
            ]);
        }

        // إذا الطلب من الويب
        return redirect()->route('director.attendance')->with('success', '✅ تم تسجيل التفقد بنجاح');
    }

    public function attendanceForm()
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }

        // كل الطلاب لعرضهم في الفورم
        $students = Student::all();

        return view('director.attendance-create', compact('students'));
    }


    // عرض التفقد
    public function index_check(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\View
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }

        $query = Check::query();

        if ($request->has('date')) {
            $query->where('date', $request->date);
        }

        if ($request->has('director_id')) {
            $query->where('director_id', $request->director_id);
        }

        $records = $query->get();

        // إذا API (Postman)
        if ($request->wantsJson()) {
            if ($records->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'لا يوجد تفقد لهذه الصف'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'تم جلب التفقد بنجاح',
                'data' => $records
            ]);
        }

        // إذا ويب (Blade)
        return view('director.attendance-index', compact('records'));
    }


}
