@extends('admin/layout/main')

@section('title','Manajemen Sekolah')

@section('content')

<div class="d-flex flex-column" style="height: 100vw">
    <div class="d-flex align-items-center mt-30" style="height: 15%">
        <h1 class="d-flex">Manajemen Sekolah</h1>
        <a href="{{route('school.create')}}" class="btn btn-primary ">Tambah Data +</a>
    </div>
    <div style="height: 85%;width: 100%">
        <table class="table table-primary table-stripped">
            <thead>
                <tr style="text-align: center">
                    <th scope="col">Nama Sekolah</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schools as $s)
                <tr>
                    <td>{{$s->name}}</td>
                    <td>{{$s->address}}</td>
                    <td><a href="#" class="text-warning">Ubah</a> <a href="#" class="text-danger">Hapus</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data sekolah yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
