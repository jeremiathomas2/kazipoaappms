@extends('layouts.app')

@section('content')
<div class="page active" id="page-bookings">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Bookings</div>
    <div class="page-header">
        <div>
            <div class="page-title">Booking Management</div>
            <div class="page-subtitle">Manage all client bookings, recurring schedules and rescheduling requests.</div>
        </div>
        <div class="page-header-actions">
            <select class="form-control" style="width:auto;padding:8px 12px;font-size:13px">
                <option>All Status</option>
                <option>Pending</option>
                <option>Accepted</option>
                <option>Active</option>
                <option>Completed</option>
            </select>
            <button class="btn btn-primary btn-sm" onclick="openModal('New Booking','booking')">
                <i class="fa fa-plus"></i> New Booking
            </button>
        </div>
    </div>

    <div class="stats-grid" style="grid-template-columns:repeat(4,1fr);margin-bottom:20px">
        <div class="stat-card" style="--stat-color:var(--primary);--stat-icon-bg:var(--primary-light)">
            <div class="stat-info"><div class="stat-label">Total</div><div class="stat-value" style="font-size:22px">{{ $bookings->count() }}</div></div>
            <div class="stat-icon" style="width:40px;height:40px;font-size:16px"><i class="fa fa-list"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:var(--warning);--stat-icon-bg:var(--warning-light)">
            <div class="stat-info"><div class="stat-label">Pending</div><div class="stat-value" style="font-size:22px">{{ $bookings->where('status', 'pending')->count() }}</div></div>
            <div class="stat-icon" style="width:40px;height:40px;font-size:16px;background:var(--warning-light);color:var(--warning)"><i class="fa fa-clock"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:var(--success);--stat-icon-bg:var(--success-light)">
            <div class="stat-info"><div class="stat-label">Completed</div><div class="stat-value" style="font-size:22px">{{ $bookings->where('status', 'completed')->count() }}</div></div>
            <div class="stat-icon" style="width:40px;height:40px;font-size:16px;background:var(--success-light);color:var(--success)"><i class="fa fa-circle-check"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:var(--info);--stat-icon-bg:rgba(108,99,255,0.1)">
            <div class="stat-info"><div class="stat-label">Recurring</div><div class="stat-value" style="font-size:22px">{{ $bookings->where('type', '!=', 'one-time')->count() }}</div></div>
            <div class="stat-icon" style="width:40px;height:40px;font-size:16px;background:rgba(108,99,255,0.1);color:var(--info)"><i class="fa fa-repeat"></i></div>
        </div>
    </div>

    <div class="grid-3" style="margin-bottom:20px">
        @foreach($bookings->take(3) as $booking)
        <div class="booking-card">
            <div class="booking-card-header">
                <div><div class="booking-id">#BK-{{ $booking->id }}</div><div class="booking-title">{{ $booking->service_type }}</div></div>
                <span class="badge badge-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'active' ? 'success' : 'primary') }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
            <div class="booking-meta">
                <div class="booking-meta-item"><i class="fa fa-user"></i> {{ $booking->client->name }}</div>
                <div class="booking-meta-item"><i class="fa fa-user-tie"></i> {{ $booking->professional->name ?? 'Unassigned' }}</div>
                <div class="booking-meta-item"><i class="fa fa-map-marker-alt"></i> {{ $booking->location }}</div>
                <div class="booking-meta-item"><i class="fa fa-calendar"></i> {{ $booking->date }} {{ $booking->time }}</div>
                <div class="booking-meta-item"><i class="fa fa-repeat"></i> {{ ucfirst($booking->type) }}</div>
            </div>
            <div class="booking-actions">
                @if($booking->status == 'pending')
                <button class="btn btn-success btn-sm" onclick="showToast('Booking assigned!','success')"><i class="fa fa-check"></i> Accept</button>
                @endif
                <button class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> View</button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Bookings Table -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">All Bookings</div>
            <div style="display:flex;gap:8px">
                <input type="text" class="form-control" style="width:200px;padding:7px 12px;font-size:12.5px" placeholder="Search bookings…"/>
            </div>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Client</th><th>Service</th><th>Pro</th><th>Location</th>
                        <th>Date</th><th>Type</th><th>Status</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>#{{ $booking->id }}</td>
                        <td>{{ $booking->client->name }}</td>
                        <td>{{ $booking->service_type }}</td>
                        <td>{{ $booking->professional->name ?? '—' }}</td>
                        <td>{{ $booking->location }}</td>
                        <td>{{ $booking->date }}</td>
                        <td><span class="badge badge-info">{{ ucfirst($booking->type) }}</span></td>
                        <td><span class="badge badge-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'active' ? 'success' : ($booking->status == 'completed' ? 'success' : 'primary')) }}">{{ ucfirst($booking->status) }}</span></td>
                        <td><button class="btn btn-secondary btn-sm">View</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
