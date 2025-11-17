@if($clinics->isNotEmpty())
    @foreach($clinics as $clinic)
        <div class="row mt-4">
            <div class="col-l2 col-lg-4">
                <div class="clinic-details-image d-flex justify-content-center">
                    @if($clinic->image_path)
                        <img src="{{ Storage::url($clinic->image_path) }}" alt="{{ $clinic->name }} Image" class="img-fluid">
                    @else
                        <img src="{{ asset('assets/image/default-img.png') }}" alt="No Image Available" class="img-fluid">
                    @endif
                </div>
            </div>
            <div class="col-l2 col-lg-8 d-flex align-items-center">
                <div class="data">
                    <h5 class="clinic-title"> {{ $clinic->name }} </h5>
                    <p>
                        <span class="clinic-address"> Address: {{ $clinic->address      }} </span> <br>
                        <span class="clinic-phone">   Phone:   {{ $clinic->phone_number }} </span>
                    </p>
                    <p class="clinic-description"> {{ $clinic->description }} </p>
                    <div class="d-flex flex-row gap-1 mt-4">
                        <button class="btn btn-sm btn-primary details-button" data-id="{{ $clinic->id }}"> View More Details </button>
                        <button class="btn btn-sm btn-danger table-delete-button" data-id="{{ $clinic->id }}" data-name="{{ $clinic->name }}"> Remove Healthcare Facility </button>
                        <button class="btn btn-sm btn-warning table-edit-button" data-id="{{ $clinic->id }}"> Update Healthcare Facility Info </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif