<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kumpulkan Tugas</title>
    <link rel="icon" href="{{ asset('logo/lab.png') }}">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <style>
        body { background-color: #f4f6f9; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Form Pengumpulan Tugas</span>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                @if($errors->any())
                    <div class="alert alert-danger shadow-sm">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-primary">Detail Tugas</h5>
                    </div>
                    <div class="card-body p-4">

                        <div class="alert alert-info mb-4">
                            <strong>Tugas:</strong> {{ $detail->task->desc }}<br>
                            <strong>Tenggat:</strong> {{ \Carbon\Carbon::parse($detail->task->due)->format('d M Y, H:i') }}
                        </div>

                        <form action="{{ route('student-task.add', $detail->id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Keterangan / Catatan<span style="color: red">*</span> :</label>
                                <textarea name="description" id="description" cols="20" rows="4" class="form-control" placeholder="Tulis keterangan pekerjaan yang dilakukan.." required></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="proof" class="form-label fw-bold">Upload Bukti Foto<span style="color: red">*</span> :</label>
                                <input type="file" class="form-control" name="proof" id="proof" accept="image/*" capture="environment" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('student.dashboard') }}" class="btn btn-outline-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Kirim Tugas</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
