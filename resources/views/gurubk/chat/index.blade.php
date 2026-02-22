@extends('gurubk.layouts.app')

@section('title','Chat Konseling')

@section('content')
<style>
body {
    margin: 0;
}
.chat-wrapper {
    display: flex;
    height: 80vh;
    gap: 15px;
}
.chat-sidebar {
    width: 30%;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
}
.chat-search {
    padding: 10px;
    border-bottom: 1px solid #eee;
}
.chat-search input {
    width: 100%;
    padding: 8px 12px;
    border-radius: 20px;
    border: 1px solid #ccc;
    outline: none;
}
.chat-list {
    flex: 1;
    overflow-y: auto;
}
.chat-user {
    padding: 12px 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    border-bottom: 1px solid #f1f1f1;
    position: relative;
    transition: 0.2s;
}
.chat-user:hover { background: #f2f4ff; }
.chat-user.active { background: #e6ebff; }
.chat-user h6 { margin: 0; font-size: 14px; font-weight: 500; }
.chat-user small { font-size: 12px; color: #888; }
.badge-new {
    position: absolute;
    top: 12px;
    right: 15px;
    background: #ff3b30;
    color: #fff;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 50%;
}
.avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }

.chat-room {
    flex: 1;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
}
.chat-navbar {
    padding: 15px 20px;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: center;
    gap: 10px;
    background: #f7f7f7;
    font-weight: 500;
}
.chat-body {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 12px;
    background: #f7f8fa;
}
.chat-bubble {
    padding: 10px 15px;
    border-radius: 20px;
    max-width: 65%;
    font-size: 14px;
    position: relative;
    word-wrap: break-word;
    line-height: 1.4;
}
.siswa { background: #e1ffc7; align-self: flex-start; }
.gurubk { background: #5d5fef; color: #fff; align-self: flex-end; }
.timestamp {
    font-size: 10px;
    color: #666;
    position: absolute;
    bottom: -16px;
    right: 10px;
}
.chat-footer {
    padding: 12px 15px;
    border-top: 1px solid #eee;
    display: flex;
    gap: 10px;
    background: #f7f7f7;
}
.chat-footer input {
    flex: 1;
    border-radius: 25px;
    padding: 10px 18px;
    border: 1px solid #ccc;
    outline: none;
}
.chat-footer button { border-radius: 25px; }

.status-box {
    font-size: 13px;
    color: #555;
    margin-top: 4px;
}

@media(max-width:768px){
    .chat-wrapper { flex-direction: column; }
    .chat-sidebar { width: 100%; height: 220px; }
    .chat-room { flex: 1; }
}
</style>

<h4 class="mb-3">Chat Konseling Siswa</h4>

<div class="chat-wrapper">
    <div class="chat-sidebar">
        <div class="chat-search">
            <input type="text" id="searchUser" placeholder="Cari siswa...">
        </div>
        <div class="chat-list" id="chatList">
            @foreach($konseling as $k)
            <a href="?id={{ $k->id_konseling }}" style="text-decoration:none;color:inherit;">
                <div class="chat-user {{ request('id')==$k->id_konseling?'active':'' }}">
                    <img src="{{ $k->siswa->avatar ?? asset('images/default-avatar.png') }}" class="avatar">
                    <div>
                        <h6>{{ $k->siswa->nama_siswa }}
                            @php $unread=$k->chats->where('is_read',0)->where('sender_type','siswa')->count(); @endphp
                            @if($unread)<span class="badge-new">{{ $unread }}</span>@endif
                        </h6>
                        <small>{{ ucfirst($k->status_konseling) }}</small>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <div class="chat-room">
        @php $selected = $konseling->where('id_konseling',request('id'))->first(); @endphp

        @if($selected)
        <div class="chat-navbar">
            <img src="{{ $selected->siswa->avatar ?? asset('images/default-avatar.png') }}" class="avatar">
            <div>
                {{ $selected->siswa->nama_siswa }}
                <div class="status-box">Status: {{ ucfirst($selected->status_konseling) }}</div>
            </div>
        </div>

        <div class="chat-body" id="chatBody">
            @foreach($selected->chats as $chat)
            <div class="chat-bubble {{ $chat->sender_type }}">
                {{ $chat->message }}
                <div class="timestamp">{{ $chat->created_at->format('H:i') }}</div>
            </div>
            @endforeach
        </div>

        @if($selected->status_metode=='online'||$selected->status_metode==null)
        <form action="{{ route('gurubk.chat.reply',$selected->id_konseling) }}" method="POST" id="chatForm">
            @csrf
            <div class="chat-footer">
                <input type="text" name="message" placeholder="Ketik balasan..." required>
                <button class="btn btn-primary px-4">Kirim</button>
            </div>
        </form>
        @endif

        @else
        <div class="d-flex justify-content-center align-items-center h-100 text-muted">
            Pilih siswa untuk membuka chat
        </div>
        @endif
    </div>
</div>

<audio id="notifSound" src="{{ asset('sounds/notify.mp3') }}" preload="auto"></audio>

<script>
const chatBody = document.getElementById('chatBody');
if(chatBody) chatBody.scrollTop = chatBody.scrollHeight;

const searchInput = document.getElementById('searchUser');
searchInput.addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    document.querySelectorAll('.chat-user').forEach(user=>{
        const name = user.querySelector('h6').textContent.toLowerCase();
        user.parentElement.style.display = name.includes(filter) ? '' : 'none';
    });
});

Pusher.logToConsole=false;
window.Echo=new Echo({
    broadcaster:'pusher',
    key:'{{ env("PUSHER_APP_KEY") }}',
    cluster:'{{ env("PUSHER_APP_CLUSTER") }}',
    forceTLS:true
});

@if($selected)
window.Echo.channel('chat.{{ $selected->id_konseling }}')
    .listen('ChatSent',(e)=>{
        const div=document.createElement('div');
        div.classList.add('chat-bubble',e.chat.sender_type);
        div.innerHTML=e.chat.message+'<div class="timestamp">'+(new Date(e.chat.created_at)).toLocaleTimeString([], {hour:'2-digit',minute:'2-digit'})+'</div>';
        chatBody.appendChild(div);
        chatBody.scrollTop=chatBody.scrollHeight;
        document.getElementById('notifSound').play();

        fetch('/gurubk/chat/'+e.chat.konseling_id+'/read',{
            method:'POST',
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}
        });
    });
@endif
</script>
@endsection
