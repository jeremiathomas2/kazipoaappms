@extends('layouts.app')

@section('content')
<div class="page active" id="page-bookings">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Bookings</div>
    <div class="page-header">
        <div>
            <div class="page-title">Booking Management</div>
            <div class="page-subtitle">Manage all client bookings, recurring schedules and rescheduling requests.</div>
        </div>
        <div class="page-header-actions">
          <button class="btn btn-primary btn-sm" onclick="openModal('New Booking','booking')">
            <i class="fa fa-plus"></i> New Booking
          </button>
        </div>
    </div>

    <div class="stats-grid" style="grid-template-columns:repeat(4,1fr);margin-bottom:20px">
        <div class="stat-card" style="--stat-color:var(--primary);--stat-icon-bg:var(--primary-light)">
            <div class="stat-info"><div class="stat-label">Total</div><div class="stat-value" style="font-size:22px">{{ $bookings->count() }}</div></div>
            <div class="stat-icon" style="width:40px;height:40px;font-size:16px"><i class="fa fa-list"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:var(--warning);--stat-icon-bg:var(--warning-light)">
            <div class="stat-info"><div class="stat-label">Pending</div><div class="stat-value" style="font-size:22px">{{ $bookings->where('status', 'pending')->count() }}</div></div>
            <div class="stat-icon" style="width:40px;height:40px;font-size:16px;background:var(--warning-light);color:var(--warning)"><i class="fa fa-clock"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:var(--success);--stat-icon-bg:var(--success-light)">
            <div class="stat-info"><div class="stat-label">Completed</div><div class="stat-value" style="font-size:22px">{{ $bookings->where('status', 'completed')->count() }}</div></div>
            <div class="stat-icon" style="width:40px;height:40px;font-size:16px;background:var(--success-light);color:var(--success)"><i class="fa fa-circle-check"></i></div>
        </div>
        <div class="stat-card" style="--stat-color:var(--info);--stat-icon-bg:rgba(108,99,255,0.1)">
            <div class="stat-info"><div class="stat-label">Recurring</div><div class="stat-value" style="font-size:22px">{{ $bookings->where('type', '!=', 'one-time')->count() }}</div></div>
            <div class="stat-icon" style="width:40px;height:40px;font-size:16px;background:rgba(108,99,255,0.1);color:var(--info)"><i class="fa fa-repeat"></i></div>
        </div>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('bookings.index') }}" method="GET" class="filter-bar" id="filterForm">
        <div class="filter-item" style="flex: 2;">
            <div class="header-search" style="max-width: none; border-radius: 8px;">
                <i class="fa fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by client, service, location..." onchange="this.form.submit()"/>
            </div>
        </div>
        <div class="filter-item">
            <select name="professional_id" class="form-control" onchange="this.form.submit()">
                <option value="">All Professionals</option>
                @foreach($professionals as $pro)
                    <option value="{{ $pro->id }}" {{ request('professional_id') == $pro->id ? 'selected' : '' }}>{{ $pro->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-item">
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="filter-item">
            <select name="type" class="form-control" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="one-time" {{ request('type') == 'one-time' ? 'selected' : '' }}>One-time</option>
                <option value="weekly" {{ request('type') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ request('type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
            </select>
        </div>
    </form>

    <!-- Bookings Table -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">All Bookings</div>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>ID</th><th>Client</th><th>Service</th><th>Pro</th><th>Location</th>
                <th>Date</th><th>Type</th><th>Status</th><th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bookings as $booking)
              <tr>
                <td>#{{ $booking->id }}</td>
                <td>{{ $booking->client->name }}</td>
                <td>{{ $booking->service_type }}</td>
                <td>{{ $booking->professional->name ?? '—' }}</td>
                <td>{{ $booking->location }}</td>
                <td>{{ $booking->date }} {{ $booking->time }}</td>
                <td><span class="badge badge-info">{{ ucfirst($booking->type) }}</span></td>
                <td>
                  <form action="{{ route('bookings.status', $booking) }}" method="POST" style="display:inline">
                    @csrf
                    <select name="status" class="form-control form-control-sm" style="width:auto;padding:4px 8px;font-size:12px" onchange="this.form.submit()">
                      <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                      <option value="accepted" {{ $booking->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                      <option value="active" {{ $booking->status == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                  </form>
                </td>
                <td style="display:flex;gap:4px;flex-wrap:wrap">
                  <button class="btn btn-secondary btn-sm" onclick="openViewModal({{ json_encode($booking) }})">
                    <i class="fa fa-eye"></i> View
                  </button>
                  <button class="btn btn-secondary btn-sm" onclick="openModal('Edit Booking', 'booking', {{ json_encode($booking) }})">
                    <i class="fa fa-edit"></i> Edit
                  </button>
                  <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?')">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>

<!-- View Booking Modal -->
<div class="modal-overlay" id="viewBookingModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="viewModalTitle">Booking Details</div>
      <button class="modal-close" onclick="closeViewModal()"><i class="fa fa-times"></i></button>
    </div>
    <div id="viewModalBody" style="padding: 20px;">
    </div>
  </div>
</div>

<script>
function openViewModal(booking) {
  const modalBody = document.getElementById('viewModalBody');
  modalBody.innerHTML = `
    <div style="display:grid;gap:12px">
      <div style="display:flex;justify-content:space-between;align-items:center">
        <h3 style="margin:0">#BK-${booking.id} - ${booking.service_type}</h3>
        <span class="badge badge-${booking.status == 'pending' ? 'warning' : booking.status == 'active' ? 'success' : 'primary'}">${booking.status.charAt(0).toUpperCase() + booking.status.slice(1)}</span>
      </div>
      <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px">
        <div>
          <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px">Client</strong>
          <span style="font-weight:600">${booking.client ? booking.client.name : 'N/A'}</span>
        </div>
        <div>
          <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px">Professional</strong>
          <span style="font-weight:600">${booking.professional ? booking.professional.name : 'Unassigned'}</span>
        </div>
        <div>
          <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px">Date</strong>
          <span style="font-weight:600">${booking.date}</span>
        </div>
        <div>
          <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px">Time</strong>
          <span style="font-weight:600">${booking.time}</span>
        </div>
        <div>
          <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px">Location</strong>
          <span style="font-weight:600">${booking.location}</span>
        </div>
        <div>
          <strong style="display:block;margin-bottom:4px;color:var(--text-muted);font-size:12px">Type</strong>
          <span class="badge badge-info" style="display:inline-block">${booking.type.charAt(0).toUpperCase() + booking.type.slice(1)}</span>
        </div>
      </div>
    </div>
  `;
  document.getElementById('viewBookingModal').classList.add('open');
}

function closeViewModal() {
  document.getElementById('viewBookingModal').classList.remove('open');
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
  const viewModal = document.getElementById('viewBookingModal');
  if (e.target === viewModal) {
    closeViewModal();
  }
});
</script>
@endsection
