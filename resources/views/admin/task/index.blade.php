@extends('admin/layout/main')

@section('title', 'Manajemen Tugas PKL')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <h2 class="mb-0">Manajemen Tugas PKL</h2>

    <div class="d-flex gap-2 flex-wrap">
        <form action="{{ route('task.clearProofs') }}" method="POST" class="m-0" onsubmit="return confirm('Peringatan: Yakin ingin menghapus SEMUA berkas fisik bukti gambar dari SELURUH tugas di server? Tindakan ini permanen!');">
            @csrf
            <button type="submit" class="btn btn-outline-danger shadow-sm">
                🗑️ Kosongkan Penyimpanan Bukti
            </button>
        </form>

        <a href="{{ route('task.create') }}" class="btn btn-primary shadow-sm">
            + Tambah Tugas Baru
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col" class="text-start ps-4">Deskripsi Tugas</th>
                        <th scope="col">Tenggat</th>
                        <th scope="col">Monitoring Progres</th>
                        <th scope="col" width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                    <tr class="align-middle text-center">
                        <td class="text-start ps-4">{{ $task->desc }}</td>
                        <td>
                            <span class="text-muted fw-semibold">
                                {{ \Carbon\Carbon::parse($task->due)->format('d M Y, H:i') }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('task.unsubmitted', $task->id) }}" class="btn btn-outline-danger btn-sm position-relative px-3">
                                    Belum: <b>{{ $task->unsubmitted_count }}</b>
                                </a>
                                <a href="{{ route('task.submitted', $task->id) }}" class="btn btn-outline-success btn-sm position-relative px-3">
                                    Selesai: <b>{{ $task->submitted_count }}</b>
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                <form action="{{ route('task.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Menghapus tugas akan menghapus berkas pengumpulan siswa. Lanjutkan?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            Belum ada data tugas yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
