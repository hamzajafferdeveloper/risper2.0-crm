@extends('layouts.adminlayout')

@section('title', 'Dashboard')

@section('content-admin')
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <div class="card border-0 overflow-hidden">
                <div class="card-header flex items-center justify-between">
                    <h6 class="card-title mb-0 text-lg">All Leads</h6>
                    <div>
                        <button id="openAddLeadModal"
                            class="flex items-center gap-2 !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 text-white font-medium px-2.5 py-2.5 rounded-lg float-end me-4 transition">
                            <iconify-icon icon="simple-line-icons:plus" class="text-lg"></iconify-icon>
                            <p class="text-sm">Add Lead</p>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="lead-table"
                        class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate">
                        <thead>
                            <tr>
                                <th>S.L</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Added By</th>
                                <th>Lead Owner</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Employee Modal -->
    <div id="addLeadModal" class="hidden flex fixed inset-0 z-50  justify-end bg-black/50 transition-opacity duration-300">

        <!-- Modal Panel -->
        <div id="addLeadPanel"
            class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl p-6 w-full max-w-7xl z-10 transform translate-x-full transition-transform duration-300">

            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-lg font-semibold">Add New Lead</h2>
                <button class="closeAddModal text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <x-admin.add-lead-form />
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let table;

        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#lead-table')) {
                $('#lead-table').DataTable().destroy();
            }

            table = $('#lead-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.leads.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },

                    {
                        data: 'lead_added_by_name',
                        name: 'lead_added_by_name'
                    },
                    {
                        data: 'lead_owner_name',
                        name: 'lead_owner_name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [1, 'asc']
                ],
                pagingType: "full_numbers",
                language: {
                    paginate: {
                        first: "« First",
                        last: "Last »",
                        previous: "‹",
                        next: "›"
                    }
                }
            });

            // =================== Modal Controls =================== //
            // Utility: open modal
            function openModal(modalId, panelId) {
                $(`#${modalId}`).removeClass('hidden');
                setTimeout(() => {
                    $(`#${panelId}`).removeClass('translate-x-full');
                }, 10);
            }

            // Utility: close modal
            function closeModal(modalId, panelId) {
                $(`#${panelId}`).addClass('translate-x-full');
                setTimeout(() => {
                    $(`#${modalId}`).addClass('hidden');
                }, 150);
            }

            // ========== Add Lead Modal ========== //
            $('#openAddLeadModal').on('click', function() {
                openModal('addLeadModal', 'addLeadPanel');
            });

            $('.closeAddModal').on('click', function() {
                closeModal('addLeadModal', 'addLeadPanel');
            });

            $('#addLeadModal').on('click', function(e) {
                if (e.target.id === 'addLeadModal') {
                    closeModal('addLeadModal', 'addLeadPanel');
                }
            });


            let actionType = "save"; // default

            // Detect which button is clicked
            $('#addLeadForm button[type="submit"], #addLeadForm button.save-add-more').on('click', function() {
                if ($(this).hasClass('save-add-more')) {
                    actionType = "save_add_more";
                } else {
                    actionType = "save";
                }
            });

            $('#addLeadForm').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.leads.store') }}",
                    type: "POST",
                    data: formData,
                    success: function() {
                        toastr.success('✅ Lead added successfully!', 'Success');
                        table.ajax.reload();

                        if (actionType === "save") {
                            // Close modal and reset
                            $('#addLeadModal').addClass('hidden');
                            $('#addLeadForm')[0].reset();
                        } else if (actionType === "save_add_more") {
                            // Just reset form, keep modal open
                            $('#addLeadForm')[0].reset();
                            // Re-init select2 after reset
                            if (window.jQuery && typeof jQuery.fn.select2 === 'function') {
                                jQuery('.select2').val('').trigger('change');
                            }
                        }

                        // Reset action type back
                        actionType = "save";
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ An error occurred while adding the lead.', 'Error');
                        }
                    }
                });
            });
        });
    </script>
@endpush
