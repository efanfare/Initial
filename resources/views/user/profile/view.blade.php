@extends('layouts.main_dashboard', ['title' => 'Profile', 'dbClass' => 'db photo-bank-sec'])
@section('content')
    <div class="bg-color-box">
        <div class="profile-options">
            <div class="profile-img-edit">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input name="profile_image" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                        {{-- <label for="imageUpload"></label> --}}
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview"
                            style="background-image: url({{ auth()->user()->profile_image->thumbnail ?? Avatar::create(auth()->user()->first_name . ' ' . auth()->user()->last_name)->setDimension(112, 112) }});">
                        </div>
                    </div>
                </div>
                <div class="profile-img-content">
                    <h6>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                    <a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                </div>
            </div>
            <div class="edit-profile-btn">
                <a href="{{ route('profile') }}" class="btn btn-primary">Edit profile</a>
            </div>
        </div>
        <div class="form-main-box">
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-0">First Name</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-0">{{ auth()->user()->first_name ?? '--' }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-0">Last Name</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-0">{{ auth()->user()->last_name ?? '--' }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-0">{{ auth()->user()->email ?? '--' }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-0">Contact number</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-0">{{ auth()->user()->contact_number ?? '--' }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-0">Country</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-0">{{ auth()->user()->country->name ?? '--' }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-0">City</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-0">{{ auth()->user()->city ?? '--' }}</p>
                </div>
            </div>
            <hr>
        </div>

    </div>
@endsection
