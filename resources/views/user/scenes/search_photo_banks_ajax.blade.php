@forelse ($photoBanks as $photoBank)
    @if ($photoBank->item)
        <a href="javascript:void(0)">
            <img id="photoBank_{{ $photoBank->item_id }}" draggable="true" ondragstart="startDrag(event)"
                src="{{ $photoBank->item->item_image?->thumb }}" alt="image" class="img-fluid canvas-img">
        </a>
    @endif
@empty
    <p>Item with this keyword doesnot exist</p>
@endforelse
