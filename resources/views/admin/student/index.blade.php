@extends('admin/layout/main')

@section('title','Manajemen Siswa')

@section('content')

<div class="d-flex flex-column" style="height: 100vw">
    <div class="d-flex align-items-center mt-30" style="height: 15%">
        <h1 class="d-flex">Manajemen Siswa</h1>
    </div>
    <div style="height: 85%;width: 100%">
        <table class="table table-primary table-stripped">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Sekolah</th>
                    <th scope="col">Lab</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $s)
                <tr>
                    <td>{$s->name}</td>
                    <td>{$s->school_id->name}</td>
                    <td>{$s->lab_id->name}</td>
                    <td>{$s->status}</td>
                    <td><a href="#" class="text-warning">Ubah</a> <a href="#" class="text-danger">Delete</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data siswa yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
