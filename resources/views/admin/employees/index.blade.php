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

            <x-admin.edit-employee-form />
        </div>
    </div>

    <x-confirm />
@endsection

@push('scripts')
    <script>
        let table;
        let deleteId = null;

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
        })
    </script>
@endpush
