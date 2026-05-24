@extends('layouts.app')

@section('content')
<div class="page active" id="page-kazilive-history">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> <a href="{{ route('kazilive.index') }}">KaziLive</a><span>/</span> History</div>
    <div class="page-header">
        <div>
            <div class="page-title">Session History</div>
            <div class="page-subtitle">Logs of all completed KaziLive sessions.</div>
        </div>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Session ID</th><th>Service</th><th>Professional</th><th>Client</th><th>Location</th><th>Date</th><th>Duration</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($sessions as $session)
                    <tr>
                        <td>#KL-{{ $session->id }}</td>
                        <td>{{ $session->booking->service_type }}</td>
                        <td>{{ $session->booking->professional->name }}</td>
                        <td>{{ $session->booking->client->name }}</td>
                        <td>{{ $session->booking->location }}</td>
                        <td>{{ $session->booking->date }}</td>
                        <td>{{ $session->duration }}</td>
                        <td><span class="badge badge-success">Completed</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted)">No session history found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
