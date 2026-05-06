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

    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
    @error('name')
        <div style="color:red;">{{ $message }}</div>
    @enderror
    <br><br>

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
     @error('email')
        <div style="color:red;">{{ $message }}</div>
    @enderror
    <br><br>
    <input type="password" name="password" placeholder="Password">
     @error('password')
        <div style="color:red;">{{ $message }}</div>
    @enderror
    <br><br>

    <select name="role">
    <option value="">Select Role</option>
        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
        <option value="cleaner" {{ old('role') == 'cleaner' ? 'selected' : '' }}>Cleaner</option>
    </select>
     @error('role')
        <div style="color:red;">{{ $message }}</div>
    @enderror
    <br><br>

    <button type="submit">Register</button>
</form>

</body>
</html>
