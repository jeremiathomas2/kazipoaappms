@extends('layouts.app')

@section('content')
<div class="page active" id="page-clients">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Clients</div>
    <div class="page-header">
        <div>
            <div class="page-title">Client Management</div>
            <div class="page-subtitle">Manage registered and guest clients on the platform.</div>
        </div>
        <div class="page-header-actions">
          <button class="btn btn-primary btn-sm" onclick="openModal('Add Client', 'client')"><i class="fa fa-user-plus"></i> Add Client</button>
        </div>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('clients.index') }}" method="GET" class="filter-bar" id="filterForm">
        <div class="filter-item" style="flex: 2;">
            <div class="header-search" style="max-width: none; border-radius: 8px;">
                <i class="fa fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, contact, email or region..." onchange="this.form.submit()"/>
            </div>
        </div>
        <div class="filter-item">
            <select name="region" class="form-control" onchange="this.form.submit()">
                <option value="">All Regions</option>
                @foreach($regions as $region)
                    <option value="{{ $region }}" {{ request('region') == $region ? 'selected' : '' }}>{{ $region }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-item">
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    </form>

    <div class="card">
        <div class="card-header">
            <div class="card-title">All Clients</div>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Name</th><th>Contact</th><th>Email</th><th>Region</th><th>Bookings</th><th>Last Active</th><th>Status</th><th>Actions</th></tr>
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
                <td>{{ $client->email }}</td>
                <td>{{ $client->region }}</td>
                <td>{{ $client->bookings_count }}</td>
                <td>{{ $client->last_active ? \Carbon\Carbon::parse($client->last_active)->diffForHumans() : '—' }}</td>
                <td><span class="badge badge-{{ $client->status == 'active' ? 'success' : 'warning' }}">{{ ucfirst($client->status) }}</span></td>
                <td>
                  <button class="btn btn-secondary btn-sm" onclick="openClientViewModal({{ json_encode($client) }})"><i class="fa fa-eye"></i> View</button>
                  <button class="btn btn-secondary btn-sm" onclick="openModal('Edit Client', 'client', {{ json_encode($client) }})"><i class="fa fa-edit"></i> Edit</button>
                  <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this client?')"><i class="fa fa-trash"></i> Delete</button>
                  </form>
                </td>
              </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- View Client Modal -->
<div class="modal-overlay" id="viewClientModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="viewClientTitle">Client Details</div>
      <button class="modal-close" onclick="closeClientViewModal()"><i class="fa fa-times"></i></button>
    </div>
    <div id="viewClientBody" style="padding: 20px;">
    </div>
  </div>
</div>

<script>
function openClientViewModal(client) {
  const body = document.getElementById('viewClientBody');
  body.innerHTML = `
    <div style="display:flex;gap:16px;align-items:center;margin-bottom:20px;">
      <div class="avatar" style="width: 72px; height:72px; font-size:24px;">
        ${client.name.charAt(0)}${(client.name.split(' ')[1]?.charAt(0) || '')}
      </div>
      <div>
        <h2 style="margin:0; color: var(--text-primary);">${client.name}</h2>
        <p style="margin:4px 0 0;color:var(--text-muted);">Client</p>
      </div>
    </div>
    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;">
      <div>
        <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px;">Contact</strong>
        <span style="font-weight:600;">${client.contact || '—'}</span>
      </div>
      <div>
        <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px;">Email</strong>
        <span style="font-weight:600;">${client.email || '—'}</span>
      </div>
      <div>
        <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px;">Region</strong>
        <span style="font-weight:600;">${client.region || '—'}</span>
      </div>
      <div>
        <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px;">Bookings Count</strong>
        <span style="font-weight:600;">${client.bookings_count}</span>
      </div>
      <div>
        <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px;">Last Active</strong>
        <span style="font-weight:600;">${client.last_active || '—'}</span>
      </div>
      <div>
        <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px;">Status</strong>
        <span class="badge badge-${client.status === 'active' ? 'success' : 'warning'}">
          ${client.status.charAt(0).toUpperCase() + client.status.slice(1)}
        </span>
      </div>
    </div>
    <div class="modal-footer" style="margin-top:20px;">
      <button type="button" class="btn btn-secondary" onclick="closeClientViewModal()">Close</button>
      <button class="btn btn-primary" onclick="openModal('Edit Client', 'client', ${JSON.stringify(client).replace(/"/g, '&quot;')}); closeClientViewModal();">Edit Client</button>
    </div>
  `;
  document.getElementById('viewClientModal').classList.add('open');
}

function closeClientViewModal() {
  document.getElementById('viewClientModal').classList.remove('open');
}

document.addEventListener('click', function(e) {
  if (e.target === document.getElementById('viewClientModal')) {
    closeClientViewModal();
  }
});
</script>
@endsection
