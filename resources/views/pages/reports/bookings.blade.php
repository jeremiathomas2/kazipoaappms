@extends('layouts.app')

@section('content')
<div class="page active">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Reports <span>/</span> Bookings</div>
    <div class="page-header">
        <div>
            <div class="page-title">Booking Reports</div>
            <div class="page-subtitle">Detailed analysis of booking trends and metrics.</div>
        </div>
    </div>
    <div class="card">
        <div style="padding:40px; text-align:center">
            <i class="fa fa-chart-bar" style="font-size:48px; color:var(--primary); margin-bottom:20px"></i>
            <h3>Booking Reports Dashboard</h3>
            <p style="color:var(--text-muted)">Generating visual reports for bookings...</p>
        </div>
    </div>
</div>
@endsection
