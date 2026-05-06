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

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"><br><br>

    <input type="password" name="password" placeholder="Password"><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
