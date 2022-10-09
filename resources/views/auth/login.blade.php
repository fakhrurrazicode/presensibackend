@extends('layouts.auth')

@section('content')

<div class="account-pages my-5 mt-10">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card animate__animated animate__slideInDown animate__slow">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-6 p-4 animate__animated animate__slideInDown animate__slow">
                                <div class="mx-auto">
                                    <div href="#" class="d-flex align-items-center">
                                        <img src="{{asset('images/logo.png')}}" alt="" height="64" />

                                        <span class="ms-2" style="font-weight: bold; font-size: 24px;">Sistem
                                            Presensi</span>
                                    </div>
                                </div>

                                <h6 class="h5 mb-0 mt-3">
                                    Selamat Datang
                                </h6>
                                <p class="text-muted mt-1 mb-4">
                                    Masukkan alamat email dan kata sandi Anda untuk mengakses panel admin.
                                </p>


                                <form class="authentication-form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="icon-dual" data-feather="mail"></i>
                                            </span>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        {{-- <a href="pages-recoverpw.html"
                                            class="float-end text-muted text-unline-dashed ms-1">Forgot your
                                            password?</a> --}}
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="icon-dual" data-feather="lock"></i>
                                            </span>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin"
                                                checked />
                                            <label class="form-check-label" for="checkbox-signin">Remember
                                                me</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 text-center d-grid">
                                        <button class="btn btn-primary" type="submit">
                                            Log In
                                        </button>
                                    </div>
                                </form>
                                {{-- <div class="py-3 text-center">
                                    <span class="fs-16 fw-bold">OR</span>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <a href="" class="btn btn-white mb-2 mb-sm-0"><i
                                                class="uil uil-google icon-google me-2"></i>With Google</a>
                                        <a href="" class="btn btn-white mb-2 mb-sm-0"><i
                                                class="uil uil-facebook me-2 icon-fb"></i>With Facebook</a>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="col-lg-6 d-none d-md-inline-block">
                                <div class="auth-page-sidebar">
                                    <div class="overlay"></div>
                                    <div class="auth-user-testimonial">
                                        <p class="fs-24 fw-bold text-white mb-1">
                                            BIJAK
                                        </p>
                                        <p class="lead">
                                            "Gunakan dengan bijak"
                                        </p>
                                        <p>- Admin User</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">
                            Don't have an account?
                            <a href="pages-register.html" class="text-primary fw-bold ms-1">Sign Up</a>
                        </p>
                    </div>

                </div> --}}

            </div>

        </div>

    </div>

</div>

@endsection