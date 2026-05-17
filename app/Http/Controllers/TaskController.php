<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Lab;
use App\Models\Student;
use App\Models\Task;
use App\Models\TaskDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Integer;


class TaskController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        $submitted = TaskDetail::where('sub_stat','submitted')->count();
        $unsubmitted = TaskDetail::where('sub_stat','queue')->count();
        return view('admin.task.index',compact('tasks','submitted','unsubmitted'));
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

    public function submitted(Task $task){
        $details = TaskDetail::with('student')->where('task_id',$task->id)->where('sub_stat','submitted')->get();
        return view('admin.task.submitted',compact('details','task'));
    }

    public function unsubmitted(Task $task){
        $details = TaskDetail::with('student')->where('task_id',$task->id)->where('sub_stat','queue')->get();
        return view('admin.task.unsubmitted',compact('details','task'));
    }


    public function clearProofs()
{
    $details = TaskDetail::whereNotNull('proof')->get();

    foreach ($details as $detail) {
        if (Storage::disk('public_htdocs')->exists($detail->proof)) {
            Storage::disk('public_htdocs')->delete($detail->proof);
        }

        $detail->update([
            'proof'       => null
        ]);
    }

    return redirect()->back()->with('success', 'Semua bukti berhasil dihapus.');
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
    public function edit(Task $task)
    {
        $students = Student::all()->sortBy('lab_id');

        $assignedStudents = TaskDetail::where('task_id', $task->id)
                                ->pluck('student_id')
                                ->toArray();

        return view('admin.task.edit', compact('task', 'students', 'assignedStudents'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'desc'       => 'required|string',
            'due'        => 'required|date',
            'student_id' => 'required|array',
        ]);

        $task->update([
            'desc' => $request->desc,
            'due'  => $request->due,
        ]);

        TaskDetail::where('task_id', $task->id)->delete();

        foreach ($request->student_id as $studentId) {
            TaskDetail::create([
                'task_id'    => $task->id,
                'student_id' => (int) $studentId,
                'sub_stat'   => 'queue',
            ]);
        }

        return redirect()->route('task.index')
                        ->with('success', 'Tugas berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        TaskDetail::where('task_id',$task->id)->delete();
        $task->delete();

        return redirect()->route('task.index')
                        ->with('success','Tugas berhasil dihapus.');
    }

    public function accept(Task $task, TaskDetail $detail)
    {
        $detail->update(['sub_stat' => 'accepted']);

        return redirect()->route('task.submitted', $task->id)
                        ->with('success', 'Berhasil menyetujui tugas.');
    }

    public function reject(Task $task, TaskDetail $detail)
    {
        $detail->update(['sub_stat' => 'rejected']);

        return redirect()->route('task.submitted', $task->id)
                        ->with('success', 'Berhasil menolak tugas.');
    }
}
