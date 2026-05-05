@extends('admin/layout/main')

@section('title','Tambah Data Sekolah')

@section('content')

<h1>Tambah Data Sekolah</h1>
<br>
<form action="{{route('school.store')}}" method="POST">
    @csrf
    <div class="mb-3">
    <label for="name" class="form-label">Nama Sekolah :</label>
    <input type="text" name="name" class="form-control">
</div>
<div class="mb-3">
    <label for="address" class="form-label">Alamat Sekolah :</label>
    <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
</div>
<div class="mb-3">
    <button class="btn btn-primary">Kirim</button>
</div>
</form>

@endsection
