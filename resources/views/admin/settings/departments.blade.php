@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
        <!-- Header -->
        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">All Departments</h2>
            <button id="openCreateDepartmentModal"
                class="py-2 px-4 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                + Create
            </button>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="departmentTable" class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Name</th>
                        <th class="px-4 py-3 border-b">Parent Department</th>
                        <th class="px-4 py-3 border-b text-center">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Create Department Modal -->
    <div id="createDepartmentModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full max-w-2xl mt-10 rounded-xl shadow-lg p-6 relative animate__animated animate__fadeInDown">
            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Create Department</h2>
            <form id="createDepartmentForm" class="flex flex-col gap-3">
                @csrf
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="w-full sm:w-1/2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" class="w-full form-control" placeholder="Enter department name"
                            required>
                    </div>
                    <div class="w-full sm:w-1/2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Parent Department</label>
                        <select name="parent_id" id="parent_id" class="form-select select2">
                            <option value="">-- None --</option>
                            @foreach (App\Models\Department::all() as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-3 space-x-2">
                    <button type="button" id="closeCreateDepartmentModal"
                        class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Department Modal -->
    <div id="editDepartmentModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full max-w-2xl mt-10 rounded-xl shadow-lg p-6 relative animate__animated animate__fadeInDown">
            <h2 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Edit Department</h2>
            <form id="editDepartmentForm" class="flex flex-col gap-3">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_department_id">

                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="w-full sm:w-1/2">
                        <label>Name</label>
                        <input type="text" name="name" id="edit_name" class="w-full form-control" required>
                    </div>

                    <div class="w-full sm:w-1/2">
                        <label>Parent Department</label>
                        <select name="parent_id" id="edit_parent_id" class="form-select select2">
                            <option value="">-- None --</option>
                            @foreach (App\Models\Department::all() as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end mt-3 space-x-2">
                    <button type="button" id="closeEditDepartmentModal"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 !bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded hover:opacity-90 transition">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // ✅ Initialize DataTable
            const table = $('#departmentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.settings.departments') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'parent_name',
                        name: 'parent_name',
                        defaultContent: '-'
                    },
                    {
                        data: 'id',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: id => `
                    <button class="editDepartment !bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs" data-id="${id}">Edit</button>
                    <button class="deleteDepartment !bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${id}">Delete</button>
                `
                    }
                ]
            });

            // ✅ Create Modal
            $('#openCreateDepartmentModal').on('click', () => $('#createDepartmentModal').removeClass('hidden'));
            $('#closeCreateDepartmentModal').on('click', () => $('#createDepartmentModal').addClass('hidden'));

            // ✅ Edit Modal
            $(document).on('click', '.editDepartment', function() {
                const id = $(this).data('id');

                $.ajax({
                    url: `/admin/departments/${id}/edit`,
                    method: 'GET',
                    success: res => {
                        // Expecting JSON {id, name, parent_id}
                        $('#edit_department_id').val(res.id);
                        $('#edit_name').val(res.name);
                        $('#edit_parent_id').val(res.parent_id).trigger('change');

                        $('#editDepartmentModal').removeClass('hidden');

                        // Re-init select2 each time
                        $('#edit_parent_id').select2({
                            width: '100%',
                            dropdownParent: $('#editDepartmentModal'),
                            placeholder: 'Select Parent Department',
                            allowClear: true
                        });
                    },
                    error: () => toastr.error('Failed to fetch department info.')
                });
            });

            $('#closeEditDepartmentModal').on('click', () => $('#editDepartmentModal').addClass('hidden'));

            // ✅ Create Submit
            $('#createDepartmentForm').on('submit', function(e) {
                e.preventDefault();
                $.post("{{ route('admin.departments.store') }}", $(this).serialize())
                    .done(() => {
                        toastr.success('Department created successfully!');
                        table.ajax.reload();
                        $('#createDepartmentModal').addClass('hidden');
                        this.reset();
                    })
                    .fail(() => toastr.error('Failed to create department'));
            });

            // ✅ Update Submit
            $('#editDepartmentForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_department_id').val();
                $.ajax({
                    url: `/admin/departments/${id}`,
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: () => {
                        toastr.success('Department updated successfully!');
                        table.ajax.reload();
                        $('#editDepartmentModal').addClass('hidden');
                    },
                    error: () => toastr.error('Failed to update department.')
                });
            });

            // ✅ Delete with Confirm
            $(document).on('click', '.deleteDepartment', function() {
                const id = $(this).data('id');
                confirmDelete(() => {
                    $.ajax({
                        url: `/admin/departments/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: () => {
                            toastr.success('Department deleted!');
                            table.ajax.reload();
                        },
                        error: () => toastr.error('Failed to delete department')
                    });

                });
            });

            // ✅ Initialize Select2 globally
            $('.select2').select2({
                width: '100%',
                placeholder: 'Select option',
                allowClear: true
            });
        });
    </script>
@endpush
