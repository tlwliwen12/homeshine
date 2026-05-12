<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HomeShine</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC;
            color: #1F2937;
        }

        /* Navbar */
        .navbar{
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.04);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-brand{
            font-size: 30px;
            font-weight: 700;
            color: #2563EB !important;
        }

        .nav-link{
            color: #1F2937 !important;
            font-weight: 500;
            margin-left: 10px;
            transition: 0.3s;
            border-radius: 10px;
            padding: 8px 14px !important;
        }

        .nav-link:hover{
            color: #2563EB !important;
            background: #EFF6FF;
        }

        /* Hero */
        .hero-section{
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(to right, #F8FAFC, #EFF6FF);
        }

        .hero-title{
            font-size: 58px;
            font-weight: 700;
            line-height: 1.2;
        }

        .hero-text{
            font-size: 18px;
            line-height: 1.8;
            color: #6B7280;
        }

        .badge-custom{
            background: rgba(16,185,129,0.12);
            color: #10B981;
            padding: 10px 18px;
            border-radius: 50px;
            font-weight: 500;
            display: inline-block;
        }

        /* Buttons */
        .btn-primary{
            background-color: #2563EB;
            border: none;
        }

        .btn-primary:hover{
            background-color: #1D4ED8;
        }

        .btn-outline-primary{
            border-color: #2563EB;
            color: #2563EB;
        }

        .btn-outline-primary:hover{
            background-color: #2563EB;
            color: white;
        }

        /* Feature Cards */
        .feature-card{
            border: none;
            border-radius: 24px;
            background: white;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            transition: 0.3s ease;
        }

        .feature-card:hover{
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }

        .feature-icon{
            font-size: 55px;
        }

        footer{
            background: white;
        }

    </style>

</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg py-3">

    <div class="container">

        <a class="navbar-brand" href="/">
            HomeShine
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active text-primary fw-semibold' : '' }}" href="/">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Services
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contact
                    </a>
                </li>

                @guest

                    <li class="nav-item ms-2">
                        <a href="/login" class="btn btn-outline-primary rounded-pill px-4">
                            Login
                        </a>
                    </li>

                    <li class="nav-item ms-2">
                        <a href="/register" class="btn btn-primary rounded-pill px-4">
                            Register
                        </a>
                    </li>

                @endguest

                @auth

                    <li class="nav-item ms-3 fw-semibold">
                        Hi, {{ auth()->user()->name }}
                    </li>

                    @if(auth()->user()->role == 'customer')

                        <li class="nav-item ms-3">
                            <a href="/customer/dashboard" class="btn btn-primary rounded-pill px-4">
                                Dashboard
                            </a>
                        </li>

                    @elseif(auth()->user()->role == 'cleaner')

                        <li class="nav-item ms-3">
                            <a href="/cleaner/dashboard" class="btn btn-primary rounded-pill px-4">
                                Dashboard
                            </a>
                        </li>

                    @endif

                    <li class="nav-item ms-2">

                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="btn btn-danger rounded-pill px-4">
                                Logout
                            </button>
                        </form>

                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>

<!-- Hero -->
<section class="hero-section">

    <div class="container">

        <div class="row align-items-center">

            <!-- Left -->
            <div class="col-lg-6">

                <span class="badge-custom mb-3">
                    Trusted Cleaning Service
                </span>

                <h1 class="hero-title mb-4">
                    Professional Cleaning Services For Your Home
                </h1>

                <p class="hero-text mb-4">
                    HomeShine helps you book trusted and professional cleaning services quickly and easily.
                </p>

                @guest

                    <a href="/register" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm me-2">
                        Get Started
                    </a>

                    <a href="/login" class="btn btn-outline-primary btn-lg px-5 py-3 rounded-pill shadow-sm">
                        Login
                    </a>

                @endguest

                @auth

                    @if(auth()->user()->role == 'customer')

                        <a href="/customer/dashboard" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm">
                            Go To Dashboard
                        </a>

                    @elseif(auth()->user()->role == 'cleaner')

                        <a href="/cleaner/dashboard" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm">
                            Go To Dashboard
                        </a>

                    @endif

                @endauth

            </div>

            <!-- Right -->
            <div class="col-lg-6 text-center mt-5 mt-lg-0">

                <img src="{{ asset('images/cleaning.png') }}"
                     class="img-fluid"
                     style="max-width:500px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));"
                     alt="Cleaning Service">

            </div>

        </div>

    </div>

</section>

<!-- Features -->
<section class="py-5 bg-white">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold" style="font-size:40px;">
                Why Choose HomeShine?
            </h2>

            <p class="text-secondary">
                Reliable and professional home cleaning services.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="card feature-card p-4 text-center h-100">

                    <div class="feature-icon mb-3">🧹</div>

                    <h4 class="fw-bold">Professional Cleaners</h4>

                    <p class="text-secondary mt-3">
                        Experienced and trusted cleaning professionals for your home.
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card feature-card p-4 text-center h-100">

                    <div class="feature-icon mb-3">📅</div>

                    <h4 class="fw-bold">Easy Booking</h4>

                    <p class="text-secondary mt-3">
                        Book your cleaning service anytime with a simple process.
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card feature-card p-4 text-center h-100">

                    <div class="feature-icon mb-3">✨</div>

                    <h4 class="fw-bold">Quality Service</h4>

                    <p class="text-secondary mt-3">
                        We ensure every home stays clean, fresh, and comfortable.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Footer -->
<footer class="border-top py-4">

    <div class="container text-center text-secondary">
        © 2026 HomeShine. All Rights Reserved.
    </div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
