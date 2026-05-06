<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentTaskRequest;
use App\Models\TaskDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

use function Illuminate\Support\now;

class StudentTaskController
{
    public function create(TaskDetail $detail){
        return view('student.student-task.add',compact('detail'));
    }

    public function add(StudentTaskRequest $request,TaskDetail $detail){
        $user = auth('students')->user();
        $file = $request->file('proof');

        $image = Image::read($file)
                    ->scaleDown(width:800)
                    ->toJpeg(quality:75);
        $fileName = 'proof_'.$user->id.'_'.now()->format('Ymd_His').'.jpg';
        $path = 'proofs/'.$fileName;
        Storage::disk('public')->put($path,$image);
        $detail->update([
            'proof'=>$path,
            'sub_stat'=>'submitted',
            'description'=>$request->description
        ]);

        return redirect()->route('student.dashboard')
                    ->with('success','Tugas berhasil dikumpulkan.');

    }
}
