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

    .cleaner-avatar{
    width:35px;
    height:35px;
    object-fit:cover;
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
    max-width:95vw;
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

    .stat-card{
        transition:.3s;
    }

    .stat-card:hover{
        transform:translateY(-5px);
    }

    /* ========================================
       GLOBAL DESIGN SYSTEM
    ======================================== */

    .page-header{
        margin-bottom:2rem;
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

    /* Reusable Card */
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

    /* Status Badge */
    .status-badge{
        padding:.55rem .9rem;
        border-radius:999px;
        font-size:.75rem;
        font-weight:600;
    }

    .status-pending{
        background:#FEF3C7;
        color:#92400E;
    }

    .status-accepted{
        background:#DBEAFE;
        color:#1E40AF;
    }

    .status-completed{
        background:#DCFCE7;
        color:#166534;
    }

    .status-cancelled{
        background:#FEE2E2;
        color:#991B1B;
    }

    /* Action Cards */
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

    .action-icon{
        width:55px;
        height:55px;
        border-radius:15px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
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
            align-items:start !important;
        }

        .nav-item{
            width:100%;
        }

        .nav-link{
            margin-bottom:5px;
        }

        .profile-nav{
            margin:10px 0;
            padding:10px;
            background:#F8FAFC;
            border-radius:12px;
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

        .notification-menu{
            width:95vw;
            max-width:350px;
        }
    }

    .table-responsive{
        border-radius:16px;
    }

    .table thead th{
        border-bottom:2px solid #E5E7EB;
        font-weight:600;
        color:#374151;
    }

    .table td{
        vertical-align:middle;
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
                                 class="rounded-circle me-2 cleaner-avatar"
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
                       id="notificationDropdown"
                       data-bs-toggle="dropdown">

                        <i class="bi bi-bell-fill fs-5"></i>

                        @if(Auth::user()->unreadNotifications->count())

                            <span class="unread-dot position-absolute top-0 start-100 translate-middle"></span>

                        @endif

                    </a>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2 notification-menu">

                    <li class="px-3 py-2 border-bottom">

                        <div class="d-flex justify-content-between align-items-center">

                            <strong class="fs-6">
                                Notifications
                            </strong>

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
                                $title = 'Customer Payment';
                            }

                            elseif(str_contains($message,'booking')){
                                $icon = 'bi-calendar-check';
                                $bg = 'bg-warning-subtle';
                                $color = 'text-warning';
                                $title = 'New Booking';
                            }

                            elseif(str_contains($message,'cancel')){
                                $icon = 'bi-x-circle';
                                $bg = 'bg-danger-subtle';
                                $color = 'text-danger';
                                $title = 'Booking Cancelled';
                            }

                            elseif(
                                str_contains($message,'account approved') ||
                                str_contains($message,'approved your account')
                            ){

                                $icon = 'bi-patch-check-fill';
                                $bg = 'bg-success-subtle';
                                $color = 'text-success';
                                $title = 'Account Approved';
                            }

                            elseif(str_contains($message,'payout')){
                                $icon = 'bi-wallet2';
                                $bg = 'bg-success-subtle';
                                $color = 'text-success';
                                $title = 'Payout Received';
                            }


                        @endphp

                        <li>

                            <a href="#"
                               class="dropdown-item notification-item p-3">

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
                                        <div class="d-flex align-items-center">
                                            <span class="unread-dot"></span>
                                        </div>
                                    @endif

                                </div>

                            </a>

                        </li>

                    @empty

                        <li>

                            <div class="text-center py-4 text-muted">

                                No notifications

                            </div>

                        </li>

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
<div class="container-fluid px-xl-5 px-lg-4 px-md-3 px-2 main-content">

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
