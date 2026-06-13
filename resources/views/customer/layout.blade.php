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

<style>

/* ========================================
   BASE
======================================== */

body{
    font-family:'Poppins',sans-serif;
    background:#F8FAFC;
    color:#1F2937;
}

/* ========================================
   NAVBAR (SIMPLIFIED + CLEANER)
======================================== */

.navbar{
    background:#fff;
    box-shadow:0 2px 12px rgba(0,0,0,.05);
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
    padding:8px 12px !important;
    border-radius:10px;
    transition:.2s ease;
}

.nav-link:hover{
    background:#EFF6FF;
    color:#2563EB !important;
}

.nav-link.active{
    background:#EFF6FF;
    color:#2563EB !important;
}

/* ========================================
   MAIN CONTENT
======================================== */

.main-content{
    padding-top:32px;
    padding-bottom:40px;
}

/* ========================================
   PAGE HEADER (SYSTEM STANDARD)
======================================== */

.page-header{
    margin-bottom:1.5rem;
}

.page-title{
    font-size:2rem;
    font-weight:700;
    color:#111827;
}

.page-subtitle{
    color:#6B7280;
    font-size:.95rem;
}

/* ========================================
   UNIFIED CARD SYSTEM (IMPORTANT)
======================================== */

.ui-card{
    background:#fff;
    border:none;
    border-radius:20px;
    box-shadow:0 4px 20px rgba(0,0,0,.06);
    transition:.3s;
}

.ui-card:hover{
    transform:translateY(-4px);
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

/* ========================================
   STATUS BADGES (KEEP BUT CLEANED)
======================================== */

.status-badge{
    padding:.45rem .8rem;
    border-radius:999px;
    font-size:.75rem;
    font-weight:600;
}

.status-pending{background:#FEF3C7;color:#92400E;}
.status-confirmed{background:#DBEAFE;color:#1E40AF;}
.status-completed{background:#DCFCE7;color:#166534;}
.status-cancelled{background:#FEE2E2;color:#991B1B;}
.status-progress{
    background:#E0E7FF;
    color:#3730A3;
}

/* ========================================
   ACTION CARDS (SIMPLIFIED)
======================================== */

.action-card{
    background:white;
    border-radius:20px;
    padding:1.25rem;
    text-decoration:none;
    color:#111827;
    display:block;
    transition:.3s;
    box-shadow:0 4px 20px rgba(0,0,0,.05);
}

.action-card:hover{
    transform:translateY(-4px);
    color:#2563EB;
}

.stat-card{
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.icon-box{
    width:70px;
    height:70px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.action-icon{
    width:55px;
    height:55px;
    border-radius:15px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}

.action-card{
    height:100%;
}

/* ========================================
   BUTTONS (UNIFIED LOOK)
======================================== */

.btn-primary{
    background:#2563EB;
    border:none;
    border-radius:12px;
    padding:10px 16px;
}

.btn-primary:hover{
    background:#1D4ED8;
}

/* ========================================
   TABLES (CLEAN GRID STYLE)
======================================== */

.table thead th{
    border-bottom:2px solid #E5E7EB;
    font-weight:600;
    color:#374151;
}

.table td{
    vertical-align:middle;
}

.section-card{
    background:#fff;
    border:none;
    border-radius:20px;
    box-shadow:0 4px 20px rgba(0,0,0,.06);
    transition:.3s;
}

.section-card:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

/* ========================================
   NOTIFICATIONS (UNCHANGED LOGIC, CLEAN UI)
======================================== */

.notification-menu{
    width:360px;
    max-width:95vw;
    max-height:420px;
    overflow-y:auto;
}

.notification-item{
    border-radius:10px;
    transition:.15s ease;
}

.notification-item:hover{
    background:#F8FAFC;
}

.notification-icon{
    width:40px;
    height:40px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
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
    width:7px;
    height:7px;
    background:#EF4444;
    border-radius:50%;
}

/* ========================================
   FOOTER
======================================== */

footer{
    background:#fff;
    border-top:1px solid #E5E7EB;
    margin-top:40px;
}

/* ========================================
   RESPONSIVE
======================================== */

@media (max-width:991px){

    .navbar-nav{
        padding-top:12px;
        align-items:start !important;
    }

    .nav-item{
        width:100%;
    }

    .nav-link{
        margin-bottom:4px;
    }
}

@media (max-width:576px){

    .navbar-brand{
        font-size:20px;
    }

    .main-content{
        padding-top:18px;
        padding-bottom:20px;
    }

    .notification-menu{
        width:95vw;
        max-width:340px;
    }
}

</style>

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
        <button class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <i class="bi bi-list fs-2"></i>

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

                    <a href="/customer/payments"
                       class="nav-link {{ request()->is('customer/payments*') ? 'active' : '' }}">
                        <i class="bi bi-credit-card"></i>
                        History
                    </a>

                </li>

                <!-- User -->
                <li class="nav-item ms-2">

                    <span class="fw-semibold text-secondary d-flex align-items-center">

                        @if(Auth::user()->profile_image)

                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                                 class="rounded-circle me-2"
                                 width="35"
                                 height="35"
                                 style="object-fit:cover;">

                        @else

                            <i class="bi bi-person-circle fs-4 me-2"></i>

                        @endif

                        <span class="text-truncate"
                              style="max-width:120px;display:inline-block;">

                            {{ Auth::user()->name }}

                        </span>

                    </span>

                </li>

                <li class="nav-item dropdown me-3">

                    <a class="nav-link position-relative"
                       href="#"
                       id="customerNotificationDropdown"
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
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="fs-6">Notifications</strong>
                                <small class="text-muted">
                                    {{ Auth::user()->notifications->count() }}
                                </small>
                            </div>
                        </li>

                        @forelse(Auth::user()->notifications->take(8) as $notification)

                            @php
                                $message = strtolower($notification->data['message']);

                                $icon = 'bi-bell';
                                $bg = 'bg-secondary-subtle';
                                $color = 'text-secondary';
                                $title = 'Notification';

                               if(str_contains($message,'payment')){

                                   $icon = 'bi-cash-stack';
                                   $bg = 'bg-success-subtle';
                                   $color = 'text-success';
                                   $title = 'Payment';

                               }

                               elseif(str_contains($message,'booking')){

                                   $icon = 'bi-calendar-check';
                                   $bg = 'bg-warning-subtle';
                                   $color = 'text-warning';
                                   $title = 'Booking Update';

                               }

                               elseif(
                                   str_contains($message,'InProgress') ||
                                   str_contains($message,'Completed')
                                ){

                                    $icon = 'bi-check-circle';
                                    $bg = 'bg-primary-subtle';
                                    $color = 'text-primary';
                                    $title = 'Status Update';

                                }
                            @endphp

                            <li>

                                <a href="#" class="dropdown-item p-3 notification-item">

                                    <div class="d-flex">

                                        <div class="notification-icon {{ $bg }}">
                                            <i class="bi {{ $icon }} {{ $color }}"></i>
                                        </div>

                                        <div class="ms-3 flex-grow-1">

                                            <div class="fw-semibold">
                                                {{ $title }}
                                            </div>

                                            <div class="notification-message">
                                                {{ $notification->data['message'] }}
                                            </div>

                                            <div class="notification-time mt-1">
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

                            <li class="text-center py-4 text-muted">
                                No notifications
                            </li>

                        @endforelse

                    </ul>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->is('customer/profile*') ? 'active' : '' }}"
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
                                class="btn btn-danger px-4 rounded-pill">
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
    $user->phone;

@endphp

@if(!$profileComplete)

<div class="alert alert-warning m-3 border-0 shadow-sm rounded-4">

    <i class="bi bi-exclamation-triangle-fill me-2"></i>

    Your profile is incomplete.

    <a href="/customer/profile">
        Complete Profile
    </a>

</div>

@endif

<!-- Main Content -->
<div class="container-fluid px-xl-5 px-lg-4 px-md-3 px-2 main-content">

    @yield('content')

</div>

<!-- Footer -->
<!-- Footer -->
<footer class="bg-white border-top mt-5 py-3">

    <div class="container text-center text-secondary">

        © 2026 HomeShine Customer Panel

    </div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const dropdown = document.getElementById('customerNotificationDropdown');

    if (dropdown) {

        dropdown.addEventListener('click', function () {

            fetch("{{ route('customer.notifications.read') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            // remove badge instantly
            const badge = dropdown.querySelector('.badge');
            if (badge) {
                badge.remove();
            }

        });

    }

});

</script>

</body>

</html>
