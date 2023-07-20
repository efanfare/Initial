@extends('layouts.main_dashboard', ['title' => 'Profile', 'dbClass' => 'db photo-bank-sec'])
@section('content')
@section('styles')
    <link rel="stylesheet" href="{{ asset('countryselect/css/countrySelect.css') }}">
    <link rel="stylesheet" href="{{ asset('countryselect/css/demo.css') }}">
    <style>
    </style>
@endsection
@if (session()->has('message'))
    <div class="toast-container top-0 end-0 p-3">
        <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center aligns-center"
            style="z-index: 5; right: 0; bottom: 0;">
            <div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true"
                data-delay="4000">
                <div class="toast-header">
                    <strong class="mr-auto">Success!</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="toast-body">
                    {{ session()->get('message') }}
                </div>
            </div>
        </div>
    </div>
@endif
<div class="bg-color-box">
    <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update', auth()->id()) }}">
        @csrf
        <div class="profile-options">
            <div class="profile-img-edit">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input name="profile_image" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview"
                            style="background-image: url({{ $user->profile_image->thumbnail ?? Avatar::create(auth()->user()->first_name . ' ' . auth()->user()->last_name)->setDimension(112, 112) }});">
                        </div>
                    </div>
                </div>
                <div class="profile-img-content">
                    <h6>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                    <a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                </div>
            </div>
            <div class="edit-profile-btn">
                <a href="{{ route('profile.view') }}" class="btn btn-primary">View profile</a>
            </div>
        </div>

        <div class="form-main-box">
            <div class="form-flex">
                <div class="form-data">
                    <label>First name</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text"
                        name="first_name" id="first_name" value="{{ old('first_name', auth()->user()->first_name) }}">
                    @if ($errors->has('first_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('first_name') }}
                        </div>
                    @endif
                </div>
                <div class="form-data">
                    <label>Last name</label>
                    <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text"
                        name="last_name" id="last_name" value="{{ old('last_name', auth()->user()->last_name) }}">
                    @if ($errors->has('last_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('last_name') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-flex">
                <div class="form-data">
                    <label>Email address</label>
                    <input type="email" readonly placeholder="{{ auth()->user()->email }}" class="form-control">
                </div>
                <div class="form-data">
                    <label>Contact number</label>
                    <input class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" type="text"
                        name="contact_number" id="contact_number" placeholder=""
                        value="{{ old('contact_number', auth()->user()->contact_number) }}">
                    @if ($errors->has('contact_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contact_number') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="form-flex">
                <div class="form-data">
                    <label for="country_id">Country</label>

                    <div class="">
                        <input class="form-control" id="country_selector" type="text">
                        <label for="country_selector" style="display:none;">Select a country here...</label>
                    </div>
                    <div class="" style="display:none;">
                        <input class="form-control" type="text" id="country_selector_code" name="country_id"
                            placeholder="Selected country " />
                        <label for="country_selector_code">...and the selected country code will be updated here</label>
                    </div>
                    @if ($errors->has('country_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('country_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-data">
                    <label>City</label>
                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text"
                        name="city" id="city" value="{{ old('city', auth()->user()->city) }}">
                    @if ($errors->has('city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('city') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-flex">
                <div class="form-data">
                    <label>New password</label>
                    <div class="eye-icon-main-div">
                        <input id="password" type="password" name="password" placeholder="New Password"
                            class="form-control">
                        <div class="password-eye-icon" onclick="password_show_hide();">
                            <i class="fa fa-eye" id="show_eye"></i>
                            <i class="fa fa-eye-slash d-none" id="hide_eye"></i>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
                <div class="form-data">
                    <label>Confirm password</label>
                    <div class="eye-icon-main-div">
                        <input id="password-confirm" type="password" name="password_confirmation"
                            placeholder="Confirm Password" class="form-control">
                        <div class="password-eye-icon" onclick="password_confirm_show_hide();">
                            <i class="fa fa-eye" id="show_eye_confirm"></i>
                            <i class="fa fa-eye-slash d-none" id="hide_eye_confirm"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit-profile-btn">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
    </form>

    <input type="hidden" value="{{ $user->country?->short_code }}" id="default-country-id">
</div>
@endsection

@section('scripts')
<script>
    /*COUNTRY DROPDOWN SCRIPT BEGIN*/
    var langArray = [];
    $('.countries option').each(function() {
        var img = $(this).attr("data-thumbnail");
        var text = this.innerText;
        var value = $(this).val();
        var item = '<li><img src="' + img + '" alt="" value="' + value + '"/><span>' + text + '</span></li>';
        langArray.push(item);
    })

    $('#a').html(langArray);

    //Set the button value to the first el of the array
    $('.btn-select').html(langArray[0]);
    $('.btn-select').attr('value', 'en');

    //change button stuff on click
    $('#a li').click(function() {
        var img = $(this).find('img').attr("src");
        var value = $(this).find('img').attr('value');
        $('.btn-select').html(langArray[langIndex]);
        var text = this.innerText;
        var item = '<li><img src="' + img + '" alt="" /><span>' + text + '</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
        $(".b").toggle();
        $('.countries').find(":selected").val(value);
        // console.log(value);
    });

    $(".btn-select").click(function() {
        $(".b").toggle();
    });


    var defaultCountryId = $("#default-country-id").val();

    var sessionLang = defaultCountryId ?? 0;
    if (sessionLang) {
        //find an item with value of sessionLang
        var langIndex = langArray.indexOf(sessionLang);
        console.log(langIndex);
        $('.btn-select').html(langArray[{{ $user->country_id }} - 1]);
        $('.btn-select').attr('value', sessionLang);
    } else {
        var langIndex = langArray.indexOf('ch');
        console.log(langIndex);
        //$('.btn-select').attr('value', 'en');
    }
    /*COUNTRY DROPDOWN SCRIPT END*/
</script>


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

    /*IMAGE PREVIEW SCRIPT BEGIN*/
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });

    /*IMAGE PREVIEW SCRIPT END*/
</script>

<script src="{{ asset('countryselect/js/countrySelect.js') }}"></script>
<script>
    var defaultCountryId = $("#default-country-id").val() ? $("#default-country-id").val() : 'us';
    $("#country_selector").countrySelect({
        defaultCountry: defaultCountryId,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        responsiveDropdown: true,
        preferredCountries: ['ca', 'gb', 'us']
    });
</script>
@if (session()->has('message') || session()->has('error'))
    <script>
        $('.toast').toast('show');
    </script>
@endif
@endsection
