<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify Email - HomeShine</title>

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

        .verify-card{
            width: 100%;
            max-width: 520px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 45px;
            box-shadow: 0 20px 40px rgba(37,99,235,0.10);
            border: 1px solid rgba(229,231,235,0.6);
            text-align: center;
            transition: 0.3s;
        }

        .verify-card:hover{
            transform: translateY(-4px);
        }

        .logo{
            font-size: 34px;
            font-weight: 700;
            color: #2563EB;
        }

        .verify-icon{
            width: 95px;
            height: 95px;
            background: rgba(16,185,129,0.12);
            color: #10B981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            margin: 0 auto 25px;
            animation: float 2s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
            100% { transform: translateY(0px); }
        }

        .verify-title{
            font-size: 28px;
            font-weight: 700;
            color: #1F2937;
        }

        .verify-text{
            color: #6B7280;
            line-height: 1.8;
            margin-top: 12px;
        }

        .btn-custom{
            background: #2563EB;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 13px 30px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-custom:hover{
            background: #1D4ED8;
            transform: translateY(-2px);
        }

        .back-link{
            color: #10B981;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover{
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

    </style>

</head>

<body>

<div class="verify-card">

    <!-- Badge -->
    <div class="badge-custom">
        Security Verification
    </div>

    <!-- Logo -->
    <h1 class="logo mb-3">
        HomeShine
    </h1>

    <!-- Icon -->
    <div class="verify-icon">
        <i class="bi bi-envelope-check"></i>
    </div>

    <!-- Title -->
    <h2 class="verify-title">
        Verify Your Email
    </h2>

    <!-- Text -->
    <p class="verify-text">

        We’ve sent a verification link to your email address.
        Please check your inbox and click the link to activate your account.

    </p>

    <!-- Success Message -->
    @if (session('message'))

        <div class="alert alert-success rounded-4 mt-4">

            {{ session('message') }}

        </div>

    @endif

    <!-- Resend Button -->
    <form method="POST"
          action="{{ route('verification.send') }}"
          class="mt-4">

        @csrf

        <button type="submit" class="btn btn-custom">

            <i class="bi bi-arrow-repeat me-1"></i>
            Resend Email

        </button>

    </form>

</div>

</body>

</html>
