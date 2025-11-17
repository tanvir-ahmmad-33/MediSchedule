@if($appointmentSchedules->isNotEmpty())
    @foreach($appointmentSchedules as $appointmentSchedule)
        <tr>
            <td>{{ $loop->iteration + $appointmentSchedules->firstItem() - 1 }}</td>
            <td>{{ $appointmentSchedule->clinic_name }}</td>
            <td>{{ $appointmentSchedule->clinic_city }}</td>
            <td>{{ $appointmentSchedule->weekday }}</td>
            <td>
                @if( $appointmentSchedule->operational_availability == 'available')
                    <span class="text-success">Available</span>
                @else
                    <span class="text-danger">Unavailable</span>
                @endif
            </td>
            <td>
                <span class="text-danger">0</span>
            </td>
            <td>
                <button type="button" 
                        class="btn btn-xs btn-info details-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#moreDetailsModal"
                        data-id="{{ $appointmentSchedule->id }}">
                        More Details
                    </button>
            </td>
            <td class="d-flex flex-row gap-1">
                <button class="btn btn-xs btn-warning d-flex flex-row edit-button"
                        data-id="{{ $appointmentSchedule->id }}">
                    <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                </button>
                <button class="btn btn-xs btn-danger d-flex flex-row delete-button"
                        data-id="{{ $appointmentSchedule->id }}"
                        data-name="{{ $appointmentSchedule->clinic_name }}">
                    <i class="fa-solid fa-trash-can me-1"></i>Delete
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="9" class="text-center text-small text-danger">No appointment schedule is found.</td>
    </tr>
@endif