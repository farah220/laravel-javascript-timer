<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'><link rel="stylesheet" href="{{asset('assets/style.css')}}">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-form">
    <form action="{{route('web.register')}}" method="post">
        @csrf
        <h1>Sign up</h1>
        <div class="content">
            <div class="input-field">
                <input type="text" placeholder="Name" name="name" value="{{ old('name') }}">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-field">
                <input type="email" placeholder="Email"  name="email" value="{{ old('email') }}" >
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
            <div class="input-field">
                <input type="password" placeholder="password Confirmation" name="password_confirmation" >
            </div>

        </div>
        <div class="action">
            <button type="submit" class="btn btn-dark" >Sign up</button>
        </div>
    </form>
</div>
<!-- partial -->
<script  src="{{asset('assets/script.js')}}"></script>

</body>
</html>
