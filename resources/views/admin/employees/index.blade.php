@extends('layouts.adminlayout')

@section('title', 'Dashboard')

@section('content-admin')
    <div x-data="{ showModal: false, showEditModal: false, editEmployeeId: null }" class="grid grid-cols-12">

        <div class="col-span-12">
            <div class="card border-0 overflow-hidden">
                <div class="card-header flex items-center justify-between">
                    <h6 class="card-title mb-0 text-lg">All Employees</h6>
                    <div>
                        <button @click="showModal = true"
                            class="flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-medium px-2.5 py-2.5 rounded-lg float-end me-4 transition">
                            <iconify-icon icon="simple-line-icons:plus" class="text-lg"></iconify-icon>
                            <p class="text-sm">Add Member</p>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Profile Pic</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Employee Modal -->
        <div x-show="showModal" x-cloak @keydown.escape.window="showModal = false"
            class="fixed inset-0 z-50 flex justify-end">
            <div x-show="showModal" x-transition.opacity.duration.300ms class="absolute inset-0 bg-black/50"
                @click="showModal = false"></div>

            <div x-show="showModal" x-transition.scale.origin.center.duration.300ms
                class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl p-6 w-full max-w-7xl z-10">
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h2 class="text-lg font-semibold">Add New Member</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">✕</button>
                </div>

                <x-admin.add-employee-form />
            </div>
        </div>

        <!-- Edit Employee Modal -->
        <div x-show="showEditModal" x-cloak
            x-on:open-edit-employee-modal.window="
             editEmployeeId = $event.detail.employeeId;
             showEditModal = true;
         "
            @keydown.escape.window="showEditModal = false" class="fixed inset-0 z-50 flex justify-end">

            <!-- Backdrop -->
            <div x-show="showEditModal" x-transition.opacity.duration.300ms class="absolute inset-0 bg-black/50"
                @click="showEditModal = false"></div>

            <!-- Modal Content -->
            <div x-show="showEditModal" x-transition.scale.origin.center.duration.300ms
                class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl p-6 w-full max-w-7xl z-10">

                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h2 class="text-lg font-semibold">Edit Member</h2>
                    <button @click="showEditModal = false" class="text-gray-500 hover:text-gray-700">✕</button>
                </div>

                <!-- Pass employeeId to component via Alpine -->
                <div x-data="{ id: editEmployeeId }" x-init="$watch('id', value => { $refs.editForm.load(value) })">
                    <div x-ref="editForm">
                        <x-admin.edit-employee-form />
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        let table;

        $(function() {
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
                        data: 'profile_pic',
                        name: 'profile_pic',
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
        });

        $(document).on('click', '.editEmployee', function(e) {
            e.preventDefault();
            let employeeId = $(this).data('id');
            // window.location.href = `/admin/employees/${employeeId}/edit`;
            window.dispatchEvent(new CustomEvent('open-edit-employee-modal', {
                detail: {
                    employeeId
                }
            }));
        });

        $(document).on('click', '.deleteEmployee', function(e) {
            e.preventDefault();
            let employeeId = $(this).data('id');

            if (confirm('Are you sure you want to delete this employee?')) {
                $.ajax({
                    // url: `/admin/employees/${employeeId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success('Employee deleted successfully!', 'Success');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        toastr.error('❌ An error occurred while deleting the employee.',
                            'Error');
                    }
                });
            }
        });

        $(document).ready(function() {
            $('#addEmployeeForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.employees.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success('Employee added successfully!', 'Success');

                        // Reload datatable
                        table.ajax.reload();

                        // Reset form
                        $('#addEmployeeForm')[0].reset();

                        // Close modal via Alpine
                        window.dispatchEvent(new CustomEvent('close-add-employee-modal'));
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ An error occurred while adding the employee.',
                                'Error');
                        }
                    }
                });
            });
        });
    </script>
@endpush
