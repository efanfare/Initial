@extends('layouts.scene_art', ['title' => 'Art Board'])
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white !important;
            background-color: #0d6efd;
            padding: 0.2rem;
        }
    </style>
    <style>
        .container-item {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        .image {
            display: block;
            width: 100%;
            height: auto;
        }

        .overlay-item {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .3s ease;
            background-color: #00000085;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .container-item:hover .overlay-item {
            opacity: 0.8;
        }

        .icon-plus {
            color: black;
            font-size: 26px;
            position: absolute;
            top: 20%;
            left: 63%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .icon-trash {
            color: black;
            font-size: 28px;
            position: absolute;
            top: 20%;
            left: 88%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .fa-plus:hover {
            color: red;
        }

        .selected-background {
            opacity: 0.5;
            /* background-color: red; */
        }

        .fa-check {
            color: #fff !important;
            font-size: 20px;
        }

        .remove-upload-file-background {
            position: relative;
        }

        .remove-upload-file-background i {
            position: absolute;
            top: 23px;
            right: 14px;
            z-index: 999;
        }

        .remove-upload-file-item {
            position: relative;
        }

        .remove-upload-file-item i {
            position: absolute;
            top: 23px;
            right: 14px;
            z-index: 999;
        }

        #thread-file-preview {
            position: relative;
        }

        #thread-file-preview i {
            position: absolute;
            top: 0px;
            right: 0px;
            z-index: 999;
        }
    </style>
@endsection

@section('content')
    <div class="main-fixed-div editor-screen">
        <span class="oc-toggle oc-left">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>

        <div class="toast-container top-0 end-0 p-3">
            <!-- Toasts will be appended here -->
        </div>

        <nav class="oc-nav oc-left">
            <div class="left-corner-tab">
                <ul class="nav nav-tabs" role="tablist">
                    @if (auth()->user()->id === $scene->user_id)
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"><img
                                    src="{{ asset('images/bk1.png') }}"alt="image" class="img-fluid"> Backgrounds</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ auth()->user()->id !== $scene->user_id ? 'active' : '' }}" data-toggle="tab"
                            href="#tabs-2" role="tab"><img src="{{ asset('images/bk2.png') }}"alt="image"
                                class="img-fluid"> Items</a>
                    </li>
                    @if (auth()->user()->id === $scene->user_id)
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"><img
                                    src="{{ asset('images/bk3.png') }}"alt="image" class="img-fluid"> Text</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="left-toggle-content scrollbar" id="style-3">
                <div class="tab-content">
                    @if (auth()->user()->id === $scene->user_id)
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="main-search-bar">
                                <input type="search" placeholder="Search background" class="form-control"
                                    id="search-background">
                                <div class="main-search-icon">
                                    <a href="javascript:void(0)" id="search-background-search"><i class="fa fa-search"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div id="uploaded-background-area">
                                @include('user.scenes.background')
                            </div>
                        </div>
                    @endif
                    <div class="tab-pane {{ auth()->user()->id !== $scene->user_id ? 'active' : '' }}" id="tabs-2"
                        role="tabpanel">
                        <div class="main-search-bar">
                            <input type="search" placeholder="Search item" class="form-control" id="search-item">
                            <div class="main-search-icon">
                                <a href="javascript:void(0)" id="search-item-search"><i class="fa fa-search"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>


                        <div id="uploaded-item-area">
                            @include('user.scenes.uploaded_items')
                        </div>
                        <div id="photo-bank-area">
                            @include('user.scenes.photobank')
                        </div>
                        @include('user.scenes.avatar')
                    </div>
                    @if (auth()->user()->id === $scene->user_id)
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <textarea rows="7" class="form-control" id="add-text-value">Your Text Here</textarea>
                            <div class="form-group form-data">
                                <label for="text-color">Color:</label>
                                <input type="color" class="form-control" id="text-color">
                            </div>
                            <div class="form-group form-data">
                                <label for="font-size">Font Size:</label>
                                <select class="form-control" id="font-size">
                                    <option value="12">12</option>
                                    <option value="16">16</option>
                                    <option value="20">20</option>
                                    <option value="24">24</option>
                                    <!-- Add more font size options here -->
                                </select>
                            </div>
                            <div class="form-group form-data">
                                <label for="font-family">Font Family:</label>
                                <select class="form-control" id="font-family">
                                    <option value="Arial">Arial</option>
                                    <option value="Verdana">Verdana</option>
                                    <option value="Helvetica">Helvetica</option>
                                    <!-- Add more font options here -->
                                </select>
                            </div>
                            <button class="btn btn-primary" id="add-text-btn">ADD TEXT</button>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        <div class="container ad-bnner-sec">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="oc-wrap">
                        <div class="gf-main-img editor-pos-images">

                            {{-- <img src="https://placehold.co/800x700/8e96c8/white?text=Add%20Background"alt="image" class="canva-img"> --}}
                            <div id="canvasContainer" class="canva-img" ondragover="dragOver(event)"
                                ondrop="dropItem(event)">
                                <div class="loadingio-spinner-rolling-0tr3gdvvgq7">
                                    <div class="ldio-y1o0zpyoiar">
                                        <div></div>
                                    </div>
                                </div>

                                <canvas id="scene" class="" style=""></canvas>
                            </div>


                            <!-- <div class="close-screen-icon">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a href="javascript:void(0)"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->
                        </div>

                        <div class="chat-overflow-dropdown">

                            <div class="chat-icon-img">
                                <a href="javascript:void(0)"><img
                                        src="{{ asset('images/chat-icon-img.png') }}"alt="image" class="img-fluid">
                                </a>
                                <div class="tooltip-msg">
                                    <span>Edit Title</span>
                                    <div class="tooltip-des">
                                        <img src="{{ asset('images/icon-tip.png') }}"alt="image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <div class="close-function">
                                    <input type="text" id="title" name="" placeholder="Title"
                                        maxlength="60" class="form-control"
                                        @if (auth()->user()->id !== $scene->user_id) readonly @endif value="{{ $scene->title }}">
                                    <div class="close-screen-icon close-icon">
                                        <a href="javascript:void(0)"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <textarea cols="4" rows="4" id="description" class="form-control" placeholder="Description"
                                    @if (auth()->user()->id !== $scene->user_id) readonly @endif>{{ $scene->description }}</textarea>
                            </div>
                        </div>

                    </div>

                    @if (request()->user()->package_id === 1)
                        {{-- TODO:Remove this container when site will lived and add will be showed by google ads --}}
                        <div class="ad-container-scene">
                            <img src="https://placehold.co/1200x120/?text=Ad%20goes%20here" alt=""
                                class="img-fluid">
                            <span class="ad-cut-icon-scene" onclick="removeAd()">&#10005;</span>
                        </div>

                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3193209969219776"
                            crossorigin="anonymous"></script>
                    @endif
                </div>
            </div>

        </div>


    </div>
    <span class="oc-toggle-right oc-right">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
    </span>
    <nav class="oc-nav-right oc-right scrollbar" id="style-3">
        {{-- Ajax html --}}
    </nav>

    </div>

    <input type="hidden" id="background-id" value="{{ isset($scene->backgorund_id) ? $scene->backgorund_id : null }}" />
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>


    <script>
        var userId = '{{ auth()->user()->id }}';
        var sceneCreatedUserId = '{{ $scene->user_id }}';
        var sceneId = '{{ $scene->id }}';
        var saveTimeout;
        var canvas;

        function deleteObject(eventData, transform) {
            var target = transform.target;
            var canvas = target.canvas;
            canvas.remove(target);
            canvas.requestRenderAll();
            saveCanvas();
        }
        var deleteIcon =
            "data:image/svg+xml,%3C%3Fxml version='1.0' encoding='utf-8'%3F%3E%3C!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'%3E%3Csvg version='1.1' id='Ebene_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='595.275px' height='595.275px' viewBox='200 215 230 470' xml:space='preserve'%3E%3Ccircle style='fill:%23E86759;' cx='299.76' cy='439.067' r='218.516'/%3E%3Cg%3E%3Crect x='267.162' y='307.978' transform='matrix(0.7071 -0.7071 0.7071 0.7071 -222.6202 340.6915)' style='fill:white;' width='65.545' height='262.18'/%3E%3Crect x='266.988' y='308.153' transform='matrix(0.7071 0.7071 -0.7071 0.7071 398.3889 -83.3116)' style='fill:white;' width='65.544' height='262.179'/%3E%3C/g%3E%3C/svg%3E";
        var imgDel = document.createElement("img");
        imgDel.src = deleteIcon;

        function renderIcon(ctx, left, top, styleOverride, fabricObject) {
            if (fabricObject.type === 'text' && userId === sceneCreatedUserId) { // Check if the object type is text
                var size = this.cornerSize;
                ctx.save();
                ctx.translate(left, top);
                ctx.rotate(fabric.util.degreesToRadians(fabricObject.angle));
                ctx.drawImage(imgDel, -size / 2, -size / 2, size, size);
                ctx.restore();
            }
        }

        fabric.Object.prototype.controls.deleteControl = new fabric.Control({
            x: 0.5,
            y: -0.5,
            offsetY: 16,
            cursorStyle: "pointer",
            mouseUpHandler: deleteObject,
            render: renderIcon,
            cornerSize: 24,
        });

        canvas = new fabric.Canvas("scene", {
            // preserveObjectStacking: true,
            // containerClass: "canva-img",
        });

        function showBorder(object) {
            object.set({
                stroke: 'green', // Set the border color
                strokeWidth: 2, // Set the border width

            });
            canvas.renderAll(); // Render the canvas to apply the changes
        }

        function hideBorder(object) {
            object.set({
                stroke: null, // Remove the border color
                strokeWidth: 0, // Remove the border width
            });
        }

        function showObject(object, userId) {
            canvas.forEachObject(function(object) {
                if (object.userId === userId && object.type !== "text") {
                    showBorder(object);
                } else {
                    hideBorder(object);
                }
            });
            canvas.renderAll();
        }

        canvas.selection = false; //Disable group functionality
        // Listen for object:added and object:modified events on the canvas
        canvas.on('object:added', saveCanvas);
        canvas.on('object:modified', saveCanvas);


        fabric.Object.prototype.transparentCorners = false;
        fabric.Object.prototype.cornerColor = "blue";
        fabric.Object.prototype.cornerStyle = "circle";

        canvas.setWidth(800);
        canvas.setHeight(700);
        var previousCanvasJson = {!! $scene->canvas_json !!};
        if (previousCanvasJson) {
            var tmp = JSON.stringify(previousCanvasJson);

            canvas.loadFromJSON(tmp, function(objects, options) {
                canvas.requestRenderAll();
                canvas.forEachObject(function(object) {
                    if (object.type !== 'text') {
                        object.set({
                            hasControls: false
                        });
                    }

                    showObject(object, userId);

                    if (object.userId !== userId && sceneCreatedUserId !== userId) {
                        object.set({
                            selectable: false
                        });
                    }
                });

            });
        }
        canvas.on('after:render', function() {
            $('.loadingio-spinner-rolling-0tr3gdvvgq7').hide();
        });

        function selectBackground(backgroundId, element) {

            var parentDiv = $(element).closest('.container-item');
            var imageURL = parentDiv.find('img').attr("src");

            // var backgroundId = $(element).find().attr("data-background-id");
            $("#background-id").val(backgroundId);
            $('.fa-check').remove();

            var previousSelected = $('.bg-container').children('.selected-background');
            var previousSelectedBackgroundId = previousSelected.attr("id");
            previousSelected.removeClass('selected-background');

            var htmlSelectCode = '<a href="javascript:void(0)" onclick="selectBackground(' + backgroundId +
                ', this)" class="icon-plus" title="Select backgorund"><i class="fa fa-plus"></i></a>';
            var htmlDeleteCode = '<a href="javascript:void(0)" onclick="showBackgroundDeleteConfirmation(' +
                backgroundId +
                ', this)" class="icon-trash" title="Delete background"><i class="fa fa-trash"></i></a>';

            parentDiv.find('i').remove();

            previousSelected.find('.overlay-item').append(htmlSelectCode);

            if (previousSelected.closest('.user-background').length == 1) {
                previousSelected.find('.overlay-item').append(htmlDeleteCode);
            }
            // previousSelected.find('img').after(deleteIconHtml);
            parentDiv.addClass('selected-background');
            parentDiv.find('.overlay-item').html('');



            var selectIconHtml = '<i class="fa fa-check fa-lg position-absolute"></i>';


            parentDiv.find('.overlay-item').after(selectIconHtml);


            fabric.Image.fromURL(imageURL, function(img, isError) {
                img.set({
                    originX: "left",
                    originY: "top",
                    scaleX: canvas.getWidth() / img.width, //new update
                    scaleY: canvas.getHeight() / img.height, //new update
                });

                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
                // Add a mouseover event listener to the canvas
                canvas.on('mouseover', function() {
                    // Disable the background image when mouse is over the canvas
                    canvas.backgroundImage = null;
                    canvas.renderAll();
                });
                // Save the canvas state after adding the background image
                saveCanvas();
            });

        };

        var tooltip;
        var tooltipClicked;
        var tooltipHidden;

        canvas.on('mouse:over', function(event) {

            if (event.target && event.target.type === 'image') {
                if (event.target && event.target !== tooltip) {


                    var rectCoords = event.target.getBoundingRect();

                    // Get the width of the object
                    var objectWidth = rectCoords.width;
                    if (document.contains(tooltip)) {
                        document.body.removeChild(tooltip);
                        // return;
                    }

                    var object = event.target;
                    var mouse = canvas.getPointer(event.e);

                    var id = event.target._element.id ? event.target._element.id : event.target.id;
                    var userId = event.target.userId;
                    var uuid = event.target.uuid;
                    var date = event.target.date;
                    var isDeleted = event.target.isDeleted;
                    var userDetail = getUserProfileDetail(userId, date);

                    tooltip = document.createElement('div');
                    var img1 = userDetail.profile;
                    var img2 = '{{ asset('/images/angle-down-shape.png') }}';
                    var authUserId = '{{ auth()->user()->id }}';
                    liDeleteHtml = '';
                    liResizeRotateHtml = '';
                    if (userId == authUserId || sceneCreatedUserId == authUserId) {
                        var liDeleteHtml = '<li ><a href="#" data-uuid-id="' + uuid +
                            '" id="delete-object"><i id="delete-object" data-uuid-id="' + uuid +
                            '" class="fa fa-trash" aria-hidden="true"></i></a></li>';
                        var liResizeRotateHtml =
                            '<li><a href="javascript:void(0)"><i id="rotateBtn" data-uuid-id="' + uuid +
                            '" class="fa fa-arrows" aria-hidden="true"></i></a></li>' +
                            '<li><a href="javascript:void(0)"><i id="resizeBtn" data-uuid-id="' + uuid +
                            '" class="fa fa-expand" aria-hidden="true"></i></a></li>';
                    }



                    tooltip.innerHTML =
                        '<div class="editor-items">' +
                        '</button><div class="icon-hover-box"><div class="icon-hover-img">' +
                        img1 +
                        '</div><div class="icon-hover-text"><p>' + userDetail.name +
                        '</p><span>' + userDetail.date +
                        '</span></div><i id="hideBtn" class="fa fa-times-circle fa-lg" style="color:red" aria-hidden="true"></i></div>' +
                        '<ul>' + liResizeRotateHtml +
                        // '<li><a href="#"><span id="thread" data-scene-id="' +
                        // sceneId + '" data-user-id="' +
                        // userId + '" data-uuid-id="' + uuid + '" data-item-id="' + id +
                        // '">1</span></a></li>' +
                        liDeleteHtml +
                        '</ul>' +
                        '<div class="angle-pos"><img src="' + img2 +
                        '" alt="image" class="img-fluid"> </div></div>';

                    tooltip.style.position = 'absolute';
                    // Get the position of the canvas on the page
                    var canvasRect = canvas.getElement().getBoundingClientRect();
                    var canvasLeft = canvasRect.left + window.pageXOffset;
                    var canvasTop = canvasRect.top + window.pageYOffset;

                    setTimeout(function() {
                        // Get the width of the tooltip
                        var tooltipWidth = tooltip.offsetWidth;
                        // Calculate the left position for centering the tooltip
                        var leftPosition = canvasLeft + rectCoords.left + (objectWidth / 2) - (
                            tooltipWidth / 2) + 42;
                        // Calculate the top position for the tooltip
                        var topPosition = canvasTop + rectCoords.top - 190;

                        tooltip.style.left = leftPosition + 'px';
                        tooltip.style.top = topPosition + 'px';
                        tooltip.style.opacity = '1';
                    }, 50); // Small delay to allow the tooltip element to fully render

                    document.body.appendChild(tooltip);
                    // Fade in the tooltip
                    // tooltip.style.opacity = '1';

                    // Set a flag to indicate that the tooltip button was clicked
                    var tooltipClicked = false;


                    $.ajax({
                        type: 'GET',
                        url: '{{ route('scene.ajax.item.thread') }}',
                        data: {
                            uuid: uuid,
                            itemId: id,
                            sceneId: sceneId,
                            userId: userId,
                            date: date,
                            isDeleted: isDeleted
                        },
                        success: function(response) {
                            // Handle response
                            console.log(response.message);
                            // Render HTML content
                            $('.oc-nav-right').html('');
                            $('.oc-nav-right').append(response.html);
                            $('.oc-right').addClass('--is-active');
                            $('.oc-wrap').addClass('o-ri');
                            $('.oc-wrap').addClass('--is-active');
                            $('.oc-wrap').removeClass('l-ri');
                            $('.invite-people').addClass('o-ri2 --is-active');
                            $('.mainbar-back-link').removeClass('l-ri2 --is-active');
                            $('.oc-nav.oc-left.--is-active').removeClass('--is-active');
                            $('.oc-toggle.oc-left.--is-active').removeClass('--is-active');
                            // if (!$('.oc-toggle.oc-left.--is-active').length && !$(
                            //         '.oc-toggle-right.oc-right.--is-active').length) {
                            //     $('.oc-wrap.oc-left.--is-active').removeClass('--is-active');
                            //     $('.oc-wrap').removeClass('o-ri');
                            //     $('.invite-people').removeClass('o-ri2 --is-active');
                            // }
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error(error);
                        }
                    });


                    // Add a click event listener to the tooltip button
                    tooltip.addEventListener('click', function(event) {
                        // Check if the clicked element is the hide button
                        if (event.target.id === 'hideBtn') {
                            // Set the flag to true when the tooltip button is clicked
                            tooltipClicked = true;
                            // Hide the tooltip
                            tooltip.style.opacity = '0';
                            // Set the tooltipHidden flag to true
                            tooltipHidden = true;
                            setTimeout(function() {
                                if (document.contains(
                                        tooltip
                                    )) { // Check if tooltip is still present in the DOM
                                    document.body.removeChild(tooltip);
                                }
                            }, 300); // 0.3 seconds transition duration
                        }

                        if (event.target.id === 'delete-object') {
                            var uuid = event.target.dataset.uuidId;

                            var threadExistsInDb = false;

                            $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                url: '{{ route('scene.ajax.item.thread.exists') }}',
                                data: {
                                    uuid: uuid
                                },
                                success: function(response) {
                                    threadExistsInDb = response.status;
                                    if (threadExistsInDb) {
                                        const objects = canvas.getObjects();
                                        for (let i = 0; i < objects.length; i++) {
                                            if (objects[i] && objects[i].uuid === uuid &&
                                                objects[i].type === "image") {
                                                objects[i].isDeleted = true;
                                                objects[i].setSrc(
                                                    '{{ url('images/bin-img.png') }}',
                                                    function() {
                                                        canvas.requestRenderAll();
                                                    });

                                                break;
                                            }
                                        }
                                    } else {
                                        $('.oc-nav-right').html('');
                                        $('.oc-nav-right').append(response.html);
                                        $('.oc-right').removeClass('--is-active');
                                        $('.mainbar-back-link').removeClass(
                                            'l-ri2 --is-active');
                                        $('.invite-people').removeClass('o-ri2 --is-active');
                                        canvas.remove(object)
                                    }
                                    saveCanvas();
                                }
                            });



                            if (document.contains(
                                    tooltip
                                )) { // Check if tooltip is still present in the DOM
                                document.body.removeChild(tooltip);
                            }
                            canvas.requestRenderAll();

                        }

                        if (event.target.id === 'thread') {
                            var uuid = event.target.dataset.uuidId;
                            var itemId = event.target.dataset.itemId;

                            $.ajax({
                                type: 'GET',
                                url: '{{ route('scene.ajax.item.thread') }}',
                                data: {
                                    uuid: uuid,
                                    itemId: itemId,
                                    sceneId: sceneId,
                                    userId: userId,
                                    date: date,
                                    isDeleted: isDeleted
                                },
                                success: function(response) {
                                    // Handle response
                                    console.log(response.message);
                                    // Render HTML content
                                    $('.oc-nav-right').html('');
                                    $('.oc-nav-right').append(response.html);
                                    $('.oc-right').addClass('--is-active')
                                },
                                error: function(xhr, status, error) {
                                    // Handle error
                                    console.error(error);
                                }
                            });


                        }

                        tooltipClicked = true;
                    });
                    var resizeBtn = document.querySelector('#resizeBtn');
                    if (resizeBtn) {
                        resizeBtn.addEventListener('click', function(event) {
                            // Handle resize functionality
                            var object = event.target;
                            var objectId = object.id;
                            var uuid = event.target.dataset.uuidId;

                            var canvasObject = null;
                            var objects = canvas.getObjects();
                            for (var i = 0; i < objects.length; i++) {
                                if (objects[i].uuid === uuid) {
                                    canvasObject = objects[i];
                                    break;
                                }
                            }

                            if (canvasObject) {
                                canvasObject.hasControls = true;
                                canvasObject.lockRotation = true; // Disable rotation

                                canvasObject.setControlsVisibility({
                                    mtr: false,
                                    mt: true, // Top middle
                                    mb: true, // Bottom middle
                                    ml: true, // Left middle
                                    mr: true, // Right middle
                                    bl: true, // Bottom left
                                    br: true, // Bottom right
                                    tl: true, // Top left
                                    tr: true // Top right
                                });
                                // Set the active object to the selected object
                                canvas.setActiveObject(canvasObject);

                                // Call the bringToFront method to ensure the object is in front of other objects (optional)
                                canvas.bringToFront(canvasObject);
                                // Render the canvas to show the resizing controls
                                canvas.requestRenderAll();
                            }

                        });

                    }

                    var rotateBtn = document.querySelector('#rotateBtn');
                    if (rotateBtn) {
                        rotateBtn.addEventListener('click', function(event) {

                            // Handle resize functionality
                            var object = event.target;
                            var objectId = object.id;
                            var uuid = event.target.dataset.uuidId;

                            var canvasObject = null;
                            var objects = canvas.getObjects();
                            for (var i = 0; i < objects.length; i++) {
                                if (objects[i].uuid === uuid) {
                                    canvasObject = objects[i];
                                    break;
                                }
                            }

                            if (canvasObject) {
                                canvasObject.hasControls = true;
                                canvasObject.lockRotation = false; // Disable rotation
                                canvasObject.lockScalingRotate = true;

                                canvasObject.setControlsVisibility({
                                    mtr: true,
                                    mt: false, // Top middle
                                    mb: false, // Bottom middle
                                    ml: false, // Left middle
                                    mr: false, // Right middle
                                    bl: false, // Bottom left
                                    br: false, // Bottom right
                                    tl: false, // Top left
                                    tr: false // Top right
                                });

                                // Set the active object to the selected object
                                canvas.setActiveObject(canvasObject);

                                // Call the bringToFront method to ensure the object is in front of other objects (optional)
                                canvas.bringToFront(canvasObject);

                                // Render the canvas to show the resizing controls
                                canvas.requestRenderAll();
                            }

                        });
                    }

                    // Rest of the code...

                    // Add a click event listener to the tooltip button
                    tooltip.addEventListener('click', function() {
                        // Set the flag to true when the tooltip button is clicked
                        tooltipClicked = true;
                    });


                }
            }
        });



        canvas.on('mouse:out', function(event) {
            if (event.target && event.target.type === 'image') {
                if (document.contains(tooltip)) {
                    // document.body.removeChild(tooltip);
                    // $('.oc-nav-right').html('');

                    // $('.oc-right').removeClass('--is-active');
                }
            }
        });




        // Add a selection:created event listener on the canvas
        canvas.on('selection:created', function() {
            // Hide the tooltip when a selection is created on the canvas
            // tooltip.style.opacity = '0';
            tooltipHidden = true;
        });


        canvas.renderAll();




        function generateRandomId(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }


        function getUserProfileDetail(userId, date) {
            var userDetail = null; // Variable to store user detail
            jQuery.ajax({
                type: 'GET',
                async: false,
                url: '{{ route('profile.ajax.user.detail') }}',
                data: {
                    id: userId,
                    date: date,
                },
                success: function(response) {
                    userDetail = response.user;
                },
                error: function(error) {
                    alert(response.error);
                }
            });
            return userDetail;
        };


        const startDrag = function(e) {
            const uuid = generateRandomId(16); // Generates a random ID with length of 16 characters
            e.dataTransfer.setData('text/plain', e.target.id + ',' +
                userId + ',' + uuid);
        };
        const dragOver = function(e) {
            e.preventDefault();
        };

        const dropItem = function(e) {
            e.preventDefault();
            var data = e.dataTransfer.getData('text/plain'); //receiving the "data" i.e. id of the target dropped.
            var objectData = data.split(',');
            var objectId = objectData[0];
            var userId = objectData[1];
            var uuid = objectData[2];
            var date = new Date().getTime() / 1000;
            var isDeleted = false;

            var imag = document.getElementById(objectId); //getting the target image info through its id.

            var img = new fabric.Image(imag, {
                //initializing the fabric image.
                left: e.layerX -
                    80, //positioning the target on exact position of mouse event drop through event.layerX,Y.
                top: e.layerY - 40,
                id: objectId,
                userId: userId,
                uuid: uuid,
                date: date,
                isDeleted: isDeleted,
                hasControls: false
            });
            img.scaleToWidth(70);
            img.scaleToHeight(70);
            img.toObject(['id']);
            img.toObject(['userId']);
            img.toObject(['uuid']);
            img.toObject(['date']);
            img.toObject(['isDeleted']);
            canvas.add(img);
            showObject(img, userId);


        };

        jQuery('#add-text-btn').click(function() {
            var message = $('textarea#add-text-value').val();
            var color = $('input#text-color').val();
            var fontSize = $('select#font-size').val();
            var fontFamily = $('select#font-family').val();

            var new_text = new fabric.Text(message, {
                left: 100,
                top: 100,
                fontSize: parseInt(fontSize),
                fill: color,
                fontFamily: fontFamily,
                userId: userId,
                id: 'your-id-here' // Replace 'your-id-here' with the desired ID value
            });

            new_text.toObject = (function(toObject) {
                return function() {
                    return fabric.util.object.extend(toObject.call(this), {
                        hoverCursor: 'default' // Disable mouseover effect
                    });
                };
            })(new_text.toObject);

            canvas.add(new_text);
            canvas.setActiveObject(canvas.item(canvas.getObjects().length - 1));
            canvas.renderAll();
        });




        function saveCanvas() {
            // Cancel any previously scheduled save operation
            clearTimeout(saveTimeout);

            var saveButton = $('#save-art');
            var originalText = saveButton.text();
            saveButton.text('Saving...');


            // Schedule a new save operation to occur in 1 second
            saveTimeout = setTimeout(function() {
                // Serialize the canvas to JSON
                canvas.forEachObject(function(object) {
                    hideBorder(object);
                });
                var canvasJson = JSON.stringify(canvas.toObject(['id', 'userId', 'uuid', 'date', 'isDeleted']));
                var uuid = `{{ $scene->uuid }}`;
                var backgroundId = $("#background-id").val();
                var canvasImage = canvas.toDataURL();
                $('.scene-invite-image').attr('src', canvasImage);

                // Send the serialized JSON data to the server using AJAX
                jQuery.ajax({
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: '{{ route('scene.update', $scene) }}',
                    data: {
                        canvasJson: canvasJson,
                        backgroundId: backgroundId,
                        canvasImage: canvasImage,
                    },
                    success: function(response) {
                        // alert(response.message);
                        saveButton.text('Saved');
                        canvas.forEachObject(function(object) {
                            if (object.type !== 'text') {
                                showObject(object, userId);
                            }
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }, 1000);
        }
    </script>

    <script>
        $('#title, #description').on('input', function() {

            var title = $(this).val();
            var updatedValue = $(this).val();
            var saveButton = $('#save-art');
            var originalText = saveButton.text();
            saveButton.text('Saving...');
            jQuery.ajax({
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{{ route('scene.update', $scene) }}',
                data: {
                    column: $(this).attr('id'), // Pass the ID of the changed field
                    value: updatedValue // Pass the updated value
                },
                success: function(response) {
                    saveButton.text('Saved');
                    // alert(response.message);
                },
                error: function(error) {
                    // alert(response.error);
                }
            });
        });
    </script>

    <script>
        // Disable the add-thread button initially
        $(document).ready(function() {
            $('#add-thread').prop('disabled', true);
        });

        // Listen for changes in the input fields
        $('body').on('input change', '#thread-message-input, #thread-file-input', function() {
            var addButton = $('#add-thread');

            // Check if the message input or file input is not empty
            if ($('#thread-message-input').val() !== '' || $('#thread-file-input').val() !== '') {
                // Enable the add-thread button
                addButton.prop('disabled', false);
            } else {
                // Disable the add-thread button
                addButton.prop('disabled', true);
            }
        });


        $('body').on('click', '#add-thread', function() {
            $(this).prop("disabled", true);
            let data_uuid = $(this).attr("data-uuid");
            let data_item_id = $(this).attr("data-item-id");

            var threadMessageInput = $("#thread-message-input").val();
            var chatBox = document.getElementById('style-3');
            chatBox.scrollTop = chatBox.scrollHeight - chatBox.clientHeight;
            var fileInput = $('#thread-file-input');
            var file = fileInput.prop('files')[0]; // Get the selected file
            var fd = new FormData();
            if (file) {
                // Create a FormData object

                // Append data 
                fd.append('chat_image', file);
                fd.append('_token', "{{ csrf_token() }}");
                fd.append('uuid', data_uuid);
                fd.append('message', threadMessageInput);
                fd.append('sceneId', sceneId);
                fd.append('itemId', data_item_id);
            } else {
                fd.append('_token', "{{ csrf_token() }}");
                fd.append('uuid', data_uuid);
                fd.append('message', threadMessageInput);
                fd.append('sceneId', sceneId);
                fd.append('itemId', data_item_id);
            }

            jQuery.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{{ route('scene.ajax.item.thread.update') }}',
                processData: false, // prevent jQuery from processing data
                contentType: false, // prevent jQuery from setting content type
                cache: false,
                data: fd,

                success: function(response) {
                    if (response.textHtml) {
                        $('#all-comment').append(response.textHtml);
                    }
                    if (response.imageChatHtml) {
                        $('#all-comment').append(response.imageChatHtml);
                    }

                    $("#thread-message-input").val('');
                    $("#thread-file-preview").html('')
                    $('#thread-file-input').val('');
                    $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight - $('.chat-box')[0]
                        .clientHeight);
                    setTimeout(function() {
                        // Enable the add-thread button
                        $("#add-thread").prop("disabled", true);
                    }, 2000);

                    $("#sort-thread").show();

                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    var errorMessage = error.responseJSON.message;
                    $.each(errors, function(key, value) {
                        errorMessage += value + '<br>';
                    });
                    showToast('error', errorMessage);
                    // Simulate the completion of the AJAX request after 2 seconds
                    setTimeout(function() {
                        // Enable the add-thread button
                        $("#add-thread").prop("disabled", false);
                    }, 2000);
                }

            });
        });

        function resetThreadFileUpload() {
            $("#thread-file-preview").html('')
            $('#thread-file-input').val('');
        }
        $('body').on('keydown', '#thread-message-input', function() {
            if (event.keyCode === 13) { // 13 is the keycode for Enter key
                event.preventDefault(); // Prevent the default behavior of the Enter key

                // Trigger the click event on the add-thread button
                $('#add-thread').trigger('click');
            }
        });

        $('body').on('click', '.sort-icon', function() {
            var order = $(this).data('order');
            var uuid = $(this).data('uuid');
            $('.sort-icon').not(this).removeClass('disabled');
            $(this).toggleClass('disabled');
            $.ajax({
                url: "{{ route('scene.item.thread.ajax.filter') }}",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{{ route('scene.item.thread.ajax.filter') }}',
                data: {
                    order: order,
                    uuid: uuid
                },
                success: function(response) {

                    $('.comment-box.thread-loop').remove()

                    $('.chat-box').append(response.html);

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

    <script>
        // $('document').ready(function() {
        //     if ($('.oc-toggle.oc-left.--is-active').length && $(
        //             '.oc-toggle-right.oc-right.--is-active').length) {
        //         $('.oc-wrap.oc-left.--is-active').removeClass('--is-active');
        //         $('.oc-wrap').removeClass('o-ri');
        //         $('.invite-people').removeClass('o-ri2 --is-active');
        //     }
        // });
        $('body').on('click', '.edit-thread', function() {
            var inputField = $(this).closest('.edit-comment-cont').find('textarea');
            var saveButton = $(this).closest('.edit-comment-cont').find('.save-thread');
            var title = $(this).closest('.edit-comment-cont').find('h6');
            // Hide the h6 element
            title.hide();
            // Show the input element
            inputField.show();
            saveButton.show();


        });

        $('body').on('click', '.save-thread', function() {
            var inputField = $(this).closest('.edit-comment-cont').find('textarea');
            var saveButton = $(this).closest('.edit-comment-cont').find('.save-thread');
            var title = $(this).closest('.edit-comment-cont').find('h6');
            var threadId = $(this).data('id');

            // Update the thread title with the input field value
            var newTitle = inputField.val();
            // Show the h6 element
            title.text(newTitle);


            // Hide the input field and save icon
            inputField.hide();
            saveButton.hide();

            title.show();

            jQuery.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{{ route('scene.ajax.item.thread.update') }}',
                data: {
                    id: threadId, // Pass the ID of the changed field
                    message: newTitle
                },
                success: function(response) {
                    // Handle success response
                    console.log('Thread updated successfully');
                },
                error: function(error) {
                    // alert(response.error);
                }
            });

        });
        // Add jQuery event handler for file upload
        $('body').on('click', '#thread-file-upload', function() {
            $('#thread-file-input').click();
        });

        // Delete thread 

        $('body').on('click', '.delete-thread', function() {
            var threadId = $(this).data('id');
            var commentBox = $(this).closest('.comment-box');

            jQuery.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{{ route('scene.ajax.item.thread.delete') }}',
                data: {
                    id: threadId
                },
                success: function(response) {
                    // Handle success response
                    console.log('Thread deleted successfully');
                    commentBox.remove(); // Remove the commentDiv element
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });


        // Add jQuery event handler for file input change
        $('body').on('change', '#thread-file-input', function() {
            var file = this.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                // Display file preview in the message
                var filePreview = '<div class="file-preview">' +
                    '<img width="80"  src="' + e.target.result + '" alt="File Preview">' +
                    '<p>' + file.name + '</p>' +
                    '</div>';
                $('#thread-file-preview').append(filePreview);
                // $("#thread-message-input").css("background-image", "url(" + e.target.result + ")");
                // Add the cut icon
                var cutIcon = document.createElement('i');
                cutIcon.className = 'cut-icon fa fa-times-circle fa-lg';
                cutIcon.style.color = 'red';
                cutIcon.setAttribute('aria-hidden', 'true');
                cutIcon.setAttribute('onclick', 'resetThreadFileUpload()');
                $('#thread-file-preview').append(cutIcon);
            }

            reader.readAsDataURL(file);
        });


        $(".close-screen-icon").click(function() {
            $(this).closest(".dropdown.open").removeClass("open");
        });

        function resetItemUpload() {
            document.getElementById('start-item').classList.remove("hidden");
            document.getElementById('response-item').classList.add("hidden");
            // document.getElementById('notimage-item').classList.remove("hidden");
            document.getElementById('file-image-item').classList.add("hidden");
            document.getElementById('file-image-item').src = "";
            document.getElementById('item-input-fields').style.display = "none";
            document.getElementById("file-upload-form-item").reset();
            $("#item-upload-tags").tagsinput('removeAll');
            document.querySelector('.remove-upload-file-item').innerHTML = '';
        }

        function resetBackgroundUpload() {
            document.getElementById('start').classList.remove("hidden");
            document.getElementById('response').classList.add("hidden");
            // document.getElementById('notimage').classList.remove("hidden");
            document.getElementById('file-image').classList.add("hidden");
            document.getElementById('file-image').src = "";
            document.getElementById('background-input-fields').style.display = "none";
            document.getElementById("file-upload-form").reset();
            document.querySelector('.remove-upload-file-background').innerHTML = '';

        }
    </script>

    {{-- Upload Item with title and keywords --}}
    <script>
        var itemStoreUrl = '{{ route('item.store') }}';
        var backgroundStoreUrl = '{{ route('background.store') }}';
        var addPhotoBankUrl = '{{ route('item.add.photo.bank') }}';
        var deleteItemUrl = '{{ route('item.delete') }}';
        var searchItemUrl = '{{ route('item.search') }}';
        var searchBackgroundUrl = '{{ route('background.search') }}';
        var deleteBackgroundUrl = '{{ route('background.delete') }}';
    </script>
    <script src="{{ asset('js/uploadBackground.js') }}"></script>
    <script src="{{ asset('js/uploadItem.js') }}"></script>
    <script src="{{ asset('js/keywordsInput.js') }}"></script>
    <script src="{{ asset('js/addPhotoBank.js') }}"></script>
    <script src="{{ asset('js/deleteItem.js') }}"></script>
    <script src="{{ asset('js/searchItem.js') }}"></script>
    <script src="{{ asset('js/searchBackground.js') }}"></script>
    <script src="{{ asset('js/deleteBackground.js') }}"></script>
    <script>
        $(document).ready(function() {
            var colorInput = document.getElementById('text-color');
            var selectedColor = colorInput.value;

            colorInput.style.backgroundColor = selectedColor;
        });
        var colorInput = document.getElementById('text-color');

        colorInput.addEventListener('change', function() {
            var selectedColor = colorInput.value;
            colorInput.style.backgroundColor = selectedColor;
        });
    </script>
    <script>
        $('body').on('click', '#save-caption', function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var uuid = $(this).data('uuid');
            var description = $('.item-thread-caption').val();

            var captionId = $('#caption-id').val();

            var data = {
                id: captionId,
                uuid: uuid,
                description: description
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: '{{ route('save.item.thread.caption') }}',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(response) {
                    // Caption saved successfully
                    showToast('success', response.message);
                    $('.new-caption').html('');
                    var html =
                        '<textarea class="item-thread-caption form-control" maxlength="255" style="display:none">' +
                        response.data.description + '</textarea>' +
                        '<input type="hidden" id="caption-id" value="' + response.data.id + '">' +
                        '<button class="save-caption" id="save-caption" data-uuid="' + response.data
                        .uuid + '" data-id="' +
                        response.data.id + '" style="font-size:12px; display:none;">' +
                        'Save<i class="fa fa-check"></i></button>' +
                        '<div><a href="#" class="edit-caption" title="Edit Caption"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>' +
                        '<h6>' + response.data.description + '</h6>';
                    $('.new-caption').append(html);
                    $('.edit-caption').show();
                },
                error: function(xhr, status, error) {
                    // Error occurred during AJAX request
                    if (xhr.status === 422) {
                        // Validation error
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        for (var field in errors) {
                            errorMessage += errors[field][0] + '<br>';
                        }

                        showToast('error', errorMessage);
                    } else if (xhr.status === 404) {
                        // Caption not found error
                        showToast('error', xhr.responseJSON.error);
                    } else {
                        // Other errors
                        showToast('error', xhr.responseText);
                    }
                }
            });
        });
        $('body').on('click', '.edit-caption', function() {
            var commentCont = $(this).closest('.comment-cont');
            var inputField = commentCont.find('textarea');
            var saveButton = commentCont.find('.save-caption');
            var caption = commentCont.find('h6');
            $('.edit-caption').hide();
            // Hide the caption element
            caption.hide();
            // Show the input field
            inputField.show();
            // Show the save button
            saveButton.show();
        });


        $('body').on('click', '#add-tag-btn', function(e) {
            var tag = $('#item-upload-tags').val();
            if (tag) {
                $('#item-upload-tags').tagsinput('add', tag);
                $('#item-upload-tags').val('');
            }
        });
    </script>
@endsection
