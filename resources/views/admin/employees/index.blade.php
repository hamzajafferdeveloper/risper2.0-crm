@extends('layouts.adminlayout')

@section('title', 'Dashboard')

@section('content-admin')
    <div class="grid grid-cols-12">
        <div class="col-span-12">

            <div class="card border-0 overflow-hidden">

                @include('admin.employees.partials.filter')

                <div class="card-header flex items-center justify-between">
                    <div class="flex gap-1 ">
                        <iconify-icon icon="solar:case-minimalistic-bold-duotone"
                            class="text-[#8D35E3] text-2xl"></iconify-icon>
                        <h6 class="card-title mb-0 text-xl">All Employees</h6>
                    </div>
                    <div>
                        <button id="openAddEmployeeModal"
                            class="flex items-center gap-2 !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 text-white font-medium px-2.5 py-2.5 rounded-lg float-end me-4 transition">
                            <iconify-icon icon="simple-line-icons:plus" class="text-lg"></iconify-icon>
                            <p class="text-sm">Add Employee</p>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="employees-table"
                        class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200 border-separate border-spacing-y-1">
                        <thead
                            class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 sticky top-0 z-10 shadow-sm">
                            <tr>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">S.L</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Employee ID</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Profile Pic</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Name</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Email</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Mobile</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Reporting To</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Designation</th>
                                <th class="px-4 py-3 font-semibold whitespace-nowrap">Department</th>
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
    <div id="addEmployeeModal"
        class="hidden flex fixed inset-0 z-50  justify-end bg-black/50 transition-opacity duration-300">

        <!-- Modal Panel -->
        <div id="addEmployeePanel"
            class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl p-6 w-full max-w-7xl z-10 transform translate-x-full transition-transform duration-300">

            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-lg font-semibold">Add New Employee</h2>
                <button class="closeAddModal text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <x-admin.add-employee-form />
        </div>
    </div>

    @include('admin.employees.partials.edit-form')
@endsection

@push('scripts')
    <script>
        let table;
        let deleteId = null;

        const fileInput = document.getElementById("editProfilePicInput");
        const preview = document.getElementById("editProfilePicPreview");
        const placeholder = document.getElementById("editProfilePicPlaceholder");
        const removeBtn = document.getElementById("editRemoveProfilePicBtn");

        fileInput.addEventListener("change", () => {
            const file = fileInput.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = "block";
                placeholder.style.display = "none";
                removeBtn.classList.remove("hidden");
            }
        });

        removeBtn.addEventListener("click", () => {
            fileInput.value = "";
            preview.src = "";
            preview.style.display = "none";
            placeholder.style.display = "block";
            removeBtn.classList.add("hidden");
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

        $(document).ready(function() {

            if ($.fn.DataTable.isDataTable('#employees-table')) {
                $('#employees-table').DataTable().destroy();
            }

            table = $('#employees-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.employees.index') }}",
                    data: function(d) {
                        d.reporting_to = $('#filterReportingTo').val();
                        d.designation_id = $('#filterDesignation').val();
                        d.department_id = $('#filterDepartment').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'employee_id',
                        name: 'employee_id'
                    },
                    {
                        data: 'profile_pic',
                        name: 'profile_pic',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `<img src="/storage/${data}" class="w-8 h-8 rounded-xl" />`;
                        },
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            return `<a href="/admin/employees/${row.id}" class="hover:underline">${data}</a>`;
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
                        data: 'reporting_to',
                        name: 'reporting_to'
                    },
                    {
                        data: 'designation',
                        name: 'designation'
                    },
                    {
                        data: 'department_name',
                        name: 'department_name'
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


            // ✅ Filters Reload
            $('#filterReportingTo, #filterDesignation, #filterDepartment').on('change', function() {
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

            // ========== Add Employee Modal ========== //
            $('#openAddEmployeeModal').on('click', function() {
                openModal('addEmployeeModal', 'addEmployeePanel');
            });

            $('.closeAddModal').on('click', function() {
                closeModal('addEmployeeModal', 'addEmployeePanel');
            });

            $('#addEmployeeModal').on('click', function(e) {
                if (e.target.id === 'addEmployeeModal') {
                    closeModal('addEmployeeModal', 'addEmployeePanel');
                }
            });

            // ========== Edit Employee Modal ========== //
            $(document).on('click', '.editEmployee', function(e) {
                e.preventDefault();
                let employeeId = $(this).data('id');

                // Open modal
                openModal('editEmployeeModal', 'editEmployeePanel');
            });


            $('.closeEditModal').on('click', function() {
                closeModal('editEmployeeModal', 'editEmployeePanel');
                window.history.pushState({}, '', '/admin/employees');
            });


            $('#editEmployeeModal').on('click', function(e) {
                if (e.target.id === 'editEmployeeModal') {
                    closeModal('editEmployeeModal', 'editEmployeePanel');
                    window.history.pushState({}, '', '/admin/employees');
                }
            });

            // Open confirm modal when delete clicked
            $(document).on('click', '.deleteEmployee', function(e) {
                e.preventDefault();
                deleteId = $(this).data('id');
                confirmDelete(() => {
                    $.ajax({
                        url: "/admin/employees/" + deleteId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            toastr.success('Employee deleted successfully!', 'Success');
                            table.ajax.reload();
                        },
                        error: function() {
                            toastr.error(
                                '❌ An error occurred while deleting the employee.',
                                'Error');
                        },
                        complete: function() {
                            closeModal('confirmModal', 'confirmPanel');
                            deleteId = null;
                        }
                    });
                });
            });

            // =================== Add Employee =================== //
            $(document).on('submit', '#addEmployeeForm', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.employees.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        toastr.success('Employee added successfully!', 'Success');
                        table.ajax.reload();
                        $('#addEmployeeModal').addClass('hidden');
                        $('#addEmployeeForm')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ An error occurred while adding the employee.',
                                'Error');
                        }
                    }
                });
            });

            // ========== Edit Employee Modal ========== //
            $(document).on('click', '.editEmployee', function(e) {
                e.preventDefault();
                let employeeId = $(this).data('id');
                // Open modal
                openModal('editEmployeeModal', 'editEmployeePanel');

                const form = $('#editEmployeeModal form');
                form.attr('data-id', employeeId); // now the form knows the employee ID
                form[0].reset();

                // STEP 1: Fetch dropdown data first
                $.ajax({
                    url: "/employee/get-dropdown-data", // returns countries, departments, etc.
                    type: "GET",
                    success: function(response) {
                        console.log(response);
                        populateDropdown('country_id', response.countries);
                        populateDropdown('department_id', response.departments);
                        populateDropdown('designation_id', response.designations);
                        populateDropdown('language_id', response.languages);
                        populateEmploymentTypeDropdown('employee_type_id', response
                            .employmentTypes);
                        populateBussniessAdrressDropdown('business_address_id', response
                            .bussinessAddresses);
                        populateDropdown('reporting_to', response.employees);

                        // STEP 2: After dropdowns filled → now load employee data
                        $.ajax({
                            url: `/admin/employees/${employeeId}/edit`,
                            type: "GET",
                            success: function(employee) {
                                fillEmployeeForm(form, employee);
                            },
                            error: function() {
                                toastr.error('Failed to load employee data');
                            }
                        });
                    },
                    error: function() {
                        toastr.error('Failed to load dropdown data');
                    }
                });
            });

            // Helper: Populate dropdown options
            function populateDropdown(name, data) {
                const select = $(`select[name="${name}"]`);

                // Ensure dropdown and data exist
                if (!select.length) {
                    console.warn(`⚠️ No <select name="${name}"> found`);
                    return;
                }
                if (!Array.isArray(data)) {
                    console.warn(`⚠️ Invalid or missing data for "${name}":`, data);
                    return;
                }

                select.empty().append('<option value="">Select</option>');
                data.forEach(item => {
                    select.append(`<option value="${item.id}">${item.name}</option>`);
                });
                select.trigger('change');
            }

            function populateEmploymentTypeDropdown(name, data) {
                const select = $(`select[name="${name}"]`);

                // Ensure dropdown and data exist
                if (!select.length) {
                    console.warn(`⚠️ No <select name="${name}"> found`);
                    return;
                }
                if (!Array.isArray(data)) {
                    console.warn(`⚠️ Invalid or missing data for "${name}":`, data);
                    return;
                }

                select.empty().append('<option value="">Select</option>');
                data.forEach(item => {
                    select.append(`<option value="${item.id}">${item.type}</option>`);
                });
                select.trigger('change');
            }

            function populateBussniessAdrressDropdown(name, data) {
                const select = $(`select[name="${name}"]`);

                // Ensure dropdown and data exist
                if (!select.length) {
                    console.warn(`⚠️ No <select name="${name}"> found`);
                    return;
                }
                if (!Array.isArray(data)) {
                    console.warn(`⚠️ Invalid or missing data for "${name}":`, data);
                    return;
                }

                select.empty().append('<option value="">Select</option>');
                data.forEach(item => {
                    select.append(`<option value="${item.id}">${item.address}</option>`);
                });
                select.trigger('change');
            }

            // Helper: Fill form fields after dropdowns loaded
            function fillEmployeeForm(form, employee) {
                form.find('input[name="employee_id"]').val(employee.employee_id);
                form.find('input[name="name"]').val(employee.name);
                form.find('input[name="email"]').val(employee.email);
                form.find('input[name="mobile"]').val(employee.mobile);
                form.find('input[name="hourly_rate"]').val(employee.hourly_rate);
                form.find('input[name="joining_date"]').val(employee.joining_date);
                form.find('input[name="date_of_birth"]').val(employee.date_of_birth);
                form.find('textarea[name="address"]').val(employee.address);
                form.find('textarea[name="about"]').val(employee.about);
                form.find('input[name="probation_end_date"]').val(employee.probation_end_date);
                form.find('input[name="notice_period_start_date"]').val(employee.notice_period_start_date);
                form.find('input[name="notice_period_end_date"]').val(employee.notice_period_end_date);

                // Select dropdowns
                form.find('select[name="salutation"]').val(employee.salutation).trigger('change');
                form.find('select[name="gender"]').val(employee.gender).trigger('change');
                form.find('select[name="country_id"]').val(employee.country_id).trigger('change');
                form.find('select[name="reporting_to"]').val(employee.reporting_to).trigger('change');
                form.find('select[name="language_id"]').val(employee.language_id).trigger('change');
                form.find('select[name="designation_id"]').val(employee.designation_id).trigger('change');
                form.find('select[name="department_id"]').val(employee.department_id).trigger('change');
                form.find('select[name="employee_type_id"]').val(employee.employee_type_id).trigger('change');
                form.find('select[name="marital_status"]').val(employee.marital_status).trigger('change');
                form.find('select[name="business_address_id"]').val(employee.business_address_id).trigger('change');

                // Profile pic
                const fileInput = document.getElementById("editProfilePicInput");
                const preview = document.getElementById("editProfilePicPreview");
                const placeholder = document.getElementById("editProfilePicPlaceholder");
                const removeBtn = document.getElementById("editRemoveProfilePicBtn");

                if (employee.profile_pic) {
                    const imgUrl = `/storage/${employee.profile_pic}`;

                    preview.src = imgUrl;
                    preview.style.display = "block";
                    placeholder.style.display = "none";
                    removeBtn.classList.remove("hidden");
                } else {
                    preview.style.display = "none";
                    placeholder.style.display = "block";
                    removeBtn.classList.add("hidden");
                }

                // Toggle switches
                form.find('input[name="login_allowed"]').prop('checked', !!employee.login_allowed);
                form.find('input[name="receive_email_notification"]').prop('checked', !!employee
                    .receive_email_notification);
            }

            // =================== Update Employee =================== //
            $(document).on('submit', '#editEmployeeModal form', function(e) {
                e.preventDefault();
                let form = $(this);
                let employeeId = $('#editEmployeeForm').attr('data-id')
                let formData = new FormData(this);

                console.log(employeeId)

                formData.append('_method', 'PUT');

                $.ajax({
                    url: `/admin/employees/${employeeId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        toastr.success('Employee updated successfully!', 'Success');
                        table.ajax.reload();
                        closeModal('editEmployeeModal', 'editEmployeePanel');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ Failed to update employee.', 'Error');
                        }
                    }
                });
            });


        })
    </script>
@endpush
