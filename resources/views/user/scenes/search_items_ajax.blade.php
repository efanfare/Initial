@forelse ($items as $item)
    @if (isset($item->item_image))
        <div class="container-item" id="item_{{ $item->id }}">
            <img src="{{ $item->item_image?->thumb }}" alt="image" class="img-fluid image" title="{{ $item->title }}">
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
    <p>Item with this keyword doesnot exist</p>
@endforelse
