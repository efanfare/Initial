<div class="position-relative user-container container-item d-flex justify-content-center align-items-center"
    id="{{ $background->id }}">
    <img src="{{ $background->background_image->preview }}" title="{{ $background->title }}"
        data-background-id="{{ $background->id }}" width="100px" alt="image" class="img-fluid" />
    <div class="overlay-item">
        <a href="javascript:void(0)" onclick="selectBackground({{ $background->id }} ,this)" class="icon-plus"
            title="Select backgorund">
            <i class="fa fa-plus"></i>
        </a>
        <a href="javascript:void(0)" onclick="showBackgroundDeleteConfirmation({{ $background->id }} ,this)" class="icon-trash"
            title="Delete backgorund">
            <i class="fa fa-trash"></i>
        </a>
    </div>
</div>
