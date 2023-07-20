@extends('layouts.main_dashboard', ['title' => 'Profile', 'dbClass' => 'db photo-bank-sec'])
@section('content')
    <div class="bg-color-box">
        @if (session()->has('message'))
            <p class="alert alert-info">
                {{ session()->get('message') }}
            </p>
        @endif
        @if (session()->has('error'))
            <p class="alert alert-danger">
                {{ session()->get('error') }}
            </p>
        @endif
        <div class="form-main-box">
            <form method="POST" action="{{ route('scene.store') }}">
                @csrf
                <h5>Make a Scene</h5>
                <br>
                <div class="form-flex">
                    <div class="form-data">
                        <label>Title</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                            name="title" maxlength="60" id="title" value="{{ old('title') }}">
                            <span id="title-char-count">0/60 Character Limit</span>
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-flex">
                    <div class="form-data">
                        <label>Description</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description"
                            value="{{ old('description') }}"></textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="gallery-img-btn">
                    <button class="btn btn-primary" type="submit">
                        Save and Goto Art Board
                    </button>
                    
                </div>
            </form>
        </div>

    </div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    var titleInput = $("#title");
    var charCountSpan = $("#title-char-count");

    titleInput.on("input", function() {
        var charCount = titleInput.val().length;
        charCountSpan.text(charCount + "/60 Character Limit");

        if (charCount > 60) {
            titleInput.val(titleInput.val().slice(0, 60));
            charCountSpan.text("60/60 Character Limit");
        }
    });
});
</script>
@endsection