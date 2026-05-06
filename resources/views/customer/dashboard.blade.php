<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
</head>
<body>

<h1>Customer Dashboard</h1>

@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

@if (session('verify'))
    <div style="color: orange;">
        {{ session('verify') }}
    </div>
@endif

<p>Welcome, {{ auth()->user()->name }}</p>

<h3>Menu</h3>

<a href="#">View Services</a> |
<a href="#">My Bookings</a> |

<form method="POST" action="{{ route('logout') }}" style="display:inline;">
    @csrf
    <button type="submit">Logout</button>
</form>

<hr>
<h3>Quick Actions</h3>

<a href="#">
    <button>Book a Cleaning Service</button>
</a>

</body>
</html>
