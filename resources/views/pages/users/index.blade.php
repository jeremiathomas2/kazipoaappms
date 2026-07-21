@extends('layouts.app')

@section('content')
<div class="page active">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> User Management</div>
    <div class="page-header">
        <div>
            <div class="page-title">All Users</div>
            <div class="page-subtitle">Manage administrators, clients, and professionals.</div>
        </div>
        <button class="btn btn-primary btn-sm" onclick="openModal('Add User', 'user')">
            <i class="fa fa-plus"></i> Add User
        </button>
    </div>
    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge badge-{{ $user->role === 'Admin' ? 'primary' : ($user->role === 'Professional' ? 'info' : 'secondary') }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</td>
                        <td>
                            @if($user->role === 'Admin')
                                @if($user->suspended_at)
                                    <span class="badge badge-danger">Suspended</span>
                                @elseif($user->verified_at)
                                    <span class="badge badge-success">Verified</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            @elseif($user->role === 'Client')
                                <span class="badge badge-{{ $user->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            @elseif($user->role === 'Professional')
                                <span class="badge badge-{{ $user->status === 'available' ? 'success' : ($user->status === 'in_session' ? 'danger' : 'warning') }}">
                                    {{ str_replace('_', ' ', ucfirst($user->status)) }}
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($user->role === 'Admin')
                                <button class="btn btn-secondary btn-sm" onclick="openModal('Edit User', 'user', {{ json_encode($user) }})">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                @if(!$user->suspended_at)
                                <form action="{{ route('users.suspend', $user) }}" method="POST" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="reason" value="Suspended by admin">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to suspend this user?')">
                                        <i class="fa fa-ban"></i> Suspend
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>
                                    <i class="fa fa-eye"></i> View
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
