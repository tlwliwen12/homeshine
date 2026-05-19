<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password - HomeShine</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        .reset-card{
            width: 100%;
            max-width: 500px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(37,99,235,0.10);
            border: 1px solid rgba(229,231,235,0.6);
            transition: 0.3s;
        }

        .reset-card:hover{
            transform: translateY(-4px);
        }

        .logo-img{
            width: 180px;
            height: auto;
            margin-bottom: 10px;
        }

        .subtitle{
            color: #6B7280;
            line-height: 1.7;
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

        .icon-box{
            width: 90px;
            height: 90px;
            background: rgba(37,99,235,0.10);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 38px;
            color: #2563EB;
        }

        .form-label{
            font-weight: 500;
            color: #1F2937;
        }

        .form-control{
            border-radius: 14px;
            padding: 12px;
            border: 1px solid #D1D5DB;
        }

        .form-control:focus{
            border-color: #60A5FA;
            box-shadow: 0 0 0 0.2rem rgba(96,165,250,0.25);
        }

        .btn-custom{
            background: #2563EB;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 13px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-custom:hover{
            background: #1D4ED8;
            transform: translateY(-2px);
            color: white;
        }

        .back-link{
            color: #10B981;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover{
            color: #059669;
        }

    </style>

</head>

<body>

<div class="reset-card">

    <!-- Header -->
    <div class="text-center mb-4">

        <span class="badge-custom">
            Secure Password Reset
        </span>

        <!-- Icon -->
        <div class="icon-box">
            <i class="bi bi-shield-lock"></i>
        </div>

        <!-- Title -->
        <h3 class="fw-bold mb-3">
            Reset Your Password
        </h3>

        <p class="subtitle">

            Create a new secure password for your HomeShine account.

        </p>

    </div>

    <!-- Form -->
    <form method="POST" action="/reset-password">

        @csrf

        <input type="hidden"
               name="token"
               value="{{ $token }}">

        <!-- Email -->
        <div class="mb-4">

            <label class="form-label">
                Email Address
            </label>

            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Enter your email"
                   value="{{ old('email') }}"
                   required>

            @error('email')

                <div class="text-danger small mt-2">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <!-- Password -->
        <div class="mb-4">

            <label class="form-label">
                New Password
            </label>

            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Enter new password"
                   required>

            @error('password')

                <div class="text-danger small mt-2">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <!-- Confirm Password -->
        <div class="mb-4">

            <label class="form-label">
                Confirm Password
            </label>

            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="Confirm your password"
                   required>

        </div>

        <!-- Submit -->
        <div class="d-grid mb-3">

            <button type="submit"
                    class="btn btn-custom">

                <i class="bi bi-key-fill me-1"></i>
                Reset Password

            </button>

        </div>

    </form>

    <!-- Back -->
    <div class="text-center mt-4">

        <a href="/login"
           class="back-link">

            ← Back to Login

        </a>

    </div>

</div>

</body>

</html>
