<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Panel - HomeShine</title>

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
            font-family: 'Poppins', sans-serif;
            background: #F8FAFC;
            color: #1F2937;
        }

        /* Navbar */
        .navbar{
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        }

        .navbar-brand{
            font-size: 28px;
            font-weight: 700;
            color: #2563EB !important;
        }

        .nav-link{
            color: #1F2937 !important;
            font-weight: 500;
            margin-right: 10px;
            transition: 0.3s;
        }

        .nav-link:hover{
            color: #2563EB !important;
        }

        .nav-link.active{
            color: #2563EB !important;
        }

        /* Main */
        .main-content{
            padding-top: 40px;
            padding-bottom: 40px;
        }

        /* Cards */
        .custom-card{
            background: white;
            border: none;
            border-radius: 24px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        }

        /* Buttons */
        .btn-primary{
            background: #2563EB;
            border: none;
            border-radius: 50px;
        }

        .btn-primary:hover{
            background: #1D4ED8;
        }

        .btn-danger{
            border-radius: 50px;
        }

        /* Footer */
        footer{
            background: white;
            border-top: 1px solid #E5E7EB;
            padding: 20px 0;
            margin-top: 40px;
        }

    </style>

</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg py-3">

    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand"
           href="/admin/dashboard">
            HomeShine
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#adminNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- Navbar Menu -->
        <div class="collapse navbar-collapse"
             id="adminNavbar">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">

                    <a class="nav-link"
                       href="/admin/dashboard">

                        <i class="bi bi-speedometer2 me-1"></i>
                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link"
                       href="/admin/services">

                        <i class="bi bi-grid me-1"></i>
                        Services

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link"
                       href="/admin/services/create">

                        <i class="bi bi-plus-circle me-1"></i>
                        Add Service

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link"
                       href="/admin/cleaners">

                        <i class="bi bi-person-badge me-1"></i>
                        Manage Cleaners

                    </a>

                </li>

                <a href="/admin/bookings"
                   class="nav-link">

                    <i class="bi bi-calendar-check me-2"></i>

                    Manage Bookings

                </a>

                <li class="nav-item">

                    <a href="/admin/transactions"
                       class="nav-link">

                       <i class="bi bi-cash-stack me-2"></i>

                       Transactions

                    </a>

                </li>

                <!-- Logout -->
                <li class="nav-item ms-3">

                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                                class="btn btn-danger px-4 rounded-pill">

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

        © 2026 HomeShine Admin Panel

    </div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
