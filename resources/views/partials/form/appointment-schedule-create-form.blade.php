<form action="#" method="POST" id="appointment-schedule-create-form">
    @csrf

    <div class="form-group mb-3">
        <label for="clinic_id" class="form-label">Healthcare Facility Name</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
            <select name="clinic_id" id="clinic_id" class="form-select">
                <option value="" selected disabled>Please select an healthcare facility</option>
                @if($clinics->isNotEmpty())
                    @foreach($clinics as $clinic)
                        <option value="{{ $clinic->id }}"> {{ $clinic->name }} </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="appointment_date" class="form-label">Consultation Date</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
            <input type="date" name="appointment_date" id="appointment_date" class="form-control" value="">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="opening_time" class="form-label">Consultation Start Time</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-hourglass-start"></i></span>
                    <input type="time" name="opening_time" id="opening_time" class="form-control" value="">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="closing_time" class="form-label">Consultation Finish Time</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-hourglass-end"></i></span>
                    <input type="time" name="closing_time" id="closing_time" class="form-control" value="">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="patient_capacity" class="form-label">Patients Limit</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-hospital-user"></i></span>
            <input type="number" name="patient_capacity" id="patient_capacity" class="form-control" value="" placeholder="e.g., 33">
        </div>
    </div>
    
    <div class="form-group mb-3">
        <label for="" class="form-label">Operation will be happen? (Yes/No)</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="ot_status" id="ot_status_yes" value="1">
            <label class="form-check-label" for="ot_status_yes">Yes</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="ot_status" id="ot_status_no" value="0">
            <label class="form-check-label" for="ot_status_no">No</label>
        </div>
    </div>

    <button type="submit" class="btn btn-sm btn-success appointment-schedule-create-btn">Create New Appointment Schedule</button>
</form>