@forelse($notifications as $notification)
    @php
        $user = App\Models\User::find($notification->data['userAlertId']);
    @endphp
    <a href="{{ route('notifications.markAsRead', ['notification_id' => $notification->id]) }}" id="sketch">
        <div class="dp-inner-box {{ $notification->read_at ? '' : 'read-notification' }}" style="border-bottom: .5px solid #e7e2e2;">
            <div class="dp-inner-img">
                <img src="{{ $user->profile_image->avatar ?? Avatar::create($user->first_name . ' ' . $user->last_name)->setDimension(112, 112) }}"
                    alt="image" class="img-fluid">
            </div>
            <div class="dp-inner-text">
                <h6>{{ $user->first_name . ' ' . $user->last_name }} <span
                        class="pull-right">{{ $notification->created_at->diffForHumans() }}</span></h6>
                <p>{{ $notification->data['description'] }}</p>
            </div>
        </div>
    </a>
@empty
    <p class="no-notification">No record found</p>
@endforelse
