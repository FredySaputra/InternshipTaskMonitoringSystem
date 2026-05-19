<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal PKL | Login</title>
    <link rel="icon" href="{{ asset('logo/lab.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e0e7ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            max-width: 420px;
            width: 100%;
            border-radius: 1.25rem;
            overflow: hidden;
        }
        .login-header {
            background-color: #ffffff;
            padding: 2.5rem 2rem 1.5rem 2rem;
        }
        .brand-icon {
            max-width: 80px;
            margin: 0 auto 1rem auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-control {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 0.75rem 1rem;
        }
        .form-control:focus {
            background-color: #ffffff;
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .btn-login {
            padding: 0.75rem 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

    <div class="container px-3">
        <div class="card login-card shadow-lg border-0 mx-auto">

            <div class="login-header text-center border-bottom">
                <div class="brand-icon text-primary">
                    <img src="{{ asset('logo/lab.png') }}" class="w-100 h-auto">
                </div>
                <h3 class="fw-bold text-dark mb-1">Monitoring PKL</h3>
                <p class="text-muted fs-6 mb-0">Sistem Monitoring PKL Lab ICT</p>
            </div>

            <div class="card-body p-4 p-sm-5 bg-white">

                @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-center py-2 px-3 mb-4 fs-7 shadow-sm border-0" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <div>
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('login-process') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="username" class="form-label fw-semibold text-secondary small text-uppercase">Username</label>
                        <input type="text" name="username" id="username" class="form-control form-control-lg fs-6 rounded-3" placeholder="Masukkan username..." required autofocus autocomplete="username">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold text-secondary small text-uppercase">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg fs-6 rounded-3" placeholder="Masukkan password..." required autocomplete="current-password">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-login rounded-3 shadow-sm mt-2">
                        Masuk
                    </button>
                </form>

            </div>

            <div class="card-footer bg-light text-center py-3 border-0">
                <small class="text-muted">
                    &copy; {{ date('Y') }} Laboratorium ICT Universitas Budi Luhur<br>
                    <span style="font-size: 0.75rem;">Gunakan kredensial yang telah diberikan oleh supervisor.</span>
                </small>
            </div>
        </div>
    </div>

</body>
</html>
