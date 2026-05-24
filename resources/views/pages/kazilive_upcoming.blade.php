@extends('layouts.app')

@section('content')
<div class="page active" id="page-kazilive-upcoming">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> <a href="{{ route('kazilive.index') }}">KaziLive</a><span>/</span> Upcoming</div>
    <div class="page-header">
        <div>
            <div class="page-title">Upcoming KaziLive Sessions</div>
            <div class="page-subtitle">Scheduled sessions that will auto-start soon.</div>
        </div>
    </div>

    <div class="grid-3" style="margin-bottom:20px">
        @forelse($upcoming_sessions as $session)
        <div class="card" style="border-color:var(--warning);border-style:dashed">
            <div class="card-header">
                <div class="card-title">⏱ Upcoming</div>
                <span class="badge badge-warning">Countdown</span>
            </div>
            <div style="font-size:13px;font-weight:700;color:var(--text-primary);margin-bottom:8px">{{ $session->booking->service_type }} #{{ $session->booking->id }}</div>
            <div style="font-size:12.5px;color:var(--text-secondary);margin-bottom:4px"><i class="fa fa-user-tie"></i> {{ $session->booking->professional->name ?? 'Unassigned' }} → {{ $session->booking->client->name }}</div>
            <div style="font-size:12.5px;color:var(--text-secondary);margin-bottom:12px"><i class="fa fa-map-marker-alt"></i> {{ $session->booking->location }}</div>
            <div style="font-size:28px;font-weight:900;color:var(--warning);letter-spacing:-1px;font-variant-numeric:tabular-nums">00:04:58</div>
            <div style="font-size:11px;color:var(--text-muted);margin-top:4px">Session auto-starts at {{ $session->booking->time }}</div>
        </div>
        @empty
        <div class="card">
            <div class="card-body" style="text-align:center;padding:40px">
                <i class="fa fa-calendar-clock" style="font-size:48px;color:var(--text-muted);margin-bottom:16px"></i>
                <div class="card-title">No Upcoming Sessions</div>
                <p style="color:var(--text-muted)">All sessions are either active or completed.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
