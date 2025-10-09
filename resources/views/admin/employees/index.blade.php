@extends('layouts.adminlayout')

@section('title', 'Dashboard')

@section('content-admin')
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <div class="card border-0 overflow-hidden">
                <div class="card-header flex items-center justify-between">
                    <h6 class="card-title mb-0 text-lg">All Employees</h6>
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
                        class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate">
                        <thead>
                            <tr>
                                <th>S.L</th>
                                <th>Employee ID</th>
                                <th>Profile Pic</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
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

    <!-- Edit Employee Modal -->
    <div id="editEmployeeModal"
        class="hidden flex fixed inset-0 z-50  justify-end bg-black/50 transition-opacity duration-300">

        <!-- Modal Panel -->
        <div id="editEmployeePanel"
            class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl p-6 w-full max-w-7xl z-10 transform translate-x-full transition-transform duration-300">

            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-lg font-semibold">Edit Member</h2>
                <button class="closeEditModal text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <form id="editEmployeeForm" enctype="multipart/form-data"
                class="row g-3 max-h-[90vh] flex flex-col gap-3 overflow-y-auto px-5">
                @csrf

                <div class="sm:flex gap-3">
                    <!-- Left Section -->
                    <div class="flex flex-col gap-3 sm:w-[calc(100%-208px)] w-full mr-4">
                        <div class="sm:flex gap-3">
                            <!-- Employee ID -->
                            <div class="w-full sm:w-1/3">
                                <label class="form-label">Employee ID *</label>
                                <input type="text" name="employee_id" class="form-control" required>
                            </div>

                            <!-- Salutation -->
                            <div class="w-full sm:w-1/3">
                                <label class="form-label">Salutation</label>
                                <select name="salutation" class="form-select select2">
                                    <option value="">Select</option>
                                    <option>Mr</option>
                                    <option>Mrs</option>
                                    <option>Miss</option>
                                    <option>Dr.</option>
                                    <option>Sir</option>
                                    <option>Madam</option>
                                </select>
                            </div>

                            <!-- Name -->
                            <div class="w-full sm:w-1/3">
                                <label class="form-label">Full Name *</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mage:user"></iconify-icon>
                                    </span>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="sm:flex gap-3 w-full">
                            <!-- Email -->
                            <div class="w-full sm:w-1/2">
                                <label class="form-label">Email *</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mage:email"></iconify-icon>
                                    </span>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="w-full sm:w-1/2">
                                <label class="form-label">Password *</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                    </span>
                                    <input type="password" name="password" class="form-control" placeholder="*******">
                                </div>
                            </div>
                        </div>

                        <div class="sm:flex gap-3 w-full">

                            <div class="w-full sm:w-1/3">
                                <label class="form-label">Gender *</label>
                                <select name="gender" class="form-select select2" required>
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Country -->
                            <div class="w-full sm:w-1/3">
                                <label class="form-label">Country</label>
                                <select name="country_id" class="form-select select2">
                                    <option value="">Select</option>
                                </select>
                            </div>

                            <!-- Mobile -->
                            <div class="w-full sm:w-1/3">
                                <label class="form-label">Mobile</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                                    </span>
                                    <input type="text" name="mobile" class="form-control"
                                        placeholder="+1 (555) 000-0000">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Pic -->
                    <div class="sm:w-52 relative">
                        <label class="form-label block mb-2">Profile Picture</label>
                        <div
                            class="sm:w-52 h-52 bg-neutral-200 dark:bg-neutral-600 rounded-md flex items-center justify-center overflow-hidden relative border border-gray-300">

                            <!-- Preview -->
                            <img id="editProfilePicPreview" src="" alt="Profile Picture"
                                class="w-full h-full object-cover" style="display:none;">

                            <!-- Placeholder Icon/Text -->
                            <span id="editProfilePicPlaceholder" class="text-gray-500 text-sm">Upload</span>

                            <!-- File Input Overlay -->
                            <input type="file" id="editProfilePicInput" name="profile_pic"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                        </div>
                        <!-- Remove Button -->
                        <button type="button" id="editRemoveProfilePicBtn"
                            class="hidden mt-2 text-red-500 text-sm underline">
                            Remove
                        </button>
                    </div>
                </div>

                <div class="sm:flex gap-3">
                    <!-- Reporting To -->
                    <div class="w-full sm:w-1/4">
                        <label class="form-label">Reporting To</label>
                        <select name="reporting_to" class="form-select select2">
                            <option value="">Select</option>
                        </select>
                    </div>

                    <!-- Language -->
                    <div class="w-full sm:w-1/4">
                        <label class="form-label">Language</label>
                        <select name="language_id" class="form-select select2">
                            <option value="">Select</option>
                        </select>
                    </div>

                    <!-- Designation -->
                    <div class="w-full sm:w-1/4">
                        <label class="form-label">Designation</label>
                        <select name="designation_id" class="form-select select2">
                            <option value="">Select</option>
                        </select>
                    </div>

                    <!-- Department -->
                    <div class="w-full sm:w-1/4">
                        <label class="form-label">Department</label>
                        <select name="department_id" class="form-select select2">
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>

                <div class="sm:flex gap-3">
                    <!-- Joining Date -->
                    <div class="w-full sm:w-1/2">
                        <label class="form-label">Joining Date *</label>
                        <input type="date" name="joining_date" class="form-control" required>
                    </div>

                    <!-- DOB -->
                    <div class="w-full sm:w-1/2">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control">
                    </div>
                </div>

                <!-- Address -->
                <div class="col-md-12">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2"></textarea>
                </div>

                <!-- About -->
                <div class="col-md-12">
                    <label class="form-label">About</label>
                    <textarea name="about" class="form-control" rows="3"></textarea>
                </div>

                <!-- Skills (Multi-select with tagging) -->
                <div class="col-md-6">
                    <label class="form-label">Skills</label>
                    <div id="skills-container" class="d-flex flex-wrap" style="gap: 6px; min-height: 38px;">
                        <input type="text" id="skill-input" class="form-control border"
                            placeholder="Type and press Enter" />
                    </div>
                    <input type="hidden" name="skills" class="form-control" id="skills-hidden">
                </div>

                {{-- Seperator --}}
                <div class="my-6 flex items-center">
                    <div class="flex-grow border-t border-neutral-300 dark:border-neutral-600"></div>
                    <span class="px-4 text-sm font-medium text-gray-600 dark:text-gray-300">Other Details</span>
                    <div class="flex-grow border-t border-neutral-300 dark:border-neutral-600"></div>
                </div>

                <div class="sm:flex items-center gap-5">
                    <div class="w-full sm:w-1/2">
                        <label class="form-label">Permissions</label>
                        <div class="flex w-full items-center gap-3">
                            <!-- Login Allowed -->
                            <div class="flex items-center gap-3 w-1/2">
                                <label class="form-label" style="margin-bottom: unset !important">Login Allowed</label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="login_allowed" class="sr-only peer toggle-input"
                                        checked>
                                    <span
                                        class="relative w-11 h-6 bg-gray-400 peer-focus:outline-none rounded-full peer dark:bg-gray-500
                       peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                       peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px]
                       after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                       after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600">
                                    </span>
                                    <span
                                        class="line-height-1 font-medium ms-3 toggle-label text-md text-gray-600 dark:text-gray-300">
                                        Yes
                                    </span>
                                </label>
                            </div>

                            <!-- Email Notifications -->
                            <div class="flex items-center gap-3 w-1/2">
                                <label class="form-label" style="margin-bottom: unset !important">Receive Email
                                    Notifications</label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="receive_email_notification"
                                        class="sr-only peer toggle-input" checked>
                                    <span
                                        class="relative w-11 h-6 bg-gray-400 peer-focus:outline-none rounded-full peer dark:bg-gray-500
                       peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                       peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px]
                       after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                       after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600">
                                    </span>
                                    <span
                                        class="line-height-1 font-medium ms-3 toggle-label text-md text-gray-600 dark:text-gray-300">
                                        Yes
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Slack ID -->
                    {{-- <div class="w-full sm:w-1/3">
            <label class="form-label">Slack Member ID</label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 border rounded-e-0 border-e-0 rounded-s-md border-neutral-200 dark:border-neutral-600">
                    @
                </span>
                <input type="text" name="slack_member_id"
                    class="form-control grow rounded-ss-none rounded-es-none" placeholder="info@gmail.com">
            </div>
        </div> --}}

                    <div class="w-full sm:w-1/2">
                        <label class="form-label">Hourly Rate</label>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 border rounded-e-0 border-e-0 rounded-s-md border-neutral-200 dark:border-neutral-600">
                                $
                            </span>
                            <input type="number" name="hourly_rate"
                                class="form-control grow rounded-ss-none rounded-es-none" placeholder="45">
                        </div>
                    </div>

                </div>

                <div class="sm:flex gap-3">
                    <!-- Probation End Date -->
                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Probation End Date</label>
                        <input type="date" name="probation_end_date" class="form-control">
                    </div>

                    <!-- Notice Period -->
                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Notice Period Start</label>
                        <input type="date" name="notice_period_start_date" class="form-control">
                    </div>
                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Notice Period End</label>
                        <input type="date" name="notice_period_end_date" class="form-control">
                    </div>
                </div>

                <div class="sm:flex gap-3">
                    <!-- Employee Type -->
                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Employee Type</label>
                        <select name="employee_type_id" class="form-select select2">
                            <option value="">Select</option>
                        </select>
                    </div>

                    <!-- Marital Status -->
                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Marital Status *</label>
                        <select name="marital_status" class="form-select select2" required>
                            <option value="">Select</option>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widower</option>
                            <option>Widow</option>
                            <option>Separate</option>
                            <option>Divorced</option>
                            <option>Engaged</option>
                        </select>
                    </div>

                    <!-- Business Address -->
                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Business Address</label>
                        <select name="business_address_id" class="form-select select2">
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>

                <!-- Submit -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary !bg-[#8D35E3] px-4">Save Employee</button>
                </div>
            </form>
        </div>
    </div>

    <x-confirm />
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
                ajax: "{{ route('admin.employees.index') }}",
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
                            return `<img src="/storage/${data}" class="w-12 h-12 rounded-xl" />`;
                        },
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
                        data: 'mobile',
                        name: 'mobile'
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
                openModal('confirmModal', 'confirmPanel');
            });

            // Cancel
            $('#cancelDelete').on('click', function() {
                closeModal('confirmModal', 'confirmPanel');
                deleteId = null;
            });

            // Confirm delete
            $('#confirmDelete').on('click', function() {
                if (!deleteId) return;

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
                        toastr.error('❌ An error occurred while deleting the employee.',
                            'Error');
                    },
                    complete: function() {
                        closeModal('confirmModal', 'confirmPanel');
                        deleteId = null;
                    }
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
                        populateDropdown('country_id', response.countries);
                        populateDropdown('department_id', response.departments);
                        populateDropdown('designation_id', response.designations);
                        populateDropdown('language_id', response.languages);
                        populateDropdown('employee_type_id', response.employee_types);
                        populateDropdown('business_address_id', response.business_addresses);
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
