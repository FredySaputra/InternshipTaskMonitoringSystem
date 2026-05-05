@extends('admin/layout/main')

@section('title','Tambah Data Siswa')

@section('content')

<h1>Tambah Data Siswa</h1>
<br>
<form action="{{route('student.store')}}" method="POST">
    @csrf
    @method('POST')
<div class="mb-3">
    <label for="name" class="form-label">Nama Siswa :</label>
    <input type="text" name="name" class="form-control">
</div>
<div class="mb-3">
    <label for="username" class="form-label">Username :</label>
    <input type="text" name="username" class="form-control">
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password :</label>
    <input type="password" name="password" class="form-control">
</div>
<div class="mb-3">
    <label for="status" class="form-label">Status :</label>
    <select name="status" id="status" class="form-control">
        <option value="active">Aktif</option>
        <option value="inactive">Tidak Aktif</option>
    </select>
</div>
<div class="mb-3">
    <label for="school_id" class="form-label">Asal Sekolah :</label>
    <select name="school_id" id="school_id" class="form-control">
        <option value="">-- Pilih Sekolah --</option>
        @forelse ($schools as $id=>$name)
        <option value={{$id}}>{{$name}}</option>
        @empty
        <option disabled>Belum ada data sekolah yang ditambahkan.</option>
        @endforelse
    </select>
</div>
<div class="mb-3">
    <label for="lab_id" class="form-label">Penempatan Lab :</label>
    <select name="lab_id" id="lab_id" class="form-control">
        <option value="">-- Pilih Lab --</option>
        @forelse ($labs as $id=>$name)
        <option value={{$id}}>{{$name}}</option>
        @empty
        <option disabled>Belum ada data lab yang ditambahkan.</option>
        @endforelse
    </select>
</div>
<div class="mb-3">
    <button class="btn btn-primary">Kirim</button>
</div>
</form>

@endsection
