<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Monitoring')</title>
    <link rel="icon" href="{{ asset('logo/lab.png') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        html, body {
            margin: 0;
            background-color: #f8f9fa;
        }
        .wrapper {
            display: flex;
            min-height: 100vh; 
        }
        .sidebar {
            width: 250px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }
        .nav-link.active {
            background-color: #0d6efd;
            border-radius: 0.375rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar bg-dark p-3">
        <h5 class="text-white mb-4 text-center border-bottom pb-3">Task Management</h5>

        <ul class="nav flex-column flex-grow-1">
            <li class="nav-item mb-1">
                <a href="{{ route('school.index') }}" class="nav-link text-light {{ request()->routeIs('school.*') ? 'active' : '' }}">
                    Sekolah
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('lab.index') }}" class="nav-link text-light {{ request()->routeIs('lab.*') ? 'active' : '' }}">
                    Lab
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('student.index') }}" class="nav-link text-light {{ request()->routeIs('student.*') ? 'active' : '' }}">
                    Siswa
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('task.index') }}" class="nav-link text-light {{ request()->routeIs('task.*') ? 'active' : '' }}">
                    Penugasan
                </a>
            </li>
        </ul>

        <div class="mt-auto pt-3 border-top">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
            </form>
        </div>
    </div>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('errors') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

</body>
</html>
