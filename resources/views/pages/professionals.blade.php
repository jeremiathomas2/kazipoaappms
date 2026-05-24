@extends('layouts.app')

@section('content')
<div class="page active" id="page-professionals">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Professionals</div>
    <div class="page-header">
        <div>
            <div class="page-title">Professionals</div>
            <div class="page-subtitle">Manage verified service providers across all regions.</div>
        </div>
        <div class="page-header-actions">
            <button class="btn btn-primary btn-sm"><i class="fa fa-user-plus"></i> Add Pro</button>
        </div>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('professionals.index') }}" method="GET" class="filter-bar" id="filterForm">
        <div class="filter-item" style="flex: 2;">
            <div class="header-search" style="max-width: none; border-radius: 8px;">
                <i class="fa fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, service or region..." onchange="this.form.submit()"/>
            </div>
        </div>
        <div class="filter-item">
            <select name="service" class="form-control" onchange="this.form.submit()">
                <option>All Categories</option>
                @foreach($services as $service)
                    <option value="{{ $service }}" {{ request('service') == $service ? 'selected' : '' }}>{{ $service }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-item">
            <select name="region" class="form-control" onchange="this.form.submit()">
                <option>All Regions</option>
                @foreach($regions as $region)
                    <option value="{{ $region }}" {{ request('region') == $region ? 'selected' : '' }}>{{ $region }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-item">
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option>All Status</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="in_session" {{ request('status') == 'in_session' ? 'selected' : '' }}>In Session</option>
                <option value="starting_soon" {{ request('status') == 'starting_soon' ? 'selected' : '' }}>Starting Soon</option>
            </select>
        </div>
        <div class="view-switcher">
            <button type="button" class="view-btn" id="gridBtn" onclick="switchView('grid')" title="Grid View">
                <i class="fa fa-th-large"></i>
            </button>
            <button type="button" class="view-btn" id="listBtn" onclick="switchView('list')" title="List View">
                <i class="fa fa-list"></i>
            </button>
        </div>
    </form>

    <!-- Professionals Grid View -->
    <div class="grid-3" id="proGridView">
        @forelse($professionals as $pro)
        <div class="pro-card">
            <div class="pro-card-top">
                <div class="pro-avatar" style="background:linear-gradient(135deg, {{ $pro->avatar_color ?? 'var(--primary)' }}, #FFB347)">
                    {{ strtoupper(substr($pro->name, 0, 1)) }}{{ strtoupper(substr(strrchr($pro->name, " "), 1, 1)) }}
                </div>
                <div style="flex:1">
                    <div class="pro-name">{{ $pro->name }}</div>
                    <div class="pro-service">{{ $pro->service }}</div>
                    <div style="font-size:11px;color:var(--text-muted)"><i class="fa fa-location-dot"></i> {{ $pro->region }}</div>
                </div>
                <div class="pro-rating"><i class="fa fa-star"></i> {{ $pro->rating }}</div>
            </div>
            <div style="display:flex;gap:6px;flex-wrap:wrap">
                @if($pro->is_verified)
                <span class="badge badge-success"><i class="fa fa-circle-check"></i> Verified</span>
                @endif
                <span class="badge badge-primary">{{ $pro->jobs_count }} jobs</span>
                <span class="badge badge-{{ $pro->status == 'available' ? 'success' : ($pro->status == 'in_session' ? 'danger' : 'warning') }}">
                    {{ ucfirst(str_replace('_', ' ', $pro->status)) }}
                </span>
            </div>
            <div class="pro-card-btns">
                <button class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Profile</button>
                <button class="btn btn-primary btn-sm"><i class="fa fa-comment"></i> Wasiliana</button>
            </div>
        </div>
        @empty
        <div class="card" style="grid-column: span 3; text-align: center; padding: 40px;">
            <i class="fa fa-user-slash" style="font-size: 48px; color: var(--text-muted); margin-bottom: 16px;"></i>
            <h3>No Professionals Found</h3>
            <p style="color: var(--text-muted)">Try adjusting your search or filters.</p>
        </div>
        @endforelse
    </div>

    <!-- Professionals List View -->
    <div class="pro-list" id="proListView" style="display: none;">
        @forelse($professionals as $pro)
        <div class="pro-list-item">
            <div class="pro-avatar" style="width: 42px; height: 42px; font-size: 14px; background:linear-gradient(135deg, {{ $pro->avatar_color ?? 'var(--primary)' }}, #FFB347)">
                {{ strtoupper(substr($pro->name, 0, 1)) }}{{ strtoupper(substr(strrchr($pro->name, " "), 1, 1)) }}
            </div>
            <div class="pro-list-info">
                <div style="width: 180px;">
                    <div class="pro-name" style="font-size: 14px;">{{ $pro->name }}</div>
                    <div class="pro-service" style="font-size: 12px; color: var(--text-muted);">{{ $pro->service }}</div>
                </div>
                <div class="pro-list-meta">
                    <div style="width: 120px;"><i class="fa fa-location-dot" style="width: 14px;"></i> {{ $pro->region }}</div>
                    <div style="width: 60px;"><i class="fa fa-star" style="color: var(--warning); width: 14px;"></i> {{ $pro->rating }}</div>
                    <div style="width: 100px;"><i class="fa fa-briefcase" style="width: 14px;"></i> {{ $pro->jobs_count }} Jobs</div>
                </div>
                <div style="width: 120px;">
                    <span class="badge badge-{{ $pro->status == 'available' ? 'success' : ($pro->status == 'in_session' ? 'danger' : 'warning') }}">
                        {{ ucfirst(str_replace('_', ' ', $pro->status)) }}
                    </span>
                </div>
            </div>
            <div style="display: flex; gap: 8px;">
                <button class="btn btn-secondary btn-icon" title="View Profile"><i class="fa fa-eye"></i></button>
                <button class="btn btn-primary btn-icon" title="Contact"><i class="fa fa-comment"></i></button>
            </div>
        </div>
        @empty
        <div class="card" style="text-align: center; padding: 40px;">
            <i class="fa fa-user-slash" style="font-size: 48px; color: var(--text-muted); margin-bottom: 16px;"></i>
            <h3>No Professionals Found</h3>
            <p style="color: var(--text-muted)">Try adjusting your search or filters.</p>
        </div>
        @endforelse
    </div>
</div>

<script>
function switchView(view) {
    const grid = document.getElementById('proGridView');
    const list = document.getElementById('proListView');
    const gridBtn = document.getElementById('gridBtn');
    const listBtn = document.getElementById('listBtn');

    if (view === 'grid') {
        grid.style.display = 'grid';
        list.style.display = 'none';
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
    } else {
        grid.style.display = 'none';
        list.style.display = 'flex';
        gridBtn.classList.remove('active');
        listBtn.classList.add('active');
    }
    localStorage.setItem('proViewMode', view);
}

document.addEventListener('DOMContentLoaded', () => {
    const savedView = localStorage.getItem('proViewMode') || 'grid';
    switchView(savedView);
});
</script>
@endsection
