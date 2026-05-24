@extends('layouts.app')

@section('content')
<div class="page active">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> User Management <span>/</span> Suspensions</div>
    <div class="page-header">
        <div>
            <div class="page-title">User Suspensions</div>
            <div class="page-subtitle">Manage blocked accounts and policy violations.</div>
        </div>
    </div>
    <div class="card">
        <div style="padding:40px; text-align:center">
            <i class="fa fa-ban" style="font-size:48px; color:var(--danger); margin-bottom:20px"></i>
            <h3>Suspended Accounts</h3>
            <p style="color:var(--text-muted)">No accounts are currently suspended.</p>
        </div>
    </div>
</div>
@endsection
