<!-- Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="statusModalLabel">Staff Status Overview</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <p class="ms-3 me-3 mb-1 mt-2">
            <strong>Name</strong>: <span id="staffName">***</span> <br>
            <strong>Working Section</strong>: <span id="staffWorkingSection"> *** </span>
        </p>
        <p class="ms-3 me-3 mb-4">
            <strong>Current status</strong>: <span id="currentStatus">***</span>
        </p>
        <h6 class="ms-3 me-3 mb-4 text-center">
            <span id="buttonTitle" class="p-2 rounded-pill shadow"></span>
        </h6>
        <div class="buttons ms-3 me-3 text-center" id="statusButtons"></div>
        <hr class="bg-secondary-emphasis">
        <div class="d-flex justify-content-center mb-3">
            <button class="btn btn-sm btn-outline-secondary">Back To Main</button>
        </div>
      </div>
    </div>
  </div>
</div>