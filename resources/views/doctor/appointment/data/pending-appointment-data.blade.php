@if($appointments->isNotEmpty())
    @foreach($appointments as $appointment)
        <tr>
            <td class="text-center">{{ $loop->iteration + $appointments->firstItem() - 1 }}</td>
            <td class="text-center"> {{ $appointment->user->name }} </td>
            <td class="text-center"> {{ $appointment->age }} </td>
            <td class="text-center"> {{ $appointment->address }}, {{ $appointment->city }} </td>
            <td class="text-center"> {{ $appointment->appointmentType->appt_type_name }} ({{ $appointment->appointmentType->appt_type_code }}) </td>
            <td class="text-center">
                <select class="form-select-xs select-status border border-0
                    {{ $appointment->status == 'pending' ? 'bg-warning' : '' }}
                    {{ $appointment->status == 'approved' ? 'bg-success text-light' : '' }}
                    {{ $appointment->status == 'cancelled' ? 'bg-danger text-light' : '' }}" data-id="{{ $appointment->id }}">
                    @if($appointment->status == 'pending')
                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $appointment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    @elseif($appointment->status == 'approved')
                        <option value="approved" {{ $appointment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    @elseif($appointment->status == 'cancelled')
                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    @endif
                </select>
            </td>
        </tr>
    @endforeach
@else
    <td colspan="7" class="text-center text-small text-danger">No appointment is found.</td>
@endif