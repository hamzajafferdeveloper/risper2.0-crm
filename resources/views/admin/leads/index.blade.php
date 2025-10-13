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

            <x-admin.add-lead-form formId="addLeadForm" />
        </div>
    </div>
    <!-- Edit Employee Modal -->
    <div id="editLeadModal" class="hidden flex fixed inset-0 z-50  justify-end bg-black/50 transition-opacity duration-300">

        <!-- Modal Panel -->
        <div id="editLeadPanel"
            class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl p-6 w-full max-w-7xl z-10 transform translate-x-full transition-transform duration-300">

            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-lg font-semibold">Edit Lead</h2>
                <button class="closeEditModal text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <x-admin.add-lead-form formId="editLeadForm" />
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

            function confirmDelete(action) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "This record will be deleted permanently!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel",
                    customClass: {
                        confirmButton: "swal-confirm-btn",
                        cancelButton: "swal-cancel-btn"
                    },
                    buttonsStyling: false, // disable default SweetAlert2 styling
                    didRender: () => {
                        // optional: you can force a hover effect via JS if needed
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        action();
                    }
                });
            }

            function initSelect2(modalSelector) {
                const $modal = $(modalSelector);
                if (window.jQuery && typeof jQuery.fn.select2 === 'function') {
                    $modal.find('.select2').select2({
                        placeholder: "Search or select",
                        allowClear: true,
                        width: '100%',
                        dropdownParent: $modal.find('.relative') // ensures dropdown shows inside modal
                    });
                }
            }

            function syncCompanySection(modalId) {
                const form = $(`#${modalId} form`);
                const checkbox = form.find('#companyDetail');
                const section = form.find('#companySection');
                if (checkbox.length && section.length) {
                    section.toggleClass('hidden', !checkbox.prop('checked'));
                }
            }

            // =================== Utilities =================== //
            // Utility: open modal
            function openModal(modalId, panelId) {
                $(`#${modalId}`).removeClass('hidden');
                setTimeout(() => {
                    $(`#${panelId}`).removeClass('translate-x-full');
                }, 10);

                // ✅ Sync Company Details visibility
                syncCompanySection(modalId);
            }

            // Utility: close modal
            function closeModal(modalId, panelId) {
                $(`#${panelId}`).addClass('translate-x-full');
                setTimeout(() => {
                    $(`#${modalId}`).addClass('hidden');
                }, 150);
            }


            function fillLeadForm(lead) {
                const form = $('#editLeadForm'); // target only edit modal form

                form.find('#leadId').val(lead.id);
                form.find('select[name="salutation"]').val(lead.salutation).trigger('change');
                form.find('input[name="name"]').val(lead.name);
                form.find('input[name="email"]').val(lead.email);

                form.find('select[name="lead_source_id"]').val(lead.lead_source_id).trigger('change');
                form.find('select[name="added_by"]').val(lead.added_by).trigger('change');
                form.find('select[name="lead_owner"]').val(lead.lead_owner?.id || '').trigger('change');

                form.find('#auto_convert_lead_to_client').prop('checked', lead.auto_convert_lead_to_client ===
                    'yes');

                if (lead.company_detail) {
                    form.find('#companyDetail').prop('checked', true);
                    form.find('#companyDetail').triggerHandler('change');

                    form.find('input[name="company_name"]').val(lead.company_detail.name || '');
                    form.find('input[name="website"]').val(lead.company_detail.website || '');
                    form.find('input[name="mobile"]').val(lead.company_detail.mobile || '');
                    form.find('input[name="office_phone_number"]').val(lead.company_detail.office_phone_number ||
                        '');
                    form.find('select[name="country_id"]').val(lead.company_detail.country_id || '').trigger(
                        'change');
                    form.find('input[name="state"]').val(lead.company_detail.state || '');
                    form.find('input[name="city"]').val(lead.company_detail.city || '');
                    form.find('input[name="postal_code"]').val(lead.company_detail.postal_code || '');
                    form.find('textarea[name="address"]').val(lead.company_detail.address || '');
                } else {
                    form.find('#companyDetail').prop('checked', false).trigger('change');
                }
            }


            // ========== Add Lead Modal ========== //
            $('#openAddLeadModal').on('click', function() {
                openModal('addLeadModal', 'addLeadPanel');
                setTimeout(() => initSelect2('#addLeadModal'), 200);
            });

            $('.closeAddModal').on('click', function() {
                $('#addLeadForm')[0].reset();
                closeModal('addLeadModal', 'addLeadPanel');
            });

            $('#addLeadModal').on('click', function(e) {
                if (e.target.id === 'addLeadModal') {
                    $('#addLeadForm')[0].reset();
                    closeModal('addLeadModal', 'addLeadPanel');
                }
            });

            $('#closeModal').on('click', function() {
                $('#addLeadForm')[0].reset();
                closeModal('editLeadModal', 'editLeadPanel');
                closeModal('addLeadModal', 'addLeadPanel');
            })

            // ========== Edit Lead Modal ========== //
            $(document).on('click', '.editLead', function() {
                const id = $(this).data('id');
                openModal('editLeadModal', 'editLeadPanel');
                setTimeout(() => initSelect2('#editLeadModal'), 200);

                $.ajax({
                    url: `/admin/leads/${id}/edit`,
                    type: 'GET',
                    beforeSend: function() {
                        $('#editLeadPanel .p-6').html(
                            '<div class="text-center py-10 text-gray-500">Loading Lead...</div>'
                        );
                    },
                    success: function(response) {
                        fillLeadForm(response.lead);
                        syncCompanySection('editLeadModal');

                    },
                    error: function() {
                        toastr.error('Failed to load lead details.');
                    }
                });
            });

            $('#editLeadModal').on('click', function(e) {
                if (e.target.id === 'editLeadModal') {

                    $('#editLeadForm')[0].reset();
                    closeModal('editLeadModal', 'editLeadPanel');
                }
            });

            $('#closeModal').on('click', function() {
                $('#editLeadForm')[0].reset();
                closeModal('editLeadModal', 'editLeadPanel');
            })

            let actionType = "save"; // default

            // Detect which button is clicked
            $('#addLeadForm button[type="submit"], #addLeadForm button.save-add-more').on('click', function() {
                if ($(this).hasClass('save-add-more')) {
                    actionType = "save_add_more";
                } else {
                    actionType = "save";
                }
            });

            $('#addLeadForm, #editLeadForm').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const leadId = form.find('#leadId').val();
                const url = leadId ? `/admin/leads/${leadId}` : `/admin/leads/store`;
                const method = leadId ? 'PUT' : 'POST';

                $('#saveBtn').prop('disabled', true).text('Saving...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize() + (leadId ? '&_method=PUT' : ''),
                    success: function() {
                        toastr.success(leadId ? 'Lead updated successfully!' :
                            'Lead added successfully!');
                        form[0].reset();
                        closeModal(leadId ? 'editLeadModal' : 'addLeadModal', leadId ?
                        'editLeadPanel' : 'addLeadPanel');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error('An error occurred.');
                        }
                    },
                    complete: function() {
                        $('#saveBtn').prop('disabled', false).text('Save');
                    }
                });
            });

            $(document).on('click', '.deleteLead', function() {
                const leadId = $(this).data('id');
                const url = `/admin/leads/${leadId}`;

                confirmDelete(() => {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            toastr.success('Lead deleted successfully!');
                            table.ajax.reload();
                        },
                        error: function() {
                            toastr.error('Failed to delete lead.');
                        }
                    });
                });
            });
        });
    </script>
@endpush
