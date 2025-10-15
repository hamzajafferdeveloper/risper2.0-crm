@extends('layouts.adminlayout')

@section('title', 'Dashboard')

@section('content-admin')
    <div class="grid grid-cols-12 gap-4 px-4 sm:px-6 lg:px-8">
        <div class="col-span-12">
            <div class="card border-0 overflow-hidden">

                <!-- Filters -->
                @include('admin.leads.partials.filter')

                <div
                    class="card-header flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 border-b border-gray-200 dark:border-gray-700 px-6 py-5 bg-white/70 dark:bg-gray-900/50 backdrop-blur-sm">
                    <h6
                        class="text-xl font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2 tracking-tight">
                        <iconify-icon icon="solar:users-group-rounded-bold-duotone"
                            class="text-[#8D35E3] text-2xl"></iconify-icon>
                        All Leads
                    </h6>

                    <div class="flex items-center gap-3">

                        <!-- Add Lead Button -->
                        <button id="openAddLeadModal"
                            class="flex items-center gap-2 !bg-gradient-to-r from-[#8D35E3] to-[#7B2FCC] hover:from-[#7B2FCC] hover:to-[#8D35E3] text-white font-medium px-4 py-2.5 rounded-lg shadow-md transition-all duration-200 hover:shadow-lg focus:ring-2 focus:ring-[#8D35E3]/30">
                            <iconify-icon icon="simple-line-icons:plus" class="text-base"></iconify-icon>
                            <span>Add Lead</span>
                        </button>
                    </div>
                </div>

                <div
                    class="overflow-x-auto sm:overflow-x-visible overflow-y-auto scrollbar-thin scrollbar-thumb-[#8D35E3]/70 scrollbar-track-transparent">
                    <table id="lead-table"
                        class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200 border-separate border-spacing-y-1">
                        <thead
                            class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 sticky top-0 z-10 shadow-sm">
                            <tr>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">S.L</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Name</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Email</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Added By</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Lead Owner</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Lead Watcher</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Lead Stage</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Date</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            <!-- Dynamic Rows -->
                        </tbody>
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
            // Destroy old table if exists
            if ($.fn.DataTable.isDataTable('#lead-table')) {
                $('#lead-table').DataTable().destroy();
            }

            $('.select2').each(function() {
                const placeholder = $(this).data('placeholder') || 'Select option';

                $(this).select2({
                    width: 'resolve',
                    placeholder: placeholder,
                    allowClear: true,
                    templateResult: formatStageOption, // Adds color dot for stages
                    templateSelection: formatStageOption
                });
            });

            // Color formatting for "Stage" dropdown only
            function formatStageOption(option) {
                if (!option.id) return option.text;
                const color = $(option.element).data('color');
                if (color) {
                    return $(
                        '<span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:' +
                        color + ';margin-right:6px;"></span>' + option.text + '</span>');
                }
                return option.text;
            }


            // ✅ DataTable initialization with filters
            let table = $('#lead-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.leads.index') }}",
                    data: function(d) {
                        d.added_by = $('#filterAddedBy').val();
                        d.owner_id = $('#filterOwner').val();
                        d.watcher_id = $('#filterWatcher').val();
                        d.stage_id = $('#filterStage').val();
                        d.start_date = $('#startDate').val();
                        d.end_date = $('#endDate').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            return `<a href="/admin/leads/${row.id}" class="text-[#8D35E3] hover:underline">${data}</a>`;
                        }
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
                        data: 'deal_watcher_name',
                        name: 'deal_watcher_name'
                    },
                    {
                        data: 'deal_stage_name',
                        name: 'deal_stage_name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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
                drawCallback: function() {
                    // re-init select2 in table after draw
                    $('.deal-stage-select').select2({
                        width: '100%'
                    });
                }
            });

            // Auto-apply filters when any filter changes (selects + dates)
            $('#filterAddedBy, #filterOwner, #filterWatcher, #filterStage').on('change', function() {
                table.ajax.reload();
            });
            // date inputs: react to change and typing (some browsers)
            $('#startDate, #endDate').on('change input', function() {
                table.ajax.reload();
            });

            // ✅ Apply & Reset Filter Buttons
            $('#applyFilters').on('click', () => table.ajax.reload());
            $('#resetFilters').on('click', () => {
                $('#filterAddedBy, #filterOwner, #filterWatcher, #filterStage').val('').trigger('change');
                $('#startDate, #endDate').val('');
                table.ajax.reload();
            });

            // ✅ Column visibility toggle dropdown
            $('#columnToggleBtn').on('click', function(e) {
                e.stopPropagation();
                $('#columnToggleMenu').toggleClass('hidden');
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#columnToggleBtn, #columnToggleMenu').length) {
                    $('#columnToggleMenu').addClass('hidden');
                }
            });

            // Toggle columns
            $('input.toggle-vis').on('change', function(e) {
                let column = table.column($(this).attr('data-column'));
                column.visible(!column.visible());
            });

            // ✅ Handle Deal Stage Update
            $(document).on('change', '.deal-stage-select', function() {
                const leadId = $(this).data('lead-id');
                const stageId = $(this).val();
                $.post("{{ route('admin.leads.updateStage') }}", {
                    _token: "{{ csrf_token() }}",
                    lead_id: leadId,
                    stage_id: stageId
                }, function(res) {
                    toastr.success(res.message || "Stage updated!");
                    table.ajax.reload(null, false);
                }).fail(() => toastr.error("Error updating stage"));
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
