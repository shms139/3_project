<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Director;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // here relation between admin and user
    public function index()
    {
        $user = User::find(1);
        return $user->mobile;

        $admin = Admin::find(1);
        return  $admin->user_id;//mobile
    }

    public function Announcements()
    {
        $admin_ann = Admin::find(1);
        return $admin_ann->body;


        $director = Director::with('announcements')->find(1);
        foreach ($director->announcements as $announcement) {
            return $announcement->title;//echo
        }
    }


        public function createAnnouncements(Request $request): JsonResponse
        {

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

}
