@extends('layouts.app')

@section('content')
<div class="page active" id="page-chat">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Chat</div>
    <div class="page-header">
        <div class="page-title">Messages</div>
        <span class="badge badge-primary">5 Unread</span>
    </div>
    <div class="chat-layout">
        <div class="chat-sidebar">
            <div class="chat-sidebar-header">
                Conversations
                <div style="margin-top:8px"><input type="text" class="form-control" style="font-size:12px;padding:7px 12px" placeholder="Search…"/></div>
            </div>
            <div class="chat-list">
                @foreach($professionals as $pro)
                <div class="chat-item {{ $loop->first ? 'active' : '' }}">
                    <div class="avatar" style="background:linear-gradient(135deg, {{ $pro->avatar_color ?? 'var(--primary)' }}, #FFB347)">
                        {{ strtoupper(substr($pro->name, 0, 1)) }}{{ strtoupper(substr(strrchr($pro->name, " "), 1, 1)) }}
                    </div>
                    <div style="flex:1;min-width:0">
                        <div class="chat-item-name">{{ $pro->name }}</div>
                        <div class="chat-item-preview">Booking confirmed for tomorrow</div>
                    </div>
                    <div style="text-align:right">
                        <div class="chat-item-time">2m</div>
                        @if($loop->first)
                        <span class="nav-badge" style="margin-left:0;margin-top:4px;display:inline-block">3</span>
                        @endif
                    </div>
                </div>
                @endforeach
                @foreach($clients as $client)
                <div class="chat-item">
                    <div class="avatar">
                        {{ strtoupper(substr($client->name, 0, 1)) }}{{ strtoupper(substr(strrchr($client->name, " "), 1, 1)) }}
                    </div>
                    <div style="flex:1;min-width:0">
                        <div class="chat-item-name">{{ $client->name }}</div>
                        <div class="chat-item-preview">Can we reschedule to Friday?</div>
                    </div>
                    <div class="chat-item-time">1h</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="chat-main">
            <div class="chat-header">
                <div class="avatar" style="background:linear-gradient(135deg, #FF6B35, #FFB347)">JH</div>
                <div style="flex:1">
                    <div style="font-size:14px;font-weight:800;color:var(--text-primary)">Juma Hassan</div>
                    <div style="font-size:12px;color:var(--success)"><i class="fa fa-circle" style="font-size:8px"></i> Online — In KaziLive</div>
                </div>
                <div style="display:flex;gap:8px">
                    <button class="btn btn-secondary btn-sm"><i class="fa fa-phone"></i></button>
                    <button class="btn btn-secondary btn-sm"><i class="fa fa-video"></i></button>
                </div>
            </div>
            <div class="chat-messages">
                <div class="msg"><div class="avatar" style="background:linear-gradient(135deg,#FF6B35,#FFB347);flex-shrink:0">JH</div><div><div class="msg-bubble">Habari! Nimefika nyumbani kwa client. Naanza kazi sasa.</div><div class="msg-time">9:02 AM</div></div></div>
                <div class="msg out"><div class="avatar" style="background:linear-gradient(135deg,var(--primary),var(--info));flex-shrink:0">A</div><div><div class="msg-bubble">Sawa kabisa! KaziLive session imeanza automatically. Kazi njema!</div><div class="msg-time">9:03 AM</div></div></div>
                <div class="msg"><div class="avatar" style="background:linear-gradient(135deg,#FF6B35,#FFB347);flex-shrink:0">JH</div><div><div class="msg-bubble">Asante. Nitakupigia picha baada ya kumaliza.</div><div class="msg-time">9:05 AM</div></div></div>
                <div class="msg out"><div class="avatar" style="background:linear-gradient(135deg,var(--primary),var(--info));flex-shrink:0">A</div><div><div class="msg-bubble">Vizuri sana. Booking #4820 iko confirmed for next week pia automatically.</div><div class="msg-time">9:06 AM</div></div></div>
                <div class="msg"><div class="avatar" style="background:linear-gradient(135deg,#FF6B35,#FFB347);flex-shrink:0">JH</div><div><div class="msg-bubble">Booking confirmed for tomorrow as well. Thank you! <i class="fa fa-thumbs-up"></i></div><div class="msg-time">10:31 AM</div></div></div>
            </div>
            <div class="chat-input-area">
                <button class="header-btn"><i class="fa fa-paperclip"></i></button>
                <input type="text" class="chat-input" placeholder="Type a message…" id="chatInput" onkeydown="sendChat(event)"/>
                <button class="btn btn-primary btn-icon" onclick="sendChatBtn()"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
@endsection
