<?php

namespace App\Http\Controllers;

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
        $request->validate([
                'firstname' => ['required', 'string', 'max:10'],
                'lastname' => ['required', 'string', 'max:10'],
                'address' => ['required', 'string'],
                'date' => ['required', 'date', 'after:2010-01-01', 'before:2020-12-31'],
                'mobile' => ['required', 'unique:directors,mobile'],
                'password' => ['required'],
                'email' => ['required', 'email'],
            'user_id' => ['required']
            ]);

//        ], ['mobile.unique' => "Mobile is not unique"]// لتوضيح رسالة الخطأ للفلتر

        $user = Director::query()->create([
            'firstname' => $request['username'],
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
        dd();

        return response()////return $request=> usernam ,mobile and password only butreturn  $user =>will come all migrate of model ex: username , mobile  password and id and date
        ->json([
            'status' => 1,
            "date" => $user,
            "message" => "director created successfuly"
        ]);
    }

    public function registerStudent(Request $request): JsonResponse
    {
        $request->validate([
            'firstname' => ['required|string|max:10'],//
            'lastname' => ['required|string|max:10'],
            "address" => ['required|string'],
            // 'role' => ['required|in:,manager,guide', 'student'],
            // 'discount' => ['required|boolean'],
            'parents_job' => ['required|string'],
            'parents_name' => ['required|string'],
            'date' => ['required|date|after:2010-01-01|before:2020-12-31'],
            'the_class' => ["required", "string", "in::first,second,third,fourth,fifth "],
            "mobile" => ['required' | 'unique:users,mobile'],
            'password' => ['required'],
            //'salary'=>['reqired |integer|min:300000|max:700000'],
            'email' => ['required|email'],

        ], ['mobile.unique' => "Mobile is not unique"]// لتوضيح رسالة الخطأ للفلتر
        );

        $user = Student::query()->create([
            'firstname' => $request['username'],
            'lastname' => $request["lastname"],
            'address' => $request["address"],
            // 'role' => $request["role"],
            //    'discount' => $request['Discount'],
            'parents_job' => $request["parents_job"],
            'parents_name' => $request["parents_name"],
            'the_class' => $request["status"],
            'date' => $request["date"],
            'mobile' => $request['mobile'],
            'password' => $request['password'],
            //   'subject' => $request['subject'],
            //  'salary'=>$request['salary'],
            'email' => $request["email"],
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
        $request->validate([
            'firstname' => ['required|string|max:10'],//
            // 'lastname' => ['required|string|max:10'],
            //"address" => ['required|string'],
            // 'role' => ['required|in:,manager,guide', 'student'],
            // 'discount' => ['required|boolean'],
            'son_name' => ['required|string'],
            // 'date' => ['required|date|after:2010-01-01|before:2020-12-31'],
            // 'the_class' => ["required", "string", "in::first,second,third,fourth,fifth "],
            "mobile" => ['required' | 'unique:users,mobile'],
            'password' => ['required|string'],
            //'salary'=>['reqired |integer|min:300000|max:700000'],
            'email' => ['required|email'],
        ], ['mobile.unique' => "Mobile is not unique"]// لتوضيح رسالة الخطأ للفلتر
        );

        $user = P_student::query()->create([
            'firstname' => $request['username'],
            'lastname' => $request["lastname"],
            //   'address' => $request["address"],
            //   'role' => $request["role"],
            //    'discount' => $request['Discount'],
            'son_name' => $request["parents_job"],
            //   'parents_name' => $request["parents_name"],
            // 'the_class' => $request["status"],
            //'date' => $request["date"],
            'mobile' => $request['mobile'],
            'password' => $request['password'],
            //   'subject' => $request['subject'],
            //  'salary'=>$request['salary'],
            'email' => $request["email"],
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

    public function user($id): JsonResponse
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
}

