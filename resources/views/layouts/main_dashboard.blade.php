<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('panel.site_title') }} - {{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/fav-icon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    @yield('styles')
</head>

<body>
    <!-- DASHBOARD SECTION BEGIN -->
    <div class="{{ $dbClass }}" x-data="{ rightSide: false, leftSide: false }">
        <div class="left-side" :class="{ 'active': leftSide }" id="style-3">
            <div class="left-side-button" @click="leftSide = !leftSide">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
                <svg stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                    stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
            </div>
            <div class="logo">
                <a href="{{ route('home') }}" class="dashboard-brand"><img
                        src="{{ asset('images/dashboard-logo.png') }}" alt="image" class="img-fluid"> </a>
            </div>
            <div class="sidebar-flex">
                <div class="sidebar-box">
                    <div class="side-wrapper">
                        <div class="side-menu">
                            <a href="{{ route('user.dashboard') }}"
                                class="{{ request()->is('dashboard') ? 'active' : '' }}">
                                <img src="{{ asset('images/side1.png') }}" alt="image" class="img-fluid">
                                Dashboard
                            </a>
                            <a href="{{ route('scenes.index') }}"
                                class="{{ request()->is('scenes') || request()->is('scene/create') ? 'active' : '' }}">
                                <img src="{{ asset('images/side2.png') }}" alt="image" class="img-fluid"> Scenes</a>
                            <a href="{{ route('galleries.index') }}"
                                class="{{ request()->is('galleries*') ? 'active' : '' }}">
                                <img src="{{ asset('images/side3.png') }}" alt="image" class="img-fluid"> My
                                Gallery</a>
                            <a href="{{ route('item.index') }}"
                                class="{{ request()->is('item/index*') ? 'active' : '' }}">
                                <img src="{{ asset('images/side4.png') }}" alt="image" class="img-fluid"> Photo
                                bank</a>
                        </div>
                    </div>
                    <div class="side-wrapper">
                        <div class="side-menu">
                            <a href="{{ route('profile.view') }}"
                                class="{{ request()->is('profile') || request()->is('profile/view') ? 'active' : '' }}"><img
                                    src="{{ asset('images/side5.png') }}" alt="image" class="img-fluid"> Profile
                                setting</a>
                            <a class="{{ request()->is('plans') || request()->is('plans/*') ? 'active' : '' }}"
                                href="{{ route('plans.index') }}"><img src="{{ asset('images/side6.png') }}"
                                    alt="image" class="img-fluid ">
                                Subscription</a>
                        </div>
                    </div>
                </div>
                <div class="side-bottom-wrapper">
                    <div class="side-bottom-menu">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal"><img
                                src="{{ asset('images/side7.png') }}" alt="image" class="img-fluid"> Logout</a>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal logout-modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img src="{{ asset('images/logout-img.png') }}" alt="image" class="img-fluid">
                                <h6>Are you sure you <span>want to logout?</span></h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="button"
                                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
                                    class="btn btn-primary">Yes</button>
                                <form id="logoutform" action="{{ route('logout') }}" method="POST"
                                    style="display:none;">
                                    {{ csrf_field() }}
                                    <button type="submit">Log out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
            </div>
        </div>
        <div class="main">
            <div class="db-top-bar-flex">
                <div class="db-top-bar">
                    <h5><small>Welcome</small> {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</h5>
                </div>
                <div class="avatar-flex">
                    <div class="overflow-dropdown">
                        <div class="img-dropdown">
                            <a href="javascript:void(0)">
                                <img src="{{ auth()->user()->profile_image->avatar ?? Avatar::create(auth()->user()->first_name . ' ' . auth()->user()->last_name)->setDimension(75, 75) }}"
                                    alt="image" class="img-fluid" />
                                <p>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                            </a>
                        </div>
                        <div class="dropdown">
                            <a href="{{ route('profile.view') }}" id="adobeXd">Profile setting</a>
                            <a href="{{ route('plans.index') }}" id="sketch">Subscription plan</a>
                            {{-- <a href="javascript:void(0)" id="figma">Support</a> --}}
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal"
                                id="inVision">Logout</a>
                        </div>
                    </div>
                    <div class="overflow-bell-icon">
                        <div class="bell-icon">
                            <a href="javascript:void(0)" id="notification-bell">
                                <span class="bell-span">
                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                    <div class="bell-number">
                                        <span
                                            class="circle-box">{{ request()->user()->notifications()->unread()->count() }}</span>
                                    </div>
                                </span>
                            </a>
                        </div>
                        <div class="dropdown" id="notification-dropdown">
                            <div class="notification-container-wrapper">
                                <div id="notification-container" data-page="1">
                                    <!-- Notifications will be dynamically loaded here -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="toast-container-notification">

            </div>
            @yield('content')
            @if (request()->user()->package_id === 1)
                {{-- TODO:Remove this container when site will lived and add will be showed by google ads --}}
                <div class="ad-container-dashboard">
                    <img src="https://placehold.co/900x100/?text=Ad%20goes%20here" alt="" class="img-fluid">
                    <span class="cut-icon" onclick="removeAd()">&#10005;</span>
                </div>

                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3193209969219776"
                    crossorigin="anonymous"></script>
            @endif
            <div class="dashboard-footer-flex">
                <div class="db-footer-logo-flex">
                    <div class="db-footer-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('images/db-footer-logo.png') }}"
                                alt="image" class="img-fluid"></a>
                    </div>

                    <div class="db-footer-links">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            {{-- <li><a href="javascript:void(0)">Support</a></li> --}}
                            <li><a href="{{ route('terms') }}">terms of use</a></li>
                            <li><a href="{{ route('privacy') }}">Privacy policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="db-footer-text">
                    <p>Copyright © 2023 efanfare. All rights reserved</p>
                </div>
            </div>
        </div>
    </div>
    <!-- DASHBOARD SECTION END -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.9.4/dist/alpine.js"></script>
    <script>
        function removeAd() {
            $('.ad-container-dashboard').remove();
        }
        $(document).ready(function() {
            // TODO:Remove this function when site will lived and add will be showed by google ads

            /*AVATAR DROPDOWN SCRIPT BEGIN*/
            $(".img-dropdown a").click(function() {
                $(".overflow-dropdown .dropdown a").removeClass("clicked");
                $(".overflow-dropdown .dropdown").toggleClass("open");
            });
            $(".overflow-dropdown .dropdown a").click(function() {
                $(".overflow-dropdown .dropdown a").removeClass("clicked");
                $(this).toggleClass("clicked");
            });
            $(document).click(function(event) {
                var target = $(event.target);
                if (
                    !target.closest(".overflow-dropdown .dropdown").length &&
                    !target.closest(".img-dropdown a").length
                ) {
                    $(".overflow-dropdown .dropdown a").removeClass("clicked");
                    $(".overflow-dropdown .dropdown").removeClass("open");
                }
            });
            /*AVATAR DROPDOWN SCRIPT END*/
            /*BELL ICON SCRIPT BEGIN*/
            $(".bell-icon a").click(function() {
                $(".overflow-bell-icon .dropdown a").removeClass("clicked");
                $(".overflow-bell-icon .dropdown").toggleClass("open");
            });
            $(".overflow-bell-icon .dropdown a").click(function() {
                $(".overflow-bell-icon .dropdown a").removeClass("clicked");
                $(this).toggleClass("clicked");
            });
            $(document).click(function(event) {
                var target = $(event.target);
                if (
                    !target.closest(".overflow-bell-icon .dropdown").length &&
                    !target.closest(".bell-icon a").length
                ) {
                    $(".overflow-bell-icon .dropdown a").removeClass("clicked");
                    $(".overflow-bell-icon .dropdown").removeClass("open");
                }
            });
            /*BELL ICON SCRIPT END*/
            /*DOTS DROPDOWN SCRIPT BEGIN*/
            $("#gallery-dots-id a").click(function() {
                var sceneId = $(this).data('scene-id');
                var classa = '.dropdown-' + sceneId;
                $(".gallery-dot-overflow .dropdown.open").not(classa).removeClass("open");
                $(".gallery-dot-overflow " + classa + " a").removeClass("clicked");
                $(".gallery-dot-overflow " + classa).toggleClass("open");
            });
            $(".gallery-dot-overflow .dropdown a").click(function() {
                $(".gallery-dot-overflow .dropdown a").removeClass("clicked");
                $(this).toggleClass("clicked");
            });
            $(document).click(function(event) {
                var target = $(event.target);
                if (
                    !target.closest(".gallery-dot-overflow .dropdown").length &&
                    !target.closest("#gallery-dots-id a").length
                ) {
                    $(".gallery-dot-overflow .dropdown a").removeClass("clicked");
                    $(".gallery-dot-overflow .dropdown").removeClass("open");
                }
            });
            /*DOTS DROPDOWN SCRIPT END*/
        });
    </script>

    {{-- Start Notifications Script --}}
    <script>
        var notifcationCount = '{{ auth()->user()->notifications()->count() }}';

        var isPageStatus;
        $(document).ready(function() {
            var loading = false; // Flag to track loading state

            // Load notifications via AJAX
            function loadNotifications(page) {
                if (loading) return; // If already loading, do nothing

                loading = true; // Set loading flag

                $.ajax({
                    url: "{{ route('notifications.index') }}",
                    method: "GET",
                    data: {
                        page: page
                    },
                    success: function(response) {
                        if (response.status) {
                            if (isPageStatus) {
                                return;
                            }
                            isPageStatus = true;
                            // Display a message indicating no more records
                            $('#notification-container').append(
                                '<p class="no-notification">No more records found.</p>');
                        } else {
                            if (page === 1) {
                                $('#notification-container').empty();
                                // var notifcationCount  =  auth()->user()->notifications()->count();
                                if (notifcationCount > 0) {
                                    $('#notification-container').append(
                                        '<button id="mark-as-all-read-btn">Mark All as Read</button>'
                                    );
                                }


                            }
                            // Append the notifications
                            $('#notification-container').append(response);
                            $('#notification-container').data('page', page + 1);
                        }

                        loading = false; // Reset loading flag
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        loading = false; // Reset loading flag in case of error
                    }
                });
            }

            // Show notifications when bell icon is clicked
            $('#notification-bell').click(function() {

                var page = 1; // Reset page to 1 when the bell icon is clicked
                isPageStatus = false;
                loadNotifications(page);
            });

            // Load more notifications on scroll
            $(".notification-container-wrapper").scroll(function() {
                if (isPageStatus) {
                    return;
                }
                var container = $(this);
                if (container.scrollTop() + container.innerHeight() >= container[0].scrollHeight - 20) {
                    var page = $('#notification-container').data('page');
                    loadNotifications(page);
                }
            });
        });



        // Mark all notifications as read
        $(document).on('click', '#mark-as-all-read-btn', function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('notifications.markAsAllRead') }}",
                method: "POST",
                success: function(response) {

                    showToastNotification(response.message);
                    $('.circle-box').text(0);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        function showToastNotification(message) {
            $('.toast-container-notification').html('');
            var toast = $(
                '<div class="toast-container top-0 end-0 p-3"><div aria-live="polite" aria-atomic="true"  class="d-flex justify-content-center aligns-center" style="z-index: 5; right: 0; bottom: 0;">' +
                '<div id="liveNotificationToast" class="toast-notification toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">' +
                '<div class="toast-header">' +
                '<strong class="mr-auto">Success!</strong>' +
                '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '</div>' +
                '<div class="toast-body">' +
                message +
                '</div>' +
                '</div></div>');


            $('.toast-container-notification').append(toast);
            $('.toast-notification').toast('show');

        }
    </script>
    {{-- End Notifications Script --}}
    @yield('scripts')
</body>

</html>
