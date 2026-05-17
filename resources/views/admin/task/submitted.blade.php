@extends('admin/layout/main')

@section('title','Tugas Dikumpulkan')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex flex-column" style="height: 100vw">
    <div class="d-flex align-items-center mt-30" style="height: 15%">
        <h1 class="d-flex">Daftar Tugas Sudah Dikumpulkan</h1>
        <button onclick="history.back()" class="btn btn-info">Kembali</button>
        <form action="{{ route('task.clearProofs') }}" method="POST"
            onsubmit="return confirm('Yakin ingin menghapus semua bukti? Tindakan ini tidak bisa dibatalkan!')">
            @csrf
            <button type="submit" class="btn btn-danger">
                Hapus Semua Bukti
            </button>
        </form>
    </div>
    <div style="height: 85%;width: 100%">
        <table class="table table-primary table-stripped">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Lab</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Bukti</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($details as $detail)
                <tr>
                    <td>{{$detail->student->name}}</td>
                    <td>{{$detail->student->lab->name}}</td>
                    <td>{{$detail->updated_at}}</td>
                    <td>
                @if($detail->proof)
                    <a href="{{ env('APP_URL') . '/' . $detail->proof }}" target="_blank" class="text-decoration-none">
                        Lihat Bukti
                    </a>
                @else
                    <span class="text-muted">Belum ada bukti</span>
                @endif
            </td>
            <td>
                    <form action="{{ route('task.rejected', [$task->id, $detail->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                    </form>

                    <form action="{{ route('task.accepted', [$task->id, $detail->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                    </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data tugas yang dikumpulkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
