<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Director;
use App\Models\User;
use Cassandra\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // here relation between admin and user
    public function index()
    {
        $user = User::find(1);
        return $user->mobile;

//        $admin = Admin::find(1);
//        return  $admin->user_id;//mobile
    }

    public function Announcements()
    {
        $admin_ann = Admin::find(1);
        return $admin_ann->body;

//
//        $director = Director::with('announcements')->find(1);
//        foreach ($director->announcements as $announcement) {
//            return $announcement->title;//echo
//        }
    }


        public function createAnnouncements(Request $request): JsonResponse
        {
            if (auth()->user()->role !== 'manager') {
                abort(403, 'Unauthorized');
            }
            $admin_id = $request->admin_id;
            $body = $request->body;
            $title = $request->title;
            $date = $request->date;

            $request->validate([
                "admin_id" => ["required"],
                "date" => ["required", "date"],
                "body" => ["required", "string", "max:255"],
                "title" => ["required", "string", "max:255"],
            ]);

            $creatAnn = Announcement::query()->create([
                "admin_id" => $admin_id,
                "date" => $date,
                "body" => $body,
                'title' => $title
            ]);

            return response()->json([
                'message' => 'تم إضافة الطلب بنجاح',
                'data' => $creatAnn
            ]);
        }
        public function index_Ann(): JsonResponse
        {
                $Ann = Announcement::all();//find(1);
                return response()->json([
                    'status' => 1,
                    "date" => $Ann,
                    "message" => "director created successfully",
                        ]);
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

            'date' => $request["date"],
            'mobile' => $request['mobile'],
            'password' => $request['password'],
            'email' => $request["email"],
            'user_id' => $request['user_id']
        ]);

        return response()////return $request=> username ,mobile and password only but return  $user =>will come all migrate of model ex: username , mobile  password and id and date
        ->json([
            'status' => 1,
            "date" => $user,
            "message" => "director created successfully",

        ]);
    }

    public function storeMark(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'mark'       => 'required|integer|min:0|max:100',
            'exam_date'  => 'required|date',
        ]);

        $mark = Mark::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'mark'       => $request->mark,
            'exam_date'  => $request->exam_date,
        ]);

        return response()->json([
            'success' => true,
            'data' => $mark,
            'message' => 'تمت إضافة العلامة بنجاح',
        ]);
    }
    public function getMarksByClassAndSubject($class, $subjectId)
    {
        $marks = Mark::with('student')
            ->whereHas('student', function($query) use ($class) {
                $query->where('class', $class);
            })
            ->where('subject_id', $subjectId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $marks,
        ]);
    }

}
