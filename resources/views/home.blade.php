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

/* ===== NAVBAR (cleaner + softer) ===== */
.navbar{
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 18px rgba(0,0,0,0.04);
    position: sticky;
    top: 0;
    z-index: 999;
}

.navbar-brand{
    font-size: 28px;
    font-weight: 700;
    color: #2563EB !important;
}

.nav-link{
    color: #1F2937 !important;
    font-weight: 500;
    margin-left: 10px;
    border-radius: 12px;
    padding: 8px 14px !important;
    transition: 0.25s;
}

.nav-link:hover{
    background: #EFF6FF;
    color: #2563EB !important;
}

/* ===== HERO ===== */
.hero-section{
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 100%);
}

.hero-title{
    font-size: 56px;
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -0.5px;
}

.hero-text{
    font-size: 18px;
    line-height: 1.7;
    color: #6B7280;
}

/* badge */
.badge-custom{
    background: rgba(37,99,235,0.1);
    color: #2563EB;
    padding: 8px 16px;
    border-radius: 999px;
    font-weight: 500;
    display: inline-block;
}

/* ===== BUTTONS ===== */
.btn-primary{
    background-color: #2563EB;
    border: none;
    box-shadow: 0 6px 18px rgba(37,99,235,0.25);
}

.btn-primary:hover{
    background-color: #1D4ED8;
    transform: translateY(-1px);
}

.btn-outline-primary{
    border-color: #2563EB;
    color: #2563EB;
}

.btn-outline-primary:hover{
    background-color: #2563EB;
    color: white;
}

/* ===== CARDS ===== */
.feature-card{
    border: 1px solid rgba(0,0,0,0.05);
    border-radius: 20px;
    background: white;
    box-shadow: 0 8px 25px rgba(0,0,0,0.04);
    transition: 0.3s ease;
}

.feature-card:hover{
    transform: translateY(-8px);
    box-shadow: 0 14px 35px rgba(0,0,0,0.08);
}

.feature-icon{
    font-size: 48px;
}

/* ===== SECTIONS SPACING ===== */
section{
    padding: 80px 0;
}

/* ===== TITLES ===== */
h2{
    letter-spacing: -0.3px;
}

/* ===== FOOTER ===== */
footer{
    background: white;
    padding: 25px 0;
    border-top: 1px solid #eee;
}

/* ===== ANIMATION ===== */
.reveal{
    opacity: 0;
    transform: translateY(18px);
    transition: all 0.6s ease;
}

.reveal.active{
    opacity: 1;
    transform: translateY(0);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 991px){

    .hero-title{
        font-size: 42px;
        text-align: center;
    }

    .hero-text{
        text-align: center;
    }

    .hero-section{
        text-align: center;
        padding: 60px 0;
    }
}

@media (max-width: 576px){

    .hero-title{
        font-size: 32px;
    }

    .hero-text{
        font-size: 16px;
    }

    .btn{
        width: 100%;
    }

    section{
        padding: 60px 0;
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
                     style="max-width:480px; width:100%; filter: drop-shadow(0 20px 30px rgba(0,0,0,0.08));"
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

                    <h2 class="text-primary fw-bold my-3">RM 60</h2>

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

                    <h2 class="text-primary fw-bold my-3">RM 180</h2>

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
                    @if(session('success'))
                        <div class="alert alert-success rounded-3 border-0 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="/contact/send">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control rounded-3" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control rounded-3" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Message</label>
                            <textarea name="message" class="form-control rounded-3" rows="4" required></textarea>
                        </div>

                        <button class="btn btn-primary rounded-pill px-4">
                            Send Message
                        </button>
                    </form>

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
