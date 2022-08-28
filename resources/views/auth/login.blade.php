<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'><link rel="stylesheet" href="{{asset('assets/style.css')}}">

</head>
<body>
<div class="login-form">
    <form action="{{route('web.login')}}" method="post">
        @csrf
        <h1>Login</h1>
        <div class="content">
            <div class="input-field">
                <input type="email" placeholder="Email" name="email" autocomplete="nope">
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-field">
                <input type="password" placeholder="Password" name="password" >
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <a href="{{route('web.register-form')}}" class="link">sign up?</a>
        </div>
        <div class="action">
            <button type="submit" class="btn btn-dark">Sign in</button>
        </div>
    </form>
</div>
<!-- partial -->
<script  src="{{asset('assets/script.js')}}"></script>

</body>
</html>
