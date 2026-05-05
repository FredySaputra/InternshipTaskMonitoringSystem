@extends('admin/layout/main')

@section('title','Manajemen Lab')

@section('content')

<div class="d-flex flex-column" style="height: 100vw">
    <div class="d-flex align-items-center mt-30" style="height: 15%">
        <h1 class="d-flex">Manajemen Lab</h1>
        <a href="{{route('lab.create')}}" class="btn btn-primary ">Tambah Data +</a>
    </div>
    <div style="height: 85%;width: 100%">
        <table class="table table-primary table-stripped">
            <thead>
                <tr style="text-align: center">
                    <th scope="col">Nama Lab</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($labs as $lab)
                <tr>
                    <td>{{$lab->name}}</td>
                    <td>{{$lab->category}}</td>
                    <td><a href="#" class="text-warning">Ubah</a> <form action="{{route('lab.destroy',$lab->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button></form></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data lab yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
