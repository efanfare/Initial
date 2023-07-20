@extends('layouts.app', ['title' => 'Signup', 'bodyClass' => 'signup-scr'])
@section('content')
    <!-- SIGNUP SECTION BEGIN -->
    <section class="signup-pg-sec signup-height">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 left-column">
                    <div class="form-sec">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <h4>Signup</h4>
                            <div class="inner-field">
                                <input type="text" name="name" placeholder="Full Name"
                                    class="form-control" name="name"
                                    value="{{ old('name') }}" required autocomplete="name">
                                <div class="icon-bar">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>
                            @error('name')
                                    <span class="invalid-error-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <div class="inner-field">
                                <input id="email" type="email" name="email" placeholder="Email"
                                    class="form-control" value="{{ old('email') }}"
                                    required autocomplete="email">
                                <div class="icon-bar">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                            </div>
                            @error('email')
                                    <span class="invalid-error-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <div class="inner-field">
                                <input id="password" type="password" name="password" placeholder="Password"
                                    class="form-control" required
                                    autocomplete="new-password">
                                <div class="icon-bar">
                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                </div>
                                <div class="eye-icon-bar">
                                    <span class="input-group-text" onclick="password_show_hide();">
                                        <i class="fa fa-eye" id="show_eye"></i>
                                        <i class="fa fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                                    <span class="invalid-error-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <div class="inner-field">
                                <input id="password-confirm" type="password" name="password_confirmation"
                                    placeholder="Confirm Password" class="form-control" required
                                    autocomplete="new-password">
                                <div class="icon-bar">
                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                </div>
                                <div class="eye-icon-bar">
                                    <span class="input-group-text" onclick="password_confirm_show_hide();">
                                        <i class="fa fa-eye" id="show_eye_confirm"></i>
                                        <i class="fa fa-eye-slash d-none" id="hide_eye_confirm"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="journey-btn">
                                <button type="submit" class="btn btn-primary">Sign up</button>
                            </div>
                        </form>
                        <div class="or-text">
                            <p>OR</p>
                        </div>
                        <div class="social-site-btn">
                            <a href="{{ url('auth/google') }}" class="btn btn-primary"><i class="fa fa-google-plus"
                                    aria-hidden="true"></i> Google</a>
                            <a href="{{ url('auth/facebook') }}" class="btn btn-primary"><i class="fa fa-facebook"
                                    aria-hidden="true"></i> Facebook</a>
                        </div>
                        <div class="member-cls">
                            <p>Already A Member? <a href="{{ route('login') }}">Sign In</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 col-12 right-column">
                    <div class="pg-logo">
                        <a href="{{ URL::to('/') }}"><img src="{{ asset('images/logo.png') }}"></a>
                    </div>
                    <div class="signup-img">
                        <img src="{{ asset('images/signup-img.png') }}" alt="image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SIGNUP SECTION END -->
@endsection

@section('scripts')
    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function password_confirm_show_hide() {
            var x = document.getElementById("password-confirm");
            var show_eye = document.getElementById("show_eye_confirm");
            var hide_eye = document.getElementById("hide_eye_confirm");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

    </script>
@endsection
