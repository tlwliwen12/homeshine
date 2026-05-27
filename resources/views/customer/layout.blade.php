<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customer Panel - HomeShine</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

        body{
            font-family: 'Poppins', sans-serif;
            background: #F8FAFC;
            color: #1F2937;
        }

        /* Navbar */
        .navbar{
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand{
            font-size: 28px;
            font-weight: 700;
            color: #2563EB !important;
        }

        .nav-link{
            color: #1F2937 !important;
            font-weight: 500;
            margin-left: 8px;
            padding: 8px 14px;
            border-radius: 10px;
            transition: 0.3s;
        }

        .nav-link:hover{
            background: #EFF6FF;
            color: #2563EB !important;
        }

        .nav-link.active{
            background: #EFF6FF;
            color: #2563EB !important;
            font-weight: 600;
        }

        /* Main Content */
        .main-content{
            padding-top: 40px;
            padding-bottom: 60px;
        }

        /* Page Title */
        .page-title{
            font-size: 32px;
            font-weight: 700;
        }

        /* Cards */
        .custom-card{
            background: white;
            border: none;
            border-radius: 24px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .custom-card:hover{
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }

        /* Buttons */
        .btn-primary{
            background-color: #2563EB;
            border: none;
        }

        .btn-primary:hover{
            background-color: #1D4ED8;
        }

        .btn-danger{
            border-radius: 50px;
        }

        /* Footer */
        footer{
            background: white;
            border-top: 1px solid #E5E7EB;
            padding: 20px 0;
        }

    </style>

</head>

<body>

<!-- SUCCESS ALERT -->
@if(session('success'))

<script>

Swal.fire({
    title: 'Success',
    text: '{{ session('success') }}',
    icon: 'success',
    confirmButtonColor: '#2563EB',
    confirmButtonText: 'OK'
});

</script>

@endif

<!-- Navbar -->
<nav class="navbar navbar-expand-lg py-3">

    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="/customer/dashboard">
            HomeShine
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('customer/dashboard') ? 'active' : '' }}"
                       href="/customer/dashboard">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('customer/services') ? 'active' : '' }}"
                       href="/customer/services">
                        <i class="bi bi-grid me-1"></i> Services
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('customer/bookings') ? 'active' : '' }}"
                       href="/customer/bookings">
                        <i class="bi bi-calendar-check me-1"></i> Bookings
                    </a>
                </li>

                <li class="nav-item">

                    <a href="/customer/payments" class="nav-link">
                        <i class="bi bi-credit-card"></i>
                        History
                    </a>

                </li>

                <!-- User -->
                <li class="nav-item ms-3">
                    <span class="fw-semibold text-secondary">
                        @auth
                        Hi, {{ Auth::user()->name }}
                        @endauth
                    </span>
                </li>

                <li class="nav-item">

                    <a class="nav-link"
                       href="/customer/profile">

                        <i class="bi bi-person-circle me-1"></i>
                        Profile

                    </a>

                </li>

                <!-- Logout -->
                <li class="nav-item ms-3">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="btn btn-danger rounded-pill px-4">
                            Logout
                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- Main Content -->
<div class="container main-content">

    @yield('content')

</div>

<!-- Footer -->
<footer>

    <div class="container text-center text-secondary">

        © 2026 HomeShine Customer Panel

    </div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
