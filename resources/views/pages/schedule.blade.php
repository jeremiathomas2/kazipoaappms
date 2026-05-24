@extends('layouts.app')

@section('content')
<div class="page active" id="page-schedule">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Scheduling</div>
    <div class="page-header">
        <div class="page-title">Scheduling Automation</div>
        <div class="page-subtitle">KaziLive sessions auto-schedule from bookings. No manual creation needed.</div>
    </div>
    <div class="card" style="margin-bottom:16px">
        <div class="card-header">
            <div class="card-title"><i class="fa fa-calendar-day"></i> Today — {{ now()->format('M d, Y') }}</div>
            <button class="btn btn-secondary btn-sm"><i class="fa fa-chevron-left"></i></button>
            <button class="btn btn-secondary btn-sm"><i class="fa fa-chevron-right"></i></button>
        </div>
        <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:8px;text-align:center;margin-bottom:16px">
            <div style="font-size:11px;font-weight:700;color:var(--text-muted);padding:6px 0">MON</div>
            <div style="font-size:11px;font-weight:700;color:var(--text-muted);padding:6px 0">TUE</div>
            <div style="font-size:11px;font-weight:700;color:var(--text-muted);padding:6px 0">WED</div>
            <div style="font-size:11px;font-weight:700;color:var(--text-muted);padding:6px 0">THU</div>
            <div style="font-size:11px;font-weight:700;color:var(--text-muted);padding:6px 0">FRI</div>
            <div style="font-size:11px;font-weight:700;color:var(--text-muted);padding:6px 0">SAT</div>
            <div style="font-size:11px;font-weight:700;color:var(--text-muted);padding:6px 0">SUN</div>
        </div>
        <div style="display:flex;flex-direction:column;gap:8px">
            @foreach($bookings as $booking)
            <div style="display:flex;align-items:center;gap:12px;padding:10px 14px;background:{{ $booking->status == 'active' ? 'var(--primary-light)' : 'var(--body-bg)' }};border-radius:8px;border-left:4px solid {{ $booking->status == 'active' ? 'var(--primary)' : 'var(--card-border)' }}">
                <div style="font-size:12px;font-weight:700;color:{{ $booking->status == 'active' ? 'var(--primary)' : 'var(--text-muted)' }};min-width:70px">{{ $booking->time }}</div>
                <div style="flex:1">
                    <div style="font-size:13px;font-weight:700">{{ $booking->service_type }} — {{ $booking->professional->name ?? 'Unassigned' }}</div>
                    <div style="font-size:11px;color:var(--text-muted)">{{ $booking->client->name }} · {{ $booking->location }} · 
                        <span style="color:{{ $booking->status == 'active' ? 'var(--success)' : 'var(--text-muted)' }}">
                            ● {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                </div>
                <span class="badge badge-{{ $booking->status == 'active' ? 'success' : 'primary' }}">
                    {{ $booking->status == 'active' ? 'Live' : 'Scheduled' }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
