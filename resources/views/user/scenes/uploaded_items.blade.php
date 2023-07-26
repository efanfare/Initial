<div class="image-selector">
    <div class="image-view-text">
        <p>Upload Item</p>
    </div>
    <div class="place-file-uploader">
        <form id="file-upload-form-item" class="uploader">
            <div class="row">
                <div class="cut remove-upload-file-item"></div>
                <input id="file-upload-item" type="file" name="fileUpload" accept="image/*" />
                <label for="file-upload-item" id="file-drag-item">
                    <img id="file-image-item" src="#" alt="Preview" class="hidden">
                    <div id="start-item">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        <div>Click here to upload image</div>
                        <div id="notimage-item" class="hidden">Please select an image</div>
                        <span> Image type : jpeg and png</span>
                    </div>
                    <div id="response-item" class="hidden">
                        <div id="messages-item"></div>
                    </div>
                </label>
            </div>
            <div id="item-input-fields" style="display:none;">
                <div class="row">
                    <span>Item Title</span>
                    <input type="text" name="title" id="item-upload-tile" class="form-control" />
                </div>
                <div class="row">
                    <span>Item Keywords</span>
                    <input type="text" name="tags[]" id="item-upload-tags" class="form-control"
                        data-role="tagsinput" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="add-tag-btn">Add keyword</button>
                    </div>
                </div>
                <div class="row">
                    <div class="edit-profile-btn">
                        <a href="javascript:void(0)" id="upload-items" class="btn btn-secondary">Add Item</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- <p class="no-file-item">No item upload</p> --}}
</div>
<div class="uplaoded-background">

    <div class="image-view-text  @if ($items->count() <= 0) d-none @endif">
        <p>Uploaded Items</p>
        <a href="{{ route('item.index') }}">See all</a>

    </div>
    <div id="loader" class="d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="uploaded-flex scrollbar" id="style-3">

        @forelse ($items as $item)
            @if (isset($item->item_image))
                <div class="container-item" id="item_{{ $item->id }}">
                    <img src="{{ $item->item_image?->thumb }}" alt="image" class="img-fluid image"
                        title="{{ $item->title }}">
                    <div class="overlay-item">
                        <a href="javascript:void(0)" onclick="addPhotoBank({{ $item->id }})" class="icon-plus"
                            title="Add Photo Bank">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="showItemDeleteConfirmation({{ $item->id }})"
                            class="icon-trash" title="Delete Item">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endif
        @empty
            <p>No item uploaded</p>
        @endforelse
    </div>
</div>
