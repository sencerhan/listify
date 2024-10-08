@foreach ($messages as $item)
    <div class="chat-message {{ $item->from == 'me' ? 'receiver' : 'sender' }}">
        <div class="chat-name">{{ $item->sender->name }}</div>
        <div class="chat-text">{{ $item->message }}</div>
    </div>
@endforeach 