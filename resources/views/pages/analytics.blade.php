@extends('layouts.app')

@section('content')
<div class="page active" id="page-analytics">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Analytics</div>
    <div class="page-header">
        <div class="page-title">Analytics & Insights</div>
        <div class="page-header-actions">
            <select class="form-control" style="width:auto;padding:8px 12px;font-size:13px">
                <option>Last 30 Days</option><option>Last 7 Days</option><option>This Year</option>
            </select>
            <button class="btn btn-secondary btn-sm"><i class="fa fa-download"></i> Export</button>
        </div>
    </div>
    <div class="stats-grid">
        <div class="stat-card" style="--stat-color:var(--primary);--stat-icon-bg:var(--primary-light)">
            <div class="stat-info"><div class="stat-label">Platform Revenue</div><div class="stat-value">TZS 4.2M</div><div class="stat-change up"><i class="fa fa-arrow-up"></i> 18.4%</div></div>
            <div class="stat-icon"><i class="fa fa-coins"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:var(--success);--stat-icon-bg:var(--success-light)">
            <div class="stat-info"><div class="stat-label">Avg Rating</div><div class="stat-value">4.82</div><div class="stat-change up"><i class="fa fa-star"></i> Excellent</div></div>
            <div class="stat-icon" style="background:var(--success-light);color:var(--success)"><i class="fa fa-star"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:var(--accent);--stat-icon-bg:var(--accent-light)">
            <div class="stat-info"><div class="stat-label">Completion Rate</div><div class="stat-value">94.7%</div><div class="stat-change up"><i class="fa fa-arrow-up"></i> 2.1%</div></div>
            <div class="stat-icon" style="background:var(--accent-light);color:var(--accent)"><i class="fa fa-chart-pie"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:var(--info);--stat-icon-bg:rgba(108,99,255,0.1)">
            <div class="stat-info"><div class="stat-label">Repeat Clients</div><div class="stat-value">68.2%</div><div class="stat-change up"><i class="fa fa-arrow-up"></i> 5.3%</div></div>
            <div class="stat-icon" style="background:rgba(108,99,255,0.1);color:var(--info)"><i class="fa fa-repeat"></i></div>
        </div>
    </div>
    <div class="grid-2">
        <div class="card">
            <div class="card-header"><div class="card-title">Monthly Bookings</div></div>
            <div class="chart-placeholder" id="analyticsChart"></div>
        </div>
        <div class="card">
            <div class="card-header"><div class="card-title">Top Regions</div></div>
            <div style="display:flex;flex-direction:column;gap:10px;margin-top:8px">
                <div><div style="display:flex;justify-content:space-between;font-size:13px;font-weight:700;margin-bottom:5px"><span><i class="fa fa-city" style="color:var(--primary)"></i> Mwanza</span><span style="color:var(--primary)">38%</span></div><div class="progress"><div class="progress-bar" style="width:38%"></div></div></div>
                <div><div style="display:flex;justify-content:space-between;font-size:13px;font-weight:700;margin-bottom:5px"><span><i class="fa fa-city" style="color:var(--accent)"></i> Dar es Salaam</span><span style="color:var(--accent)">31%</span></div><div class="progress"><div class="progress-bar" style="width:31%;background:var(--accent)"></div></div></div>
                <div><div style="display:flex;justify-content:space-between;font-size:13px;font-weight:700;margin-bottom:5px"><span><i class="fa fa-city" style="color:var(--success)"></i> Arusha</span><span style="color:var(--success)">18%</span></div><div class="progress"><div class="progress-bar" style="width:18%;background:var(--success)"></div></div></div>
                <div><div style="display:flex;justify-content:space-between;font-size:13px;font-weight:700;margin-bottom:5px"><span><i class="fa fa-city" style="color:var(--info)"></i> Dodoma</span><span style="color:var(--info)">13%</span></div><div class="progress"><div class="progress-bar" style="width:13%;background:var(--info)"></div></div></div>
            </div>
        </div>
    </div>
</div>
@endsection
