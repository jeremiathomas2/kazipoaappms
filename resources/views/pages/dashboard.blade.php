@extends('layouts.app')

@section('content')
<div class="page active" id="page-dashboard">
    <div class="breadcrumb"><a href="#">Home</a><span>/</span> Dashboard</div>

    <div class="page-header">
        <div>
            <div class="page-title">Dashboard Overview</div>
            <div class="page-subtitle">Welcome back, {{ auth()->user()->name ?? 'Admin' }} — here's what's happening on Kazipoa today.</div>
        </div>
        <div class="page-header-actions">
            <button class="btn btn-secondary btn-sm"><i class="fa fa-download"></i> Export</button>
            <button class="btn btn-primary btn-sm" onclick="openModal('New Booking','booking')">
                <i class="fa fa-plus"></i> New Booking
            </button>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card" style="--stat-color:#1A6EFF;--stat-icon-bg:var(--primary-light)">
            <div class="stat-info">
                <div class="stat-label">Total Bookings</div>
                <div class="stat-value">{{ number_format($stats['total_bookings']) }}</div>
                <div class="stat-change up"><i class="fa fa-arrow-up"></i> 14.3% this month</div>
            </div>
            <div class="stat-icon"><i class="fa fa-calendar-check"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:#18C16E;--stat-icon-bg:var(--success-light)">
            <div class="stat-info">
                <div class="stat-label">Active Pros</div>
                <div class="stat-value">{{ number_format($stats['active_pros']) }}</div>
                <div class="stat-change up"><i class="fa fa-arrow-up"></i> 8.1% this month</div>
            </div>
            <div class="stat-icon" style="background:var(--success-light);color:var(--success)"><i class="fa fa-user-tie"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:#F5A623;--stat-icon-bg:var(--warning-light)">
            <div class="stat-info">
                <div class="stat-label">Active Clients</div>
                <div class="stat-value">{{ number_format($stats['active_clients']) }}</div>
                <div class="stat-change up"><i class="fa fa-arrow-up"></i> 22.5% this month</div>
            </div>
            <div class="stat-icon" style="background:var(--warning-light);color:var(--warning)"><i class="fa fa-users"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:#FF6B35;--stat-icon-bg:var(--accent-light)">
            <div class="stat-info">
                <div class="stat-label">Live Sessions</div>
                <div class="stat-value">{{ number_format($stats['live_sessions']) }}</div>
                <div class="stat-change up"><i class="fa fa-circle" style="font-size:8px;color:var(--danger)"></i> {{ $stats['live_sessions'] }} active now</div>
            </div>
            <div class="stat-icon" style="background:var(--accent-light);color:var(--accent)"><i class="fa fa-bolt"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:#F03E3E;--stat-icon-bg:var(--danger-light)">
            <div class="stat-info">
                <div class="stat-label">Pending Requests</div>
                <div class="stat-value">{{ number_format($stats['pending_requests']) }}</div>
                <div class="stat-change down"><i class="fa fa-arrow-down"></i> Needs attention</div>
            </div>
            <div class="stat-icon" style="background:var(--danger-light);color:var(--danger)"><i class="fa fa-clock"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:#6C63FF;--stat-icon-bg:rgba(108,99,255,0.1)">
            <div class="stat-info">
                <div class="stat-label">Recurring Bookings</div>
                <div class="stat-value">{{ number_format($stats['recurring_bookings']) }}</div>
                <div class="stat-change up"><i class="fa fa-arrow-up"></i> 5.6% growth</div>
            </div>
            <div class="stat-icon" style="background:rgba(108,99,255,0.1);color:var(--info)"><i class="fa fa-repeat"></i></div>
        </div>
    </div>

    <!-- Main Charts Row -->
    <div class="grid-2-1" style="margin-bottom:16px">
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title">Booking Activity</div>
                    <div class="card-subtitle">Last 12 weeks</div>
                </div>
                <div style="display:flex;gap:8px">
                    <span class="badge badge-primary">Bookings</span>
                    <span class="badge badge-success">Completed</span>
                </div>
            </div>
            <div class="chart-placeholder" id="mainChart"></div>
            <div style="display:flex;justify-content:space-between;font-size:11px;color:var(--text-muted);padding-top:8px;font-weight:600">
                <span>Mar 1</span><span>Mar 7</span><span>Mar 14</span><span>Mar 21</span><span>Apr 1</span>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title">Service Categories</div>
            </div>
            <div style="display:flex;flex-direction:column;gap:12px">
                @php
                    $categories = [
                        ['name' => 'House Cleaning', 'percent' => 34, 'color' => 'var(--primary)'],
                        ['name' => 'Plumbing', 'percent' => 22, 'color' => 'var(--success)'],
                        ['name' => 'Car Washing', 'percent' => 18, 'color' => 'var(--accent)'],
                        ['name' => 'Electrical', 'percent' => 14, 'color' => 'var(--warning)'],
                        ['name' => 'Others', 'percent' => 12, 'color' => 'var(--info)'],
                    ];
                @endphp
                @foreach($categories as $cat)
                <div>
                    <div style="display:flex;justify-content:space-between;font-size:12.5px;font-weight:700;margin-bottom:5px">
                        <span>{{ $cat['name'] }}</span><span style="color:{{ $cat['color'] }}">{{ $cat['percent'] }}%</span>
                    </div>
                    <div class="progress"><div class="progress-bar" style="width:{{ $cat['percent'] }}%; background:{{ $cat['color'] }}"></div></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Pros + Recent Activity -->
    <div class="grid-1-2">
        <!-- Featured Pros -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Top Professionals</div>
                <a href="{{ route('professionals.index') }}" class="btn btn-secondary btn-sm">View All</a>
            </div>
            <div style="display:flex;flex-direction:column;gap:12px">
                @foreach($top_pros as $pro)
                <div class="pro-card">
                    <div class="pro-card-top">
                        <div class="pro-avatar" style="background:linear-gradient(135deg, {{ $pro->avatar_color ?? 'var(--primary)' }}, #FFB347)">
                            {{ strtoupper(substr($pro->name, 0, 1)) }}{{ strtoupper(substr(strrchr($pro->name, " "), 1, 1)) }}
                        </div>
                        <div style="flex:1">
                            <div class="pro-name">{{ $pro->name }}</div>
                            <div class="pro-service">{{ $pro->service }} • <i class="fa fa-location-dot" style="font-size:10px"></i> {{ $pro->region }}</div>
                            @if($pro->is_verified)
                            <div class="pro-verified"><i class="fa fa-circle-check"></i> Verified Pro</div>
                            @endif
                        </div>
                        <div class="pro-rating"><i class="fa fa-star"></i> {{ $pro->rating }}</div>
                    </div>
                    <div class="pro-stats">
                        <div class="pro-stat"><div class="pro-stat-value">{{ $pro->jobs_count }}</div><div class="pro-stat-label">Jobs</div></div>
                        <div class="pro-stat"><div class="pro-stat-value">98%</div><div class="pro-stat-label">Rate</div></div>
                        <div class="pro-stat"><div class="pro-stat-value">3</div><div class="pro-stat-label">Active</div></div>
                    </div>
                    <div class="pro-card-btns">
                        <button class="btn btn-secondary btn-sm"><i class="fa fa-comment"></i> Wasiliana</button>
                        <button class="btn btn-primary btn-sm" onclick="openModal('Direct Booking','booking')"><i class="fa fa-calendar-plus"></i> Book</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Recent Activity</div>
                <span class="badge badge-primary">Live Feed</span>
            </div>
            <div class="timeline" id="activityFeed">
                @foreach($recent_bookings as $booking)
                <div class="timeline-item">
                    <div class="timeline-dot" style="background:{{ $booking->status == 'active' ? 'var(--success)' : 'var(--primary)' }}"></div>
                    <div class="timeline-line"></div>
                    <div class="timeline-content">
                        <div class="timeline-title">Booking #BK-{{ $booking->id }} {{ $booking->status }}</div>
                        <div class="timeline-sub">Client {{ $booking->client->name }} booked {{ $booking->service_type }}</div>
                        <div class="timeline-time">{{ $booking->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
