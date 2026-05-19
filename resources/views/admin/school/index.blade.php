@extends('admin/layout/main')

@section('title', 'Manajemen Sekolah')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Sekolah</h2>
    <a href="{{ route('school.create') }}" class="btn btn-primary shadow-sm">
        + Tambah Data
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col" class="text-start ps-4">Nama Sekolah</th>
                        <th scope="col" class="text-start">Alamat</th>
                        <th scope="col" width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schools as $s)
                    <tr class="align-middle">
                        <td class="fw-bold text-start ps-4">{{ $s->name }}</td>
                        <td class="text-start text-wrap" style="max-width: 400px;">{{ $s->address }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('school.edit', $s->id) }}" class="btn btn-warning btn-sm">Ubah</a>

                                <form action="{{ route('school.destroy', $s->id) }}" method="POST" class="form-delete m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            Belum ada data sekolah yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('.form-delete');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Menghapus data sekolah ini juga akan berdampak pada relasi data siswa di dalamnya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection
