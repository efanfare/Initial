@extends('layouts.main_dashboard', ['title' => 'Gallery Collection', 'dbClass' => 'db'])
@section('content')
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
                    data-delay="5000">
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

    <div class="toast-container top-0 end-0 p-3">

    </div>

    <!-- Modal -->
    <div class="modal logout-modal fade" id="exampleModalGalleryDelete" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/logout-img.png') }}" alt="image" class="img-fluid">
                    <h6>Are you sure you want to delete this gallery collection?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" onclick="deleteGallery()" id="delete-button" class="btn btn-primary">Yes</button>
                    <form id="delete-form" action="{{ route('gallery.delete', 'id') }}" method="POST"
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
    @if ($galleries->isNotEmpty())
        <div class="welcome-box-flex">
            <div class="welcome-box-text">
                <h6>Gallery Collection</h6>
            </div>
            <div class="welcome-box-btn">
                <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal-scene-listing">Add Collection</a>
            </div>
        </div>
    @else
        <div class="new-gallery-image">
            <img src="{{ asset('images/new-gallery-image.png') }}" alt="image" class="img-fluid">
            <p>No Gallery Collection of scenes</p>
            <div class="welcome-box-btn">
                <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal-scene-listing">Add Collection</a>
            </div>
        </div>
    @endif


    <!-- SCENE LISTING MODAL BEGIN -->
    <div class="modal fade" id="exampleModal-scene-listing" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="scene-modal-content">
                        <div class="scene-modal-heading">
                            <h4>Add Gallery Collection</h4>
                            <p id="scene-add-error-message" style="color:red"></p>
                        </div>


                        <div class="scene-input-box">
                            <div class="scene-error-msg">
                                <input type="text" name="title" id="add-gallery-title"
                                    placeholder="Add Title of collection" class="form-control">
                            </div>
                            <button type="button" class="btn btn-primary" id="scene-modal-func" data-toggle="modal"
                                data-target="#exampleModal-confirm-listing">Add Collection</button>
                        </div>
                    </div>
                    <div class="row scene-gallery-row scrollbar" id="style-3">
                        @foreach ($scenes as $scene)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="select-box-img">
                                    <div class="select-inner-img">
                                        <img src="{{ $scene->scene_canvas_image?->url ?? 'https://placehold.co/800x700/8e96c8/white?text=Scene%20Snapshot' }}"
                                            alt="image" class="img-div">


                                        <div class="select-inner-overlay"></div>
                                        <div class="select-inner-checkbox">
                                            <label class="checkbox">
                                                <input type="checkbox" name="scenes[]"
                                                    class="checkbox__input scene-checkbox" value="{{ $scene->id }}"
                                                    @if (in_array($scene->id, old('scenes', []))) checked @endif />
                                                <span class="checkbox__inner"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <h6>{{ $scene->title }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCENE LISTING MODAL END -->
    <!-- CONFIRM SCENE MODAL BEGIN -->
    <div class="modal logout-modal fade" id="exampleModal-confirm-listing" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="images/scene-sub.png" alt="image" class="img-fluid">
                    <h6>Are you sure you want to <span>create collection</span></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- CONFIRM SCENE MODAL END -->

    {{-- Edit Listing Modal --}}
    <div id="edit-gallery-modal-html"></div>
    {{-- End Edit Listing Modal --}}

    {{-- View Listing Modal --}}
    <div id="view-gallery-modal-html"></div>
    {{-- End View Listing Modal --}}

    @if ($galleries->isNotEmpty())
        <div class="row gallery-boxes-row">
            @forelse ($galleries as $gallery)
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="gallery-main-box">
                        @php
                            $firstScene = $gallery->scenes->first();
                        @endphp
                        @if ($firstScene && isset($firstScene->scene_canvas_image))
                            <img src="{{ $firstScene->scene_canvas_image->url }}" alt="image" class="img-div">
                        @else
                            <img src="https://placehold.co/437x249/8e96c8/white?text=Scene%20Snapshot" alt="image"
                                class="img-div">
                        @endif

                        <div class="content-flex">
                            <div class="gallery-box-heading">
                                <h6>{{ $gallery->title }}</h6>
                                <p>Created {{ $gallery->created_at?->diffForHumans() }}</p>
                            </div>
                            <div class="gallery-dot-overflow">
                                <div class="gallery-dots" id="gallery-dots-id" data-scene-id="{{ $gallery->id }}">
                                    <a href="javascript:void(0)" data-scene-id="{{ $gallery->id }}"><i
                                            class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                </div>
                                <div class="dropdown dropdown-{{ $gallery->id }}">
                                    <a href="javascript:void(0)" class="edit-collection" id="{{ $gallery->id }}"
                                        data-id="{{ $gallery->id }}">Edit</a>
                                    <a href="javascript:void(0)" class="delete-link" data-id="{{ $gallery->id }}"
                                        onclick="showDeleteConfirmation({{ $gallery->id }})" class="delete-link"
                                        id="sketch">Delete</a>

                                    <a href="javascript:void(0)" id="figma" class="view-collection"
                                        data-id="{{ $gallery->id }}">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No Gallery found!</p>
            @endforelse

        </div>

        <div class="row d-flex justify-content-center">
            {{ $galleries->links('vendor.pagination.bootstrap-4', ['pageName' => 'bg_page', 'class' => 'justify-content-center']) }}

        </div>
    @endif

@endsection
@section('scripts')
    <!-- Include jQuery library in your HTML file -->


    <!-- Add a script to handle the click event on the delete link -->
    <script>
        $(document).ready(function() {
            /*SHOW HIDE MODAL SCRIPT BEGIN*/
            $('#scene-modal-func').click(function() {
                // $('#exampleModal-scene-listing').modal('hide');
                $('#exampleModal-confirm-listing').modal('show');
            });
        });
        /*SHOW HIDE MODAL SCRIPT END*/
    </script>

    <script>
        $(document).ready(function() {
            // Add event listener to the "Yes" button in the modal
            $('#exampleModal-confirm-listing').on('click', '.btn-primary', function() {
                // Get the selected scenes checkboxes
                const selectedScenes = $('.scene-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                // Get the title of the collection
                const title = $('#add-gallery-title').val();

                // Send the AJAX request to save the collection and its scenes
                $.ajax({
                    url: '{{ route('gallery.store') }}',
                    type: 'POST',
                    data: {
                        title: title,
                        scenes: selectedScenes,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {

                        $('#exampleModal-confirm-listing').modal('hide');
                        $('#add-gallery-title').val(''); // Reset the title input field
                        $('.scene-checkbox:checked').prop('checked', false);
                        $('#exampleModal-scene-listing').modal('hide');
                        showToastGallery('success', response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 3000);

                    },
                    error: function(xhr, status, error) {
                        // Display an error message
                        const errorMessage = xhr.responseJSON.message;

                        $('.title-invalid').remove();

                        if (xhr.responseJSON.errors.hasOwnProperty('title')) {

                            const titleMessage = xhr.responseJSON.errors.title[0];

                            var titleErrorHtml =
                                '<span class="text-danger title-invalid">' +
                                titleMessage +
                                '</span>';
                            $('#add-gallery-title').after(titleErrorHtml);
                        }

                        // ss
                        $('#scene-add-error-message').addClass(
                            'd-none');
                        if (xhr.responseJSON.errors.hasOwnProperty('scenes')) {
                            const sceneMessage = xhr.responseJSON.errors.scenes[0];
                            $('#scene-add-error-message').html('');
                            $('#scene-add-error-message').html(sceneMessage);
                            $('#scene-add-error-message').removeClass(
                                'd-none');
                        }
                        $('#exampleModal-confirm-listing').modal('hide');
                    }




                });
            });
        });
    </script>

    {{-- Edit collection --}}

    <script>
        $(document).ready(function() {
            /*SHOW HIDE MODAL SCRIPT BEGIN*/
            $('#scene-modal-func-edit').click(function() {
                $('#exampleModal-confirm-listing-edit').modal('show');
            });
        });


        // Edit Collection
        $(document).on('click', '.edit-collection', function(e) {
            var id = $(this).data('id');
            var editUrl = '{{ route('gallery.edit', ['id' => ':id']) }}';
            editUrl = editUrl.replace(':id', id);
            $('#edit-gallery-modal-html').html('');

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {
                    $('#edit-gallery-modal-html').html(response.html);
                    $('#exampleModal-scene-listing-edit').modal('show');
                },
                error: function() {
                    alert('Error retrieving edit collection');
                }
            });
        });

        $(document).on('click', '.update-gallery-button.btn-primary', function(e) {
            // Get the selected scenes checkboxes
            var id = $(this).data('id');
            const selectedScenes = $('.edit-scenes-input:checked').map(function() {
                return $(this).val();
            }).get();

            // Get the title of the collection
            const title = $('#edit-gallery-title').val();

            var updateUrl = '{{ route('gallery.update', ['id' => ':id']) }}';
            updateUrl = updateUrl.replace(':id', id);

            // Send the AJAX request to save the collection and its scenes
            $.ajax({
                url: updateUrl,
                type: 'POST',
                data: {
                    _method: 'PUT',
                    title: title,
                    scenes: selectedScenes,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {

                    $('#exampleModal-confirm-listing-edit').modal('hide');
                    $('#edit-gallery-title').val(''); // Reset the title input field
                    $('.edit-scenes-checkbox:checked').prop('checked', false);
                    $('#exampleModal-scene-listing-edit').modal('hide');
                    showToastGallery('success', response.message);
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    // Display an error message
                    const errorMessage = xhr.responseJSON.message;

                    $('.title-invalid').remove();

                    if (xhr.responseJSON.errors.hasOwnProperty('title')) {

                        const titleMessage = xhr.responseJSON.errors.title[0];
                        var titleErrorHtml =
                            '<span class="text-danger title-invalid">' +
                            titleMessage +
                            '</span>';
                        $('#edit-gallery-title').after(titleErrorHtml);
                    }

                    $('#scene-edit-error-message').addClass(
                        'd-none');
                    if (xhr.responseJSON.errors.hasOwnProperty('scenes')) {
                        const sceneMessage = xhr.responseJSON.errors.scenes[0];
                        $('#scene-edit-error-message').removeClass(
                            'd-none');
                    }
                    $('#exampleModal-confirm-listing-edit').hide();
                }
            });
        });
    </script>
    {{-- View Collection --}}
    <script>
        // View Collection
        $(document).on('click', '.view-collection', function(e) {
            var id = $(this).data('id');
            var showUrl = '{{ route('gallery.show', ['id' => ':id']) }}';
            showUrl = showUrl.replace(':id', id);
            $('#view-gallery-modal-html').html('');

            $.ajax({
                url: showUrl,
                method: 'GET',
                success: function(response) {
                    $('#view-gallery-modal-html').html(response.html);
                    $('#exampleModal-scene-listing-view').modal('show');
                },
                error: function() {
                    alert('Error retrieving view collection');
                }
            });
        });
    </script>
    <script>
        function showDeleteConfirmation(galleryId) {
            // Show the confirmation modal
            $('#exampleModalGalleryDelete').modal('show');

            // Update the delete button action with the scene ID
            $('#delete-button').attr('data-gallery-id', galleryId);
        }

        function deleteGallery() {
            var galleryId = $('#delete-button').attr('data-gallery-id');

            // Set the form action with the scene ID
            var deleteForm = $('#delete-form');
            var deleteUrl = deleteForm.attr('action').replace('id', galleryId);
            deleteForm.attr('action', deleteUrl);

            // Submit the form
            deleteForm.submit();

            // Close the confirmation modal
            $('#exampleModalGalleryDelete').modal('hide');
        }

        function showToastGallery(type, message) {
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
    @if (session()->has('message') || session()->has('error'))
        <script>
            $('.toast').toast('show');
        </script>
    @endif
@endsection
