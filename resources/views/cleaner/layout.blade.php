<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Cleaner Panel - HomeShine</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        body{
            font-family:'Poppins',sans-serif;
            background:#F8FAFC;
        }

        .navbar-custom{
            background:white;
            box-shadow:0 4px 20px rgba(0,0,0,0.05);
            padding:15px 30px;
        }

        .brand{
            font-size:28px;
            font-weight:700;
            color:#2563EB;
        }

        .nav-link{
            font-weight:500;
            color:#374151 !important;
            margin-left:10px;
            transition:0.3s;
        }

        .nav-link:hover{
            color:#2563EB !important;
        }

        .custom-card{
            border:none;
            border-radius:24px;
            background:white;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
        }

    </style>

</head>

<body>

@php

use App\Models\Booking;

$pendingBookings = Booking::where('status', 'Pending')->count();

@endphp

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">

    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand brand"
           href="/cleaner/dashboard">

            HomeShine

        </a>

        <!-- Toggle -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                <!-- Dashboard -->
                <li class="nav-item">

                    <a class="nav-link"
                       href="/cleaner/dashboard">

                        <i class="bi bi-speedometer2 me-1"></i>
                        Dashboard

                    </a>

                </li>

                <!-- Manage Bookings -->
                <li class="nav-item">

                    <a class="nav-link"
                       href="/cleaner/bookings">

                        <i class="bi bi-calendar-check me-1"></i>
                        Manage Bookings

                        <span class="badge bg-danger rounded-pill">

                            {{ $pendingBookings }}

                        </span>

                    </a>

                </li>

                <!-- Accepted Jobs -->
                <li class="nav-item">

                    <a class="nav-link"
                       href="/cleaner/jobs">

                        <i class="bi bi-briefcase-fill me-1"></i>
                        Accepted Jobs

                    </a>

                </li>

                <!-- User -->
                <li class="nav-item ms-3">

                    <span class="fw-semibold text-secondary">

                        {{ Auth::user()->name }}

                    </span>

                </li>

                <!-- Logout -->
                <li class="nav-item ms-3">

                    <form method="POST"
                          action="/logout">

                        @csrf

                        <button class="btn btn-danger rounded-pill px-4">
                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- Content -->
<div class="container py-4">

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
