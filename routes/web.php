<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login-process');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('auth:web')->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'index']);
    Route::resource('/student',StudentController::class);
    Route::resource('/school',SchoolController::class);
    Route::resource('/lab',LabController::class);
    Route::resource('/task',TaskController::class);
});

Route::middleware('auth:students')->group(function(){

});
