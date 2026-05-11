<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST" action="/register">
    @csrf

    @if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}"><br><br>

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"><br><br>

    <input type="password" name="password" placeholder="Password"><br>
    <small>
        Password must be 8–10 characters, include:
        uppercase, lowercase, number, and symbol.
    </small><br><br>

    <select name="role">
    <option value="">Select Role</option>
        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
        <option value="cleaner" {{ old('role') == 'cleaner' ? 'selected' : '' }}>Cleaner</option>
    </select><br><br>

    <button type="submit">Register</button>
    <br><br>

    <p>
    Already have an account?
    <a href="/login">Login</a>
    </p>
</form>

</body>
</html>
