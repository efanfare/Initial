@extends('layouts.app', ['title' => 'New Password', 'bodyClass' => 'signup-scr'])
@section('content')
    <!-- SIGNUP SECTION BEGIN -->
    <section class="signup-pg-sec forgot-password-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 left-column">
                    <div class="form-sec">
                        <form method="POST" action="{{ route('password.request') }}">
                            @csrf
                            <input name="token" value="{{ $token }}" type="hidden">

                            <h4>Set New Password</h4>
                            @if (session()->has('error'))
                                <span class="invalid-error-text" role="alert">
                                    <strong> {{ session()->get('error') }}</strong>
                                </span>
                            @endif
                            <div class="inner-field">
                                <input id="email" type="email" readonly class="form-control" name="email"
                                    value="{{ $email ?? old('email') }}" autocomplete="email" autofocus
                                    placeholder="{{ trans('global.login_email') }}">
                                <div class="icon-bar">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="inner-field">
                                <input id="password" type="password" name="password" placeholder="New Password"
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
                            </div>

                            @if ($errors->has('password'))
                                <span class="invalid-error-text">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                            <div class="inner-field">
                                <input id="password-confirm" type="password" name="password_confirmation"
                                    placeholder="Confirm Password" class="form-control">
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
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
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
