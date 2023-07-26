<x-mail::message>
    # Scene Invitation

{{ $inviterName }} has invited you to a new scene, which is a <b>{{ $sceneTitle }}</b>.

{{ $inviterMessage }}

<img src="{{ $canvasImageUrl }}" alt="Scene Canvas Image"/>

<x-mail::button :url="$url">
    Accept Scene
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
