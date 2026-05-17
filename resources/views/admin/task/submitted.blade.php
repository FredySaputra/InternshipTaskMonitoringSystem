@extends('admin/layout/main')

@section('title', 'Tugas Dikumpulkan')

@section('content')

<form id="bulk-action-form" method="POST" action="">
    @csrf

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <a href="{{ route('task.index') }}" class="btn btn-outline-secondary btn-sm mb-2">&larr; Kembali</a>
            <h2 class="mb-0">Daftar Pengumpulan Tugas</h2>
            <p class="text-muted mb-0">Tugas: <span class="text-dark fw-bold">{{ $task->desc }}</span></p>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <div class="btn-group shadow-sm" role="group">
                <button type="button" onclick="submitBulk('{{ route('task.bulkAccept', $task->id) }}')" class="btn btn-success btn-sm px-3">
                    ✔ Setujui Terpilih
                </button>
                <button type="button" onclick="submitBulk('{{ route('task.bulkReject', $task->id) }}')" class="btn btn-danger btn-sm px-3">
                    ❌ Tolak Terpilih
                </button>
            </div>

            <button type="submit" form="clear-proofs-form" class="btn btn-outline-danger btn-sm shadow-sm">
                🗑️ Hapus Semua Bukti Fisik
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col" width="40">
                                <input type="checkbox" id="select-all" class="form-check-input">
                            </th>
                            <th scope="col" class="text-start ps-2">Nama Siswa</th>
                            <th scope="col">Penempatan Lab</th>
                            <th scope="col">Waktu Pengumpulan</th>
                            <th scope="col">Berkas Bukti</th>
                            <th scope="col" width="220">Evaluasi Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($details as $detail)
                        <tr class="align-middle text-center">
                            <td>
                                @if($detail->sub_stat == 'submitted')
                                    <input type="checkbox" name="detail_ids[]" value="{{ $detail->id }}" class="form-check-input student-checkbox">
                                @else
                                    <input type="checkbox" class="form-check-input" disabled>
                                @endif
                            </td>
                            <td class="text-start ps-2 fw-bold">{{ $detail->student->name }}</td>
                            <td>{{ $detail->student->lab->name }}</td>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($detail->updated_at)->format('d M Y, H:i') }}</td>
                            <td>
                                @if($detail->proof)
                                    <a href="{{ asset($detail->proof) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        🔍 Lihat Gambar Bukti
                                    </a>
                                @else
                                    <span class="text-muted fs-7 italic">Tidak ada berkas</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    @if($detail->sub_stat == 'accepted')
                                        <span class="badge bg-success px-3 py-2 fs-7">✔ Disetujui</span>
                                    @elseif($detail->sub_stat == 'rejected')
                                        <span class="badge bg-danger px-3 py-2 fs-7">❌ Ditolak</span>
                                    @else
                                        <button type="submit" formaction="{{ route('task.accepted', [$task->id, $detail->id]) }}" class="btn btn-success btn-sm">✔ Setujui</button>
                                        <button type="submit" formaction="{{ route('task.rejected', [$task->id, $detail->id]) }}" class="btn btn-danger btn-sm">❌ Tolak</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                Belum ada siswa yang mengirim berkas untuk tugas ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

<form id="clear-proofs-form" action="{{ route('task.clearProofs') }}" method="POST" class="d-none" onsubmit="return confirm('Yakin ingin menghapus semua berkas fisik bukti gambar? Tindakan ini permanen!');">
    @csrf
</form>

<script>
    document.getElementById('select-all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.student-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    function submitBulk(routeUrl) {
        let checkedCount = document.querySelectorAll('.student-checkbox:checked').length;
        if (checkedCount === 0) {
            alert('Silakan pilih minimal satu siswa terlebih dahulu.');
            return;
        }

        if (confirm(`Apakah Anda yakin ingin memproses ${checkedCount} tugas sekaligus?`)) {
            let form = document.getElementById('bulk-action-form');
            form.action = routeUrl;
            form.submit();
        }
    }
</script>

@endsection
