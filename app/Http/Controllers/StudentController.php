<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Lab;
use App\Models\School;
use App\Models\Student;
use App\Models\TaskDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController
{

    public function dashboard()
    {
        $student = Auth::guard('students')->user();

        $taskDetails = TaskDetail::with('task')
            ->where('student_id', $student->id)
            ->where('sub_stat', '!=', 'accepted')
            ->where(function ($query) {
                $query->where('sub_stat', '!=', 'queue')
                      ->orWhereHas('task', function ($q) {
                          $q->whereDate('due', '>=', now()->toDateString());
                      });
            })            ->get()
            ->map(function ($detail) {
                if ($detail->sub_stat == 'queue') {
                    $detail->is_late = now()->greaterThan($detail->task->due);
                } else {
                    $detail->is_late = $detail->updated_at->greaterThan($detail->task->due);
                }

                return $detail;
            });

        return view('student.dashboard', compact('student', 'taskDetails'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['school', 'lab'])
            ->withCount([
                'taskDetail as total_tasks',
                'taskDetail as accepted_tasks' => function ($query) {
                    $query->where('sub_stat', 'accepted');
                }
            ])
            ->orderBy('lab_id')
            ->paginate(15);

        $students->getCollection()->transform(function ($student) {
            if ($student->total_tasks > 0) {
                $student->grade_percentage = round(($student->accepted_tasks / $student->total_tasks) * 100);
            } else {
                $student->grade_percentage = 0;
            }
            return $student;
        });

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

    public function printPdf()
    {
        $students = Student::with(['school', 'lab'])
            ->withCount([
                'taskDetail as total_tasks',
                'taskDetail as accepted_tasks' => function ($query) {
                    $query->where('sub_stat', 'accepted');
                }
            ])
            ->orderBy('lab_id')
            ->get();

        $students->transform(function ($student) {
            if ($student->total_tasks > 0) {
                $student->grade_percentage = round(($student->accepted_tasks / $student->total_tasks) * 100);
            } else {
                $student->grade_percentage = 0;
            }
            return $student;
        });

        $datePrinted = now()->format('d F Y, H:i') . ' WIB';

        $pdf = Pdf::loadView('admin.student.report_pdf', compact('students', 'datePrinted'))
                  ->setPaper('a4', 'portrait'); // Menggunakan ukuran kertas A4 potret

        return $pdf->download('Laporan_Akumulasi_Nilai_Siswa_PKL_' . now()->format('Ymd') . '.pdf');
    }
}
