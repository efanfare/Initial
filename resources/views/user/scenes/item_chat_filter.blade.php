@foreach ($itemChatThread as $threadChat)
    <div class="comment-box thread-loop">
        <div class="comment-box-flex">
            <div class="time-box">
                <span>{{ $threadChat->updated_at->diffForHumans() }}</span>
            </div>
            <div class="comment-avatar-text">

                <p>{{ auth()->user()->id === $threadChat->user_id ? 'you' : $threadChat->user?->first_name . ' ' . $threadChat->user?->last_name }}
                </p>
                @if (auth()->user()->id === $threadChat->user_id)
                    <img src="{{ auth()->user()->profile_image->avatar ??Avatar::create(auth()->user()->first_name . ' ' . auth()->user()->last_name)->setDimension(35, 36)->setShape('circle')->setFontSize(10) }}"
                        alt="image" class="img-fluid" />
                @else
                    <img src="{{ $threadChat->user?->profile_image->avatar ??Avatar::create($threadChat->user?->first_name . ' ' . $threadChat->user?->last_name)->setDimension(35, 36)->setShape('circle')->setFontSize(10) }}"
                        alt="image" class="img-fluid" />
                @endif

            </div>
        </div>
        <div class="edit-comment-cont">

            @if ($threadChat->type === 'Text')
                @if ($threadChat->user_id === auth()->user()->id)
                <div>
                    <a href="#" class="edit-thread"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="javascript:void(0)" class="delete-thread" data-id="{{ $threadChat->id }}"><i
                            class="fa fa-trash" aria-hidden="true"></i></a>

                </div>
                   
                    <input class="thread-id form-control" type="text" value="{{ $threadChat->title }}"
                        style="display:none;">
                    <button class="save-thread" data-id="{{ $threadChat->id }}"
                        style="font-size:12px; display:none;">Save <i class="fa fa-check"></i></button>
                @endif
                <h6>{{ $threadChat->title }}</h6>
            @else
                <a href="javascript:void(0)" class="delete-thread" data-id="{{ $threadChat->id }}"><i
                        class="fa fa-trash" aria-hidden="true"></i></a>


                <img src="{{ $threadChat->chat_image->avatar }}" />
            @endif
        </div>
    </div>
@endforeach