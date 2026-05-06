<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laman Siswa</title>
    <link rel="icon" href="{{ asset('logo/lab.png') }}">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
</head>
<body>
    <div class="d-flex mt-5">
    <h5 class="d-flex w-50 justify-content-center">Selamat datang,&nbsp;<b>{{$student->name}}</b></h5>
    <form action="{{route('logout')}}" method="POST" class="d-flex w-50 justify-content-center">
        @csrf
        @method('POST')
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    </div>
    <h3 class="d-flex justify-content-center mt-5">
        Tugas Hari Ini
    </h3>
    <div class="d-flex justify-content-center" ">
        <table class="table table-hover table-stripped" style="width: 80vh;">
        <thead class="table-primary">
            <tr class="text-center">
                <th>Tugas</th>
                <th>Tenggat</th>
                <th>Status</th>
                <th>Kumpulkan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($taskDetails as $detail)
            <tr class="text-center">
                <td>{{$detail->task->desc}}</td>
                <td>{{$detail->task->due}}</td>
                <td>{{$detail->sub_stat}}</td>
                @if($detail->sub_stat != 'submitted')
                <td><a href="{{route('student-task.create',$detail->id)}}">Klik disini</a></td>
                @else
                <td>Dikumpulkan</td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada tugas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</body>
</html>


