@extends('layouts.app')

@section('content')
<div class="page active" id="page-clients">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Clients</div>
    <div class="page-header">
        <div>
            <div class="page-title">Client Management</div>
            <div class="page-subtitle">Manage registered and guest clients on the platform.</div>
        </div>
        <button class="btn btn-primary btn-sm"><i class="fa fa-user-plus"></i> Add Client</button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">All Clients</div>
            <input type="text" class="form-control" style="width:200px;padding:7px 12px;font-size:12.5px" placeholder="Search clients…"/>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Name</th><th>Contact</th><th>Region</th><th>Bookings</th><th>Last Active</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px">
                                <div class="avatar">
                                    {{ strtoupper(substr($client->name, 0, 1)) }}{{ strtoupper(substr(strrchr($client->name, " "), 1, 1)) }}
                                </div> 
                                {{ $client->name }}
                            </div>
                        </td>
                        <td>{{ $client->contact }}</td>
                        <td>{{ $client->region }}</td>
                        <td>{{ $client->bookings_count }}</td>
                        <td>{{ $client->last_active ? \Carbon\Carbon::parse($client->last_active)->diffForHumans() : '—' }}</td>
                        <td><span class="badge badge-{{ $client->status == 'active' ? 'success' : 'warning' }}">{{ ucfirst($client->status) }}</span></td>
                        <td><button class="btn btn-secondary btn-sm">View</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
