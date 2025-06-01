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
    Route::get('/user/{id}',[AuthController::class,'user']);

});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
