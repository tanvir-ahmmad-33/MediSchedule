<!-- Edit Appointment Type Modal -->
<div class="modal fade" id="editAppointmentType" tabindex="-1" aria-labelledby="editAppointmentTypeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editAppointmentTypeLabel">Edit New Appointment Type</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <form action="#" method="POST" id="edit-appointment-type-form">
            @csrf

            <input type="hidden" name="id" id="id" value="">

            <div class="form-group p-3 pt-2">
                <label for="appointment_type_name" class="form-label">Appointment Type Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                    <input type="text" name="appointment_type_name" id="appointment_type_name" class="form-control" value="">
                </div>
            </div>

            <div class="d-flex flex-wrap p-3 pt-2 gap-2">
                <div class="form-group flex-fill">
                    <label for="abbreviation" class="form-label">Abbreviation</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                        <input type="text" name="abbreviation" id="abbreviation" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group flex-fill">
                    <label for="ophthalmologist-icon" class="form-label">Select Appointment Type Icon</label>
                    <div class="d-flex flex-wrap">
                      <div class="flex-fill">
                          <select id="ophthalmologist-icon" name="ophthalmologist_icon" class="form-select">
                              <option value="fas fa-eye" data-icon="fas fa-eye">Eye</option>
                              <option value="fas fa-eye-dropper" data-icon="fas fa-eye-dropper">Eye Dropper</option>
                              <option value="fas fa-search" data-icon="fas fa-search">Search</option>
                              <option value="fas fa-glasses" data-icon="fas fa-glasses">Glasses</option>
                              <option value="fas fa-cogs" data-icon="fas fa-cogs">Cogs</option>
                              <option value="fas fa-eye-slash" data-icon="fas fa-eye-slash">Eye Slash</option>
                              <option value="fa-solid fa-magnifying-glass" data-icon="fa-solid fa-magnifying-glass">Magnifying Glass</option>
                              <option value="fas fa-child" data-icon="fas fa-child">Child</option>
                          </select>
                      </div>
                      <div class="flex-fill d-flex justify-content-center align-items-center bg-success text-light ms-2 rounded">
                        <i id="selected-icon" class="" style="font-size: 24px;"></i>
                      </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap p-3 pt-2 gap-2">
                <div class="form-group flex-fill">
                    <label for="min_price" class="form-label">Minimum Price</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                        <input type="number" name="min_price" id="min_price" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group flex-fill">
                    <label for="max_price" class="form-label">Maximum Price</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                        <input type="number" name="max_price" id="max_price" class="form-control" value="" >
                    </div>
                </div>
                <div class="form-group flex-fill">
                    <label for="discount" class="form-label">Discount</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                        <input type="number" name="discount" id="discount" class="form-control" value="" step="0.01" min="0" max="100">
                    </div>
                </div>
            </div>

            <div class="form-group p-3 pb-2 pt-0">
                <label for="" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>

            <hr class="modal-hr text-secondary-emphasis">

            <div class="d-flex justify-content-center gap-2 mb-3">
                <button type="submit" class="btn btn-warning">Edit Appointment Type</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>