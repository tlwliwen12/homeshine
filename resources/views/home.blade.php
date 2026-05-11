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

    <style>

        body{
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC;
        }

        .navbar-brand{
            font-size: 30px;
            font-weight: 700;
            color: #2563EB !important;
        }

        .hero-section{
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        .hero-title{
            font-size: 55px;
            font-weight: 700;
            color: #1F2937;
            line-height: 1.2;
        }

        .hero-text{
            color: #6B7280;
            font-size: 18px;
        }

        .feature-card{
            border: none;
            border-radius: 20px;
            transition: 0.3s;
        }

        .feature-card:hover{
            transform: translateY(-5px);
        }

        .feature-icon{
            font-size: 50px;
        }

        .min-vh-custom{
            min-height: 80vh;
        }

    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">

    <div class="container">

        <a class="navbar-brand" href="#">
            HomeShine
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
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

                    <li class="nav-item ms-3">
                        <span class="fw-semibold">
                            Hi, {{ auth()->user()->name }}
                        </span>
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

<!-- Hero Section -->
<section class="hero-section">

    <div class="container">

        <div class="row align-items-center min-vh-custom">

            <!-- Left Content -->
            <div class="col-lg-6">

                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                    Trusted Cleaning Service
                </span>

                <h1 class="hero-title mb-4">
                    Professional Cleaning Services For Your Home
                </h1>

                <p class="hero-text mb-4">
                    HomeShine helps you book professional and trusted cleaning services quickly and easily.
                </p>

                @guest

                    <a href="/register" class="btn btn-primary btn-lg rounded-pill px-4 me-2">
                        Get Started
                    </a>

                    <a href="/login" class="btn btn-outline-primary btn-lg rounded-pill px-4">
                        Login
                    </a>

                @endguest

                @auth

                    @if(auth()->user()->role == 'customer')

                        <a href="/customer/dashboard" class="btn btn-primary btn-lg rounded-pill px-4">
                            Go to Dashboard
                        </a>

                    @elseif(auth()->user()->role == 'cleaner')

                        <a href="/cleaner/dashboard" class="btn btn-primary btn-lg rounded-pill px-4">
                            Go to Dashboard
                        </a>

                    @endif

                @endauth

            </div>

            <!-- Right Image -->
            <div class="col-lg-6 text-center mt-5 mt-lg-0">

                <img src="{{ asset('images/cleaning.png') }}"
                     class="img-fluid"
                     style="max-width: 500px;"
                     alt="Cleaning Service">

            </div>

        </div>

    </div>

</section>

<!-- Features -->
<section class="py-5 bg-white">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Why Choose HomeShine?
            </h2>

            <p class="text-secondary">
                Reliable and professional home cleaning services.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="card feature-card shadow-sm h-100 p-4 text-center">

                    <div class="feature-icon mb-3">
                        🧹
                    </div>

                    <h4 class="fw-bold">
                        Professional Cleaners
                    </h4>

                    <p class="text-secondary mt-3">
                        Experienced and trusted cleaning professionals.
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card feature-card shadow-sm h-100 p-4 text-center">

                    <div class="feature-icon mb-3">
                        📅
                    </div>

                    <h4 class="fw-bold">
                        Easy Booking
                    </h4>

                    <p class="text-secondary mt-3">
                        Book your cleaning service anytime online.
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card feature-card shadow-sm h-100 p-4 text-center">

                    <div class="feature-icon mb-3">
                        ✨
                    </div>

                    <h4 class="fw-bold">
                        Quality Service
                    </h4>

                    <p class="text-secondary mt-3">
                        We ensure every home stays clean and fresh.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Footer -->
<footer class="bg-white border-top py-4">

    <div class="container text-center text-secondary">

        © 2026 HomeShine. All Rights Reserved.

    </div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
