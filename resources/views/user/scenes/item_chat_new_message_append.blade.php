<div
    class="{{ $itemChatThreadMessage->user_id === auth()->user()->id ? 'auth-user' : 'reply-user' }} comment-box thread-loop">
    <div class="comment-box-flex">
        <div class="time-box">
            <span>{{ $itemChatThreadMessage->updated_at->diffForHumans() }}</span>
        </div>
        <div class="comment-avatar-text">

            <p>{{ auth()->user()->id === $itemChatThreadMessage->user_id ? 'you' : $itemChatThreadMessage->user?->first_name . ' ' . $itemChatThreadMessage->user?->last_name }}
            </p>
            @if (auth()->user()->id === $itemChatThreadMessage->user_id)
                <img src="{{ auth()->user()->profile_image?->avatar ??App\Models\User::getAvatarUrl(auth()->user()->first_name . ' ' . auth()->user()->last_name) }}"
                    alt="image" class="img-fluid" />
            @else
                <img src="{{ $itemChatThreadMessage->user?->profile_image->avatar ??App\Models\User::getAvatarUrl($itemChatThreadMessage->user?->first_name . ' ' . $itemChatThreadMessage->user?->last_name)}}"
                    alt="image" class="img-fluid" />
            @endif

        </div>
    </div>

    <div class="edit-comment-cont chat-block-icon">
        <div class="new-chat-user">
            <a href="#" class="edit-thread"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            <a href="javascript:void(0)" class="delete-thread" data-id="{{ $itemChatThreadMessage->id }}"><i
                    class="fa fa-trash" aria-hidden="true"></i></a>
        </div>
        <textarea class="thread-id form-control" type="text" value="{{ $itemChatThreadMessage->title }}"
            style="display:none;">{{ $itemChatThreadMessage->title }}</textarea>
        <button class="save-thread" data-id="{{ $itemChatThreadMessage->id }}"
            style="font-size:12px; display:none;">Save
            <i class="fa fa-check"></i></button>
        
        <h6>{{ $itemChatThreadMessage->title }}</h6>
        <img width="80" src="{{ $itemChatThreadMessage->chat_image?->url }}" />


    </div>
</div>
