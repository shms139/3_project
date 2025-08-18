<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::post('login', 'login');
Route::post("/register",[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
//Route::post('/user',[AuthController::class,'user']);


Route::middleware('auth:sanctum')->group(function (){
    Route::get('/logout',[AuthController::class,'logout']);
    Route::post('/register_Director_in_admin',[AdminController::class,'register_Director_in_admin']);
    Route::post('/registerParent_student',[DirectorController::class,'registerParent_student']);
    Route::post('/registerStudent',[DirectorController::class,'registerStudent']);
    Route::get('/index_students',[DirectorController::class,'index_students']);
    Route::get('/show_student_details/{id}',[DirectorController::class,'show_student_details']);
    Route::delete('/destroy/{id}',[DirectorController::class,'destroy']);
    Route::post('/createAnnouncements',[AdminController::class,"createAnnouncements"]);
    Route::get('/index_Ann',[AdminController::class,'index_Ann']);
    Route::get('/user/{id}',[AuthController::class,'user']);
    Route::post('/addMark',[DirectorController::class,"addMark"]);
    Route::get('/getMarks/{classId}/{subjectId}',[DirectorController::class,"getMarksByClassAndSubject"]);
    Route::get('/getStudentDetailsByMark/{markId}',[DirectorController::class,"getStudentDetailsByMark"]);



});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
