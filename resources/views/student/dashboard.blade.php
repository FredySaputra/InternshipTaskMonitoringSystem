<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laman Siswa | Task Monitoring</title>
    <link rel="icon" href="{{ asset('logo/lab.png') }}">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <style>
        body { background-color: #f4f6f9; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Panel Siswa PKL</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-light d-none d-md-inline">Selamat datang, <b>{{ $student->name }}</b></span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="d-md-none mb-4">
            <h4 class="mb-0">Halo, {{ $student->name }}!</h4>
            <p class="text-muted">Semangat PKL hari ini.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Daftar Tugas Anda</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>Deskripsi Tugas</th>
                                <th>Tenggat Waktu</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($taskDetails as $detail)

                            <tr class="text-center {{ $detail->is_late ? 'text-danger' : '' }}">
                                <td class="text-start ps-4 fw-semibold">{{ $detail->task->desc }}</td>

                                <td>
                                    <span class="{{ $detail->is_late ? 'fw-bold' : '' }}">
                                        {{ \Carbon\Carbon::parse($detail->task->due)->format('d M Y, H:i') }}
                                    </span>

                                    @if($detail->is_late && $detail->sub_stat == 'queue')
                                        <br><small class="text-danger fw-bold">(Melewati Tenggat)</small>
                                    @elseif($detail->is_late && $detail->sub_stat != 'queue')
                                        <br><small class="text-danger fw-bold">(Dikumpulkan Terlambat)</small>
                                    @endif
                                </td>

                                <td>
                                    @if($detail->sub_stat == 'queue' && $detail->is_late)
                                        <span class="badge bg-dark px-3 py-2">Waktu Habis</span>
                                    @elseif($detail->sub_stat == 'queue')
                                        <span class="badge bg-secondary">Belum Dikerjakan</span>
                                    @elseif($detail->sub_stat == 'submitted')
                                        <span class="badge bg-info text-dark">Menunggu Review Admin</span>
                                    @elseif($detail->sub_stat == 'accepted')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($detail->sub_stat == 'rejected')
                                        <span class="badge bg-danger">Ditolak (Revisi)</span>
                                    @endif
                                </td>

                                <td>
                                    @if($detail->sub_stat == 'queue' && $detail->is_late)
                                        <button class="btn btn-secondary btn-sm px-3" disabled>🔒 Terkunci</button>
                                    @elseif($detail->sub_stat == 'queue' || $detail->sub_stat == 'rejected')
                                        <a href="{{ route('student-task.create', $detail->id) }}" class="btn btn-primary btn-sm">
                                            Kumpulkan Tugas
                                        </a>
                                    @else
                                        <button class="btn btn-outline-success btn-sm px-3" disabled>Selesai</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">
                                    <h6 class="mb-0">Hore! Tidak ada tugas hari ini.</h6>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
