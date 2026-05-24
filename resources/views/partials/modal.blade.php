<div class="modal-overlay" id="modalOverlay">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modalTitle">New Booking Request</div>
      <button class="modal-close" onclick="closeModal()"><i class="fa fa-times"></i></button>
    </div>
    <div id="modalBody">
      <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label class="form-label">Service Type</label>
          <select name="service_type" class="form-control">
            <option>House Cleaning</option>
            <option>Car Washing</option>
            <option>Plumbing</option>
            <option>Electrical</option>
          </select>
        </div>
        <div class="grid-2">
          <div class="form-group">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control"/>
          </div>
          <div class="form-group">
            <label class="form-label">Time</label>
            <input type="time" name="time" class="form-control"/>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Location</label>
          <input type="text" name="location" class="form-control" placeholder="Enter service address"/>
        </div>
        <div class="form-group">
          <label class="form-label">Details</label>
          <textarea name="details" class="form-control" rows="3" style="resize:vertical" placeholder="Describe the service needed..."></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Recurring Schedule</label>
          <select name="type" class="form-control">
            <option value="one-time">One-time</option>
            <option value="weekly">Weekly</option>
            <option value="bi-weekly">Bi-weekly</option>
            <option value="monthly">Monthly</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-paper-plane"></i> Send Request
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
