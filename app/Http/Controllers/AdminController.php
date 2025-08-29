<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Classes_Ann;
use App\Models\Director;
use App\Models\Mark;
use App\Models\TheClass;
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

    public function create()
    {
        if (auth()->user()->role !== 'manager') {
            abort(403, 'Unauthorized');
        }

        $classes = TheClass::all();
        return view('announcements.create', compact('classes'));
    }
        public function createAnnouncements(Request $request): \Illuminate\Http\RedirectResponse
        {
            if (auth()->user()->role !== 'manager') {
                abort(403, 'Unauthorized');
            }

            $request->validate([
                "the_class_id"    =>["required"],
                "admin_id"        => ["required"],
                "date"            => ["required", "date"],
                "body"            => ["required", "string", "max:255"],
                "title"           => ["required", "string", "max:255"],
            ]);

            $announcement = Announcement::create([
                "admin_id" => $request->admin_id,
                "date"     => $request->date,
                "body"     => $request->body,
                "title"    => $request->title
            ]);

            Classes_Ann::create([
                "the_class_id"     => $request->the_class_id,
                "announcement_id"  => $announcement->id,
            ]);
            $announcements = Classes_Ann::with('announcement', 'theClass')->get();
            return redirect()->back()->with('success', 'Director created successfully');

//            return redirect()->route('admin.create-announcements')
//                ->with('success', 'تم إضافة الإعلان بنجاح');

//            return redirect()->route('announcements.index')
//                ->with('success', 'تم إضافة الإعلان بنجاح');
            //            return response()->json([
//                'success' => true,
//                'message' => 'تم إضافة الإعلان بنجاح',
//                'data'    => $announcement
//            ]);
        }

    public function index_Ann(): object
    {
         if (auth()->user()->role !== 'manager') {
          abort(403, 'Unauthorized');
        }
              $announcements = Classes_Ann::with('announcement', 'theClass')->get();
         return view('announcements.index', compact('announcements'));

//        return response()->json([
//            'success' => true,
//            'data'    => $announcements,
//            'message' => 'جميع الإعلانات تم جلبها بنجاح'
//        ]);
    }



    public function register_Director_in_admin(Request $request): \Illuminate\Http\RedirectResponse
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
        return redirect()->back()->with('success', 'Director created successfully');
//        return response()////return $request=> username ,mobile and password only but return  $user =>will come all migrate of model ex: username , mobile  password and id and date
//        ->json([
//            'status' => 1,
//            "date" => $user,
//            "message" => "director created successfully",
//
//        ]);
    }

}
