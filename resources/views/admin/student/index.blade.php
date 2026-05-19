@extends('admin/layout/main')

@section('title', 'Manajemen Siswa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Siswa</h2>

    <div class="d-flex gap-2">
        <a href="{{ route('student.printPdf') }}" class="btn btn-outline-danger shadow-sm d-flex align-items-center gap-2">
            <i class="fa-solid fa-file-pdf"></i> Cetak Laporan PDF
        </a>

        <a href="{{ route('student.create') }}" class="btn btn-primary shadow-sm">
            + Tambah Data
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col" class="text-start ps-4">Nama</th>
                        <th scope="col">Asal Sekolah</th>
                        <th scope="col">Penempatan Lab</th>
                        <th scope="col">Skor Nilai (Progres)</th>
                        <th scope="col">Status</th>
                        <th scope="col" width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                    <tr class="align-middle text-center">
                        <td class="text-start ps-4 fw-bold">{{ $student->name }}</td>
                        <td>{{ $student->school->name }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $student->lab->name }}</span>
                        </td>

                        <td>
                            @if($student->grade_percentage >= 80)
                                <span class="badge bg-success px-3 py-2 fs-7 shadow-sm">
                                    {{ $student->grade_percentage }}% ({{ $student->accepted_tasks }}/{{ $student->total_tasks }})
                                </span>
                            @elseif($student->grade_percentage >= 50)
                                <span class="badge bg-warning text-dark px-3 py-2 fs-7 shadow-sm">
                                    {{ $student->grade_percentage }}% ({{ $student->accepted_tasks }}/{{ $student->total_tasks }})
                                </span>
                            @else
                                <span class="badge bg-danger px-3 py-2 fs-7 shadow-sm">
                                    {{ $student->grade_percentage }}% ({{ $student->accepted_tasks }}/{{ $student->total_tasks }})
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($student->status == 'active')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm">Ubah</a>

                                <form action="{{ route('student.destroy', $student->id) }}" method="POST" class="form-delete m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada data siswa yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $students->links() }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('.form-delete');

                Swal.fire({
                    title: 'Hapus data siswa?',
                    text: "Tindakan ini akan menghapus seluruh data progres dan berkas tugas yang pernah dikumpulkan oleh siswa ini!",
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
