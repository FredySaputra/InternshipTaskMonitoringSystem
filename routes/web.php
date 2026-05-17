<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentTaskController;
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
    Route::post('/task/{task}/submitted/{detail}/accepted', [TaskController::class, 'accept'])->name('task.accepted');
    Route::post('/task/{task}/submitted/{detail}/rejected', [TaskController::class, 'reject'])->name('task.rejected');
    Route::post('/task/clear-proofs', [TaskController::class, 'clearProofs'])->name('task.clearProofs');
    Route::resource('/task',TaskController::class);
    Route::get('/task/{task}/submitted',[TaskController::class,'submitted'])->name('task.submitted');
    Route::get('/task/{task}/unsubmitted',[TaskController::class,'unsubmitted'])->name('task.unsubmitted');
    Route::post('/task/{task}/bulk-accept', [TaskController::class, 'bulkAccept'])->name('task.bulkAccept');
    Route::post('/task/{task}/bulk-reject', [TaskController::class, 'bulkReject'])->name('task.bulkReject');
});

Route::middleware('auth:students')->group(function(){
    Route::get('/student-dashboard',[StudentController::class,'dashboard'])->name('student.dashboard');
    Route::post('/student-task/{detail}/add',[StudentTaskController::class,'add'])->name('student-task.add');
    Route::get('/student-task/{detail}',[StudentTaskController::class,'create'])->name('student-task.create');
});
