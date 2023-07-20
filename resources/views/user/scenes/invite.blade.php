@extends('layouts.app', ['title' => 'Profile', 'bodyClass' => 'signup-scr'])
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.my_profile') }}
                </div>
                @if (session()->has('message'))
                    <p class="alert alert-info">
                        {{ session()->get('message') }}
                    </p>
                @endif

                <div class="card-body">

                    <form action="{{ route('invite', [$scene->id]) }}" method="post">
                        {{ csrf_field() }}
                        <select multiple="multiple" name="emails[]" id="sports">
                            @foreach ($users as $id => $user)
                                @foreach ($invitedUsers as $id => $userInvitation)
                                    <option value="{{ $user }}"
                                        @if ($userInvitation == $user) selected="selected" @endif>{{ $user }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        <button type="submit">Send invite</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
