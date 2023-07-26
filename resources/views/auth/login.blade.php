@extends('layouts.guest-dashboard')


@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->

                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <form action="{{ route('login') }}" method="POST" class="user">

                                        @csrf

                                        <div class="form-group">
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror form-control-user"
                                                placeholder="Enter Email Address..." value="{{ old('email') }}">

                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror form-control-user"
                                                placeholder="Password">

                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" class="custom-control-input"
                                                    id="rememberMe">
                                                <label class="custom-control-label" for="rememberMe">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
