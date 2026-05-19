@extends('admin/layout/main')

@section('title','Edit Data Sekolah')

@section('content')

<h1>Edit Data Sekolah</h1>
<br>
<form action="{{route('school.update',$school->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
    <label for="name" class="form-label">Nama Sekolah<span style="color: red">*</span> :</label>
    <input type="text" name="name" class="form-control" value="{{old('name',$school->name)}}" maxlength="40" required>
</div>
<div class="mb-3">
    <label for="address" class="form-label">Alamat Sekolah<span style="color: red">*</span> :</label>
    <textarea name="address" id="address" cols="30" rows="10" class="form-control" required>{{old('address',$school->address)}}</textarea>
</div>
<div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                        <a href="{{ route('school.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
</form>

@endsection
