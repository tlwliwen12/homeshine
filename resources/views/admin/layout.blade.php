<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>

    <h2>HomeShine Admin Panel</h2>

    <hr>

    {{-- NAVIGATION --}}
    <a href="/admin/dashboard">Dashboard</a> |
    <a href="/admin/services">Services</a> |
    <a href="/admin/services/create">Add Service</a> |

    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <hr>

    {{-- PAGE CONTENT --}}
    @yield('content')

</body>
</html>
