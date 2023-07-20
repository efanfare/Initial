<div class="uplaoded-background">
    <div class="image-view-text">
        <p>Photo Bank</p>
        <a href="{{ route('item.index') }}">See all</a>
    </div>
    <div class="empty-box scrollbar" id="style-3">
        @forelse ($photoBanks as $photoBank)
            <a href="javascript:void(0)">
                <img id="photoBank_{{ $photoBank->item_id }}" draggable="true" ondragstart="startDrag(event)"
                    src="{{ $photoBank->item->item_image?->thumb }}"alt="image" class="img-fluid canvas-img">
            </a>
        @empty
            <p>No item uploaded</p>
        @endforelse
    </div>
</div>

{{-- width="70px" --}}
