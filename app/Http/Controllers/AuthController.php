<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Director;
use App\Models\P_student;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\password;

class AuthController extends Controller
{
// $user = User::with(['student', 'director', 'admin'])->find($userId);

    public function login(Request $request)
    {
        $request->validate([

            "email" => ["required", 'email', "exists:users,email"],
            "password" => ["required", 'string'],
            // "role" => ["required", "string", "in:student,manager,admin"],
        ]);

        if (!Auth::attempt($request->only(['email', 'password']))) {
            $message = "email & Password does not match with our record.";
            return response()->json([
                "data" => [],
                "status" => 0,
                "message" => $message
            ], 400);

        } else {
            $user = [];
            $user = User::query()->where("email", "=", $request["email"])->first();
            $token = $user->createToken("API TOKEN")->plainTextToken;
            $data = [];
            //  $user = User::query()->where('mobile','=' , "mobile")->get("mobile");
            $data["user"] = $user ['email'];
            //>select("password","username");
            $data["token"] = $token;

            // Check the user's role and redirect
            if ($user->role === 'student') {
                return response()->json([
                    "status" => 200,
                    "data" => $data,
                    'message' => 'Student logged in successfuly!',
//                    'redirect_url' => '/student/dashboard'
                ]);
            } elseif ($user->role === 'manager') {
                return response()->json([
                    "status" => 200,
                    "data" => $data,
                    'message' => 'Manager logged in successfuly',
//                    'redirect_url' => '/manager/dashboard'
                ]);
            } elseif ($user->role === 'director') {
                return response()->json([
                    "status" => 200,
                    "data" => $data,
                    'message' => 'director logged in successfuly!',
                    //'redirect_url' => '/dashboard'
                ]);
            } elseif ($user->role === 'p_student') {
                return response()->json([
                    "status" => 200,
                    "data" => $data,
                    'message' => 'p_student logged in successfuly!',
                    //'redirect_url' => '/dashboard'
                ]);

            };
        }
    }

    public function register_Director_in_admin(Request $request): JsonResponse
    {
        if (auth()->user()->role !== 'manager') {
            abort(403, 'Unauthorized');
        }
        $request->validate([
                'firstname' => ['required', 'string', 'max:10'],
                'lastname' => ['required', 'string', 'max:10'],
                'address' => ['required', 'string'],
                'date' => ['required', 'date', 'after:2000-01-01', 'before:2020-12-31'],
                'mobile' => ['required', 'unique:directors,mobile'],
                'password' => ['required'],
                'email' => ['required', 'email','unique:directors,email'],
                'user_id' => ['required']
            ]);

//        ], ['mobile.unique' => "Mobile is not unique"]// لتوضيح رسالة الخطأ للفلتر

        $user = Director::query()->create([
            'firstname' => $request['firstname'],
            'lastname' => $request["lastname"],
            'address' => $request["address"],
            //  'role' => $request["role"],
            //    'discount' => $request['Discount'],
            //    'parents_job' => $request["parents_job"],
            //  'the_class' => $request["status"],
            'date' => $request["date"],
            'mobile' => $request['mobile'],
            'password' => $request['password'],
            //   'subject' => $request['subject'],
            //  'salary'=>$request['salary'],
            'email' => $request["email"],
            'user_id' => $request['user_id']
        ]);

        return response()////return $request=> usernam ,mobile and password only but return  $user =>will come all migrate of model ex: username , mobile  password and id and date
        ->json([
            'status' => 1,
            "date" => $user,
            "message" => "director created successfuly"

        ]);
    }

    public function registerStudent(Request $request): JsonResponse
    {
        if (auth()->user()->role !== 'director') {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'firstname'    => ['required', 'string', 'max:10'],
            'lastname'     => ['required', 'string', 'max:10'],
            'address'      => ['required', 'string'],
            'parents_job'  => ['required', 'string'],
            'parents_name' => ['required', 'string'],
            'date'         => ['required', 'date', 'after:2010-01-01', 'before:2020-12-31'],
            'the_class'    => ['required', 'string', 'in:first,second,third,fourth,fifth'],
            'mobile'       => ['required', 'unique:students,mobile'],
            'password'     => ['required'],
            'email'        => ['required', 'email'],
            'director_id'  => ['required'],
            'user_id'      => ['required'],
            'p_student_id' => ['required'],
        ], [
            'mobile.unique' => "رقم الموبايل موجود مسبقاً",
        ]);

        $user = Student::query()->create([
            'firstname'    => $request['firstname'],
            'lastname'     => $request['lastname'],
            'address'      => $request['address'],
            'parents_job'  => $request['parents_job'],
            'parents_name' => $request['parents_name'],
            'the_class'    => $request['the_class'],
            'date'         => $request['date'],
            'mobile'       => $request['mobile'],
            'password'     => $request['password'],
            'email'        => $request['email'],
            'director_id'  => $request['director_id'],//لا يصح أن تضع بالداتا بيز أكثر من ثلاثة إلا إلا عندك بالداتا بز أكثر من ثلاثة
            'p_student_id' => $request['p_student_id'],// لا يصح أن تضع الجواب أكثر من خمسة إلا إذا عندك بالداتا بيز أكثر من خمسة آباء
            'user_id'      => $request['user_id'],
            ]);


        return response()////return $request=> usernam ,mobile and password only butreturn  $user =>will come all migrate of model ex: username , mobile  password and id and date
        ->json([
            'status' => 1,
            "date" => $user,
            "message" => "Student created successfuly"
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


    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 1,
            "date" => [],
            'message' => ' You are loged out successfuly'
        ]);
    }

    public function user($id): JsonResponse // لم أعرف أكمله
    {

        $user = [];
        $user = User::where("id", $id)->get();
        //    dd($produ);
        return response()->json([  //$this->sendResponse($produ,200);
            'success' => true,
            'data' => $user,
            'message' => " The details of the student ",
        ]);
    }

    public function index_Ann()
    {
        $Ann = Announcement::all();//find(1);
        return $Ann;
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
        $show_det_st = Student::where("id", $id)->get();
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
        $student = Student::where("id", $id)->get();//find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'الطالب غير موجود'
            ], 404);
        }
        // الحذف
        $student->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الطالب بنجاح'
        ]);
    }

//        // إعادة التوجيه مع رسالة نجاح
//        return redirect()->route('students.index')->with('success', 'تم حذف الطالب بنجاح');


  /*  public function index2($id){
        $products = Drug::where('quality_id' , $id)->get();

        //dd($products);
        // echo $oneProd->name;
        return $this->sendResponse($products,200);
    }
*/
}
