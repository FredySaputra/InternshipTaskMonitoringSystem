<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Lab;
use App\Models\Student;
use App\Models\Task;
use App\Models\TaskDetail;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class TaskController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('admin.task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all()->sortBy('lab_id');
        return view('admin.task.create',compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create([
            'desc'=>$request->desc,
            'due'=>$request->due
        ]);

        foreach($request->student_id as $studentId){
            TaskDetail::create([
            'task_id'=>$task->id,
            'student_id'=>(int)$studentId,
            'sub_stat'=>'queue'
        ]);
        }

        return redirect()->route('task.index')
                        ->with('success','Tugas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
