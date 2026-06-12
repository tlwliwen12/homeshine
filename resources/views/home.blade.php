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

        html {
            scroll-behavior: smooth;
        }

        /* fade-in animation */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== RESPONSIVE SYSTEM ===== */

/* smooth scaling base */
html {
    font-size: 16px;
}

/* tablets */
@media (max-width: 991px) {

    .hero-title {
        font-size: 42px;
        text-align: center;
    }

    .hero-text {
        text-align: center;
    }

    .hero-section {
        text-align: center;
        padding: 60px 0;
    }

    .container {
        padding-left: 20px;
        padding-right: 20px;
    }

    .navbar-nav {
        text-align: center;
        padding-top: 15px;
    }

    .nav-item {
        margin-bottom: 8px;
    }

    .ms-2, .ms-3 {
        margin-left: 0 !important;
    }

}

/* phones */
@media (max-width: 576px) {
    html { font-size: 14px; }

    .hero-title {
        font-size: 32px;
        line-height: 1.3;
    }

    .hero-text {
        font-size: 16px;
    }

    .navbar-brand {
        font-size: 24px;
    }

    .nav-link {
        margin-left: 0;
        padding: 10px 12px !important;
    }

    .feature-card {
        margin-bottom: 15px;
        text-align: center;
        padding: 25px;
    }

    .btn {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .feature-card {
        margin-bottom: 20px;
    }
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
                    <a class="nav-link" href="#home">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
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
<section id="home" class="hero-section">

    <div class="container">

        <div class="row align-items-center flex-column-reverse flex-lg-row">

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

                   <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center justify-content-lg-start">

                       <a href="/register" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm">
                           Get Started
                       </a>

                       <a href="/login" class="btn btn-outline-primary btn-lg px-5 py-3 rounded-pill shadow-sm">
                           Login
                       </a>

                   </div>

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

                <img src="{{ asset('images/logo.png') }}"
                     class="img-fluid mx-auto d-block"
                     style="max-width:500px; width:100%;"
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

<section id="services" class="py-5 bg-white">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold" style="font-size:40px;">
                Our Services
            </h2>

            <p class="text-secondary">
                Professional cleaning solutions for every home
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="card feature-card p-4 text-center h-100">

                    <div class="feature-icon mb-3">🏠</div>

                    <h4 class="fw-bold">Home Cleaning</h4>

                    <p class="text-secondary mt-3">
                        Full house cleaning service including rooms, kitchen, and living area.
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card feature-card p-4 text-center h-100">

                    <div class="feature-icon mb-3">🧽</div>

                    <h4 class="fw-bold">Deep Cleaning</h4>

                    <p class="text-secondary mt-3">
                        Intensive cleaning for stubborn dirt and deep hygiene.
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card feature-card p-4 text-center h-100">

                    <div class="feature-icon mb-3">🪟</div>

                    <h4 class="fw-bold">Window Cleaning</h4>

                    <p class="text-secondary mt-3">
                        Crystal clear window cleaning for a brighter home.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="py-5 bg-white">

    <div class="container">

        <div class="text-center mb-5 reveal">

            <h2 class="fw-bold" style="font-size:40px;">
                Simple Pricing
            </h2>

            <p class="text-secondary">
                Transparent and affordable rates
            </p>

        </div>

        <div class="row g-4 justify-content-center">

            <!-- Basic -->
            <div class="col-md-4 reveal">

                <div class="card feature-card p-4 text-center h-100">

                    <h4 class="fw-bold">Basic Clean</h4>

                    <h2 class="text-primary fw-bold my-3">RM 50</h2>

                    <p class="text-secondary">Standard home cleaning service</p>

                    <a href="/register" class="btn btn-outline-primary rounded-pill mt-3">
                        Book Now
                    </a>

                </div>

            </div>

            <!-- Deep -->
            <div class="col-md-4 reveal">

                <div class="card feature-card p-4 text-center h-100 border border-primary">

                    <h4 class="fw-bold">Deep Clean</h4>

                    <h2 class="text-primary fw-bold my-3">RM 120</h2>

                    <p class="text-secondary">Full deep cleaning service</p>

                    <a href="/register" class="btn btn-primary rounded-pill mt-3">
                        Book Now
                    </a>

                </div>

            </div>

            <!-- Premium -->
            <div class="col-md-4 reveal">

                <div class="card feature-card p-4 text-center h-100">

                    <h4 class="fw-bold">Premium</h4>

                    <h2 class="text-primary fw-bold my-3">RM 200</h2>

                    <p class="text-secondary">Full house + windows + kitchen</p>

                    <a href="/register" class="btn btn-outline-primary rounded-pill mt-3">
                        Book Now
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<section id="about" class="py-5">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h2 class="fw-bold mb-4" style="font-size:40px;">
                    About HomeShine
                </h2>

                <p class="text-secondary" style="line-height:1.8;">
                    HomeShine is a professional cleaning service platform designed to connect customers
                    with trusted cleaners. We focus on quality, reliability, and convenience to make home
                    cleaning easier than ever.
                </p>

                <p class="text-secondary">
                    Our mission is to ensure every home stays clean, fresh, and comfortable.
                </p>

            </div>

            <div class="col-lg-6 text-center">

                <img src="{{ asset('images/logo.png') }}"
                     class="img-fluid"
                     style="max-width:300px; opacity:0.9;">
            </div>

        </div>

    </div>

</section>

<section class="py-5">

    <div class="container">

        <div class="text-center mb-5 reveal">

            <h2 class="fw-bold" style="font-size:40px;">
                What Customers Say
            </h2>

            <p class="text-secondary">
                Real feedback from our users
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4 reveal">

                <div class="card feature-card p-4 h-100">

                    <p class="text-secondary">
                        “Very professional service. My house has never been this clean before.”
                    </p>

                    <div class="fw-bold mt-3">— Aina, Customer</div>

                </div>

            </div>

            <div class="col-md-4 reveal">

                <div class="card feature-card p-4 h-100">

                    <p class="text-secondary">
                        “Easy booking system and reliable cleaners. Highly recommended!”
                    </p>

                    <div class="fw-bold mt-3">— Daniel, Customer</div>

                </div>

            </div>

            <div class="col-md-4 reveal">

                <div class="card feature-card p-4 h-100">

                    <p class="text-secondary">
                        “As a cleaner, I get jobs easily and manage everything in one place.”
                    </p>

                    <div class="fw-bold mt-3">— Siti, Cleaner</div>

                </div>

            </div>

        </div>

    </div>

</section>

<section id="contact" class="py-5 bg-white">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold" style="font-size:40px;">
                Contact Us
            </h2>

            <p class="text-secondary">
                Get in touch with us anytime
            </p>

        </div>

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card feature-card p-4">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" class="form-control rounded-3">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control rounded-3">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Message</label>
                        <textarea class="form-control rounded-3" rows="4"></textarea>
                    </div>

                    <button class="btn btn-primary rounded-pill px-4">
                        Send Message
                    </button>

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

<script>
function revealOnScroll() {
    const elements = document.querySelectorAll('.reveal');

    elements.forEach(el => {
        const windowHeight = window.innerHeight;
        const elementTop = el.getBoundingClientRect().top;

        if (elementTop < windowHeight - 100) {
            el.classList.add('active');
        }
    });
}

window.addEventListener('scroll', revealOnScroll);
</script>

</body>
</html>
