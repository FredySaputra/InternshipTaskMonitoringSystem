@extends('admin/layout/main')

@section('title','Tugas Dikumpulkan')

@section('content')

<div class="d-flex flex-column" style="height: 100vw">
    <div class="d-flex align-items-center mt-30" style="height: 15%">
        <h1 class="d-flex">Daftar Tugas Belum Dikumpulkan</h1>
        <button onclick="history.back()" class="btn btn-info">Kembali</button>
    </div>
    <div style="height: 85%;width: 100%">
        <table class="table table-primary table-stripped">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Lab</th>
                    <th scope="col">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($details as $detail)
                <tr>
                    <td>{{$detail->student->name}}</td>
                    <td>{{$detail->student->lab->name}}</td>
                    <td>{{$detail->task->due}}</td>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data tugas yang belum dikumpulkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
