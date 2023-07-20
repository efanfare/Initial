<!-- SCENE LISTING MODAL BEGIN -->
<div class="modal fade" id="exampleModal-scene-listing-view" tabindex="-1" role="dialog"
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
                        <h4>{{ $gallery->title }}</h4>
                    </div>
                </div>
                <div class="row scene-gallery-row scrollbar" id="style-3">
                    @foreach ($gallery->scenes as $scene)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="select-box-img">
                                <div class="select-inner-img">
                                    <img src="{{ $scene->scene_canvas_image?->url ?? 'https://placehold.co/437x249/8e96c8/white?text=Scene%20Snapshot' }}"
                                        alt="image">
                                    <h6>{{ $scene->title }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
