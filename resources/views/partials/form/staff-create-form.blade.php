<form action="" method="POST" id="staff-profile-create-form" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="first_name" class="form-label">First Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="" placeholder="e.g., Mokhlesh">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="last_name" class="form-label">Last Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="" placeholder="e.g., Mia">
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="phone" class="form-label">Phone</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                    <input type="tel" name="phone" id="phone" class="form-control" value="" placeholder="e.g., 017********">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control" value="" placeholder="e.g., staff@gmail.com">
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="age" class="form-label">Age</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-cake-candles"></i></span>
                    <input type="number" name="age" id="age" class="form-control" value="" placeholder="e.g., 18">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select">
                    <option value="staff" selected>Staff</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="" selected>Please select a gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="working_section" class="form-label">Profession</label>
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
        <div class="col-12 col-lg-4">
            <div class="form-group">
                <label for="experience" class="form-label">Experience (in years)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                    <input type="number" name="experience" id="experience" class="form-control" value="" placeholder="e.g., 1">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <label for="profile_image" class="form-label">Profile Image</label>
            <input type="file" name="profile_image" id="profile_image" class="form-control">
        </div>
    </div>

    <div class="form-group mb-4">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
            <input type="password" name="password" id="password" class="form-control" value="" placeholder="Please enter a eight digits password">
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success">Create New Staff Member</button>
    </div>
</form>