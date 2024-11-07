<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
    @if($messageCount > 0)
    <span class="chat-notification" id="chat-notification-contractorside-{{$projectId}}">
        {{ $messageCount }}
    </span>
@endif
</div>