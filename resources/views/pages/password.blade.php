@extends('layouts.app')

@section('content')
<div class="page active">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> <a href="{{ route('profile.edit') }}">Profile</a><span>/</span> Password</div>
    <div class="page-header">
        <div>
            <div class="page-title">Update Password</div>
            <div class="page-subtitle">Ensure your account is using a long, random password to stay secure.</div>
        </div>
    </div>

    <div class="grid-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><i class="fa fa-key"></i> Change Password</div>
            </div>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control" required autocomplete="current-password">
                    @error('current_password', 'updatePassword')
                        <div style="color: var(--danger); font-size: 11px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" required autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <div style="color: var(--danger); font-size: 11px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                </div>

                @if (session('success'))
                    <div class="badge badge-success" style="margin-bottom: 15px; width: 100%; justify-content: center; padding: 10px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-shield-check"></i> Update Password
                    </button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title"><i class="fa fa-info-circle"></i> Password Requirements</div>
            </div>
            <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 12px;">
                <li style="display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--text-secondary);">
                    <i class="fa fa-circle-check" style="color: var(--success); font-size: 12px;"></i> Minimum 8 characters long
                </li>
                <li style="display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--text-secondary);">
                    <i class="fa fa-circle-check" style="color: var(--success); font-size: 12px;"></i> Include at least one uppercase letter
                </li>
                <li style="display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--text-secondary);">
                    <i class="fa fa-circle-check" style="color: var(--success); font-size: 12px;"></i> Include at least one number
                </li>
                <li style="display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--text-secondary);">
                    <i class="fa fa-circle-check" style="color: var(--success); font-size: 12px;"></i> Include at least one special character
                </li>
            </ul>
            <div style="margin-top: 25px; padding: 15px; background: var(--primary-light); border-radius: 12px; border-left: 4px solid var(--primary);">
                <p style="font-size: 12px; color: var(--primary); margin: 0; line-height: 1.5;">
                    <strong>Security Tip:</strong> Use a password manager to generate and store unique, strong passwords for all your accounts.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
