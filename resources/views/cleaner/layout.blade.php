<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cleaner Panel - HomeShine</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Font (SAME AS ADMIN) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

    body{
        font-family:'Poppins',sans-serif;
        background:#F8FAFC;
        color:#1F2937;
    }

    /* SAME CARD STYLE AS ADMIN */
    .custom-card{
        background:#fff;
        border:none;
        border-radius:20px;
        box-shadow:0 4px 20px rgba(0,0,0,.06);
        transition:.3s;
    }

    .custom-card:hover{
        transform:translateY(-4px);
        box-shadow:0 10px 30px rgba(0,0,0,.08);
    }

    /* ICON BOX (same admin style) */
    .icon-box{
        width:60px;
        height:60px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:24px;
    }

    /* NAVBAR (COPY ADMIN STYLE) */
    .navbar{
        background:#fff;
        box-shadow:0 2px 20px rgba(0,0,0,.05);
        position:sticky;
        top:0;
        z-index:1000;
    }

    .navbar-brand{
        font-size:28px;
        font-weight:700;
        color:#2563EB !important;
    }

    .nav-link{
        color:#374151 !important;
        font-weight:500;
        padding:10px 14px !important;
        border-radius:12px;
        transition:.3s;
    }

    .nav-link:hover{
        background:#EFF6FF;
        color:#2563EB !important;
    }

    .nav-link.active{
        background:#EFF6FF;
        color:#2563EB !important;
        font-weight:600;
    }

    /* NOTIFICATION (same admin) */
    .notification-menu{
        width:380px;
        max-height:450px;
        overflow-y:auto;
    }

    .notification-item{
        border-radius:12px;
        transition:.2s;
    }

    .notification-item:hover{
        background:#F8FAFC;
    }

    .notification-icon{
        width:42px;
        height:42px;
        border-radius:12px;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-shrink:0;
    }

    .notification-message{
        font-size:13px;
        color:#6B7280;
    }

    .notification-time{
        font-size:12px;
        color:#9CA3AF;
    }

    .unread-dot{
        width:8px;
        height:8px;
        background:#EF4444;
        border-radius:50%;
        display:inline-block;
    }

    /* MAIN CONTENT SAME AS ADMIN */
    .main-content{
        padding-top:40px;
        padding-bottom:40px;
    }

    /* MOBILE RESPONSIVE (same admin) */
    @media (max-width:991px){

        .navbar-nav{
            padding-top:15px;
        }

        .nav-item{
            width:100%;
        }

        .nav-link{
            margin-bottom:5px;
        }

    }

    @media (max-width:576px){

        .navbar-brand{
            font-size:22px;
        }

        .main-content{
            padding-top:20px;
            padding-bottom:20px;
        }

        .container-fluid{
            padding-left:15px !important;
            padding-right:15px !important;
        }

        h1{font-size:26px;}
        h2{font-size:24px;}
        h3{font-size:20px;}
    }

    </style>

</head>

<body>

@php
use App\Models\Booking;
$pendingBookings = Booking::where('status','Pending')->count();
@endphp

<!-- NAVBAR (NOW SAME STRUCTURE AS ADMIN) -->
<nav class="navbar navbar-expand-lg py-3">

    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="/cleaner/dashboard">
            HomeShine
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#cleanerNavbar">

            <i class="bi bi-list fs-2"></i>

        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="cleanerNavbar">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cleaner/dashboard') ? 'active' : '' }}"
                       href="/cleaner/dashboard">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cleaner/bookings*') ? 'active' : '' }}"
                       href="/cleaner/bookings">
                        <i class="bi bi-calendar-check me-1"></i> Bookings
                        <span class="badge bg-danger rounded-pill">{{ $pendingBookings }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cleaner/jobs*') ? 'active' : '' }}"
                       href="/cleaner/jobs">
                        <i class="bi bi-briefcase-fill me-1"></i> Jobs
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cleaner/transactions*') ? 'active' : '' }}"
                       href="/cleaner/transactions">
                        <i class="bi bi-wallet2 me-1"></i> Transactions
                    </a>
                </li>

                <!-- PROFILE -->
                <li class="nav-item ms-2">

                    <span class="fw-semibold text-secondary d-flex align-items-center">

                        @if(Auth::user()->profile_image)
                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                                 width="35"
                                 height="35"
                                 class="rounded-circle me-2"
                                 style="object-fit:cover;">
                        @else
                            <i class="bi bi-person-circle fs-4 me-2"></i>
                        @endif

                        {{ Auth::user()->name }}

                    </span>

                </li>

                <!-- NOTIFICATION (same admin style) -->
                <li class="nav-item dropdown me-3">

                    <a class="nav-link position-relative"
                       href="#"
                       id="notificationDropdown"
                       data-bs-toggle="dropdown">

                        <i class="bi bi-bell-fill fs-5"></i>

                        @if(Auth::user()->unreadNotifications->count())
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ Auth::user()->unreadNotifications->count() }}
                            </span>
                        @endif

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2 notification-menu">

                        <li class="px-3 py-2 border-bottom">
                            <strong>Notifications</strong>
                        </li>

                        @forelse(Auth::user()->notifications->take(8) as $notification)

                        <li>
                            <a href="#" class="dropdown-item notification-item p-3">

                                <div class="d-flex">

                                    <div class="notification-icon bg-secondary-subtle">
                                        <i class="bi bi-bell text-secondary"></i>
                                    </div>

                                    <div class="ms-3 flex-grow-1">
                                        <div class="fw-semibold">Notification</div>
                                        <div class="notification-message">
                                            {{ $notification->data['message'] }}
                                        </div>
                                        <div class="notification-time">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>
                                    </div>

                                    @if(is_null($notification->read_at))
                                        <span class="unread-dot mt-2"></span>
                                    @endif

                                </div>

                            </a>
                        </li>

                        @empty
                        <li class="text-center py-3 text-muted">No notifications</li>
                        @endforelse

                    </ul>

                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cleaner/profile*') ? 'active' : '' }}"
                       href="/cleaner/profile">

                        <i class="bi bi-person-circle me-1"></i>
                        My Profile

                    </a>
                </li>

                <!-- LOGOUT -->
                <li class="nav-item ms-3">

                    <form method="POST" action="/logout">
                        @csrf
                        <button class="btn btn-danger px-4 rounded-pill">
                            Logout
                        </button>
                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>

@php

$user = auth()->user();

$profileComplete =
    $user->name &&
    $user->email &&
    $user->phone &&
    $user->profile_image;

@endphp

@if(!$profileComplete)

<div class="alert alert-warning m-3 border-0 shadow-sm rounded-4">

    <i class="bi bi-exclamation-triangle-fill me-2"></i>

    Your profile is incomplete. Please update your information to fully activate your cleaner account.

    <a href="/cleaner/profile" class="fw-semibold ms-2">
        Complete Profile
    </a>

</div>

@endif

<!-- CONTENT -->
<div class="container-fluid px-lg-5 px-md-4 px-3 main-content">

    @yield('content')

</div>

<!-- Footer -->
<footer class="bg-white border-top mt-5 py-3">

    <div class="container text-center text-secondary">

        © 2026 HomeShine Cleaner Panel

    </div>

</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('notificationDropdown')?.addEventListener('click', function () {

    fetch("{{ route('cleaner.notifications.read') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

});
</script>

</body>
</html>
