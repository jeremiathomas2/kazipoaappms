@extends('layouts.app')

@section('content')
<div class="page active">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Reports <span>/</span> Regional Stats</div>
    <div class="page-header">
        <div>
            <div class="page-title">Regional Statistics</div>
            <div class="page-subtitle">Growth and performance metrics by region.</div>
        </div>
    </div>
    <div class="card">
        <div style="padding:40px; text-align:center">
            <i class="fa fa-map-marker-alt" style="font-size:48px; color:var(--accent); margin-bottom:20px"></i>
            <h3>Regional Growth</h3>
            <p style="color:var(--text-muted)">Geographic distribution of services and users.</p>
        </div>
    </div>
</div>
@endsection
