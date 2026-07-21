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
        @if($users->count() > 0)
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Suspended At</th>
                        <th>Reason</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->suspended_at->format('M d, Y H:i') }}</td>
                        <td>{{ $user->suspension_reason }}</td>
                        <td>
                            <form action="{{ route('users.unsuspend', $user) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-check"></i> Unsuspend
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div style="padding:40px; text-align:center">
            <i class="fa fa-ban" style="font-size:48px; color:var(--danger); margin-bottom:20px"></i>
            <h3>Suspended Accounts</h3>
            <p style="color:var(--text-muted)">No accounts are currently suspended.</p>
        </div>
        @endif
    </div>
</div>
@endsection
