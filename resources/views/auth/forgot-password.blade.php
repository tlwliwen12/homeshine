<h1>Forgot Password</h1>

@if (session('status'))
    <div style="color:green;">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="/forgot-password">
    @csrf

    <label>Email:</label><br>

    <input type="email" name="email">

    @error('email')
        <div style="color:red;">
            {{ $message }}
        </div>
    @enderror

    <br><br>

    <button type="submit">
        Send Reset Link
    </button>
</form>
