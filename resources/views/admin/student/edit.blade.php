@extends('admin/layout/main')

@section('title', 'Ubah Data Siswa')

@section('content')

<h1>Ubah Data Siswa</h1>
<br>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('student.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nama Siswa<span style="color: red">*</span> :</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" maxlength="50" required>
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Username<span style="color: red">*</span> :</label>
        <input type="text" name="username" class="form-control" value="{{ old('username', $student->username) }}" maxlength="10" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password :</label>
        <input type="password" name="password" class="form-control" maxlength="20">
        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status<span style="color: red">*</span> :</label>
        <select name="status" id="status" class="form-control" required>
            <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="school_id" class="form-label">Asal Sekolah<span style="color: red">*</span> :</label>
        <select name="school_id" id="school_id" class="form-control" required>
            <option value="">-- Pilih Sekolah --</option>
            @foreach ($schools as $id => $name)
                <option value="{{ $id }}" {{ old('school_id', $student->school_id) == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="lab_id" class="form-label">Penempatan Lab<span style="color: red">*</span> :</label>
        <select name="lab_id" id="lab_id" class="form-control" required>
            <option value="">-- Pilih Lab --</option>
            @foreach ($labs as $id => $name)
                <option value="{{ $id }}" {{ old('lab_id', $student->lab_id) == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                        <a href="{{ route('school.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
</form>

@endsection
