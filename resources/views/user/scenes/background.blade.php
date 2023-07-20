<div class="image-selector">
    <div class="image-view-text">
        <p>Upload background</p>
        {{-- <a href="javascript:void(0)">See all</a> --}}
    </div>
    <div class="place-file-uploader">
        <form id="file-upload-form" class="uploader" onsubmit="return false;">
            <div class="row">
                <div class="cut remove-upload-file-background"></div>
                <input id="file-upload" type="file" name="fileUpload" accept="image/*" />
                <label for="file-upload" id="file-drag">
                    <img id="file-image" src="#" alt="Preview" class="hidden">
                    <div id="start">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        <div>Click here to upload background image</div>
                        <div id="notimage" class="hidden">Please select an image</div>
                        <span>Image type : jpeg and png</span>
                    </div>
                    <div id="response" class="hidden">
                        <div id="messages"></div>
                    </div>
                </label>
            </div>
            <div class="row">
                <div id="background-input-fields" style="display:none;">
                    <div class="row">
                        <span>Title</span>
                        <input type="text" name="title" id="background-upload-tile" class="form-control" />
                    </div>
                    <div class="row">
                        <div class="edit-profile-btn">
                            <a href="javascript:void(0)" id="upload-background" class="btn btn-secondary">Add
                                background</a>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
<div class="uplaoded-background">
    <div class="image-view-text">
        <p>Select your background</p>
        <a href="{{ route('item.index', ['bg_page' => 1]) }}">See all</a>
    </div>
    <div id="loader-background" class="d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="bg-container uploaded-flex user-background scrollbar" id="style-3">
        @forelse($backgrounds as $background)
            @if ($background->service_type === 'User')
                @if (isset($background->background_image))
                    <div class="position-relative user-container container-item d-flex justify-content-center align-items-center {{ $scene->backgorund_id == $background->id ? 'selected-background' : '' }}"
                        id="{{ $background->id }}">

                        <img src="{{ $background->background_image->preview }}" title="{{ $background->title }}"
                            data-background-id="{{ $background->id }}" width="100px" alt="image"
                            class="img-fluid" />

                        @if ($scene->backgorund_id === $background->id)
                            <i class="fa fa-check fa-lg position-absolute"></i>
                            <div class="overlay-item">
                            </div>
                        @else
                            <div class="overlay-item">
                                <a href="javascript:void(0)" onclick="selectBackground({{ $background->id }} ,this)"
                                    class="icon-plus" title="Select backgorund">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <a href="javascript:void(0)"
                                    onclick="showBackgroundDeleteConfirmation({{ $background->id }} ,this)"
                                    class="icon-trash" title="Delete backgorund">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        @endif

                    </div>
                @endif
            @endif
        @empty
            <p>No background was uploaded</p>
        @endforelse
    </div>
</div>
<div class="uplaoded-background">
    <div class="image-view-text">
        <p>Select system background</p>


    </div>
    <div id="loader-background" class="d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="bg-container uploaded-flex system-background scrollbar" id="style-3">
        @forelse($backgrounds as $background)
            @if ($background->service_type === 'System')
                @if (isset($background->background_image))
                    <div class="position-relative container-item d-flex justify-content-center align-items-center  {{ $scene->backgorund_id === $background->id ? 'selected-background' : '' }} "
                        id="{{ $background->id }}">
                        <img src="{{ $background->background_image->preview }}" title="{{ $background->title }}"
                            data-background-id="{{ $background->id }}" width="100px" alt="image" class="img-fluid">

                        @if ($scene->backgorund_id === $background->id)
                            <i class="fa fa-check fa-lg position-absolute"></i>
                            <div class="overlay-item">
                            </div>
                        @else
                            <div class="overlay-item">
                                <a href="javascript:void(0)" onclick="selectBackground({{ $background->id }} ,this)"
                                    class="icon-plus" title="Select backgorund">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        @endif

                    </div>
                @endif
            @endif
        @empty
            <p>No System background was uploaded</p>
        @endforelse
    </div>
</div>
<div class="uplaoded-background d-none">
    <div class="image-view-text">
        <p>Premium backgrounds</p>
        <a href="javascript:void(0)">See all</a>
    </div>
    <div class="uploaded-flex">
        <div class="crown-div">
            <a href="javascript:void(0)"><img src="{{ asset('images/uploaded9.png') }}"alt="image"
                    class="img-fluid"></a>
            <div class="crown-img">
                <span><img src="{{ asset('images/crown.png') }}"alt="image" class="img-fluid"> </span>
            </div>
        </div>
        <div class="crown-div">
            <a href="javascript:void(0)"><img src="{{ asset('images/uploaded10.png') }}"alt="image"
                    class="img-fluid"></a>
            <div class="crown-img">
                <span><img src="{{ asset('images/crown.png') }}"alt="image" class="img-fluid"> </span>
            </div>
        </div>
        <div class="crown-div">
            <a href="javascript:void(0)"><img src="{{ asset('images/uploaded11.png') }}"alt="image"
                    class="img-fluid"></a>
            <div class="crown-img">
                <span><img src="{{ asset('images/crown.png') }}"alt="image" class="img-fluid"> </span>
            </div>
        </div>
        <div class="crown-div">
            <a href="javascript:void(0)"><img src="{{ asset('images/uploaded12.png') }}"alt="image"
                    class="img-fluid"></a>
            <div class="crown-img">
                <span><img src="{{ asset('images/crown.png') }}"alt="image" class="img-fluid"> </span>
            </div>
        </div>
    </div>
</div>
