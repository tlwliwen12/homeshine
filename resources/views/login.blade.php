<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - HomeShine</title>

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

        .login-card{
            width: 100%;
            max-width: 480px;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(37,99,235,0.10);
            border: 1px solid rgba(229,231,235,0.6);
            transition: 0.3s;
        }

        .login-card:hover{
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

        .form-control{
            border-radius: 14px;
            padding: 12px;
            border: 1px solid #D1D5DB;
        }

        .form-control:focus{
            border-color: #60A5FA;
            box-shadow: 0 0 0 0.2rem rgba(96,165,250,0.25);
        }

        .btn-login{
            background: #2563EB;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 13px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-login:hover{
            background: #1D4ED8;
            transform: translateY(-2px);
        }

        .forgot-link{
            color: #10B981;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover{
            color: #059669;
        }

        .register-link{
            color: #2563EB;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link:hover{
            color: #1D4ED8;
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
            border-radius: 14px;
            background: white;
            border: 1px solid #D1D5DB;
            cursor: pointer;
        }

    </style>

</head>

<body>

<div class="login-card">

    <!-- Header -->
    <div class="text-center mb-4">

        <div class="badge-custom">
            Welcome Back
        </div>

        <h1 class="logo">
            HomeShine
        </h1>

        <p class="subtitle mt-2">
            Login to your account
        </p>

    </div>

    <!-- Error -->
    @if ($errors->any())

        <div class="alert alert-danger rounded-4">

            {{ $errors->first() }}

        </div>

    @endif

    <!-- Form -->
    <form method="POST" action="/login">

        @csrf

        <!-- Email -->
        <div class="mb-3">

            <label class="form-label">Email Address</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Enter your email"
                   value="{{ old('email') }}">

            @error('email')
                <div class="text-danger small mt-2">
                    {{ $message }}
                </div>
            @enderror

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

                <span class="input-group-text"
                      onclick="togglePassword()">

                    <i class="bi bi-eye" id="eyeIcon"></i>

                </span>

            </div>

            @error('password')
                <div class="text-danger small mt-2">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Forgot -->
        <div class="text-end mb-3">

            <a href="/forgot-password" class="forgot-link">
                Forgot Password?
            </a>

        </div>

        <!-- Button -->
        <div class="d-grid mb-4">

            <button type="submit" class="btn btn-login">
                Login
            </button>

        </div>

        <!-- Register -->
        <div class="text-center">

            <span class="text-secondary">
                Don't have an account?
            </span>

            <a href="/register" class="register-link">
                Register
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

<script>

function togglePassword(){

    let input = document.getElementById("password");
    let icon = document.getElementById("eyeIcon");

    if(input.type === "password"){
        input.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }else{
        input.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }

}

</script>

</body>

</html>
