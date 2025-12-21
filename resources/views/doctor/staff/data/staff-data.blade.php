
            @if($staffs->isNotEmpty())
                @foreach($staffs as $staff)
                    <tr>
                        <td> {{ $loop->iteration + $staffs->firstItem() - 1}} </td>
                        <td> {{ $staff->user->name }} </td>
                        <td>
                            <button class="btn btn-xs btn-outline-dark">
                                @if($staff->working_section == 'nurse')
                                    <span class="text-success fw-bold">NUR</span>
                                @elseif($staff->working_section == 'assistant')
                                    <span class="text-warning fw-bold">ASS</span>
                                @elseif($staff->working_section == 'receptionist')
                                    <span class="text-primary fw-bold">REC</span>
                                @elseif($staff->working_section == 'technician')
                                    <span class="text-info fw-bold">TEC</span>
                                @elseif($staff->working_section == 'senior_nurse')
                                    <span class="text-danger fw-bold">SNR</span>
                                @else
                                    <span class="text-muted fw-bold">UNK</span>
                                @endif
                                <span class="fw-bold"> - {{ str_pad($staff->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </button>
                        </td>
                        <td>
                            @if($staff->working_section == 'nurse')
                                <span>Nurse</span>
                            @elseif($staff->working_section == 'assistant')
                                <span>Assistant</span>
                            @elseif($staff->working_section == 'receptionist')
                                <span>Receptionist</span>
                            @elseif($staff->working_section == 'technician')
                                <span>Technician</span>
                            @elseif($staff->working_section == 'senior_nurse')
                                <span>Senior Nurse</span>
                            @else
                                <span>Unknown</span>
                            @endif
                        </td>
                        <td>
                            @if($staff->employment_status == 'active')
                                <button 
                                    class="btn btn-xs btn-outline-success status-btn" 
                                    data-status="active"
                                    data-id="{{ $staff->id }}"
                                    data-name="{{ $staff->user->name }}"
                                    data-wksection="{{ $staff->working_section }}"
                                    >Active
                                </button>
                            @elseif($staff->employment_status == 'on_leave')
                                <button 
                                    class="btn btn-xs btn-outline-warning status-btn" 
                                    data-status="on_leave"
                                    data-id="{{ $staff->id }}"
                                    data-name="{{ $staff->user->name }}"
                                    data-wksection="{{ $staff->working_section }}"
                                    >On Leave
                                </button>
                            @elseif($staff->employment_status == 'sicked')
                                <button 
                                    class="btn btn-xs btn-outline-info status-btn" 
                                    data-status="sicked"
                                    data-id="{{ $staff->id }}"
                                    data-name="{{ $staff->user->name }}"
                                    data-wksection="{{ $staff->working_section }}"
                                    >Sick Leave
                                </button>
                            @else
                                <button 
                                    class="btn btn-xs btn-outline-warning status-btn" 
                                    data-status="festival_off"
                                    data-id="{{ $staff->id }}"
                                    data-name="{{ $staff->user->name }}"
                                    data-wksection="{{ $staff->working_section }}"
                                    >Festival Off
                                </button>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-xs btn-info">More details</button>
                        </td>
                        <td>
                            <button class="btn btn-xs btn-primary">
                                <i class="fas fa-calendar-alt me-1"></i> View Schedule
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-xs btn-warning edit-btn me-1"  data-id="{{ $staff->id }}" data-name="{{ $staff->user->name }}"><i class="fas fa-clipboard-check me-1"></i> Assign Schedule</button>
                            <button class="btn btn-xs btn-danger delete-btn"
                                    data-user-id="{{ $staff->user->id }}"
                                    data-staff-id="{{ $staff->id }}" 
                                    data-name="{{ $staff->user->name }}">
                                <i class="fa-solid fa-trash-can me-1"></i>Delete Staff
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif