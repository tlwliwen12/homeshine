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

    <style>

        body{
            font-family: 'Poppins', sans-serif;
            background: #F8FAFC;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card{
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(37,99,235,0.08);
            border: 1px solid #E5E7EB;
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
            color: #1F2937;
            font-weight: 500;
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
            box-shadow: 0 0 0 0.2rem rgba(96,165,250,0.2);
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
            color: white;
        }

        .password-note{
            font-size: 13px;
            color: #6B7280;
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
            background: rgba(16,185,129,0.1);
            color: #10B981;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 15px;
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
            Create your account to start booking cleaning services
        </p>

    </div>

    <!-- Error Messages -->
    @if ($errors->any())

        <div class="alert alert-danger rounded-4">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- Register Form -->
    <form method="POST" action="/register">

        @csrf

        <!-- Name -->
        <div class="mb-3">

            <label class="form-label">
                Full Name
            </label>

            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="Enter your full name"
                   value="{{ old('name') }}">

        </div>

        <!-- Email -->
        <div class="mb-3">

            <label class="form-label">
                Email Address
            </label>

            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Enter your email"
                   value="{{ old('email') }}">

        </div>

        <!-- Password -->
        <div class="mb-3">

            <label class="form-label">
                Password
            </label>

            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Enter your password">

            <div class="password-note mt-2">
                Password must contain uppercase, lowercase, number, and symbol.
            </div>

        </div>

        <!-- Role -->
        <div class="mb-4">

            <label class="form-label">
                Select Role
            </label>

            <select name="role" class="form-select">

                <option value="">
                    Choose your role
                </option>

                <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>
                    Customer
                </option>

                <option value="cleaner" {{ old('role') == 'cleaner' ? 'selected' : '' }}>
                    Cleaner
                </option>

            </select>

        </div>

        <!-- Button -->
        <div class="d-grid mb-3">

            <button type="submit" class="btn btn-register">
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

</div>

</body>
</html>
