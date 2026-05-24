@extends('layouts.app')

@section('content')
<div class="page active">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Reports <span>/</span> User Activity</div>
    <div class="page-header">
        <div>
            <div class="page-title">User Activity</div>
            <div class="page-subtitle">Monitor how Pros and Clients are using the platform.</div>
        </div>
    </div>
    <div class="card">
        <div style="padding:40px; text-align:center">
            <i class="fa fa-user-chart" style="font-size:48px; color:var(--info); margin-bottom:20px"></i>
            <h3>Activity Monitor</h3>
            <p style="color:var(--text-muted)">User behavior logs and engagement metrics.</p>
        </div>
    </div>
</div>
@endsection
