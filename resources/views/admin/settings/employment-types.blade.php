@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
        <!-- Header -->
        <div
            class="flex justify-between items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-900/50 backdrop-blur-sm">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                All Employment Types
            </h2>
            <button id="openCreateEmploymentTypeModal"
                class="py-2 px-4 rounded-lg !bg-gradient-to-r from-[#8D35E3] to-[#7B2FCC] text-white font-medium shadow hover:opacity-90 transition">
                + Create
            </button>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="EmploymentTypeTable"
                class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Employment Type</th>
                        <th class="px-4 py-3 border-b text-center">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Create Employment Type Modal -->
    <div id="createEmploymentTypeModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full max-w-2xl mt-10 rounded-xl shadow-lg p-6 relative animate__animated animate__fadeInDown">
            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Create Employment Type</h2>
            <form id="createEmploymentTypeForm" class="flex flex-col gap-3">
                @csrf
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Employment Type</label>
                    <input type="text" name="type" class="w-full form-control" placeholder="Enter employment type"
                        required>
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" id="closeCreateEmploymentTypeModal"
                        class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg !bg-gradient-to-r from-[#8D35E3] to-[#7B2FCC] text-white font-medium shadow hover:opacity-90 transition">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Employment Type Modal -->
    <div id="editEmploymentTypeModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full max-w-2xl mt-10 rounded-xl shadow-lg p-6 relative animate__animated animate__fadeInDown">
            <h2 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Edit Employment Type</h2>
            <form id="editEmploymentTypeForm" class="flex flex-col gap-3">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_employment_type_id">

                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Employment Type</label>
                    <input type="text" name="type" id="edit_type" class="w-full form-control" required>
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" id="closeEditEmploymentTypeModal"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 !bg-gradient-to-r from-[#8D35E3] to-[#7B2FCC] text-white rounded hover:opacity-90 transition">
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
            // ✅ Initialize DataTable
            const table = $('#EmploymentTypeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.settings.employment-types') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'id',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: id => `
                            <button class="editEmploymentType !bg-blue-500 hover:!bg-blue-600 text-white px-3 py-1 rounded text-xs" data-id="${id}">Edit</button>
                            <button class="deleteEmploymentType !bg-red-500 hover:!bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${id}">Delete</button>
                        `
                    }
                ]
            });

            // ✅ Open & Close Create Modal
            $('#openCreateEmploymentTypeModal').on('click', () => $('#createEmploymentTypeModal').removeClass(
                'hidden'));
            $('#closeCreateEmploymentTypeModal').on('click', () => $('#createEmploymentTypeModal').addClass(
                'hidden'));

            // ✅ Create Submit
            $('#createEmploymentTypeForm').on('submit', function(e) {
                e.preventDefault();
                $.post("{{ route('admin.employment-types.store') }}", $(this).serialize())
                    .done(() => {
                        toastr.success('Employment Type created successfully!');
                        table.ajax.reload();
                        $('#createEmploymentTypeModal').addClass('hidden');
                        this.reset();
                    })
                    .fail(() => toastr.error('Failed to create employment type.'));
            });

            // ✅ Edit Modal
            $(document).on('click', '.editEmploymentType', function() {
                const id = $(this).data('id');
                $.get(`/admin/employment-types/${id}/edit`, res => {
                    $('#edit_employment_type_id').val(res.id);
                    $('#edit_type').val(res.type);
                    $('#editEmploymentTypeModal').removeClass('hidden');
                });
            });
            $('#closeEditEmploymentTypeModal').on('click', () => $('#editEmploymentTypeModal').addClass('hidden'));

            // ✅ Update Submit
            $('#editEmploymentTypeForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_employment_type_id').val();
                $.ajax({
                    url: `/admin/employment-types/${id}`,
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: () => {
                        toastr.success('Employment Type updated successfully!');
                        table.ajax.reload();
                        $('#editEmploymentTypeModal').addClass('hidden');
                    },
                    error: () => toastr.error('Failed to update employment type.')
                });
            });

            // ✅ Delete
            $(document).on('click', '.deleteEmploymentType', function() {
                const id = $(this).data('id');
                confirmDelete(() => {
                    $.ajax({
                        url: `/admin/employment-types/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: () => {
                            toastr.success('Employment Type deleted!');
                            table.ajax.reload();
                        },
                        error: () => toastr.error('Failed to delete employment type.')
                    });

                });
            });
        });
    </script>
@endpush
