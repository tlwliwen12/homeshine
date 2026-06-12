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
        font-family:'Poppins',sans-serif;
        background:#F8FAFC;
        color:#1F2937;
    }

    .icon-box{
        width:60px;
        height:60px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:24px;
    }

    /* Navbar */
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

    /* Dropdown */
    .dropdown-menu{
        border:none;
        border-radius:16px;
        box-shadow:0 10px 30px rgba(0,0,0,.08);
        min-width:220px;
    }

    .dropdown-item{
        padding:10px 16px;
    }

    /* Main */
    .main-content{
        padding-top:40px;
        padding-bottom:40px;
    }

    /* Cards */
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

    /* Buttons */
    .btn-primary{
        background:#2563EB;
        border:none;
        border-radius:50px;
    }

    .logout-btn{
        border-radius:50px;
    }

    /* Footer */
    footer{
        background:#fff;
        border-top:1px solid #E5E7EB;
        padding:20px 0;
        margin-top:40px;
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
            margin-bottom:5px;
        }

        .logout-btn{
            width:100%;
            margin-top:10px;
        }

    }

    /* Phone */
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

        h1{
            font-size:26px;
        }

        h2{
            font-size:24px;
        }

        h3{
            font-size:20px;
        }

        .btn{
            width:100%;
            margin-bottom:10px;
        }

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

    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    @if(session('success'))

    <div class="container mt-3">

        <div class="alert alert-success rounded-4 border-0 shadow-sm">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    </div>

    <script>

    setTimeout(function(){

        let alert = document.querySelector('.alert-success');

        if(alert){

            alert.style.transition = '0.5s';

            alert.style.opacity = '0';

            setTimeout(() => alert.remove(),500);

        }

    },3000);

</script>

    @endif

<!-- Navbar -->
<nav class="navbar navbar-expand-lg py-3">

    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand"
           href="/admin/dashboard">
            HomeShine
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#adminNavbar">

            <i class="bi bi-list fs-2"></i>

        </button>

        <!-- Navbar Menu -->
        <div class="collapse navbar-collapse"
             id="adminNavbar">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">

                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                       href="/admin/dashboard">

                        <i class="bi bi-speedometer2 me-1"></i>
                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}"
                       href="/admin/services">

                        <i class="bi bi-grid me-1"></i>
                        Services

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->is('admin/cleaners*') ? 'active' : '' }}"
                       href="/admin/cleaners">

                        <i class="bi bi-person-badge me-1"></i>
                        Cleaners

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}"
                       href="/admin/customers">

                        <i class="bi bi-people-fill me-1"></i>
                        Customers

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->is('admin/bookings*') ? 'active' : '' }}"
                       href="/admin/bookings">

                        <i class="bi bi-calendar-check me-1"></i>
                        Bookings

                    </a>

                </li>

                <!-- Reports Dropdown -->
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle
                        {{
                            request()->is('admin/customer-statistics')
                            || request()->is('admin/transactions*')
                            || request()->is('admin/reviews*')
                                ? 'active'
                                : ''
                        }}"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">

                        <i class="bi bi-bar-chart-line-fill me-1"></i>
                        Reports

                    </a>

                    <ul class="dropdown-menu shadow border-0 rounded-4">

                        <li>

                            <a class="dropdown-item"
                               href="/admin/customer-statistics">

                                Customer Statistics

                            </a>

                        </li>

                        <li>

                            <a class="dropdown-item"
                               href="/admin/transactions">

                                Transactions

                            </a>

                        </li>

                        <li>

                            <a class="dropdown-item"
                               href="/admin/reviews">

                                Reviews & Ratings

                            </a>

                        </li>

                    </ul>

                </li>

                <!-- Admin Name -->
                <li class="nav-item ms-3">

                    <span class="fw-semibold text-secondary">

                        <i class="bi bi-person-circle me-1"></i>

                        <span class="d-none d-lg-inline">

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

                           <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                               {{ Auth::user()->unreadNotifications->count() }}

                           </span>

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

                                           <span class="unread-dot mt-2"></span>

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

                <!-- Logout -->
                <li class="nav-item ms-3">

                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                                class="btn btn-danger logout-btn px-4 rounded-pill">

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- Main Content -->
<div class="container-fluid px-lg-5 px-md-4 px-3 main-content">

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

<script>

document
.getElementById('notificationDropdown')
?.addEventListener(
    'click',
    function(){

        fetch(
            "{{ route('admin.notifications.read') }}",
            {
                method:'POST',
                headers:{
                    'X-CSRF-TOKEN':
                    '{{ csrf_token() }}'
                }
            }
        );

    }
);

</script>

</body>

</html>
