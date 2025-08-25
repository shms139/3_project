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
       //$user = Auth::user()->load('student');
      //$user = User::with('student')->find($id);
        $user = User::where("id", $id)->first();

   //     if ($user->isEmpty()) {
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على المستخدم'
            ], 404);
        }
        if ($user->role === 'student') {
            $user->load('student');
        }
        if ($user->role === 'director') {
            $user->load('director');
        }
        if ($user->role === 'p_student') {
            $user->load('p_student');
        }

        return response()->json([  //$this->sendResponse($produ,200);
            'success' => true,
            'data' => $user,
            'message' => " The details of the user ",
        ]);
    }

//        // إعادة التوجيه مع رسالة نجاح
//        return redirect()->route('students.index')->with('success', 'تم حذف الطالب بنجاح');

}
