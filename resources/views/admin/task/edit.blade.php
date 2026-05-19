@extends('admin/layout/main')

@section('title', 'Ubah Penugasan')

@section('content')

<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="d-flex align-items-center mb-4">
            <h2 class="mb-0">Ubah Penugasan</h2>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('task.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="desc" class="form-label fw-bold">Deskripsi Tugas<span style="color: red">*</span> :</label>
                        <input type="text" name="desc" id="desc" class="form-control" value="{{ old('desc', $task->desc) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="due" class="form-label fw-bold">Tenggat Tugas<span style="color: red">*</span> :</label>
                        <input type="datetime-local" name="due" id="due" class="form-control" value="{{ old('due', $task->due->format('Y-m-d\TH:i')) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Siswa<span style="color: red">*</span> :</label>

                        <div class="form-check border-bottom pb-2 mb-2">
                            <input class="form-check-input" type="checkbox" id="select-all">
                            <label class="form-check-label fw-bold text-primary" for="select-all">
                                Pilih Semua Siswa
                            </label>
                        </div>

                        <div class="overflow-auto" style="max-height: 250px;">
                            @foreach ($students as $student)
                                <div class="form-check">
                                    <input class="form-check-input student-checkbox" type="checkbox" name="student_id[]" id="student_{{ $loop->index }}" value="{{ $student->id }}" {{ in_array($student->id, old('student_id', $assignedStudents)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="student_{{ $loop->index }}">
                                        {{ $student->name }} <span class="text-muted">({{ $student->lab->name }})</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button onclick="history.back()" type="button" class="btn btn-outline-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('select-all');
        const studentCheckboxes = document.querySelectorAll('.student-checkbox');

        function updateSelectAllState() {
            const total = studentCheckboxes.length;
            const checked = document.querySelectorAll('.student-checkbox:checked').length;
            selectAllCheckbox.checked = (total === checked && total > 0);
        }

        updateSelectAllState();

        selectAllCheckbox.addEventListener('change', function () {
            studentCheckboxes.forEach(cb => {
                cb.checked = selectAllCheckbox.checked;
            });
        });

        studentCheckboxes.forEach(cb => {
            cb.addEventListener('change', updateSelectAllState);
        });
    });
</script>

@endsection
