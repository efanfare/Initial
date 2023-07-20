@extends('layouts.main_dashboard', ['title' => 'Profile', 'dbClass' => 'db'])
@section('content')
    <div class="welcome-box-flex">
        <div class="welcome-box-text">
            <h6>Scenes</h6>
        </div>
        <div class="welcome-box-btn">
            <a href="{{ route('scene.create') }}" class="btn btn-primary">Make a Scene</a>
        </div>
    </div>
    <div class="toast-container top-0 end-0 p-3"></div>
    @if (session()->has('error'))
        <div class="toast-container top-0 end-0 p-3">
            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center aligns-center"
                style="z-index: 5; right: 0; bottom: 0;">
                <div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true"
                    data-delay="5000">
                    <div class="toast-header">
                        <strong class="mr-auto">Error!</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="toast-body">
                        {{ session()->get('error') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
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

    <!-- Modal -->
    <div class="modal logout-modal fade" id="exampleModalSceneDelete" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/logout-img.png') }}" alt="image" class="img-fluid">
                    <h6>Are you sure you want to delete this scene?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" onclick="deleteScene()" id="delete-button" class="btn btn-primary">Yes</button>
                    <form id="delete-form" action="{{ route('scene.delete', 'id') }}" method="POST" style="display:none;">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit">Log out</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    {{-- Invitation Modal --}}
    <div id="invite-modal-html"></div>
    {{-- End Invitation Modal --}}
    <div class="scenes-tabs gallery-boxes-row">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#flamingo" role="tab" aria-controls="pills-flamingo"
                    aria-selected="true">Hosted Scenes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#cuckoo" role="tab" aria-controls="pills-cuckoo"
                    aria-selected="false">Shared with you</a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="flamingo" role="tabpanel" aria-labelledby="flamingo-tab">
                <div class="row">
                    @forelse ($scenes as $key => $scene)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="gallery-main-box">
                                <img src="{{ $scene->scene_canvas_image?->url ?? 'https://placehold.co/437x249/8e96c8/white?text=Scene%20Snapshot' }}"
                                    alt="image" class="img-div">

                                <div class="content-flex">
                                    <div class="gallery-box-heading">
                                        <h6>{{ $scene->title }}</h6>
                                        <p>Created {{ $scene->created_at?->diffForHumans() }}</p>
                                    </div>
                                    <div class="gallery-dot-overflow">
                                        <div class="gallery-dots" id="gallery-dots-id"
                                            data-scene-id="{{ $scene->id }}">
                                            <a href="javascript:void(0)" data-scene-id="{{ $scene->id }}"><i
                                                    class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="dropdown dropdown-{{ $scene->id }}">
                                            <a href="{{ route('scene.artboard', $scene->id) }}"
                                                id="{{ $scene->id }}">Edit</a>
                                            <a href="javascript:void(0)" class="delete-link"
                                                data-id="{{ $scene->id }}"
                                                onclick="showDeleteConfirmation({{ $scene->id }})" class="delete-link"
                                                id="sketch">Delete</a>

                                            <a href="javascript:void(0)" class="scene-invitation"
                                                data-id="{{ $scene->id }}" id="figma">Invite</a>
                                            <a href="{{ route('scene.generate.pdf', $scene->id) }}" target="_blank"
                                                class="print-scene" id="print">Print</a>
                                        </div>
                                    </div>
                                </div>
                                <p class="gallery-main-txt">{{ $scene->description }}</p>
                                <div class="invite-box-flex">
                                    <div class="invite-content">
                                        <p>Invited People</p>
                                    </div>
                                    <div class="invite-images">
                                        @foreach ($scene->sceneInvitations->take(4) as $invitation)
                                            <span class="gallery-img-cls">
                                                <img width="38"
                                                    src="{{ Avatar::create(strtoupper($invitation->email))->setDimension(112, 112)->setBackground('#' . substr(md5(rand()), 0, 6))->setShape('circle') }}"
                                                    alt="image" class="img-fluid">
                                            </span>
                                        @endforeach
                                        @php
                                            $remainingInvitationsCount = $scene->sceneInvitations->count() - 4;
                                        @endphp

                                        @if ($scene->sceneInvitations->isNotEmpty())
                                            @if ($remainingInvitationsCount > 0)
                                                <span class="counter-number">+{{ $remainingInvitationsCount }}</span>
                                            @endif
                                        @else
                                            <span class="counter-number">0</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>You have no scenes.</p>
                    @endforelse
                </div>
                <div class="row d-flex justify-content-center">
                    {{ $scenes->links('vendor.pagination.bootstrap-4', ['pageName' => 'bg_page', 'class' => 'justify-content-center']) }}

                </div>
            </div>
            <div class="tab-pane fade" id="cuckoo" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">

                    @forelse ($sharedWithYouScenes as $invitation)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="gallery-main-box">
                                <div class="gallery-box-overlay">
                                    <a href="{{ route('scene.artboard', $invitation->scene->id) }}"
                                        class="btn btn-primary">View detail</a>
                                </div>
                                <img src="{{ $invitation->scene->scene_canvas_image?->url ?? 'https://placehold.co/437x249/8e96c8/white?text=Scene%20Snapshot' }}"
                                    alt="image" class="img-div">

                                <div class="content-flex">
                                    <div class="gallery-box-heading">
                                        <h6>{{ $invitation->scene->title }}</h6>
                                        <p>{{ $invitation->scene->created_at?->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <p class="gallery-main-txt">{{ $invitation->scene->description }}</p>
                            </div>
                        </div>
                    @empty
                        <p>No scene is shared with you yet.</p>
                    @endforelse


                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function showDeleteConfirmation(sceneId) {
            // Show the confirmation modal
            $('#exampleModalSceneDelete').modal('show');

            // Update the delete button action with the scene ID
            $('#delete-button').attr('data-scene-id', sceneId);
        }

        function deleteScene() {
            var sceneId = $('#delete-button').attr('data-scene-id');

            // Set the form action with the scene ID
            var deleteForm = $('#delete-form');
            var deleteUrl = deleteForm.attr('action').replace('id', sceneId);
            deleteForm.attr('action', deleteUrl);

            // Submit the form
            deleteForm.submit();

            // Close the confirmation modal
            $('#exampleModalSceneDelete').modal('hide');
        }
    </script>
    {{-- Start Invitation People --}}
    <script>
        let invitedUsers = null;
        let hostEmail = '{{ auth()->user()->email }}';

        let newInvitedEmails = [];
        let originalPlaceholder = $('#add-people-input').attr('placeholder');

        $(document).on('click', '.scene-invitation', function(e) {
            var id = $(this).data('id');
            var editUrl = '{{ route('scene.invitation', ['id' => ':id']) }}';
            editUrl = editUrl.replace(':id', id);
            $('#invite-modal-html').html('');

            $.ajax({
                url: editUrl,
                method: 'GET',
                async: false,
                success: function(response) {
                    $('#invite-modal-html').html(response.html);

                    invitedEmails = [hostEmail, ...Object.values(response.invitedUsers)];

                    $('#exampleModal-people').modal('show');
                },
                error: function() {
                    console.log('Error retrieving edit invitation scene');
                }
            });
        });

        function updateInviteButton() {
            if (newInvitedEmails.length > 0) {
                $('#invite-people').prop('disabled', false);
            } else {
                $('#invite-people').prop('disabled', true);
            }
        }
        $(document).on('click', '#add-people-button', function(e) {
            addPerson();
        });
        $(document).on('keypress', '#add-people-input', function(event) {
            $(".invalid-email").remove();
            $('#add-people-button').prop('disabled', false);
            var keyCode = (event.keyCode ? event.keyCode : event.which);
            if (keyCode == 13) { // Check if the key pressed was Enter
                addPerson();
            }
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

        $(document).on('input', '#add-people-button', function(event) {
            $('#add-people-button').prop('disabled', false);
        });

        $(document).on('click', '.add-people-div .remove-email', function(event) {
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
        $(document).on('click', '#invite-people', function(event) {
            $('#invite-people').prop('disabled', true);

            jQuery.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('invite.process') }}',

                data: {
                    emails: newInvitedEmails,
                    sceneId: $("#modal-scene-id").val(),
                    message: $("#invite-message").val(),
                },
                success: function(response) {
                    $('#exampleModal-people').modal('hide');
                    $('.toast-container').html('');
                    showToastInvitation('Success!', response.message)

                },
                error: function(response) {
                    var errorMessage = response.responseJSON.errors;
                    showToastInvitation('Error!', errorMessage)

                }
            });
        });

        function showToastInvitation(type, message) {
            $('.toast-container').html('');
            var toast = $(
                '<div aria-live="polite" aria-atomic="true"  class="d-flex justify-content-center align-items-center" style="z-index: 5; right: 0; bottom: 0;">' +
                '<div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="6000">' +
                '<div class="toast-header">' +
                '<strong class="mr-auto">' + type.toUpperCase() + '</strong>' +
                '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '</div>' +
                '<div class="toast-body">' +
                message +
                '</div>' +
                '</div>');

            toast.addClass('toast-' + type); // Add appropriate Bootstrap class for toast type

            // Show the toast with animation
            $('.toast-container').append(toast);
            $('.toast').toast('show');
            // toast.toast({ animation: true });
            // toast.toast('show');
        }
    </script>
    {{-- End invitation People --}}
    @if (session()->has('message') || session()->has('error'))
        <script>
            $('.toast').toast('show');
        </script>
    @endif
@endsection
