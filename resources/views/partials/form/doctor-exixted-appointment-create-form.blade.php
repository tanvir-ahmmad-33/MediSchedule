<form action="" method="POST" id="doctor-exists-appointment-create-form">
    @csrf

    <div class="row mb-3">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="user_id" class="form-label mb-1">Patient Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <select name="user_id" id="user_id" class="form-select">
                        <option value="" selected disabled>Please select a patient</option>
                        @if($users->isNotEmpty())
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <button type="button" id="view-patient-details" class="btn btn-secondary text-small" data-bs-toggle="modal" data-bs-target="#patientDetailsModal" data-id="{{ $user->id }}">
                        Patient Details
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="age" class="form-label mb-1">Age</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-birthday-cake"></i></span>
                    <input type="number" name="age" id="age" class="form-control" value="" placeholder="e.g., 18">
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="address" class="form-label mb-1">House Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                    <input type="text" name="address" id="address" class="form-control" value="" placeholder="e.g., House No: 11, Hujrapur">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="city" class="form-label mb-1">City</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                    <input type="text" name="city" id="city" class="form-control" value="" placeholder="Chapai Nawabganj">
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="email" class="form-label mb-1">Email Adreess</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control" value="" placeholder="e.g., patient@gmail.com">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="phone" class="form-label mb-1">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                    <input type="tel" name="phone" id="phone" class="form-control" value="" placeholder="e.g., 017********">
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="hospital_name" class="form-label mb-1">Hospital Name</label>
                <select name="hospital_name" id="hospital_name" class="form-select">
                    <option value="" selected disabled>Please select a hospital</option>
                    @if($clinics->isNotEmpty())
                        @foreach($clinics as $clinic)
                            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="appt_type_name" class="form-label mb-1">Appointment Type</label>
                <select name="appt_type_name" id="appt_type_name" class="form-select">
                    <option value="" selected disabled>Please select an appointment type</option>
                    @if($appointmentTypes->isNotEmpty())
                        @foreach($appointmentTypes as $appointmentType)
                            <option value="{{ $appointmentType->id }}">{{ $appointmentType->appt_type_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="appt_schedule" class="form-label mb-1">Select Appointment Time</label>
                <select name="appt_schedule" id="appt_schedule" class="form-select">
                    <option value="" selected disabled>Please select a hospital</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="description" class="form-label">Description (Optional)</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter appointment description"></textarea>
    </div>

    

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success shadow">Create An Appointment</button>
    </div>
</form>