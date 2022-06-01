<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laravel_luthfifadle | Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <video src="{{ asset('vid/bg.mp4') }}" autoplay loop muted id="myVideo"></video>
    <div class="card position-absolute top-50 start-50 translate-middle text-center" style="width: 30rem;">
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
        <div class="card-header">
            <img src="{{ asset('img/logo.png') }}" height="100">
        </div>
        <div class="card-body">
            <h3>Login</h3>
            <hr>
            <form method="POST" action="{{ url('login-auth') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
