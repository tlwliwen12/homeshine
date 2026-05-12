<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HomeShine Admin Panel</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

        <div class="container">

            {{-- Brand --}}
            <a class="navbar-brand fw-bold" href="/admin/dashboard">

                <i class="bi bi-house-heart-fill"></i>
                HomeShine Admin

            </a>

            {{-- Mobile Toggle --}}
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#adminNavbar">

                <span class="navbar-toggler-icon"></span>

            </button>

            {{-- Navbar Content --}}
            <div class="collapse navbar-collapse" id="adminNavbar">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">

                        <a class="nav-link"
                           href="/admin/dashboard">

                            <i class="bi bi-speedometer2"></i>
                            Dashboard

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="/admin/services">

                            <i class="bi bi-broom"></i>
                            Services

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="/admin/services/create">

                            <i class="bi bi-plus-circle"></i>
                            Add Service

                        </a>

                    </li>

                </ul>

                {{-- Logout --}}
                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                            class="btn btn-outline-light">

                        <i class="bi bi-box-arrow-right"></i>
                        Logout

                    </button>

                </form>

            </div>

        </div>

    </nav>

    {{-- Main Content --}}
    <div class="container py-4">

        @yield('content')

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
