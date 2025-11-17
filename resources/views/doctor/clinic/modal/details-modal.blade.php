<!-- Clinic Details Modal -->
<div class="modal fade" id="clinicDetailsModal" tabindex="-1" aria-labelledby="clinicDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="clinicDetailsModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="d-flex justify-content-center" style="height: 100%;">
            <img src="" alt="Clinic Image" class="image rounded-5 p-2" style="height: 160px; object-fit: cover;">
        </div>

        <p class="ps-3 pe-3">
            <strong> Address: </strong> <span class="address"> </span> <br>
            <strong> City:    </strong> <span class="city">    </span> <br>
        </p>

        <p class="ps-3 pe-3">
            <strong>Room:</strong> <span class="room_number"></span> <br>
            <strong>Floor:</strong> <span class="floor"></span> <br>
            <strong>Contact:</strong> <span class="phone_number"></span>
        </p>

        <p class="description ps-3 pe-3"></p>

        <hr>

        <div class="d-flex justify-content-center mb-3">
            <button type="button" class="btn btn-success w-25" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
