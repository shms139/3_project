<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::post('login', 'login');
Route::post("/register",[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
//Route::post('/user',[AuthController::class,'user']);
Route::post('/createAnnouncements',[AdminController::class,"createAnnouncements"]);


Route::middleware('auth:sanctum')->group(function (){
    Route::get('/logout',[AuthController::class,'logout']);
    Route::post('/register_Director_in_admin',[AuthController::class,'register_Director_in_admin']);
    Route::post('/registerParent_student',[AuthController::class,'registerParent_student']);
    Route::post('/registerStudent',[AuthController::class,'registerStudent']);
    Route::get('/index_students',[AuthController::class,'index_students']);
    Route::get('/show_student_details/{id}',[AuthController::class,'show_student_details']);//gl H;lgi
    Route::delete('/destroy/{id}', [AuthController::class, 'destroy']);

    Route::get('/index_Ann',[AuthController::class,'index_Ann']);
    Route::get('/user/{id}',[AuthController::class,'user']);// لم أكمله

});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
