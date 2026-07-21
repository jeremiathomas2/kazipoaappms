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
        @if($users->count() > 0)
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <form action="{{ route('users.verify', $user) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-check"></i> Verify
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
            <i class="fa fa-shield-check" style="font-size:48px; color:var(--success); margin-bottom:20px"></i>
            <h3>Pending Verifications</h3>
            <p style="color:var(--text-muted)">All users are verified!</p>
        </div>
        @endif
    </div>
</div>
@endsection
