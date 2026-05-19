@extends('admin/layout/main')

@section('title', 'Manajemen Tugas PKL')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <h2 class="mb-0">Manajemen Tugas PKL</h2>

    <div class="d-flex gap-2 flex-wrap">
        <form id="form-clear-proofs" action="{{ route('task.clearProofs') }}" method="POST" class="m-0">
            @csrf
            <button type="button" id="btn-clear-proofs" class="btn btn-outline-danger shadow-sm">
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

                                <form action="{{ route('task.destroy', $task->id) }}" method="POST" class="form-delete m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
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
<div class="d-flex justify-content-center mt-4">
    {{ $tasks->links() }}
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const btnClearProofs = document.getElementById('btn-clear-proofs');
        if (btnClearProofs) {
            btnClearProofs.addEventListener('click', function () {
                const formClear = document.getElementById('form-clear-proofs');

                Swal.fire({
                    title: 'Kosongkan Semua Bukti?',
                    text: "Peringatan Besar: Tindakan ini akan menghapus SEMUA berkas fisik bukti gambar dari SELURUH tugas yang ada di server! Data ini tidak dapat dikembalikan.",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus Semua!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        formClear.submit();
                    }
                });
            });
        }

        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const formDelete = this.closest('.form-delete');

                Swal.fire({
                    title: 'Hapus Tugas Ini?',
                    text: "Menghapus tugas ini akan melenyapkan seluruh riwayat progres dan berkas pengumpulan siswa yang berkaitan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        formDelete.submit();
                    }
                });
            });
        });

    });
</script>

@endsection
