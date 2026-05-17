<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Lab;
use App\Models\School;
use App\Models\Student;
use App\Models\TaskDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController
{

    public function dashboard()
    {
        $student = Auth::guard('students')->user();
        $taskDetails = TaskDetail::where('student_id',$student->id)->where('sub_stat','!=','accepted')->paginate(15);
        return view('student.dashboard',compact('student','taskDetails'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['school', 'lab'])->orderBy('lab_id')->paginate(15);
        return view('admin.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labs = Lab::pluck('name','id');
        $schools = School::pluck('name','id');
        return view('admin.student.create',compact('labs','schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        Student::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'status'=>$request->status,
            'school_id'=>$request->school_id,
            'lab_id'=>$request->lab_id
        ]);
        return redirect()->route('student.index')
                        ->with('success','Data siswa berhasil ditambahkan');
    }


    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $labs = \App\Models\Lab::pluck('name', 'id');
        $schools = \App\Models\School::pluck('name', 'id');

        return view('admin.student.edit', compact('student', 'labs', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        $validated = $request->validated();

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $student->update($validated);

        return redirect()->route('student.index')
                         ->with('success', 'Data siswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')
                         ->with('success','Data siswa berhasil dihapus');
    }
}
