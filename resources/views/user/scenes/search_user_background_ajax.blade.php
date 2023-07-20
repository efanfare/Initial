@forelse($backgrounds as $background)
    @if ($background->service_type === 'User')
        @if (isset($background->background_image))
            <div class="position-relative container-item user-container d-flex justify-content-center align-items-center  {{ $backgroundId == $background->id ? 'selected-background' : '' }}"
                id="{{ $background->id }}">
                <img src="{{ $background->background_image->preview }}" title="{{ $background->title }}"
                    data-background-id="{{ $background->id }}" width="100px" alt="image" class="img-fluid" />
                @if ($backgroundId == $background->id)
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
                            onclick="showBackgroundDeleteConfirmation({{ $background->id }} ,this)" class="icon-trash"
                            title="Delete backgorund">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                @endif
            </div>
        @endif
    @endif
@empty
    <p>Background with this keyword doesnot exist</p>
@endforelse
