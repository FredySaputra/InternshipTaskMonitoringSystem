@extends('admin/layout/main')

@section('title', 'Tugas Belum Dikumpulkan')

@section('content')

<div class="mb-4">
    <button class="btn btn-outline-secondary btn-sm mb-2">&larr; <a href="{{route('task.index')}}">Kembali</a></button>
    <h2 class="mb-0">Siswa Belum Mengumpulkan</h2>
    <p class="text-muted">Tugas: <span class="text-dark fw-bold">{{ $task->desc }}</span></p>
</div>

<div class="card shadow-sm border-0" style="max-width: 800px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col" class="text-start ps-4">Nama Siswa</th>
                        <th scope="col">Penempatan Lab</th>
                        <th scope="col">Sisa Waktu / Tenggat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($details as $detail)
                    <tr class="align-middle text-center">
                        <td class="text-start ps-4 fw-bold text-danger">{{ $detail->student->name }}</td>
                        <td>{{ $detail->student->lab->name }}</td>
                        <td>
                            <span class="badge bg-light text-danger border">
                                {{ \Carbon\Carbon::parse($detail->task->due)->format('d M Y, H:i') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-success py-5 fw-bold">
                            ✨ Semua siswa sudah mengumpulkan tugas ini!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
