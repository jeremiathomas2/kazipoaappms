@extends('layouts.app')

@section('content')
<div class="page active">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> User Management <span>/</span> Verifications</div>
    <div class="page-header">
        <div>
            <div class="page-title">User Verifications</div>
            <div class="page-subtitle">Review pending ID and document verifications.</div>
        </div>
    </div>
    <div class="card">
        <div style="padding:40px; text-align:center">
            <i class="fa fa-shield-check" style="font-size:48px; color:var(--success); margin-bottom:20px"></i>
            <h3>Pending Verifications</h3>
            <p style="color:var(--text-muted)">All pending verification requests will appear here.</p>
        </div>
    </div>
</div>
@endsection
