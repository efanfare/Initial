@extends('layouts.app', ['title' => 'Forgot Password', 'bodyClass' => 'signup-scr'])
@section('content')
    <!-- SIGNUP SECTION BEGIN -->
    <section class="signup-pg-sec forgot-password-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 left-column">
                    <div class="form-sec">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <h4>Forgot Password ?</h4>
                            <div class="inner-field">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                                    class="form-control">
                                <div class="icon-bar forgot-icon-bar">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                    <span class="text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            <div class="journey-btn">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
</script>