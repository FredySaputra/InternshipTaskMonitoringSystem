@extends('admin/layout/main')

@section('title','Tambah Data Siswa')

@section('content')

<h1>Tambah Data Siswa</h1>
<br>
<form action="{{route('student.store')}}" method="POST">
    @csrf
    @method('POST')
<div class="mb-3">
    <label for="name" class="form-label">Nama Siswa<span style="color: red">*</span> :</label>
    <input type="text" name="name" class="form-control" maxlength="50" required>
</div>
<div class="mb-3">
    <label for="username" class="form-label">Username<span style="color: red">*</span> :</label>
    <input type="text" name="username" class="form-control" maxlength="10" required>
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password<span style="color: red">*</span> :</label>
    <input type="password" name="password" class="form-control" maxlength="20" required>
</div>
<div class="mb-3">
    <label for="status" class="form-label">Status<span style="color: red">*</span> :</label>
    <select name="status" id="status" class="form-control" required>
        <option value="active">Aktif</option>
        <option value="inactive">Tidak Aktif</option>
    </select>
</div>
<div class="mb-3">
    <label for="school_id" class="form-label">Asal Sekolah<span style="color: red">*</span> :</label>
    <select name="school_id" id="school_id" class="form-control" required>
        <option value="">-- Pilih Sekolah --</option>
        @forelse ($schools as $id=>$name)
        <option value={{$id}}>{{$name}}</option>
        @empty
        <option disabled>Belum ada data sekolah yang ditambahkan.</option>
        @endforelse
    </select>
</div>
<div class="mb-3">
    <label for="lab_id" class="form-label">Penempatan Lab<span style="color: red">*</span> :</label>
    <select name="lab_id" id="lab_id" class="form-control" required>
        <option value="">-- Pilih Lab --</option>
        @forelse ($labs as $id=>$name)
        <option value={{$id}}>{{$name}}</option>
        @empty
        <option disabled>Belum ada data lab yang ditambahkan.</option>
        @endforelse
    </select>
</div>
<div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                        <a href="{{ route('school.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
</form>

@endsection
