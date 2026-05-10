<h1>Reset Password</h1>

<form method="POST" action="/reset-password">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>New Password:</label><br>
    <input type="password" name="password"><br><br>

    <label>Confirm Password:</label><br>
    <input type="password" name="password_confirmation"><br><br>

    @error('email')
        <div style="color:red;">{{ $message }}</div>
    @enderror

    @error('password')
        <div style="color:red;">{{ $message }}</div>
    @enderror

    <button type="submit">
        Reset Password
    </button>
</form>
