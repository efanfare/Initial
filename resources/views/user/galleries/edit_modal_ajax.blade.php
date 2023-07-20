<!-- SCENE LISTING MODAL BEGIN -->
<div class="modal fade" id="exampleModal-scene-listing-edit" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="scene-modal-content">
                    <div class="scene-modal-heading">
                        <h4>Edit Gallery Collection</h4>
                        <p id="scene-edit-error-message" class="d-none" style="color:red">The one scene selected is
                            mandatory. </p>
                    </div>
                    <div class="scene-input-box">
                        <div class="scene-error-msg">
                            <input type="text" name="title" id="edit-gallery-title"
                                value="{{ old('title', $gallery->title) }}" class="form-control">
                        </div>
                        <button type="button" class="btn btn-primary" id="scene-modal-func" data-toggle="modal"
                            data-target="#exampleModal-confirm-listing-edit">Update Collection</button>
                    </div>
                </div>
                <div class="row scene-gallery-row scrollbar" id="style-3">
                    @foreach ($scenes as $scene)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="select-box-img">
                                <div class="select-inner-img">
                                    <img src="{{ $scene->scene_canvas_image?->url ?? 'https://placehold.co/800x700/8e96c8/white?text=Scene%20Snapshot' }}"
                                        alt="image">
                                    <div class="select-inner-overlay"></div>
                                    <div class="select-inner-checkbox">
                                        <label class="checkbox">
                                            @php $isSelected = $gallery->scenes->contains($scene->id) @endphp
                                            <input type="checkbox" id="edit-scenes-input" name="scenes[]"
                                                class="checkbox__input scene-checkbox edit-scenes-input"
                                                value="{{ $scene->id }}"
                                                @if (in_array($scene->id, old('scenes', []))) checked @endif
                                                @if ($isSelected) checked @endif />
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

<!-- CONFIRM SCENE MODAL BEGIN -->
<div class="modal logout-modal fade" id="exampleModal-confirm-listing-edit" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="images/scene-sub.png" alt="image" class="img-fluid">
                <h6>Are you sure you want to <span>update gallery collection</span></h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="update-gallery-button btn btn-primary"
                    data-id="{{ $gallery->id }}">Yes</button>
            </div>
        </div>
    </div>
</div>
