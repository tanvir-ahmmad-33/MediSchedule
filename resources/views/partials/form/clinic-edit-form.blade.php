<form action="#" method="POST" id="edit-clinic-form" enctype="multipart/form-data">
    @csrf

    <input type="hidden" value="id" name="id" id="id">

    <div class="form-group mb-3">
        <label for="name" class="form-label">Clinic/Hospital Name:</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-house-medical"></i></span>
            <input type="text" name="name" id="name" class="form-control" value="" placeholder="">
        </div>
    </div>
        <div class="row mb-3">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="address" class="form-label">Street Address:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-map-pin"></i></span>
                        <input type="text" name="address" id="address" class="form-control" value="" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="city" class="form-label">City:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-city"></i></span>
                        <input type="text" name="city" id="city" class="form-control" value="" placeholder="">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4">
                <div class="form-group">
                    <label for="floor" class="form-label">Floor/Level:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-dungeon"></i></span>
                        <input type="number" name="floor" id="floor" class="form-control" value="" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="form-group">
                    <label for="room_number" class="form-label">Room Number:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
                        <input type="text" name="room_number" id="room_number" class="form-control" value="" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="form-group mb-3">
                    <label for="phone_number" class="form-label">Phone Number:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="" placeholder="">
                    </div>
                </div>
            </div>
        </div>

        
                
        <div class="row">
            <div class="col-12 col-lg-5">
                <label for="image" class="form-label">Clinic Image:</label>
                <div class="d-flex justify-content-center mb-3">
                    <img src="" id="current_clinic_image_display" alt="Current Clinic Image" class="rounded" style="max-height: 160px; object-fit: cover;">
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7">
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Describe the clinic" rows="8">
                    </textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-warning update-clinic-btn shadow">Update Healthcare Facility</button>
        </div>
    </form>