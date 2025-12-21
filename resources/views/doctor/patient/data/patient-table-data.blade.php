@if($patients->isNotEmpty())
    @foreach($patients as $patient)
        <tr>
            <td class="text-center"> {{ $loop->iteration + $patients->firstItem() - 1 }} </td>
            <td class="text-center"> {{ $patient->name }} </td>
            <td class="text-center"> {{ $patient->email }} </td>
            <td class="text-center"> {{ substr($patient->phone, 0, 5) }}-{{ substr($patient->phone, 5, 7) }} </td>
            <td class="text-center"> {{ ucwords($patient->gender) }} </td>
            <td class="text-center">
                <button class="btn btn-xs btn-info details-btn" data-id="{{ $patient->id }}">More Details</button>
            </td>
        </tr>
    @endforeach
@endif