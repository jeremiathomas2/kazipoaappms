@extends('layouts.app')

@section('content')
<div class="page active">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Reports <span>/</span> Revenue</div>
    <div class="page-header">
        <div>
            <div class="page-title">Revenue Reports</div>
            <div class="page-subtitle">Track your platform's financial performance.</div>
        </div>
    </div>
    <div class="card">
        <div style="padding:40px; text-align:center">
            <i class="fa fa-coins" style="font-size:48px; color:var(--success); margin-bottom:20px"></i>
            <h3>Revenue Analysis</h3>
            <p style="color:var(--text-muted)">Financial data visualization is coming soon.</p>
        </div>
    </div>
</div>
@endsection
