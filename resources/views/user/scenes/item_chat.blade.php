<div class="toggle-right-width">
    <div class="main-heart-box">
        @if ($isDeleted)
            <img src="{{ url('images/bin-img.png') }}" alt="image" class="img-fluid">
        @else
            <img src="{{ $item?->item_image?->url }}" alt="image" class="img-fluid">
        @endif
        <div class="print-btn">
            <a target="_blank"
                href="{{ route('scene.item.thread.generate.pdf', ['uuid' => $uuid, 'isDeleted' => $isDeleted, 'userId' => $user->id, 'itemId' => $item->id]) }}"><i
                    class="fa fa-print" aria-hidden="true"></i></a>
        </div>
    </div>


    <div class="chat-box scrollbar" id="style-3">

        <div class="comment-box">
            <div class="comment-box-flex">
                <div class="comment-avatar-text">
                    <img src="{{ $user->profile_image->avatar ?? App\Models\User::getAvatarUrl($user->first_name . ' ' . $user->last_name) }}"
                        alt="image" class="img-fluid" />
                    <p>{{ $user->first_name . ' ' . $user->last_name }}</p>
                </div>
                <div class="time-box">
                    <span>{{ $date }}</span>
                </div>
            </div>
            <br>
            <div class="comment-cont uploader">
                <h6>Item title: <b>{{ $item->title }}</b></h6>
                <br>
                @if (auth()->user()->id == $user->id)
                    @if (empty($itemChatCaption->id))
                        <div class="row new-caption">
                            <textarea class="item-thread-caption form-control" maxlength="255" placeholder="Add caption"></textarea>

                            <button class="save-caption" id="save-caption" data-uuid="{{ $uuid }}"
                                style="font-size:12px;">Save
                                <i class="fa fa-check"></i>
                            </button>
                        </div>
                    @else
                        <div class="row new-caption">
                            <div>
                                <a href="#" class="edit-caption" title="Edit Caption"><i class="fa fa-pencil"
                                        aria-hidden="true"></i></a>
                            </div>
                            <textarea class="item-thread-caption form-control" maxlength="255" style="display:none">{{ $itemChatCaption->description ?? '' }}</textarea>
                            <input type="hidden" id="caption-id" value="{{ $itemChatCaption->id }}">
                            <button class="save-caption" id="save-caption" data-uuid="{{ $uuid }}"
                                data-id="{{ $itemChatCaption->id }}" style="font-size:12px; display:none;">Save
                                <i class="fa fa-check"></i></button>
                            <h6>{{ $itemChatCaption->description }}</h6>

                        </div>
                    @endif
                @else
                    <h6>{{ $itemChatCaption->description ?? '' }}</h6> {{-- inivted user --}}
                @endif
            </div>
            <div id="sort-thread" @if ($itemChatThread->isEmpty()) style="display:none" @endif>
                <span>
                    <i class="fa fa-sort-up sort-icon disabled" data-order="asc" data-uuid="{{ $uuid }}"
                        aria-hidden="true"></i></span>
                <!-- Ascending icon -->
                <span><i class="fa fa-sort-down sort-icon" data-order="desc" data-uuid="{{ $uuid }}"
                        aria-hidden="true"></i></span>
                <!-- Descending icon -->
            </div>
        </div>

        <div id="all-comment">
            @foreach ($itemChatThread as $threadChat)
                <div
                    class="{{ $threadChat->user_id === auth()->user()->id ? 'auth-user' : 'reply-user' }} comment-box thread-loop">
                    <div class="comment-box-flex">
                        <div class="time-box">
                            <span>{{ $threadChat->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="comment-avatar-text">

                            <p>{{ auth()->user()->id === $threadChat->user_id ? 'you' : $threadChat->user?->first_name . ' ' . $threadChat->user?->last_name }}
                            </p>
                            @if (auth()->user()->id === $threadChat->user_id)
                                <img src="{{ auth()->user()->profile_image->avatar ?? App\Models\User::getAvatarUrl(auth()->user()->first_name . ' ' . auth()->user()->last_name) }}"
                                    alt="image" class="img-fluid" />
                            @else
                                <img src="{{ $threadChat->user?->profile_image->avatar ?? App\Models\User::getAvatarUrl($threadChat->user?->first_name . ' ' . $threadChat->user?->last_name) }}"
                                    alt="image" class="img-fluid" />
                            @endif

                        </div>
                    </div>
                    <div class="edit-comment-cont chat-block-icon">

                        @if ($threadChat->type === 'Text')
                            @if ($threadChat->user_id === auth()->user()->id || auth()->user()->id === $threadChat->scene->user_id)
                                <div class="new-chat-user">
                                    @if ($threadChat->user_id === auth()->user()->id)
                                        <a href="#" class="edit-thread"><i class="fa fa-pencil"
                                                aria-hidden="true"></i></a>
                                    @endif


                                    <a href="javascript:void(0)" class="delete-thread"
                                        data-id="{{ $threadChat->id }}"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>

                                </div>

                                <textarea class="thread-id form-control" type="text" value="{{ $threadChat->title }}" style="display:none;">{{ $threadChat->title }}</textarea>
                                <button class="save-thread" data-id="{{ $threadChat->id }}"
                                    data-item-id="{{ $item->id }}" style="font-size:12px; display:none;">Save <i
                                        class="fa fa-check"></i></button>
                            @endif

                            <h6>{{ $threadChat->title }}</h6>
                            <img src="{{ $threadChat->chat_image?->url }}" />
                        @else
                            @if ($threadChat->user_id === auth()->user()->id || auth()->user()->id === $threadChat->scene->user_id)
                                <div class="new-chat-user">
                                    <a href="javascript:void(0)" class="delete-thread"
                                        data-id="{{ $threadChat->id }}"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
                                </div>
                            @endif
                            <img src="{{ $threadChat->chat_image->avatar }}" />
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    @if (request()->user()->package_id === 1)
        {{-- TODO:Remove this container when site will lived and add will be showed by google ads --}}
        <div class="ad-container-scene-right">
            <img src="https://placehold.co/270x280/?text=Ad%20goes%20here" alt="" class="img-fluid">
            <span class="ad-cut-icon-scene-right" onclick="removeAdRight()">&#10005;</span>
        </div>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3193209969219776"
            crossorigin="anonymous"></script>
    @endif


</div>
<div class="chat-field">
    <div class="pin-link">
        <!-- <input id="thread-message-input" type="text" placeholder="Type your message" class="form-control"> -->
        <textarea rows="2" id="thread-message-input" type="text" placeholder="Type your message"
            class="form-control"></textarea>
        <input id="thread-item-main-uuid" type="hidden" value="{{ $uuid }}">

        <!-- Add a file input field -->
        <input id="thread-file-input" type="file" accept=".gif,.jpeg,.jpg,.png" style="display: none;">
        <div class="pin-mark-link">
            <a href="#" id="thread-file-upload"><i class="fa fa-paperclip" aria-hidden="true"></i></a>
        </div>

    </div>
    <div class="plane-btn">
        <button id="add-thread" data-uuid="{{ $uuid }}" data-item-id="{{ $item->id }}" disabled>
            <i class="fa fa-paper-plane" aria-hidden="true"></i>
        </button>
    </div>


</div>
<div id="thread-file-preview"></div> <!-- Add a container for file preview -->
