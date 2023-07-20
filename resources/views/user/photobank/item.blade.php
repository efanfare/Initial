@extends('layouts.main_dashboard', ['title' => 'Photo Bank', 'dbClass' => 'db photo-bank-sec'])
@section('content')
    @if (session()->has('error'))
        <div class="toast-container top-0 end-0 p-3">
            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center aligns-center"
                style="z-index: 5; right: 0; bottom: 0;">
                <div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true"
                    data-delay="5000">
                    <div class="toast-header">
                        <strong class="mr-auto">Error!</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="toast-body">
                        {{ session()->get('error') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('message'))
        <div class="toast-container top-0 end-0 p-3">
            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center aligns-center"
                style="z-index: 5; right: 0; bottom: 0;">
                <div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true"
                    data-delay="4000">
                    <div class="toast-header">
                        <strong class="mr-auto">Success!</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="toast-body">
                        {{ session()->get('message') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Modal -->
    <div class="modal logout-modal fade" id="exampleModalItemDelete" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/logout-img.png') }}" alt="image" class="img-fluid">
                    <h6>Are you sure you want to delete this item?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" onclick="deleteItem()" id="delete-item-button"
                        class="btn btn-primary">Yes</button>
                    <form id="delete-form" action="{{ route('item.delete.photobank.index', 'id') }}" method="POST"
                        style="display:none;">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit">Log out</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Modal -->
    <div class="modal logout-modal fade" id="exampleModalBackgroundDelete" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/logout-img.png') }}" alt="image" class="img-fluid">
                    <h6>Are you sure you want to delete this background?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" onclick="deleteBackground()" id="delete-background-button"
                        class="btn btn-primary">Yes</button>
                    <form id="delete-background-form" action="{{ route('background.delete.index', 'id') }}" method="POST"
                        style="display:none;">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit">Log out</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="search-bar-box">
        <div class="search-box">
            <input type="search" name="search" placeholder="Search items and backgrounds"
                value="{{ request()->get('search') ?? request()->get('search') }}" class="form-control" id="search-input">
        </div>
        <div class="search-box-icon">
            <a href="javascript:void(0)" id="search-icon"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="welcome-box-flex photo-bank-scr">
        <div class="welcome-box-text">
            <h6>Photo Bank</h6>
        </div>
    </div>
    <div class="scenes-tabs gallery-boxes-row">
        <div class="filter-flex">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('item_page') || empty(request()->get('bg_page')) ? 'active' : '' }}"
                        data-toggle="pill" href="#flamingo" role="tab" aria-controls="pills-flamingo"
                        aria-selected="{{ request()->get('item_page') ? 'true' : 'false' }}">Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('bg_page') ? 'active' : '' }}" data-toggle="pill"
                        href="#cuckoo" role="tab" aria-controls="pills-cuckoo"
                        aria-selected="{{ request()->get('bg_page') ? true : false }}">Backgrounds</a>
                </li>
            </ul>
            <!-- <div class="filter-bell-icon">
                <a href="javascript:void(0)">
                    <span class="bell-span">
                        <i class="fa fa-filter" aria-hidden="true"></i>
                    </span>
                </a>
            </div> -->
        </div>

        <div class="tab-content mt-3">
            <div class="tab-pane fade {{ request()->get('item_page') || empty(request()->get('bg_page')) ? 'show active' : '' }}"
                id="flamingo" role="tabpanel" aria-labelledby="flamingo-tab">
                <div class="row">
                    @forelse ($items as $item)
                        @if (isset($item->item_image))
                            <div class="col-lg-2 col-md-4 col-sm-4 col-12">
                                <div class="gift-main-box" id="item_{{ $item->id }}">
                                    <span>
                                        <img src="{{ $item->item_image?->url }}" alt="image" class="img-fluid">
                                        <div class="gift-box-del">
                                            <a href="javascript:void(0)"
                                                onclick="showItemDeleteConfirmation({{ $item->id }})"><i
                                                    class="fa fa-times" aria-hidden="true"></i></a>
                                        </div>
                                    </span>
                                    <h6>{{ $item->title }}</h6>
                                    <p> {{ $item->created_at?->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p>No item has found</p>
                    @endforelse

                </div>
                <div class="row d-flex justify-content-center">
                    {{ $items->appends(['search' => $searchQuery])->links('vendor.pagination.bootstrap-4', ['pageName' => 'item_page', 'class' => 'justify-content-center']) }}

                </div>
            </div>
            <div class="tab-pane fade {{ request()->get('bg_page') ? 'show active' : '' }}" id="cuckoo"
                role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">

                    @forelse ($userBackgrounds as $background)
                        @if (isset($background->background_image))
                            <div class="col-lg-2 col-md-4 col-sm-4 col-12">
                                <div class="gift-main-box" id="background_{{ $background->id }}">
                                    <span>
                                        <img src="{{ $background->background_image?->url }}" alt="image"
                                            class="img-fluid">
                                        @if ($background->service_type === 'User')
                                            <div class="gift-box-del">
                                                <a href="javascript:void(0)"
                                                    onclick="showBackgroundDeleteConfirmation({{ $background->id }})"
                                                    title="Delete Backgorund"><i class="fa fa-times"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        @else
                                            <div class="gift-box-del topright"
                                                style="position: absolute;
                                            top: 12px;
                                            right: 1px;
                                            font-size: 18px;
                                            width: 70px;
                                            border-radius: 7%;
                                            ">
                                                System</div>
                                        @endif
                                    </span>
                                    <h6>{{ $background->title }}</h6>
                                    <p> {{ $background->created_at?->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p>No Background has found</p>
                    @endforelse

                </div>
                <div class="row d-flex justify-content-center">
                    {{ $userBackgrounds->appends(['search' => $searchQuery])->links('vendor.pagination.bootstrap-4', ['pageName' => 'bg_page', 'class' => 'justify-content-center']) }}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var searchItemUrl = '{{ route('item.index') }}';
        var searchItemType = '{{ request()->get('item_page') }}';
        var searchBgType = '{{ request()->get('bg_page') }}';
        var addSearch = '';

        if (searchItemType) {
            addSearch = '&item_page=' + 1;
        }

        if (searchBgType) {
            addSearch = '&bg_page=' + 1;
        }
        const searchInput = document.getElementById('search-input');
        const searchIcon = document.getElementById('search-icon');

        searchIcon.addEventListener('click', function(event) {
            event.preventDefault();
            const searchQuery = searchInput.value;
            window.location.href = searchItemUrl + '?search=' + searchQuery + addSearch;
        });

        searchInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const searchQuery = searchInput.value;
                window.location.href = searchItemUrl + '?search=' + searchQuery + addSearch;
            }
        });

        $('#search-input').on("search", function() {
            const searchQuery = searchInput.value;
            window.location.href = searchItemUrl;
        });
    </script>
    <script>
        function showItemDeleteConfirmation(itemId) {
            // Show the confirmation modal
            $('#exampleModalItemDelete').modal('show');

            // Update the delete button action with the scene ID
            $('#delete-item-button').attr('data-item-id', itemId);
        }

        function deleteItem() {
            var itemId = $('#delete-item-button').attr('data-item-id');

            // Set the form action with the scene ID
            var deleteForm = $('#delete-form');
            var deleteUrl = deleteForm.attr('action').replace('id', itemId);
            deleteForm.attr('action', deleteUrl);

            // Submit the form
            deleteForm.submit();

            // Close the confirmation modal
            $('#exampleModalItemDelete').modal('hide');
        }
    </script>

    {{-- Background Delete --}}

    <script>
        function showBackgroundDeleteConfirmation(backgroundId) {
            // Show the confirmation modal
            $('#exampleModalBackgroundDelete').modal('show');

            // Update the delete button action with the scene ID
            $('#delete-background-button').attr('data-background-id', backgroundId);
        }

        function deleteBackground() {
            var backgroundId = $('#delete-background-button').attr('data-background-id');

            // Set the form action with the scene ID
            var deleteForm = $('#delete-background-form');
            var deleteUrl = deleteForm.attr('action').replace('id', backgroundId);
            deleteForm.attr('action', deleteUrl);

            // Submit the form
            deleteForm.submit();

            // Close the confirmation modal
            $('#exampleModalBackgroundDelete').modal('hide');
        }
    </script>

    @if (session()->has('message') || session()->has('error'))
        <script>
            $('.toast').toast('show');
        </script>
    @endif
@endsection
