@extends('layouts.app')

@section('content')
<div class="page active">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> User Management</div>
    <div class="page-header">
        <div>
            <div class="page-title">All Users</div>
            <div class="page-subtitle">Manage system administrators and staff.</div>
        </div>
    </div>
    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Name</th><th>Email</th><th>Created</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td><button class="btn btn-secondary btn-sm">Edit</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
