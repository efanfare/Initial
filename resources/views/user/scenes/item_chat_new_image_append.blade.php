<div class="{{ $itemChatThreadImage->user_id === auth()->user()->id ? 'auth-user' : 'reply-user' }} comment-box thread-loop">
    <div class="comment-box-flex">
        <div class="time-box">
            <span>{{ $itemChatThreadImage->updated_at->diffForHumans() }}</span>
        </div>
        <div class="comment-avatar-text">

            <p>{{ auth()->user()->id === $itemChatThreadImage->user_id ? 'you' : $itemChatThreadImage->user?->first_name . ' ' . $itemChatThreadImage->user?->last_name }}
            </p>
            @if (auth()->user()->id === $itemChatThreadImage->user_id)
                <img src="{{ auth()->user()->profile_image?->avatar ??App\Models\User::getAvatarUrl(auth()->user()->first_name . ' ' . auth()->user()->last_name) }}"
                    alt="image" class="img-fluid" />
            @else
                <img src="{{ $itemChatThreadImage->user?->profile_image->avatar ??App\Models\User::getAvatarUrl($itemChatThreadImage->user?->first_name . ' ' . $itemChatThreadImage->user?->last_name) }}"
                    alt="image" class="img-fluid" />
            @endif

        </div>
    </div>

    <div class="edit-comment-cont chat-block-icon">
        <div class="new-chat-user">
        <a href="javascript:void(0)" class="delete-thread" data-id="{{ $itemChatThreadImage->id }}"><i class="fa fa-trash"
                aria-hidden="true"></i></a>
        </div>
        <img width="80" src="{{ $itemChatThreadImage->chat_image?->url }}" />

    </div>
</div>
