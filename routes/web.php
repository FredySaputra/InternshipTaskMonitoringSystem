<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
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
    Route::get('/student',[StudentController::class,'index'])->name('student');

    Route::get('/school',[SchoolController::class,'index'])->name('school');
});

Route::middleware('auth:students')->group(function(){

});
