@extends('customer.layout')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body p-4">

                    {{-- Title --}}
                    <div class="text-center mb-4">

                        <h2 class="fw-bold">
                            Forgot Password
                        </h2>

                        <p class="text-muted">
                            Enter your email to receive a password reset link
                        </p>

                    </div>

                    {{-- Success Message --}}
                    @if(session('status'))

                        <div class="alert alert-success">

                            {{ session('status') }}

                        </div>

                    @endif

                    {{-- Form --}}
                    <form method="POST" action="/forgot-password">

                        @csrf

                        <div class="mb-4">

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

                        {{-- Submit Button --}}
                        <button type="submit"
                                class="btn btn-dark w-100">

                            <i class="bi bi-envelope-fill"></i>
                            Send Reset Link

                        </button>

                    </form>

                    {{-- Back To Login --}}
                    <div class="text-center mt-3">

                        <a href="/login"
                           class="text-decoration-none">

                            Back to Login

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
