<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password - HomeShine</title>

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

        /* Card */
        .forgot-card{
            width: 100%;
            max-width: 500px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(37,99,235,0.10);
            border: 1px solid rgba(229,231,235,0.6);
            transition: 0.3s;
            animation: fadeIn 0.6s ease;
        }

        .forgot-card:hover{
            transform: translateY(-4px);
        }

        /* Animation */
        @keyframes fadeIn {

            from{
                opacity: 0;
                transform: translateY(20px);
            }

            to{
                opacity: 1;
                transform: translateY(0);
            }

        }

        /* Text */
        .subtitle{
            color: #6B7280;
            line-height: 1.7;
        }

        /* Badge */
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

        /* Form */
        .form-label{
            font-weight: 500;
            color: #1F2937;
        }

        .form-control{
            border-radius: 14px;
            padding: 12px;
            border: 1px solid #D1D5DB;
            transition: 0.3s;
        }

        .form-control:hover{
            border-color: #93C5FD;
        }

        .form-control:focus{
            border-color: #60A5FA;
            box-shadow: 0 0 0 0.2rem rgba(96,165,250,0.25);
        }

        /* Button */
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
            color: white;
            transform: translateY(-2px);
        }

        /* Back Link */
        .back-link{
            color: #10B981;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .back-link:hover{
            color: #059669;
        }

        /* Icon Circle */
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

    </style>

</head>

<body>

<div class="forgot-card">

    <!-- Header -->
    <div class="text-center mb-4">

        <span class="badge-custom">
            Password Recovery
        </span>

        <!-- Icon -->
        <div class="icon-box mt-4">

            📧

        </div>

        <!-- Title -->
        <h3 class="fw-bold mb-3">

            Forgot Password?

        </h3>

        <!-- Subtitle -->
        <p class="subtitle">

            Enter your email address and we’ll send you
            a password reset link.

        </p>

    </div>

    <!-- Success Message -->
    @if(session('status'))

        <div class="alert alert-success rounded-4">

            {{ session('status') }}

        </div>

    @endif

    <!-- Form -->
    <form method="POST" action="/forgot-password">

        @csrf

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

        <!-- Submit Button -->
        <div class="d-grid mb-3">

            <button type="submit"
                    class="btn btn-custom">

                <i class="bi bi-send-fill me-1"></i>

                Send Reset Link

            </button>

        </div>

    </form>

    <!-- Back To Login -->
    <div class="text-center mt-4">

        <a href="/login"
           class="back-link">

            ← Back to Login

        </a>

    </div>

</div>

</body>

</html>
