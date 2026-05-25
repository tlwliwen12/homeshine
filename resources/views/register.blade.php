<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - HomeShine</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #F8FAFC, #EFF6FF);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card{
            width: 100%;
            max-width: 520px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(37,99,235,0.10);
            border: 1px solid rgba(229,231,235,0.6);
            transition: 0.3s;
        }

        .register-card:hover{
            transform: translateY(-4px);
        }

        .logo{
            font-size: 34px;
            font-weight: 700;
            color: #2563EB;
        }

        .subtitle{
            color: #6B7280;
        }

        .form-label{
            font-weight: 500;
            color: #1F2937;
        }

        .form-control,
        .form-select{
            border-radius: 14px;
            padding: 12px;
            border: 1px solid #D1D5DB;
        }

        .form-control:focus,
        .form-select:focus{
            border-color: #60A5FA;
            box-shadow: 0 0 0 0.2rem rgba(96,165,250,0.25);
        }

        .btn-register{
            background: #2563EB;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 13px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-register:hover{
            background: #1D4ED8;
            transform: translateY(-2px);
        }

        .login-link{
            color: #10B981;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link:hover{
            color: #059669;
        }

        .badge-custom{
            background: rgba(16,185,129,0.12);
            color: #10B981;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 15px;
        }

        .input-group-text{
            background: white;
            border-radius: 14px;
            cursor: pointer;
        }

    </style>

</head>

<body>

<div class="register-card">

    <!-- Header -->
    <div class="text-center mb-4">

        <div class="badge-custom">
            Welcome to HomeShine
        </div>

        <h1 class="logo">
            HomeShine
        </h1>

        <p class="subtitle mt-2">
            Create your account and start booking cleaning services
        </p>

    </div>

    <!-- Errors -->
    @if ($errors->any())

        <div class="alert alert-danger rounded-4">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <!-- Form -->
    <form method="POST" action="/register">

        @csrf

        <!-- Name -->
        <div class="mb-3">

            <label class="form-label">Full Name</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="Enter your full name"
                   value="{{ old('name') }}">

        </div>

        <!-- Email -->
        <div class="mb-3">

            <label class="form-label">Email Address</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Enter your email"
                   value="{{ old('email') }}">

        </div>

        <!-- Password -->
        <div class="mb-3">

            <label class="form-label">Password</label>

            <div class="input-group">

                <input type="password"
                       name="password"
                       id="password"
                       class="form-control"
                       placeholder="Enter your password">

            </div>

            <div class="small text-muted mt-2">
                Must include uppercase, lowercase, number & symbol.
            </div>

        </div>

        <!-- Role -->
        <div class="mb-4">

            <label class="form-label">Select Role</label>

            <select name="role" class="form-select">

                <option value="">Choose your role</option>

                <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>
                    Customer
                </option>

                <option value="cleaner" {{ old('role') == 'cleaner' ? 'selected' : '' }}>
                    Cleaner
                </option>

            </select>

        </div>

        <!-- Submit -->
        <div class="d-grid mb-3">

            <button type="submit" class="btn btn-register">

                <i class="bi bi-person-plus me-1"></i>
                Create Account

            </button>

        </div>

        <!-- Login -->
        <div class="text-center">

            <span class="text-secondary">
                Already have an account?
            </span>

            <a href="/login" class="login-link">
                Login
            </a>

        </div>

    </form>

    <div class="text-center mt-3">

        <a href="{{ url('/') }}"
           class="btn btn-outline-secondary rounded-pill px-4">

            <i class="bi bi-house-door me-1"></i>
            Back to Home

        </a>

    </div>

</div>

</body>

</html>
