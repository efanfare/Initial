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
    <link rel="stylesheet" href="https://npmcdn.com/js-offcanvas/dist/_css/minified/js-offcanvas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

    <style>
        #add-people-input {
            padding-left: 30px;
            /* Set the padding to move the text away from the image */
            /* background-image: url('http://localhost:8000/images/za2.png'); */
            background-repeat: no-repeat;
            background-position: 5px center;
            /* Set the position of the image */
        }
    </style>

    @yield('styles')

</head>

<body>
    <!-- DASHBOARD WEB 22 SECTION BEGIN -->
    <div class="main-topbar editor-top-bar">
        <div class="mainbar-back-link">
            <a href="{{ route('scenes.index') }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
            <div class="art-board">
                <a href="javascript:void(0)" id="save-art"><i class="fa fa-pencil-square-o"
                        aria-hidden="true"></i>Save</a>

                {{-- <a href="javascript:void(0)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Create New
                        Artboard</a> --}}
            </div>
        </div>
        <div class="invite-people">
            <a href="{{ route('scene.generate.pdf', $scene->id) }}" class="invite-box" target="_blank"><i
                    class="fa fa-print" aria-hidden="true"></i>Print</a>
            <a href="javascript:void(0)" class="invite-box" data-toggle="modal" data-target="#exampleModal-people"><i
                    class="fa fa-users" aria-hidden="true"></i>Invite
                people{{ auth()->user()->id !== $scene->user_id ? 'd' : '' }}</a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal-people" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul class="nav nav-tabs" role="tablist">
                            @if (auth()->user()->id == $scene->user_id)
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#invited-tabs-1"
                                        role="tab">Invite
                                        People</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#invited-tabs-2" role="tab">Invited
                                    People</a>
                            </li>
                        </ul><!-- Tab panes -->
                        <div class="tab-content">
                            @if (auth()->user()->id == $scene->user_id)
                                <div class="tab-pane active " id="invited-tabs-1" role="tabpanel">
                                    <div class="title-flex">
                                        <img width="80" height="80"
                                            src="{{ $scene->scene_canvas_image?->url ?? 'https://placehold.co/437x249/8e96c8/white?text=Scene%20Snapshot' }}"
                                            alt="image" class="img-fluid scene-invite-image">
                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"
                                                aria-hidden="true"></i> Invite People</h5>
                                    </div>
                                    <br>
                                    <div class="add-people-search-box input-group">
                                        <input type="text" placeholder="Enter email" id="add-people-input"
                                            class="form-control">
                                        <div class="input-group-append">
                                            <button id="add-people-button" class="btn btn-primary">Add</button>
                                        </div>
                                        <div id="search-result"></div> <!-- to display search results -->

                                    </div>
                                    <div id="error-message-container"></div>


                                    {{-- <div class="add-people-search-box">
                                        <input type="text" placeholder="Add people email and press enter"
                                            id="add-people-input" class="form-control">
                                        <button id="add-people-button" class="btn btn-primary">Add</button>

                                        <div id="search-result"></div> <!-- to display search results -->

                                    </div> --}}

                                    <div class="add-people-div scrollbar" id="style-3">
                                        <div class="add-people-flex">
                                            <div class="add-link-func">
                                                <img width="35"
                                                    src="{{ auth()->user()->profile_image->avatar ??Avatar::create(auth()->user()->first_name . ' ' . auth()->user()->last_name)->setDimension(112, 112)->setShape('circle')->setBackground('#' . substr(md5(rand()), 0, 6)) }}"alt="image"
                                                    class="img-fluid">
                                                <a
                                                    href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                                            </div>
                                            <div class="add-position-box">
                                                <span>Owner</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="add-people-search-box">
                                        <textarea cols="6" rows="3" id="invite-message" placeholder="Add message (optional)"
                                            class="form-control"></textarea>
                                    </div>
                                    <br>
                                    <div class="btn-design">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="invite-people"
                                            disabled>Invite
                                            People</button>
                                    </div>
                                </div>
                            @endif
                            <div class="tab-pane {{ auth()->user()->id !== $scene->user_id ? 'active' : '' }}"
                                id="invited-tabs-2" role="tabpanel">
                                <div class="modal-header">
                                    <img width="80" height="80"
                                        src="{{ $scene->scene_canvas_image?->url ?? 'https://placehold.co/437x249/8e96c8/white?text=Scene%20Snapshot' }}"
                                        alt="image" class="img-fluid scene-invite-image">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"
                                            aria-hidden="true"></i> Invited people</h5>

                                </div>
                                <div class="modal-body">
                                    <div class="scrollbar" id="style-3">
                                        <div class="invite-people-box">
                                            <div class="invite-profile">
                                                <img width="35"
                                                    src="{{ auth()->user()->profile_image->avatar ??Avatar::create(auth()->user()->first_name . ' ' . auth()->user()->last_name)->setDimension(112, 112)->setShape('circle')->setBackground('#' . substr(md5(rand()), 0, 6)) }}"alt="image"
                                                    class="img-fluid">
                                                <a
                                                    href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                                            </div>
                                            <div class="profile-member">
                                                <span>You</span>
                                            </div>
                                        </div>
                                        @forelse($invitedUsersList as $user)
                                            <div class="invite-people-box">
                                                <div class="invite-profile">
                                                    <img src="{{ Avatar::create(strtoupper($user->email))->setDimension(112, 112)->setBackground('#' . substr(md5(rand()), 0, 6)) }}"
                                                        alt="image" class="img-fluid">
                                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                </div>
                                                <div class="profile-member">
                                                    <span>{{ $user->is_accepted ? 'Accepted' : 'Pending' }}</span>
                                                </div>
                                            </div>
                                        @empty
                                            <p>You have not invited yet.</p>
                                        @endforelse

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->

            <div class="profile-drop-down">
                <a href="javascript:void(0)" id="notification-bell"><span class="invite-profile">
                        @php
                            $name = request()->user()->first_name . ' ' . request()->user()->last_name;
                            $names = explode(' ', $name);
                            $initialsName = '';
                            foreach ($names as $name) {
                                $initialsName .= strtoupper(substr($name, 0, 1));
                            }
                        @endphp
                        {{ $initialsName ? $initialsName : request()->user()->name[0] }}
                    </span>
                    <div class="bell-number">
                        <span class="circle-box">{{ request()->user()->notifications()->unread()->count() }}</span>
                    </div>
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
    <!-- Modal -->
    <div class="modal logout-modal fade" id="exampleModalItemDelete" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/logout-img.png') }}" alt="image" class="img-fluid">
                    <h6>Are you sure you want to delete this item?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" onclick="deleteItem()" id="delete-item-button"
                        class="btn btn-primary">Yes</button>
                    <form id="delete-form" action="{{ route('item.delete.photobank.index', 'id') }}" method="POST"
                        style="display:none;">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit">Log out</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Modal -->
    <div class="modal logout-modal fade" id="exampleModalBackgroundDelete" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/logout-img.png') }}" alt="image" class="img-fluid">
                    <h6>Are you sure you want to delete this background?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" onclick="deleteBackground()" id="delete-background-button"
                        class="btn btn-primary">Yes</button>
                    <form id="delete-background-form" action="{{ route('background.delete.index', 'id') }}"
                        method="POST" style="display:none;">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit">Log out</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="toast-container-notification">

    </div>
    @yield('content')

    <!-- DASHBOARD SECTION END -->


    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.9.4/dist/alpine.js"></script>
    <script src="https://npmcdn.com/js-offcanvas/dist/_js/js-offcanvas.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gifler@0.1.0/gifler.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"
        integrity="sha512-CeIsOAsgJnmevfCi2C7Zsyy6bQKi43utIjdA87Q0ZY84oDqnI0uwfM9+bKiIkI75lUeI00WG/+uJzOmuHlesMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function removeAd() {
            $('.ad-container-scene').remove();
        }

        function removeAdRight() {
            $('.ad-container-scene-right').remove();
        }


        $(document).ready(function() {
            /*SIDEBAR PAGE SCRIPT BEGIN*/
            $('.oc-toggle').click(function() {
                $('.oc-toggle, .oc-nav, .oc-wrap').toggleClass('--is-active');
                $('.oc-toggle-right, .oc-nav-right').removeClass('--is-active');
                $('.oc-wrap').addClass('l-ri');
                $('.oc-wrap').addClass('--is-active');
                $('.oc-wrap').removeClass('o-ri');

                // Add or remove the classes 'l-ri' and '--is-active' to the mainbar-back-link based on the sidebar state
                if ($('.oc-toggle.oc-left.--is-active').length) {
                    $('.mainbar-back-link').addClass('l-ri2 --is-active');
                    $('.invite-people').removeClass('o-ri2 --is-active');
                } else {
                    $('.mainbar-back-link').removeClass('l-ri2 --is-active');
                }

                if (!$('.oc-toggle.oc-left.--is-active').length && !$(
                        '.oc-toggle-right.oc-right.--is-active').length) {
                    $('.oc-wrap.oc-left.--is-active').removeClass('--is-active');
                    $('.oc-wrap').removeClass('l-ri');
                }
            });

            $('.oc-toggle-right').click(function() {
                $('.oc-toggle-right, .oc-nav-right, .oc-wrap').toggleClass('--is-active');
                $('.oc-toggle, .oc-nav').removeClass('--is-active');
                $('.oc-wrap').addClass('o-ri');
                $('.oc-wrap').addClass('--is-active');
                $('.oc-wrap').removeClass('l-ri');

                // Add the classes 'o-ri2' and '--is-active' to the invite-people element when clicking on the right sidebar
                $('.invite-people').addClass('o-ri2 --is-active');
                $('.mainbar-back-link').removeClass('l-ri2 --is-active');

                if (!$('.oc-toggle.oc-left.--is-active').length && !$(
                        '.oc-toggle-right.oc-right.--is-active').length) {
                    $('.oc-wrap.oc-left.--is-active').removeClass('--is-active');
                    $('.oc-wrap').removeClass('o-ri');
                    $('.invite-people').removeClass('o-ri2 --is-active');
                }
            });
            /*SIDEBAR PAGE SCRIPT END*/

            /*IMAGE UPLOADER SCRIPT BEGIN*/
            @if (auth()->user()->id === $scene->user_id)
                function ekUpload() {
                    function Init() {

                        var fileSelect = document.getElementById('file-upload'),
                            fileDrag = document.getElementById('file-drag'),
                            submitButton = document.getElementById('submit-button');
                        fileSelect.addEventListener('change', fileSelectHandler, false);
                        var xhr = new XMLHttpRequest();
                        if (xhr.upload) {
                            fileDrag.addEventListener('dragover', fileDragHover, false);
                            fileDrag.addEventListener('dragleave', fileDragHover, false);
                            fileDrag.addEventListener('drop', fileSelectHandler, false);
                        }
                    }

                    function fileDragHover(e) {
                        var fileDrag = document.getElementById('file-drag');
                        e.stopPropagation();
                        e.preventDefault();
                        fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
                    }

                    function fileSelectHandler(e) {
                        var files = e.target.files || e.dataTransfer.files;
                        fileDragHover(e);
                        for (var i = 0, f; f = files[i]; i++) {
                            parseFile(f);
                            uploadFile(f);
                        }
                    }

                    function output(msg) {
                        var m = document.getElementById('messages');
                        m.innerHTML = msg;
                    }

                    function parseFile(file) {
                        console.log(file.name);
                        output(
                            '<strong>' + encodeURI(file.name) + '</strong>'
                        );
                        var imageName = file.name;
                        $('#upload-background').prop('disabled', false);
                        var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
                        if (isGood) {
                            document.getElementById('start').classList.add("hidden");
                            document.getElementById('response').classList.remove("hidden");
                            document.getElementById('notimage').classList.add("hidden");
                            document.getElementById('file-image').classList.remove("hidden");
                            document.getElementById('file-image').src = URL.createObjectURL(file);
                            document.getElementById('background-input-fields').style.display = "block";

                            var cutIcon = document.createElement('i');
                            cutIcon.className = 'fa fa-times-circle fa-lg';
                            cutIcon.style.color = 'red';
                            cutIcon.setAttribute('aria-hidden', 'true');
                            cutIcon.setAttribute('onclick', 'resetBackgroundUpload()');
                            document.querySelector('.remove-upload-file-background').appendChild(cutIcon);
                        } else {
                            showToast('Error',
                                'Uploaded file format is not allowed. Try uploading an image of format jpeg, or png'
                            );
                            document.getElementById('file-image').classList.add("hidden");
                            // document.getElementById('notimage').classList.remove("hidden");
                            document.getElementById('start').classList.remove("hidden");
                            document.getElementById('response').classList.add("hidden");
                            document.getElementById("file-upload-form").reset();
                        }
                    }

                    function uploadFile(file) {
                        var xhr = new XMLHttpRequest(),
                            fileInput = document.getElementById('class-roster-file'),
                            pBar = document.getElementById('file-progress')
                    }
                    if (window.File && window.FileList && window.FileReader) {
                        Init();
                    } else {
                        document.getElementById('file-drag').style.display = 'none';
                    }
                }
                ekUpload();
            @endif

            function ekUploadItem() {
                function Init() {


                    var fileSelect = document.getElementById('file-upload-item'),
                        fileDrag = document.getElementById('file-drag-item'),
                        submitButton = document.getElementById('submit-button-item');
                    fileSelect.addEventListener('change', fileSelectHandler, false);
                    var xhr = new XMLHttpRequest();
                    if (xhr.upload) {
                        fileDrag.addEventListener('dragover', fileDragHover, false);
                        fileDrag.addEventListener('dragleave', fileDragHover, false);
                        fileDrag.addEventListener('drop', fileSelectHandler, false);
                    }
                }

                function fileDragHover(e) {
                    var fileDrag = document.getElementById('file-drag-item');
                    e.stopPropagation();
                    e.preventDefault();
                    fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload-item');
                }

                function fileSelectHandler(e) {
                    var files = e.target.files || e.dataTransfer.files;
                    fileDragHover(e);
                    for (var i = 0, f; f = files[i]; i++) {
                        parseFile(f);
                        uploadFile(f);
                    }
                }

                function output(msg) {
                    var m = document.getElementById('messages-item');
                    m.innerHTML = msg;
                }

                function parseFile(file) {
                    console.log(file.name);
                    output(
                        '<strong>' + encodeURI(file.name) + '</strong>'
                    );
                    var imageName = file.name;
                    $('#upload-items').prop('disabled', false);
                    var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
                    if (isGood) {
                        document.getElementById('start-item').classList.add("hidden");
                        document.getElementById('response-item').classList.remove("hidden");
                        document.getElementById('notimage-item').classList.add("hidden");
                        document.getElementById('file-image-item').classList.remove("hidden");
                        document.getElementById('file-image-item').src = URL.createObjectURL(file);
                        document.getElementById('item-input-fields').style.display = "block";

                        var cutIcon = document.createElement('i');
                        cutIcon.className = 'fa fa-times-circle fa-lg';
                        cutIcon.style.color = 'red';
                        cutIcon.setAttribute('aria-hidden', 'true');
                        cutIcon.setAttribute('onclick', 'resetItemUpload()');
                        document.querySelector('.remove-upload-file-item').appendChild(cutIcon);
                    } else {
                        showToast('Error',
                            'Uploaded file format is not allowed. Try uploading an image of format jpeg, or png'
                        );
                        document.getElementById('file-image-item').classList.add("hidden");
                        // document.getElementById('notimage-item').classList.remove("hidden");
                        document.getElementById('start-item').classList.remove("hidden");
                        document.getElementById('response-item').classList.add("hidden");
                        document.getElementById("file-upload-form-item").reset();
                        document.getElementById('item-input-fields').style.display = "none";
                    }
                }

                function uploadFile(file) {
                    var xhr = new XMLHttpRequest(),
                        fileInput = document.getElementById('class-roster-file'),
                        pBar = document.getElementById('file-progress'),
                        fileSizeLimit = 1024; // In MB
                }
                if (window.File && window.FileList && window.FileReader) {
                    Init();
                } else {
                    document.getElementById('file-drag-item').style.display = 'none';
                }
            }

            ekUploadItem();



            /*IMAGE UPLOADER SCRIPT END*/
            /*MESSAGE BOX SCRIPT BEGIN*/
            $(".chat-icon-img a").click(function() {
                $(".chat-overflow-dropdown .dropdown a").removeClass("clicked");
                $(".chat-overflow-dropdown .dropdown a").removeClass("clicked");
                $(".chat-overflow-dropdown .dropdown").toggleClass("open");
            });
            $(".chat-overflow-dropdown .dropdown a").click(function() {
                $(".chat-overflow-dropdown .dropdown a").removeClass("clicked");
                $(".chat-overflow-dropdown .dropdown a").removeClass("clicked");
                $(this).toggleClass("clicked");
                $(this).toggleClass("clicked");
            });
            /*MESSAGE BOX SCRIPT END*/
            /*AVATAR IMAGE UPLOADER SCRIPT BEGIN*/
            function readURL(input, imgControlName) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(imgControlName).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imag").change(function() {
                var imgControlName = "#ImgPreview";
                readURL(this, imgControlName);
                $('.preview1').addClass('it');
                $('.btn-rmv1').addClass('rmv');
            });
            $("#removeImage1").click(function(e) {
                e.preventDefault();
                $("#imag").val("");
                $("#ImgPreview").attr("src", "");
                $('.preview1').removeClass('it');
                $('.btn-rmv1').removeClass('rmv');
            });
            /*AVATAR IMAGE UPLOADER SCRIPT END*/
            /*BELL ICON SCRIPT BEGIN*/
            $(".profile-drop-down a").click(function() {
                $(".invite-people .dropdown a").removeClass("clicked");
                $(".invite-people .dropdown a").removeClass("clicked");
                $(".invite-people .dropdown").toggleClass("open");
            });
            $(".invite-people .dropdown a").click(function() {
                $(".invite-people .dropdown a").removeClass("clicked");
                $(".invite-people .dropdown a").removeClass("clicked");
                $(this).toggleClass("clicked");
                $(this).toggleClass("clicked");
            });
            /*BELL ICON SCRIPT END*/
        });
    </script>
    {{-- Start Invitation People --}}
    <script>
        let hostEmail = '{{ auth()->user()->email }}';
        let invitedEmails = [hostEmail, ...Object.values(@json($invitedUsers))];
        let newInvitedEmails = [];

        function updateInviteButton() {
            if (newInvitedEmails.length > 0) {
                $('#invite-people').prop('disabled', false);
            } else {
                $('#invite-people').prop('disabled', true);
            }
        }

        $(document).ready(function(e) {

            let originalPlaceholder = $('#add-people-input').attr('placeholder');

            $('#add-people-input').on('keypress', function(event) {
                $(".invalid-email").remove();
                $('#add-people-button').prop('disabled', false);
                var keyCode = (event.keyCode ? event.keyCode : event.which);
                if (keyCode == 13) { // Check if the key pressed was Enter
                    addPerson();
                }
            });

            $('#add-people-button').on('click', function() {
                addPerson();
            });
            $('#add-people-input').on('input', function() {
                $('#add-people-button').prop('disabled', false);
            });

            function addPerson() {
                $('#add-people-button').prop('disabled', true);
                $(".invalid-email").remove();
                var email = $('#add-people-input').val();
                if (email === '') {
                    $('#error-message-container').html(
                        '<span class="text-danger invalid-email">Email field is required</span>'
                    );
                    $('#add-people-button').prop('disabled', false);
                    return;
                }
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (emailPattern.test(email)) {
                    // Check if email has already been invited
                    if (invitedEmails.includes(email)) {
                        $('#error-message-container').html(
                            '<span class="text-danger invalid-email">This email has already been invited</span>'
                        );
                        $('#add-people-button').prop('disabled', false);

                        return;
                    }

                    // Check the size of the invitedEmails array
                    if (invitedEmails.length >= 10) {
                        $('#error-message-container').html(
                            '<span class="text-danger invalid-email">You cannot invite more than 10 people at a time</span>'
                        );
                        return;
                    }

                    var query = email;
                    $.ajax({
                        url: '{{ route('search-user') }}',
                        type: 'GET',
                        data: {
                            'query': query
                        },
                        success: function(data) {
                            var html = '<div class="add-people-flex">' +
                                '<div class="add-link-func">' + data.image +
                                '<a href="mailto:' + data.email + '"> ' + data.email +
                                '</a>' +
                                '</div>' +
                                '<div class="add-position-box">' +
                                '<span class="remove-email">Remove</span>' +
                                '</div>' +
                                '</div>';

                            $('.add-people-div').append(html);
                            // Add email to the invited list
                            invitedEmails.push(email);
                            newInvitedEmails.push(email);
                            updateInviteButton();

                            $('#add-people-input').val('');
                            $('#add-people-input').attr('placeholder', originalPlaceholder);
                            $('#add-people-button').prop('disabled', false);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                } else {
                    $('#error-message-container').html(
                        '<span class="text-danger invalid-email">Invalid email</span>');
                }
            }


            $('.add-people-div').on('click', '.remove-email', function(event) {
                var emailContainer = $(this).closest('.add-people-flex');
                var email = emailContainer.find('a').text().trim();
                var index = newInvitedEmails.indexOf(email);
                var indexInvitedEmails = invitedEmails.indexOf(email);
                if (index > -1) {
                    newInvitedEmails.splice(index, 1);
                }
                if (indexInvitedEmails > -1) {
                    invitedEmails.splice(indexInvitedEmails, 1);
                }
                updateInviteButton();


                emailContainer.remove();
            });

            $('#invite-people').on('click', function(event) {

                $('#invite-people').prop('disabled', true);

                jQuery.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('invite.process') }}',

                    data: {
                        emails: newInvitedEmails,
                        sceneId: sceneId,
                        message: $("#invite-message").val(),

                    },
                    success: function(response) {
                        $('#exampleModal-people').modal('hide');
                        $('.toast-container').html('');
                        showToast('Success!', response.message)

                        setTimeout(function() {
                            location.reload();
                        }, 3000);

                    },
                    error: function(response) {
                        var errorMessage = response.responseJSON.errors;
                        alert(errorMessage);
                    }
                });
            });

        });
    </script>
    {{-- End invitation People --}}
    {{-- Start Notifications Script --}}
    <script>
        var isPageStatus;
        var notifcationCount = '{{ auth()->user()->notifications()->count() }}';
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
