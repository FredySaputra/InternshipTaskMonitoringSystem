<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentTaskRequest;
use App\Models\TaskDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class StudentTaskController
{
    public function create(TaskDetail $detail){
        if ($detail->student_id !== auth('students')->id()) {
            abort(403, 'Anda tidak diizinkan mengakses tugas ini.');
        }

        if ($detail->sub_stat == 'queue' && now()->greaterThan($detail->task->due)) {
            abort(403, 'Waktu pengumpulan tugas sudah habis. Halaman dikunci.');
        }

        return view('student.student-task.add',compact('detail'));
    }

    public function add(StudentTaskRequest $request, TaskDetail $detail){
        $user = auth('students')->user();

        if ($detail->student_id !== $user->id) {
            abort(403, 'Anda tidak diizinkan mengakses tugas ini.');
        }

        if ($detail->sub_stat == 'queue' && now()->greaterThan($detail->task->due)) {
            abort(403, 'Waktu pengumpulan tugas sudah habis. Anda tidak dapat mengunggah file.');
        }

        $file = $request->file('proof');
        $image = Image::read($file)->scaleDown(width:800)->toJpeg(quality:75);
        $fileName = 'proof_'.$user->id.'_'.now()->format('Ymd_His').'.jpg';
        $path = 'proofs/'.$fileName;

        if ($detail->proof && Storage::disk('public')->exists($detail->proof)) {
            Storage::disk('public')->delete($detail->proof);
        }

        Storage::disk('public')->put($path, (string) $image);

        $detail->update([
            'proof'=>$path,
            'sub_stat'=>'submitted',
            'description'=>$request->description
        ]);

        return redirect()->route('student.dashboard')
                    ->with('success','Tugas berhasil dikumpulkan.');
    }
}
