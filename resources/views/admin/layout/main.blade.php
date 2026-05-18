<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Monitoring')</title>
    <link rel="icon" href="{{ asset('logo/lab.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Desktop View Styles */
        @media (min-width: 992px) {
            .wrapper {
                display: flex;
                min-height: 100vh;
            }
            .sidebar-desktop {
                width: 260px;
                flex-shrink: 0;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
            .main-content {
                flex: 1;
                padding: 2.5rem;
                overflow-y: auto;
            }
        }

        /* Mobile View Adjustment */
        @media (max-width: 991.98px) {
            .main-content {
                padding: 1.5rem 1rem;
            }
        }

        /* Style for active navigation links */
        .nav-link.active {
            background-color: #0d6efd !important;
            color: #ffffff !important;
            border-radius: 0.375rem;
            font-weight: 600;
        }

        .nav-link:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.375rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark d-lg-none shadow-sm sticky-top">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">💻 Task Management</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="wrapper">

    <div class="sidebar-desktop bg-dark p-3 d-none d-lg-flex shadow">
        <h5 class="text-white mb-4 text-center border-bottom pb-3 fw-bold">Task Management</h5>
        @include('admin.layout._sidebar_links')
    </div>

    <div class="offcanvas offcanvas-start bg-dark text-white d-lg-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
        <div class="offcanvas-header border-bottom border-secondary">
            <h5 class="offcanvas-title fw-bold" id="mobileSidebarLabel">Menu Panel</h5>
            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-3">
            @include('admin.layout._sidebar_links')
        </div>
    </div>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('errors'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('errors') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

</body>
</html>
