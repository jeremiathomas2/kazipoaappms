@extends('layouts.app')

@section('content')
<div class="page active" id="page-kazilive">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> KaziLive</div>
    <div class="page-header">
        <div>
            <div class="page-title">KaziLive Sessions</div>
            <div class="page-subtitle">Real-time automated live work sessions — active tracking & communication hub.</div>
        </div>
        <span class="badge badge-danger" style="font-size:13px;padding:6px 14px"><i class="fa fa-circle" style="font-size:8px"></i> {{ $active_sessions->count() }} Live Now</span>
    </div>

    <div class="grid-3" style="margin-bottom:20px">
        @foreach($active_sessions as $session)
        <div class="live-card">
            <div class="live-pulse"><div class="live-dot"></div> LIVE</div>
            <div class="live-title">{{ $session->booking->service_type }} #{{ $session->booking->id }}</div>
            <div class="live-sub">{{ $session->booking->professional->name }} → {{ $session->booking->client->name }}</div>
            <div class="live-sub" style="margin-top:4px"><i class="fa fa-map-marker-alt" style="opacity:0.6"></i> {{ $session->booking->location }}</div>
            <div class="live-timer" id="kazi-timer">{{ $session->duration }}</div>
            <div class="live-actions">
                <button class="btn btn-primary btn-sm" onclick="showToast('Joining session…','')"><i class="fa fa-eye"></i> Monitor</button>
                <button class="btn btn-secondary btn-sm" style="background:rgba(255,255,255,0.1);color:#fff;border-color:rgba(255,255,255,0.2)"><i class="fa fa-comment"></i> Chat</button>
            </div>
        </div>
        @endforeach

        @if($upcoming_sessions->count() > 0)
        @php $upcoming = $upcoming_sessions->first(); @endphp
        <div class="card" style="border-color:var(--warning);border-style:dashed">
            <div class="card-header">
                <div class="card-title">⏱ Upcoming in 5 min</div>
                <span class="badge badge-warning">Countdown</span>
            </div>
            <div style="font-size:13px;font-weight:700;color:var(--text-primary);margin-bottom:8px">{{ $upcoming->booking->service_type }} #{{ $upcoming->booking->id }}</div>
            <div style="font-size:12.5px;color:var(--text-secondary);margin-bottom:4px"><i class="fa fa-user-tie"></i> {{ $upcoming->booking->professional->name ?? 'Unassigned' }} → {{ $upcoming->booking->client->name }}</div>
            <div style="font-size:12.5px;color:var(--text-secondary);margin-bottom:12px"><i class="fa fa-map-marker-alt"></i> {{ $upcoming->booking->location }}</div>
            <div style="font-size:28px;font-weight:900;color:var(--warning);letter-spacing:-1px;font-variant-numeric:tabular-nums" id="countdownTimer">00:04:58</div>
            <div style="font-size:11px;color:var(--text-muted);margin-top:4px">Session auto-starts at {{ $upcoming->booking->time }}</div>
        </div>
        @endif
    </div>

    <!-- Sessions Table -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">All Sessions Today</div>
            <div style="display:flex;gap:8px">
                <span class="badge badge-success">{{ $active_sessions->count() }} Active</span>
                <span class="badge badge-primary">{{ $upcoming_sessions->count() }} Upcoming</span>
                <span class="badge badge-primary" style="background:rgba(108,99,255,0.1);color:var(--info)">48 Completed</span>
            </div>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Session ID</th><th>Service</th><th>Professional</th><th>Client</th><th>Location</th><th>Start Time</th><th>Duration</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @foreach($active_sessions as $session)
                    <tr>
                        <td>#KL-{{ $session->id }}</td>
                        <td>{{ $session->booking->service_type }}</td>
                        <td>{{ $session->booking->professional->name }}</td>
                        <td>{{ $session->booking->client->name }}</td>
                        <td>{{ $session->booking->location }}</td>
                        <td>{{ $session->booking->time }}</td>
                        <td>{{ $session->duration }}</td>
                        <td><span class="badge badge-success">Active</span></td>
                    </tr>
                    @endforeach
                    @foreach($upcoming_sessions as $session)
                    <tr>
                        <td>#KL-{{ $session->id }}</td>
                        <td>{{ $session->booking->service_type }}</td>
                        <td>{{ $session->booking->professional->name ?? '—' }}</td>
                        <td>{{ $session->booking->client->name }}</td>
                        <td>{{ $session->booking->location }}</td>
                        <td>{{ $session->booking->time }}</td>
                        <td>—</td>
                        <td><span class="badge badge-warning">Starting Soon</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
