<h1>Admin Dashboard</h1>

<p>Welcome, {{ Auth::user()->name }}</p>

<hr>

<a href="/admin/services">Manage Services</a>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
