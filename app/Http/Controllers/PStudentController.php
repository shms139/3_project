<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\P_student;
use App\Models\User;
use Illuminate\Http\Request;

class PStudentController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        return $user->mobile;

        $p_student = P_student::find(1);
        return  $p_student->user_id;//mobile
    }}
