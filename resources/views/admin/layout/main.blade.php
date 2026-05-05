<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Task Monitoring')</title>
    <link rel="icon" href="{{ asset('logo/lab.png') }}">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <style>
        html,body{
            margin: 0;
        }
        .wrapper{
            display: flex;
            /* min-height: 100vh; */
        }
        .sidebar{
            width: 250px;
            /* min-height: 100vh; */
            flex-shrink: 0;
        }
        .main-content{
            flex: 1;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar bg-dark p-3">
    <h5 class="text-white mb-4">Task Management</h5>
    <ul class="nav flex-column">
        <div class="height">
        <li class="nav-item">
            <a href="{{route('school.index')}}" class="nav-link text-light">Sekolah</a>
        </li>
        <li class="nav-item">
            <a href="{{route('lab.index')}}" class="nav-link text-light">Lab</a>
        </li>
        <li class="nav-item">
            <a href="{{route('student.index')}}" class="nav-link text-light">Siswa</a>
        </li>
        <li class="nav-item">
            <a href="{{route('task.index')}}" class="nav-link text-light">Penugasan</a>
        </li>
        </div>
        <div>
        <li class="nav-item">
            <form action="{{route('logout')}}" method="post">
                @csrf
                @method('POST')
            <input type="submit" value="Logout" class="btn btn-danger"></form>
        </li>
        </div>
    </ul>
    </div>
    <main class="main-content bg-white p-4">
    @yield('content')
    </main>
</div>
</body>
</html>
