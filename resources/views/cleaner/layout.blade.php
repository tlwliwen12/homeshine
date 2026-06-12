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
            box-shadow:0 4px 20px rgba(0,0,0,.05);
            position:sticky;
            top:0;
            z-index:1000;
        }

        .brand{
            font-size:28px;
            font-weight:700;
            color:#2563EB !important;
        }

        .nav-link{
            font-weight:500;
            color:#374151 !important;
            border-radius:12px;
            padding:10px 14px !important;
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

        .custom-card{
            border:none;
            border-radius:24px;
            background:white;
            box-shadow:0 10px 25px rgba(0,0,0,.05);
        }

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

        /* Mobile */
        @media(max-width:576px){

            .notification-menu{
                width:320px;
            }

        }

        /* Tablet */
        @media (max-width:991px){

            .navbar-nav{
                padding-top:15px;
            }

            .nav-item{
                width:100%;
            }

            .nav-link{
                margin-bottom:6px;
            }

            .logout-btn{
                width:100%;
                margin-top:10px;
            }

        }

        /* Phone */
        @media (max-width:576px){

            .brand{
                font-size:22px;
            }

            .container-fluid{
                padding-left:15px !important;
                padding-right:15px !important;
            }

            h1{
                font-size:28px;
            }

            h2{
                font-size:24px;
            }

            h3{
                font-size:20px;
            }

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

                    <a class="nav-link {{ request()->is('cleaner/dashboard') ? 'active' : '' }}"
                       href="/cleaner/dashboard">

                        <i class="bi bi-speedometer2 me-1"></i>
                        Dashboard

                    </a>

                </li>

                <!-- Manage Bookings -->
                <li class="nav-item">

                    <a class="nav-link {{ request()->is('cleaner/bookings*') ? 'active' : '' }}"
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

                    <a class="nav-link {{ request()->is('cleaner/jobs*') ? 'active' : '' }}"
                       href="/cleaner/jobs">

                        <i class="bi bi-briefcase-fill me-1"></i>
                        Accepted Jobs

                    </a>

                </li>

                <li class="nav-item">

                    <a href="/cleaner/transactions"
                       class="nav-link {{ request()->is('cleaner/transactions*') ? 'active' : '' }}">

                        <i class="bi bi-wallet2 me-2"></i>
                        Transaction History

                    </a>

                </li>

                <!-- User -->
                <li class="nav-item ms-2">

                    <span class="fw-semibold text-secondary">

                        @if(Auth::user()->profile_image)

                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                                 width="35"
                                 height="35"
                                 class="rounded-circle me-2"
                                 style="object-fit:cover;">

                        @endif

                        {{ Auth::user()->name }}

                    </span>

                </li>

                <!-- Notification -->
                <li class="nav-item dropdown me-3">

                   <a class="nav-link position-relative"
                      href="#"
                      id="notificationDropdown"
                      data-bs-toggle="dropdown">

                       <i class="bi bi-bell-fill fs-5"></i>

                       @if(Auth::user()->unreadNotifications->count())

                           <span class="unread-dot mt-2"></span>

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

                               $message = strtolower(
                                   $notification->data['message']
                               );

                               $icon = 'bi-bell';
                               $bg = 'bg-secondary-subtle';
                               $color = 'text-secondary';
                               $title = 'Notification';

                               if(str_contains($message,'payment')) {
                                   $icon = 'bi-cash-stack';
                                   $bg = 'bg-success-subtle';
                                   $color = 'text-success';
                                   $title = 'Payment Received';
                               }

                               elseif(str_contains($message,'accepted')) {
                                   $icon = 'bi-check-circle';
                                   $bg = 'bg-primary-subtle';
                                   $color = 'text-primary';
                                   $title = 'Booking Accepted';
                               }

                               elseif(str_contains($message,'booking')) {
                                   $icon = 'bi-calendar-check';
                                   $bg = 'bg-warning-subtle';
                                   $color = 'text-warning';
                                   $title = 'New Booking';
                               }

                               elseif(str_contains($message,'cleaner')) {
                                   $icon = 'bi-person-plus';
                                   $bg = 'bg-info-subtle';
                                   $color = 'text-info';
                                   $title = 'Cleaner Registration';
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

                                               @if(is_null($notification->read_at))
                                                   <span class="unread-dot"></span>
                                               @endif

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

                    <a href="/cleaner/profile"
                       class="nav-link {{ request()->is('cleaner/profile*') ? 'active' : '' }}">

                        <i class="bi bi-person-circle me-2"></i>

                        My Profile

                    </a>

                </li>

                <!-- Logout -->
                <li class="nav-item ms-3">

                    <form method="POST"
                          action="/logout">

                        @csrf

                        <button class="btn btn-danger rounded-pill px-4 logout-btn">
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

<div class="alert alert-warning m-3">

    <i class="bi bi-exclamation-triangle-fill me-2"></i>

    Your profile is incomplete.

    <a href="/cleaner/profile">
        Complete Profile
    </a>

</div>

@endif

<!-- Content -->
<div class="container-fluid px-lg-5 px-md-4 px-3 py-4">

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function(){

    const dropdown =
        document.getElementById('notificationDropdown');

    if(dropdown){

        dropdown.addEventListener(
            'click',
            function(){

                fetch(
                    "{{ route('cleaner.notifications.read') }}",
                    {
                        method:'POST',
                        headers:{
                            'X-CSRF-TOKEN':
                                '{{ csrf_token() }}',
                            'Accept':
                                'application/json'
                        }
                    }
                );

                const dot =
                    document.querySelector(
                        '.nav-link .unread-dot'
                    );

                if(dot){
                    dot.remove();
                }

            }
        );

    }

});

</script>

</body>

</html>
