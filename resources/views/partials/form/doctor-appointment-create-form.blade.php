<form action="" method="POST" id="doctor-appointment-create-form">
    @csrf

    <div class="row mb-2">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="first_name" class="form-label mb-1">First Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="" placeholder="e.g., Sohag">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="last_name" class="form-label mb-1">Last Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="" placeholder="e.g., Ali">
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="age" class="form-label mb-1">Age</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-birthday-cake"></i></span>
                    <input type="number" name="age" id="age" class="form-control" value="" placeholder="e.g., 18">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="gender" class="form-label mb-1">Gender</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="" selected disabled>Please select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="password" class="form-label mb-1">Password <span class="text-danger ms-2" style="font-size: 0.75rem;">Required for login patient account</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                    <input type="password" name="password" id="password" class="form-control" value="" placeholder="Enter your password">
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
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

    <div class="row mb-2">
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

    <div class="row mb-2">
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
        <button type="submit" class="btn btn-sm btn-success">Create An Appointment</button>
    </div>
</form>