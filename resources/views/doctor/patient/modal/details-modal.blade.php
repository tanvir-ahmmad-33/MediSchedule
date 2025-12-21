<!-- Details Modal -->
<div class="modal fade" id="patientDetailsModal" tabindex="-1" aria-labelledby="patientDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="patientDetailsModalLabel">Details about ***</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
            <h6 class="bg-dark text-light rounded ms-3 me-3 mt-3 ps-3 p-2">Personal Information</h6>
            <p class="ms-3">
                <strong>Age</strong>: <span id="patient-age"></span> <br>
                <strong>Gender</strong>: <span id="patient-gender"></span>
            </p>

            <h6 class="bg-dark text-light rounded ms-3 me-3 ps-3 p-2">Contact Information</h6>
            <p class="ms-3">
                <strong>Phone</strong>: <span id="patient-phone"></span> <br>
                <strong>Email</strong>: <span id="patient-email"></span>
            </p>

            <h6 class="bg-dark text-light rounded ms-3 me-3 ps-3 p-2">Appointment Details</h6>
            <p class="ms-3">
                <strong>Date of First Appointment</strong>: <span id="first-appointment-date"></span> <br>
                <strong>Date of Latest Appointment</strong>: <span id="latest-appointment-date"></span> <br>
                <strong>Total Number of Appointments</strong>: <span id="total-appointments"></span>
            </p>
            <hr class="opacity-25">
            <div class="d-flex justify-content-center mb-3">
                <button class="btn btn-sm btn-success p-2 ps-4 pe-4" data-bs-dismiss="modal">Close Details</button>
            </div>
        </div>
    </div>
  </div>
</div>