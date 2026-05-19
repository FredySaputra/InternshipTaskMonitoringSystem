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
        $tasks = Task::withCount([
            'taskDetail as submitted_count' => function ($query) {
                $query->where('sub_stat', 'submitted');
            },
            'taskDetail as unsubmitted_count' => function ($query) {
                $query->where('sub_stat', 'queue');
            }
        ])
        ->orderBy('due', 'desc')
        ->paginate(10);

        return view('admin.task.index', compact('tasks'));
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
            'desc' => $request->desc,
            'due'  => $request->due
        ]);

        $taskDetails = [];
        foreach($request->student_id as $studentId){
            $taskDetails[] = [
                'task_id'    => $task->id,
                'student_id' => (int)$studentId,
                'sub_stat'   => 'queue',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        TaskDetail::insert($taskDetails);

        return redirect()->route('task.index')
                        ->with('success','Tugas berhasil ditambahkan.');
    }

    public function submitted(Task $task)
    {
        $details = TaskDetail::with('student.lab')
                    ->where('task_id', $task->id)
                    ->whereIn('sub_stat', ['submitted', 'accepted', 'rejected'])
                    ->get();

        return view('admin.task.submitted', compact('details', 'task'));
    }

    public function unsubmitted(Task $task)
    {
        $details = TaskDetail::with('student.lab')
                             ->where('task_id', $task->id)
                             ->whereNotIn('sub_stat', ['submitted', 'accepted', 'rejected'])
                             ->get();

        return view('admin.task.unsubmitted', compact('details', 'task'));
    }


    public function clearProofs()
    {
        $details = TaskDetail::whereNotNull('proof')->get();

        foreach ($details as $detail) {
            if (Storage::disk('public')->exists($detail->proof)) {
                Storage::disk('public')->delete($detail->proof);
            }
        }

        TaskDetail::whereNotNull('proof')->update(['proof' => null]);

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
            'student_id.*'=> ['exists:students,id']
        ]);

         $task->update([
            'desc' => $request->desc,
            'due'  => $request->due,
        ]);

         $currentStudentIds = TaskDetail::where('task_id', $task->id)
                                       ->pluck('student_id')
                                       ->toArray();

         $requestedStudentIds = array_map('intval', $request->student_id);

         $studentsToAdd = array_diff($requestedStudentIds, $currentStudentIds);
        $studentsToRemove = array_diff($currentStudentIds, $requestedStudentIds);

         if (!empty($studentsToRemove)) {
             TaskDetail::where('task_id', $task->id)
                      ->whereIn('student_id', $studentsToRemove)
                      ->delete();
        }

         if (!empty($studentsToAdd)) {
            $newDetails = [];
            foreach ($studentsToAdd as $studentId) {
                $newDetails[] = [
                    'task_id'    => $task->id,
                    'student_id' => $studentId,
                    'sub_stat'   => 'queue',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
             TaskDetail::insert($newDetails);
        }

        return redirect()->route('task.index')
                        ->with('success', 'Tugas berhasil diubah tanpa menghapus pekerjaan siswa.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
         $details = TaskDetail::where('task_id', $task->id)->get();

         foreach ($details as $detail) {
            if ($detail->proof && Storage::disk('public')->exists($detail->proof)) {
                Storage::disk('public')->delete($detail->proof);
            }
        }

         TaskDetail::where('task_id', $task->id)->delete();
        $task->delete();

        return redirect()->route('task.index')
                        ->with('success', 'Tugas beserta semua file bukti berhasil dihapus.');
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

    public function bulkAccept(Request $request, Task $task)
    {
        $request->validate([
            'detail_ids'   => 'required|array',
            'detail_ids.*' => 'exists:task_details,id'
        ]);

        TaskDetail::whereIn('id', $request->detail_ids)
                  ->where('task_id', $task->id)
                  ->update(['sub_stat' => 'accepted']);

        return redirect()->route('task.submitted', $task->id)
                        ->with('success', 'Berhasil menyetujui tugas terpilih.');
    }

    public function bulkReject(Request $request, Task $task)
    {
        $request->validate([
            'detail_ids'   => 'required|array',
            'detail_ids.*' => 'exists:task_details,id'
        ]);

        TaskDetail::whereIn('id', $request->detail_ids)
                  ->where('task_id', $task->id)
                  ->update(['sub_stat' => 'rejected']);

        return redirect()->route('task.submitted', $task->id)
                        ->with('success', 'Berhasil menolak tugas terpilih.');
    }
}
