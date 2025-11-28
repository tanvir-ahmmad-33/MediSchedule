@if($appointmentSchedules->isNotEmpty())
    @foreach($appointmentSchedules as $appointmentSchedule)
        <tr>
            <td>{{ $loop->iteration + $appointmentSchedules->firstItem() - 1 }}</td>
            <td>{{ $appointmentSchedule->clinic->name }}</td>
            <td>{{ \Carbon\Carbon::parse($appointmentSchedule->appointment_date)->format('d M, Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($appointmentSchedule->appointment_date)->format('l') }}</td>
            <td>
                <span class="{{ !$appointmentSchedule->ot_status ? 'text-danger' : 'text-success' }}">
                    {{ $appointmentSchedule->ot_status ? 'Available' : 'Unavailable'}}
                </span>
            </td>
            <td>
                @if($appointmentSchedule->patient_appointed > 0)
                    <span class="text-success"> {{ $appointmentSchedule->patient_appointed }} </span>
                @else
                    <span class="text-danger"> {{ $appointmentSchedule->patient_appointed }} </span>
                @endif
            </td>
            <td>
                <button type="button" 
                        class="btn btn-xs btn-info details-btn" 
                        data-id="{{ $appointmentSchedule->id }}">
                        More Details
                    </button>
            </td>
            <td class="d-flex flex-row gap-1">
                <button class="btn btn-xs btn-warning edit-button"
                        data-id="{{ $appointmentSchedule->id }}">
                    <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                </button>
                <button class="btn btn-xs btn-danger delete-button"
                        data-id="{{ $appointmentSchedule->id }}"
                        data-name="{{ $appointmentSchedule->clinic->name }}">
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
