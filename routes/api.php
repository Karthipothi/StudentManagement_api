<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\teacher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\students;
use App\Http\Controllers\api\studentdetails_controller;
use App\Http\Controllers\api\user_controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\userController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
//student details

Route::get('studentsdeails',[students::class,'index']);
Route::post('studentsdeails',[students::class,'store']);
Route::get('studentsdeails/{id}',[students::class,'show']);
Route::get('studentsdeails/{id}/edit',[students::class,'edit']);
Route::put('studentsdeails/{id}/edit',[students::class,'update']);
Route::delete('studentsdeails/{id}/delete',[students::class,'destroy']);

//techer details

Route::get('teacherdetails',[teacher::class,'teacherindex']);
Route::post('teacherdetailss',[teacher::class,'teacherstore']);
Route::get('teacherdetails/{id}',[teacher::class,'teachershow']);
Route::get('teacherdetails/{id}/edit',[teacher::class,'teacheredit']);
Route::put('teacherdetails/{id}/edit',[teacher::class,'teacherupdate']);
Route::delete('teacherdetails/{id}/delete',[teacher::class,'teacherdestroy']);

//user admin panel
Route::get('user',[userController::class,'userindex']);
Route::post('user',[userController::class,'userstore']);
Route::get('user/{id}',[userController::class,'usershow']);
Route::get('user/{id}/edit',[userController::class,'useredit']);
Route::put('user/{id}/edit',[userController::class,'userupdate']);
Route::delete('user/{id}/delete',[userController::class,'userdestroy']);

//dashboardcard
Route::get('dashboardcards',[students::class,'dashboardCards']);
