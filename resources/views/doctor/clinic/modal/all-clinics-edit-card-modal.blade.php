<div class="modal fade" id="allClinicsEditModal" tabindex="-1" aria-labelledby="allClinicsEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="allClinicsEditModalLabel">Healthcare Facilities Directory: Update Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="mb-0 m-3">
                    <table class="table table-borderless" id="delete-clinic-table">
                        <tbody>
                            <tr>
                                @if($clinics->isNotEmpty())
                                    @foreach($clinics as $clinic)
                                        <tr>
                                            <td> {{ $clinic->name }} </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning w-100 modal-edit-button" data-id="{{ $clinic->id }}">
                                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center">No healthcare facilities found.</td>
                                    </tr>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


                