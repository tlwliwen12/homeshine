<!DOCTYPE html>
<html>
<head>

    <title>Forgot Password</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body style="background-color:#f8f9fa;">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body p-4">

                    {{-- Title --}}
                    <div class="text-center mb-4">

                        <h2 class="fw-bold">
                            Reset Password
                        </h2>

                        <p class="text-muted">
                            Create your new password
                        </p>

                    </div>

                    {{-- Form --}}
                    <form method="POST" action="/reset-password">

                        @csrf

                        <input type="hidden"
                               name="token"
                               value="{{ $token }}">

                        {{-- Email --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Email Address
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="Enter your email"
                                   required>

                            @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        {{-- Password --}}
                        <div class="mb-3">

                            <label class="form-label">
                                New Password
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Enter new password"
                                   required>

                            @error('password')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-4">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Confirm password"
                                   required>

                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                class="btn btn-dark w-100">

                            <i class="bi bi-key-fill"></i>
                            Reset Password

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
