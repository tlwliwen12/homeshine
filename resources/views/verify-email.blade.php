<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>
<body>

<h2>Email Verification</h2>

<p>
    Please verify your email address by clicking the link we sent to your email.
</p>

<!-- Success message -->
@if (session('message'))
    <div style="color:green;">
        {{ session('message') }}
    </div>
@endif

<!-- Resend button -->
<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">
        Resend Verification Email
    </button>
</form>

<br><br>

<a href="/login">
    Back to Login
</a>

<br>

</body>
</html>
