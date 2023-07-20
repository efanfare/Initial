<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            /* border: 0.01px solid black; */
            text-align: left;
        }

        table tr,
        table td {
            padding: 5px;
        }

        /* img {
            display: block;
            margin: 0 auto;
        } */
    </style>
</head>

<body>
    {{-- <h1>Caption</h1> --}}
    <p style="float: left">
        Placed by: {{ $user->first_name . ' ' . $user->last_name }}
    </p>
    <br>
    @if ($isDeleted)
        <img src="{{ asset('images/bin-img.png') }}" alt="image" width="150" height="150" style="float: left">
    @else
        <img src="{{ $item?->item_image?->url }}" alt="image" width="150" height="150" style="float: left">
    @endif

    {{-- <img src="{{ $user->profile_image->avatar ?? Avatar::create($user->first_name . ' ' . $user->last_name)->setDimension(75, 75) }}"
            alt="image" class="img-fluid" /> --}}

    <br>
    <br>
    <br>
    <table>
        {{-- <tr>
            <th>Header 1</th>
            <th>Header 2</th>

        </tr> --}}
        @foreach ($itemChatThread as $threadChat)
            <tr>
                <td>{{ $threadChat->created_at }}
                    {{-- {{ $threadChat->created_at->diffForHumans() }} --}}
                    -
                    {{ $threadChat->user?->first_name . ' ' . $threadChat->user?->last_name }}
                    {{-- @if (auth()->user()->id === $threadChat->user_id)
                        <img src="{{ auth()->user()->profile_image->avatar ??Avatar::create(auth()->user()->first_name . ' ' . auth()->user()->last_name)->setDimension(35, 36)->setShape('circle')->setFontSize(10) }}"
                            alt="image" />
                    @else
                        <img src="{{ $threadChat->user?->profile_image->avatar ??Avatar::create($threadChat->user?->first_name . ' ' . $threadChat->user?->last_name)->setDimension(35, 36)->setShape('circle')->setFontSize(10) }}"
                            alt="image" />
                    @endif --}}
                </td>

                <td>
                    @if ($threadChat->type === 'Text')
                        <h6>{{ $threadChat->title }}</h6>
                    @else
                        <img src="{{ $threadChat->chat_image->avatar }}" />
                    @endif
                </td>

            </tr>
        @endforeach
    </table>
</body>

</html>
