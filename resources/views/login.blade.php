<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('logo/lab.png')}}">
    <title>Login Page</title>
    @vite(['resources/sass/app.scss','resources/js/app.scss'])
    <style>
        html,body{
            margin: 0;
        }
    </style>
</head>
<body>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh">
    <div class="card p-4" style="width: 300px;min-height:300px;">
        <h1 class="d-flex mb-4 justify-content-center">Silahkan Login</h1>
        <form action="{{route('login-process')}}" method="post">
        @csrf
        @method('POST')

        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
    </div>
</div>
</body>
</html>
