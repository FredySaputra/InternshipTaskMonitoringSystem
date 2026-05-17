@extends('admin/layout/main')

@section('title', 'Ubah Penugasan')

@section('content')

<h1>Ubah Penugasan</h1>
<br>

@if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

<form action="{{ route('task.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="desc" class="form-label">Deskripsi Tugas :</label>
        <input type="text" name="desc" class="form-control" value="{{ old('desc', $task->desc) }}">
    </div>

    <div class="mb-3">
        <label for="due" class="form-label">Tenggat Tugas :</label>
        <div class="col-md-2">
            <input type="datetime-local" name="due" class="form-control" value="{{ old('due', $task->due->format('Y-m-d\TH:i')) }}">
        </div>
    </div>

    <div>
        <label class="form-label">Pilih Siswa:</label>
    </div>

    @foreach ($students as $student)
        <div>
            <input
                class="form-check-input"
                type="checkbox"
                name="student_id[]"
                id="student_{{ $loop->index }}"
                value="{{ $student->id }}"
                {{ in_array($student->id, old('student_id', $assignedStudents)) ? 'checked' : '' }}
            >
            <label for="student_{{ $loop->index }}" class="form-check-label">
                {{ $student->name }} ({{ $student->lab->name }})
            </label>
        </div>
    @endforeach

    <div class="mb-3 mt-3">
        <button onclick="history.back()" type="button" class="btn btn-secondary">Kembali</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>

</form>

@endsection
