@extends('admin/layout/main')

@section('title','Edit Data Sekolah')

@section('content')

<h1>Edit Data Sekolah</h1>
<br>
<form action="{{route('school.update',$school->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
    <label for="name" class="form-label">Nama Sekolah :</label>
    <input type="text" name="name" class="form-control" value="{{old('name',$school->name)}}">
</div>
<div class="mb-3">
    <label for="address" class="form-label">Alamat Sekolah :</label>
    <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{old('address',$school->address)}}</textarea>
</div>
<div class="mb-3">
    <button class="btn btn-primary">Kirim</button>
</div>
</form>

@endsection
