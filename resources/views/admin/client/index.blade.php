@extends('layouts.adminlayout')

@section('title', 'Clients')

@section('content-admin')
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <div class="card border-0 overflow-hidden">

                @include('admin.client.partials.filter')

                <div class="card-header flex items-center justify-between">
                    <div class="flex gap-1 ">
                        <iconify-icon icon="solar:bag-2-bold-duotone" class="text-[#8D35E3] text-2xl"></iconify-icon>
                        <h6 class="card-title mb-0 text-xl">All Clients</h6>
                    </div>
                    <div>
                        <button id="openAddClientModal"
                            class="flex items-center gap-2 !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 text-white font-medium px-2.5 py-2.5 rounded-lg float-end me-4 transition">
                            <iconify-icon icon="simple-line-icons:plus" class="text-lg"></iconify-icon>
                            <p class="text-sm">Add Client</p>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="Client-table"
                        class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200 border-separate border-spacing-y-1">
                        <thead
                            class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 sticky top-0 z-10 shadow-sm">
                            <tr>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">S.L</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Image</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Name</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Email</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Mobile</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Company</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Category</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Added By</th>
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
    @include('admin.client.partials.add-edit-modals')
@endsection

@push('scripts')
    <script>
        let table;

        $(document).ready(function() {

            if ($.fn.DataTable.isDataTable('#Client-table')) {
                $('#Client-table').DataTable().destroy();
            }

            $('.select2').each(function() {
                const placeholder = $(this).data('placeholder') || 'Select option';

                $(this).select2({
                    width: 'resolve',
                    placeholder: placeholder,
                    allowClear: true,
                });
            });

            // ✅ DataTable Initialization
            let table = $('#Client-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('admin.clients.index') }}",
                    data: function(d) {
                        d.company_id = $('#filterCompany').val();
                        d.category_id = $('#filterCategory').val();
                        d.added_by = $('#filterAddedBy').val();
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
                        data: 'profile_pic',
                        name: 'profile_pic',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `<img src="${data ? '/storage/' + data : '/assets/images/avatar/avatar.png'}"
                            class="w-10 h-10 rounded-xl object-cover border shadow-sm" />`;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            return `<a href="/admin/clients/${row.id}" class="text-[#8D35E3] hover:underline">${data}</a>`;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'added_by',
                        name: 'added_by',
                        orderable: false,
                        searchable: false
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
            });

            // ✅ Filters Reload
            $('#filterCompany, #filterCategory, #filterAddedBy, #startDate, #endDate').on('change', function() {
                table.ajax.reload();
            });

            // ✅ Reinitialize Select2 on DOM Changes
            $(document).on('select2:open', () => {
                document.querySelectorAll('.select2-search__field').forEach(el => el.focus());
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
                    $modal.find('.select2').each(function() {
                        const $select = $(this);

                        // Find the correct modal container for this select
                        const $dropdownParent = $select.closest(modalSelector);

                        $select.select2({
                            placeholder: "Search or select",
                            allowClear: true,
                            width: '100%',
                            dropdownParent: $dropdownParent.length ? $dropdownParent : $(document
                                .body)
                        });
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


            function fillClientForm(Client) {
                const form = $('#editClientForm'); // target only edit modal form
                console.log(Client.email);
                form.find('#ClientId').val(Client.id);
                form.find('select[name="salutation"]').val(Client.salutation).trigger('change');
                form.find('input[name="name"]').val(Client.name);
                form.find('input[name="email"]').val(Client.email);
                form.find('input[name="mobile"]').val(Client.mobile);

                form.find('select[name="country_id"]').val(Client.country_id).trigger('change');
                form.find('select[name="language"]').val(Client.language_id).trigger('change');
                form.find('select[name="gender"]').val(Client.gender).trigger('change');
                form.find('select[name="category_id"]').val(Client.category_id).trigger('change');
                form.find('select[name="sub_category_id"]').val(Client.sub_category_id).trigger('change');

                if (Client.company_address) {
                    form.find('input[name="company_name"]').val(Client.company_address.name);
                    form.find('input[name="tax_name"]').val(Client.company_address.tax_name);
                    form.find('input[name="tax_number"]').val(Client.company_address.tax_number);
                    form.find('select[name="added_by"]').val(Client.company_address.added_by).trigger('change');
                    form.find('input[name="office_phone_number"]').val(Client.company_address.office_phone_number);
                    form.find('input[name="website"]').val(Client.company_address.website);
                    form.find('textarea[name="address"]').val(Client.company_address.address);
                    form.find('textarea[name="shipping_address"]').val(Client.company_address.shipping_address);
                    form.find('input[name="city"]').val(Client.company_address.city);
                    form.find('input[name="state"]').val(Client.company_address.state);
                    form.find('input[name="postal_code"]').val(Client.company_address.postal_code);
                    form.find('textarea[name="note"]').val(Client.company_address.note);

                }

            }


            // ========== Add Client Modal ========== //
            $('#openAddClientModal').on('click', function() {
                openModal('addClientModal', 'addClientPanel');
                setTimeout(() => initSelect2('#addClientModal'), 200);
            });

            $('.closeAddModal').on('click', function() {
                $('#addClientForm')[0].reset();
                closeModal('addClientModal', 'addClientPanel');
            });

            $('#addClientModal').on('click', function(e) {
                if (e.target.id === 'addClientModal') {
                    $('#addClientForm')[0].reset();
                    closeModal('addClientModal', 'addClientPanel');
                }
            });

            $('#closeaddClientForm').on('click', function() {
                $('#addClientForm')[0].reset();
                closeModal('addClientModal', 'addClientPanel');
            })

            // ========== Edit Client Modal ========== //
            $(document).on('click', '.editClient', function() {
                const id = $(this).data('id');
                openModal('editClientModal', 'editClientPanel');
                setTimeout(() => initSelect2('#editClientModal'), 200);

                $.ajax({
                    url: `/admin/clients/${id}/edit`,
                    type: 'GET',
                    beforeSend: function() {
                        $('#editClientPanel .p-6').html(
                            '<div class="text-center py-10 text-gray-500">Loading Client...</div>'
                        );
                    },
                    success: function(response) {
                        fillClientForm(response.client);
                        syncCompanySection('editClientModal');

                    },
                    error: function() {
                        toastr.error('Failed to load Client details.');
                    }
                });
            });

            $('#editClientModal').on('click', function(e) {
                if (e.target.id === 'editClientModal') {

                    $('#editClientForm')[0].reset();
                    closeModal('editClientModal', 'editClientPanel');
                }
            });

            $('#closeeditClientForm').on('click', function() {
                $('#editClientForm')[0].reset();
                closeModal('editClientModal', 'editClientPanel');
            })

            let actionType = "save"; // default

            // Detect which button is clicked
            $('#addClientForm button[type="submit"], #addClientForm button.save-add-more').on('click', function() {
                if ($(this).hasClass('save-add-more')) {
                    actionType = "save_add_more";
                } else {
                    actionType = "save";
                }
            });
            $('#addClientForm, #editClientForm').on('submit', function(e) {
                e.preventDefault();

                const form = $(this)[0]; // Get the raw DOM element
                const formData = new FormData(form); // Collect all inputs, including files
                const ClientId = $(form).find('#ClientId').val();
                const url = ClientId ? `/admin/clients/${ClientId}` : `/admin/clients/store`;
                const method = ClientId ? 'PUT' : 'POST';

                // If updating, add _method manually (Laravel supports this)
                if (ClientId) {
                    formData.append('_method', 'PUT');
                }

                $('#saveBtn').prop('disabled', true).text('Saving...');

                $.ajax({
                    url: url,
                    type: 'POST', // Always POST with FormData + _method override
                    data: formData,
                    processData: false, // prevent jQuery from transforming data into a query string
                    contentType: false, // let browser set the multipart/form-data header
                    cache: false,
                    success: function() {
                        toastr.success(ClientId ? 'Client updated successfully!' :
                            'Client added successfully!');
                        form.reset();
                        closeModal(ClientId ? 'editClientModal' : 'addClientModal', ClientId ?
                            'editClientPanel' : 'addClientPanel');
                        if (typeof table !== 'undefined') {
                            table.ajax.reload();
                        }
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


            $(document).on('click', '.deleteClient', function() {
                const ClientId = $(this).data('id');
                const url = `/admin/clients/${ClientId}`;

                confirmDelete(() => {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            toastr.success('Client deleted successfully!');
                            table.ajax.reload();
                        },
                        error: function() {
                            toastr.error('Failed to delete Client.');
                        }
                    });
                });
            });
        });
    </script>
@endpush
