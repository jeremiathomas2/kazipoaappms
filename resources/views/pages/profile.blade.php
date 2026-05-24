@extends('layouts.app')

@section('content')
<div class="page active">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Profile</div>
    <div class="page-header">
        <div>
            <div class="page-title">My Profile</div>
            <div class="page-subtitle">Manage your account information and preferences.</div>
        </div>
    </div>

    <div class="grid-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><i class="fa fa-user-circle"></i> Profile Information</div>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autocomplete="name">
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                </div>

                @if (session('success'))
                    <div class="badge badge-success" style="margin-bottom: 15px; width: 100%; justify-content: center; padding: 10px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title"><i class="fa fa-shield-halved"></i> Account Status</div>
            </div>
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: var(--body-bg); border-radius: 8px;">
                    <div>
                        <div style="font-size: 13px; font-weight: 700;">Role</div>
                        <div style="font-size: 11px; color: var(--text-muted);">Current access level</div>
                    </div>
                    <span class="badge badge-primary">Super Admin</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: var(--body-bg); border-radius: 8px;">
                    <div>
                        <div style="font-size: 13px; font-weight: 700;">Account Created</div>
                        <div style="font-size: 11px; color: var(--text-muted);">Member since</div>
                    </div>
                    <div style="font-size: 12px; font-weight: 700;">{{ $user->created_at->format('M d, Y') }}</div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: var(--body-bg); border-radius: 8px;">
                    <div>
                        <div style="font-size: 13px; font-weight: 700;">Two-Factor Auth</div>
                        <div style="font-size: 11px; color: var(--text-muted);">Enhanced security</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox"><div class="toggle-slider"></div></label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
