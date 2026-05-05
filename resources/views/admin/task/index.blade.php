@extends('admin/layout/main')

@section('title','Manajemen Tugas PKL')

@section('content')

<div class="d-flex flex-column" style="height: 100vw">
    <div class="d-flex align-items-center mt-30" style="height: 15%">
        <h1 class="d-flex">Manajemen Tugas PKL</h1>
        <a href="{{route('task.create')}}" class="btn btn-primary ">Tambah Data +</a>
    </div>
    <div style="height: 85%;width: 100%">
        <table class="table table-primary table-stripped">
            <thead>
                <tr>
                    <th scope="col">Tugas</th>
                    <th scope="col">Tenggat</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                <tr>
                    <td>{{$task->desc}}</td>
                    <td>{{$task->due}}</td>
                    <td>Ditambahkan</td>
                    <td><a href="#" class="text-warning">Ubah</a> <form action="{{route('task.destroy',$task->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button></form></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data tugas yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
