@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
        <!-- Header -->
        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">All Employee Designations</h2>
            <button id="openCreateEmployeeDesignationModal"
                class="py-2 px-4 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                + Create
            </button>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="EmployeeDesignationTable"
                class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Name</th>
                        <th class="px-4 py-3 border-b">Parent Designation</th>
                        <th class="px-4 py-3 border-b text-center">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Create EmployeeDesignation Modal -->
    <div id="createEmployeeDesignationModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full max-w-2xl mt-10 rounded-xl shadow-lg p-6 relative animate__animated animate__fadeInDown">
            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Create Designation</h2>
            <form id="createEmployeeDesignationForm" class="flex flex-col gap-3">
                @csrf
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="w-full sm:w-1/2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" class="w-full form-control"
                            placeholder="Enter designation name" required>
                    </div>
                    <div class="w-full sm:w-1/2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Parent Designation
                        </label>
                        <select name="parent_id" id="parent_id" class="form-select select2"
                            data-placeholder="Select parent designation">
                            <option value="">-- None --</option>
                            @foreach (App\Models\EmployeeDesignation::all() as $designation)
                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-3 space-x-2">
                    <button type="button" id="closeCreateEmployeeDesignationModal"
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

    <!-- Edit EmployeeDesignation Modal -->
    <div id="editEmployeeDesignationModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full max-w-2xl mt-10 rounded-xl shadow-lg p-6 relative animate__animated animate__fadeInDown">
            <h2 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Edit Designation</h2>
            <form id="editEmployeeDesignationForm" class="flex flex-col gap-3">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_EmployeeDesignation_id">

                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="w-full sm:w-1/2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" id="edit_name" class="w-full form-control" required>
                    </div>

                    <div class="w-full sm:w-1/2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Parent Designation
                        </label>
                        <select name="parent_id" id="edit_parent_id" class="form-select select2"
                            data-placeholder="Select parent designation">
                            <option value="">-- None --</option>
                            @foreach (App\Models\EmployeeDesignation::all() as $designation)
                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-3 space-x-2">
                    <button type="button" id="closeEditEmployeeDesignationModal"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 !bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded hover:opacity-90 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // ✅ DataTable Init
            const table = $('#EmployeeDesignationTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.settings.employees-designation') }}",
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
                            <button class="editEmployeeDesignation !bg-blue-500 hover:!bg-blue-600 text-white px-3 py-1 rounded text-xs" data-id="${id}">Edit</button>
                            <button class="deleteEmployeeDesignation !bg-red-500 hover:!bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${id}">Delete</button>
                        `
                    }
                ]
            });

            // ✅ Create Modal Toggle
            $('#openCreateEmployeeDesignationModal').on('click', () => $('#createEmployeeDesignationModal')
                .removeClass('hidden'));
            $('#closeCreateEmployeeDesignationModal').on('click', () => $('#createEmployeeDesignationModal')
                .addClass('hidden'));

            // ✅ Edit Modal Toggle
            $(document).on('click', '.editEmployeeDesignation', function() {
                const id = $(this).data('id');

                $.get(`/admin/employee-designations/${id}/edit`, res => {
                    $('#edit_EmployeeDesignation_id').val(res.id);
                    $('#edit_name').val(res.name);
                    $('#edit_parent_id').val(res.parent_id).trigger('change');

                    $('#editEmployeeDesignationModal').removeClass('hidden');

                    // Reinitialize select2 inside modal
                    $('#edit_parent_id').select2({
                        width: '100%',
                        dropdownParent: $('#editEmployeeDesignationModal'),
                        placeholder: $('#edit_parent_id').data('placeholder'),
                        allowClear: true
                    });
                });
            });

            $('#closeEditEmployeeDesignationModal').on('click', () => $('#editEmployeeDesignationModal').addClass(
                'hidden'));

            // ✅ Create Submit
            $('#createEmployeeDesignationForm').on('submit', function(e) {
                e.preventDefault();
                $.post("{{ route('admin.employee-designations.store') }}", $(this).serialize())
                    .done(() => {
                        toastr.success('Designation created successfully!');
                        table.ajax.reload();
                        $('#createEmployeeDesignationModal').addClass('hidden');
                        this.reset();
                    })
                    .fail(() => toastr.error('Failed to create designation.'));
            });

            // ✅ Update Submit
            $('#editEmployeeDesignationForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_EmployeeDesignation_id').val();
                $.ajax({
                    url: `/admin/employee-designations/${id}`,
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: () => {
                        toastr.success('Designation updated successfully!');
                        table.ajax.reload();
                        $('#editEmployeeDesignationModal').addClass('hidden');
                    },
                    error: () => toastr.error('Failed to update designation.')
                });
            });

            // ✅ Delete
            $(document).on('click', '.deleteEmployeeDesignation', function() {
                const id = $(this).data('id');
                confirmDelete(() => {
                    $.ajax({
                        url: `/admin/employee-designations/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: () => {
                            toastr.success('Designation deleted!');
                            table.ajax.reload();
                        },
                        error: () => toastr.error('Failed to delete designation.')
                    });

                });
            });

            // ✅ Select2 Init
            $('.select2').select2({
                width: '100%',
                placeholder: function() {
                    return $(this).data('placeholder') || 'Select option';
                },
                allowClear: true
            });
        });
    </script>
@endpush
