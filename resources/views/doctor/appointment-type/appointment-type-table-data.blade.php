@if($appointmentTypes->isNotEmpty())
    @foreach($appointmentTypes as $appointmentType)
        <tr scope="row" class="text-center">
            <td>{{ $appointmentTypes->firstItem() + $loop->index }}</td>
            <td> {{ $appointmentType['appt_type_name'] }} </td>
            <td> {{ $appointmentType['appt_type_code'] }} </td>
            <td> {{ \Illuminate\Support\Str::limit($appointmentType['description'], 50) }} </td>
            <td>
                @if($appointmentType['status'] == 'active')
                    <button class="btn btn-xs btn-success status-btn" data-id="{{ $appointmentType['id'] }}" data-status="active">Active</button>
                @else
                    <button class="btn btn-xs btn-danger status-btn" data-id="{{ $appointmentType['id'] }}" data-status="inactive">Inactive</button>
                @endif
            </td>
            <td>
                <button class="btn btn-info btn-xs details-btn" data-bs-toggle="modal" data-bs-target="#detailsModal" data-id="{{ $appointmentType['id'] }}">More Details</button>
            </td>
            <td class="d-flex flex-row justify-content-center">
                <button class="btn btn-xs btn-warning edit-btn d-flex flex-row align-items-center gap-1 me-2" data-id="{{ $appointmentType['id'] }}" >
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-xs btn-danger delete-btn d-flex flex-row align-items-center gap-1" data-id="{{ $appointmentType['id'] }}" data-name="{{ $appointmentType['appt_type_name'] }}">
                    <i class="fa-solid fa-trash-can"></i> Delete
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="text-center text-small text-danger">No appointment type is found.</td>
    </tr>
@endif