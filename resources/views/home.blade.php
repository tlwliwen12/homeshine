<!DOCTYPE html>
<html>
<head>
    <title>HomeShine</title>
</head>
<body>

<h1>Welcome to HomeShine 🧹</h1>
<p>Book professional cleaning services easily.</p>

<hr>

@guest
    <a href="/login">Login</a> |
    <a href="/register">Register</a>
@endguest

@auth
    <p>Welcome, {{ auth()->user()->name }}</p>

    @if(auth()->user()->role == 'customer')
        <a href="/customer/dashboard">Go to Dashboard</a>
    @elseif(auth()->user()->role == 'cleaner')
        <a href="/cleaner/dashboard">Go to Dashboard</a>
    @endif

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endauth

</body>
</html>
