<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kumpulkan Tugas</title>
    <link rel="icon" href="{{ asset('logo/lab.png') }}">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
</head>
<body>
<div class="m-5">
    <h1 class="h1">Pengumpulan Tugas</h1>
<form action="{{route('student-task.add',$detail->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="description">Keterangan :</label>
        <textarea name="description" id="description" cols="20" rows="5" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="proof">Upload Bukti :</label>
        <div class="col-md-2">
            <input type="file" class="form-control" name="proof" id="proof" accept="image/*">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>
</div>
</body>
</html>
