@extends('admin/layout/main')

@section('title', 'Manajemen Siswa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Siswa</h2>
    <a href="{{ route('student.create') }}" class="btn btn-primary shadow-sm">
        + Tambah Data
    </a>
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
                            @if($student->status == 'active')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                <form action="{{ route('student.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
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

@endsection
