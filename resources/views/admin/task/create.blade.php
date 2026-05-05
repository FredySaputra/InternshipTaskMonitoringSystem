@extends('admin/layout/main')

@section('title','Tambah Penugasan')

@section('content')

<h1>Tambah Penugasan</h1>
<br>
<form action="{{route('task.store')}}" method="POST">
    @csrf
    @method('POST')
<div class="mb-3">
    <label for="desc" class="form-label">Deskripsi Tugas :</label>
    <input type="text" name="desc" class="form-control">
</div>
<div class="mb-3">
    <label for="due" class="form-label">Tenggat Tugas :</label>
    <div class="col-md-2">
        <input type="datetime-local" name="due" class="form-control">
    </div>
</div>
<div>
    <label class="form-label">Pilih Siswa:</label>
</div>
@foreach ($students as $student)
<div>
    <input class="form-check-input" type="checkbox" name="student_id[]" id="student_{{$loop->index}}" value="{{$student->id}}" {{in_array($student->id,old('student_id',[]))?"checked":""}} >
    <label for="student_{{$loop->index}}" class="form-check-label">{{$student->name}} ({{$student->lab->name}})</label>
</div>
@endforeach
<div class="mb-3">
    <button class="btn btn-primary">Kirim</button>
</div>
</form>

@endsection
