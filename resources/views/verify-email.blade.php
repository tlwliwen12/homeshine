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

    <style>

        body{
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .verify-card{
            width: 100%;
            max-width: 550px;
            background: white;
            border-radius: 24px;
            padding: 45px;
            box-shadow: 0 10px 30px rgba(37,99,235,0.08);
            border: 1px solid #E5E7EB;
            text-align: center;
        }

        .logo{
            font-size: 34px;
            font-weight: 700;
            color: #2563EB;
        }

        .verify-icon{
            width: 90px;
            height: 90px;
            background: rgba(16,185,129,0.12);
            color: #10B981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin: 0 auto 25px;
        }

        .verify-title{
            font-size: 30px;
            font-weight: 700;
            color: #1F2937;
        }

        .verify-text{
            color: #6B7280;
            line-height: 1.8;
            margin-top: 15px;
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

<div class="verify-card">

    <!-- Logo -->
    <h1 class="logo mb-4">
        HomeShine
    </h1>

    <!-- Icon -->
    <div class="verify-icon">
        ✉️
    </div>

    <!-- Title -->
    <h2 class="verify-title">
        Verify Your Email
    </h2>

    <!-- Description -->
    <p class="verify-text">

        Please verify your email address by clicking the verification
        link sent to your email inbox.

    </p>

    <!-- Success Message -->
    @if (session('message'))

        <div class="alert alert-success rounded-4 mt-4">

            {{ session('message') }}

        </div>

    @endif

    <!-- Resend Form -->
    <form method="POST"
          action="{{ route('verification.send') }}"
          class="mt-4">

        @csrf

        <button type="submit" class="btn btn-custom">

            Resend Verification Email

        </button>

    </form>

    <!-- Back to Login -->
    <div class="mt-4">

        <a href="/login" class="back-link">

            Back to Login

        </a>

    </div>

</div>

</body>
</html>
