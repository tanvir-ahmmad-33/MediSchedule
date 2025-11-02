@if($appointmentTypes->isNotEmpty())
    @foreach($appointmentTypes as $appointmentType)
        <tr scope="row" class="text-center">
            <td>{{ $appointmentTypes->firstItem() + $loop->index }}</td>
            <td> {{ $appointmentType['appt_type_name'] }} </td>
            <td> {{ $appointmentType['appt_type_code'] }} </td>
            <td class="d-flex flex-row justify-content-center">
                <button class="btn btn-xs btn-warning edit-btn d-flex flex-row align-items-center gap-1 me-2" data-id="{{ $appointmentType['id'] }}" >
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-xs btn-danger delete-btn d-flex flex-row align-items-center gap-1" data-id="{{ $appointmentType['id'] }}" data-name="{{ $appointmentType['appt_type_name'] }}">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="4" class="text-muted text-center"></td>
    </tr>
@endif