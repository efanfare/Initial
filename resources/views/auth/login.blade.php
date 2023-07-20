@extends('layouts.app', ['title' => 'Login', 'bodyClass' => 'signup-scr'])
@section('content')
    <!-- SIGNUP SECTION BEGIN -->
    <section class="signup-pg-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 left-column">
                    <div class="form-sec">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <h4>Login</h4>
                            @if (session()->has('message'))
                                <p class="alert alert-info">
                                    {{ session()->get('message') }}
                                </p>
                            @endif
                            <div class="inner-field">
                                <input type="email" name="email" required placeholder="Email" class="form-control">
                                <div class="icon-bar">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <div class="invalid-error-text">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <div class="inner-field">
                                <input type="password" required name="password" placeholder="Password" id="password"
                                    class="form-control">
                                <div class="icon-bar">
                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                </div>
                                <div class="eye-icon-bar">
                                    <span class="input-group-text" onclick="password_show_hide();">
                                        <i class="fa fa-eye" id="show_eye"></i>
                                        <i class="fa fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                                @if ($errors->has('password'))
                                    <div class="invalid-error-text">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="forgot-pass">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ trans('global.forgot_password') }}
                                    </a>
                                @endif
                            </div>
                            <div class="journey-btn">
                                <button type="submit" class="btn btn-primary">Login</button>
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
                            <p>Don't Have An Account? <a href="{{ route('user.signup') }}">Signup</a></p>
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
    </script>
@endsection
