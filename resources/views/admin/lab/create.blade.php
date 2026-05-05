@extends('admin/layout/main')

@section('title','Tambah Data Lab')

@section('content')

<h1>Tambah Data Lab</h1>
<br>
<form action="{{route('lab.store')}}" method="POST">
    @csrf
    <div class="mb-3">
    <label for="name" class="form-label">Nama Lab :</label>
    <input type="text" name="name" class="form-control">
</div>
<div class="mb-3">
    <label for="category" class="form-label">Kategori Lab :</label>
    <select name="category" id="category" class="form-control">
        <option value="">-- Pilih Kategori Lab --</option>
        <option value="Programming">Programming</option>
        <option value="Design">Design</option>
        <option value="Artificial Intelegent">Artificial Intelegent</option>
        <option value="Networking">Networking</option>
    </select>
</div>
<div class="mb-3">
    <button class="btn btn-primary">Kirim</button>
</div>
</form>

@endsection
