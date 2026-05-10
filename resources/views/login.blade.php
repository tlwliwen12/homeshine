<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST" action="/login">
    @csrf

    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
    @error('email')
        <div style="color:red;">
            {{ $message }}
        </div>
    @enderror
    <br><br>

    <input type="password" name="password" placeholder="Password">
    @error('password')
        <div style="color:red;">
            {{ $message }}
        </div>
    @enderror
    <br><br>

    <button type="submit">Login</button>

    <br><a href="/forgot-password">
        Forgot Password?
    </a>
</form>

</body>
</html>
