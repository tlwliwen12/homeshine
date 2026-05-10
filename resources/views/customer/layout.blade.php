<!DOCTYPE html>
<html>
<head>
    <title>Customer Panel</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))

<script>

Swal.fire({
    title: 'Success!',
    text: '{{ session('success') }}',
    icon: 'success',
    confirmButtonText: 'OK'
});

</script>

@endif
<body>

    <h2>HomeShine Customer Panel</h2>

    <hr>

    <!-- NAVIGATION -->
    <a href="/customer/dashboard">Dashboard</a> |
    <a href="/customer/services">Services</a> |
    <a href="/customer/bookings">My Bookings</a> |

    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <hr>

    <!-- PAGE CONTENT -->
    @yield('content')

</body>
</html>
