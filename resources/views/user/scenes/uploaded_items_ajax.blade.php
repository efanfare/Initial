<div class="container-item" id="item_{{ $item->id }}">
    <img src="{{ $item->item_image?->thumb }}" alt="image" class="img-fluid image">
    <div class="overlay-item">
        <a href="javascript:void(0)" onclick="addPhotoBank({{ $item->id }})" class="icon-plus" title="Add Photo Bank">
            <i class="fa fa-plus"></i>
        </a>
        <a href="javascript:void(0)" onclick="showItemDeleteConfirmation({{ $item->id }})" class="icon-trash"
            title="Delete Item">
            <i class="fa fa-trash"></i>
        </a>
    </div>
</div>
