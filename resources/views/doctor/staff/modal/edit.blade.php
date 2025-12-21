<!-- Edit Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1" aria-labelledby="editStaffModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editStaffModalLabel"> Staff Approval </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-3 pb-0">
        <p>
          <strong>Name</strong>: <span class="staff_name"></span> <br>
          <strong>Email</strong>: <span class="staff_email"></span> <br>
          <strong>Phone</strong>: <span class="staff_phone"></span> <br>
          <strong>Gender</strong>: <span class="staff_gender"></span> <br>
        </p>
        <h6 class="text-center">Submit the required details for staff approval</h6>
        <p>
          <form action="#" method="POST" id="staff-profile-approve-form">
            @csrf
            @method('PUT')

            <input type="hidden" id="user_id" name="user_id" value="">


            <div class="row mb-2">
              <div class="col-12 col-lg-6 pe-1">
                <div class="form-group">
                  <label for="working_section" class="form-label mb-1">Profession</label>
                  <select name="working_section" id="working_section" class="form-control">
                      <option value="" selected disabled>Please select a profession</option>
                      <option value="nurse">Nurse</option>
                      <option value="assistant">Assistant/Helper</option>
                      <option value="receptionist">Receptionist</option>
                      <option value="technician">Technician</option>
                      <option value="senior_nurse">Senior Nurse</option>
                  </select>
                </div>
              </div>
              <div class="col-12 col-lg-6 ps-1">
                <div class="form-group">
                  <label for="experience" class="form-label mb-1">Experience (in years)</label>
                  <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                      <input type="number" name="experience" id="experience" class="form-control" value="" placeholder="e.g., 1">
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-12 col-lg-6 pe-1">
                <div class="form-group">
                  <label for="age" class="form-label mb-1">Age</label>
                  <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-cake-candles"></i></span>
                      <input type="number" name="age" id="age" class="form-control" value="" placeholder="e.g., 18">
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 ps-1">
                <label for="profile_image" class="form-label mb-1">Profile Image</label>
                <input type="file" name="profile_image" id="profile_image" class="form-control">
              </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Create New Staff Member</button>
            </div>
          </form>
        </p>
      </div>
    </div>
  </div>
</div>