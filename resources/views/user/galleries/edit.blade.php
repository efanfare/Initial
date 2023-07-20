@extends('layouts.main_dashboard', ['title' => 'Gallery Collection', 'dbClass' => 'db photo-bank-sec'])
@section('styles')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.css" />
    <style>
        .multiselect-img {
            width: 50px;
        }
    </style>
@endsection
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
            <form method="POST" action="{{ route('gallery.update', $gallery->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5>Edit a Gallery Collection</h5>
                <br>
                <div class="form-flex">
                    <div class="form-data">
                        <label>Collection Title</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                            name="title" id="title" value="{{ old('title', $gallery->title) }}">
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-flex">
                    <div class="form-data">
                        <label>Cover Photo</label>
                        <input type="file" name="cover_photo"
                            class="form-control {{ $errors->has('cover_photo') ? 'is-invalid' : '' }}" />
                        @if ($errors->has('cover_photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('cover_photo') }}
                            </div>
                        @endif
                    </div>
                    <img width=""
                        src="{{ $gallery->cover_photo?->preview ?? 'https://placehold.co/437x249/8e96c8/white?text=Cover%20Photo' }}"
                        alt="image" class="img-div">
                </div>
                <div class="form-flex">
                    <div class="form-data">
                        <label for="scene-dropdown">Select Scenes:</label>
                        <select multiple='multiple' class="form-control {{ $errors->has('scenes') ? 'is-invalid' : '' }}"
                            id="scene-dropdown" name="scenes[]">
                            @foreach ($scenes as $scene)
                                @php $isSelected = $gallery->scenes->contains($scene->id) @endphp
                                <option value="{{ $scene->id }}"
                                    data-img-src="{{ $scene->background->background_image?->preview ?? 'https://placehold.co/437x249/8e96c8/white?text=Background%20Picture' }}"
                                    @if ($isSelected) selected @endif>
                                    {{ $scene->title }}
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('scenes'))
                            <div class="invalid-feedback">
                                {{ $errors->first('scenes') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="edit-profile-btn">
                    <button class="btn btn-primary" type="submit">
                        Save
                    </button>

                </div>
            </form>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js">
    </script>


    <script>
        $(document).ready(function() {
            $('#scene-dropdown').multiselect({
                enableHTML: true,
                includeSelectAllOption: true,
                buttonClass: 'btn btn-default',
                buttonWidth: 'auto',
                maxHeight: 200,
                optionLabel: function(element) {
                    var thumbnail = $(element).data('img-src');
                    var text = $(element).text();
                    return '<span><img class="multiselect-img" src="' + thumbnail + '"> ' + text +
                        '</span>';
                },
                enableFiltering: true, // Enable filtering
                enableCaseInsensitiveFiltering: true, // Enable case-insensitive filtering
                filterPlaceholder: 'Search', // Set the filter placeholder text
                enableClearAll: true,
                clearAllText: 'Clear',
                enableFullValueFiltering: true,
                filterBehavior: 'text',
                includeFilterClearBtn: true,
                includeResetOption: true,
                resetText: 'Reset',
                templates: {
                    filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input id="multiselect-filter" class="form-control multiselect-search" type="text"></div></li>',
                    filterClearBtn: '',
                    noResults: '<li class="multiselect-item"><a href="#">No results found</a></li>'
                },

                onFiltering: function() {
                    var filterText = $('#multiselect-filter').val().toString(); // Convert to string
                    var query = filterText.trim();

                    // Check if the input is empty, and if so, reset the dropdown to its original options
                    if (query === '') {
                        $('#scene-dropdown').multiselect('dataprovider', originalOptions);
                        return;
                    }

                    var options = [];
                    $('#scene-dropdown option').each(function() {
                        var optionText = $(this).text().toLowerCase();
                        if (optionText.indexOf(query.toLowerCase()) !== -1) {
                            options.push({
                                label: optionText,
                                value: $(this).val()
                            });
                        }
                    });

                    // Update the dropdown with the filtered options
                    $('#scene-dropdown').multiselect('dataprovider', options);

                    // Set the value of the search box again
                    $('#multiselect-filter').val(filterText);

                    // Show "No results found" message
                    if (options.length === 0) {
                        $('.multiselect-container li.no-results-found').show();
                    } else {
                        $('.multiselect-container li.no-results-found').hide();
                    }

                    // Always show the filter box, even if no results are found
                    $('.multiselect-container li.filter input').show();
                },

                onChange: function(option, checked) {
                    if (!checked) {
                        return;
                    }
                    var undoClearButton = $('#scene-dropdown').siblings('.btn-group').find(
                        '.multiselect-undo-clear');
                    if (undoClearButton.length) {
                        undoClearButton.remove(); // Remove existing undo clear button if there is one
                    }
                    $('<button class="multiselect-undo-clear btn btn-link">Undo clear</button>')
                        .insertAfter('#scene-dropdown');
                },

            });

            // Find the reset button and change its type to "button"
            $('#scene-dropdown').siblings('.btn-group').find('.multiselect-reset').attr('type', 'button');

            // Undo clear functionality
            $(document).on('click', '.multiselect-undo-clear', function() {
                var values = $('#scene-dropdown').val() || [];
                $('#scene-dropdown').multiselect('select', values);
                $(this).remove();
            });
        });
    </script>
@endsection
