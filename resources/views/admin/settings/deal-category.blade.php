@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
        <!-- Header -->
        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Deal Categories</h2>
            <button id="opencreateCategoryModal"
                class="py-2 px-4 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                + Create
            </button>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="categoryTable" class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Name</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div id="createCategoryModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 mt-10  w-full max-w-md rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Create Category</h2>
            <form id="createCategoryForm">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category
                        Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-purple-400 focus:border-purple-500 dark:bg-gray-700 dark:text-gray-200"
                        placeholder="Enter category name" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="closecreateCategoryModal"
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
@endsection

@push('scripts')
    <script>
        let table;
        $(document).ready(function() {

            table = $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.deal-categories.all') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                ],
            });

            // ======================| Modal States| ======================== //
            // Open modal
            $('#opencreateCategoryModal').on('click', function() {
                $('#createCategoryModal').removeClass('hidden');
            });

            // Close modal
            $('#closecreateCategoryModal').on('click', function() {
                $('#createCategoryModal').addClass('hidden');
            });

            // Close modal on outside click
            $(document).on('click', function(e) {
                if ($(e.target).is('#createCategoryModal')) {
                    $('#createCategoryModal').addClass('hidden');
                }
            });

            // ====================| Forms States |============================ //

            $('#createCategoryForm').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.deal-categories.store') }}",
                    type: "POST",
                    data: formData,
                    success: function() {
                        toastr.success('Category added successfully!', 'Success');
                        table.ajax.reload();
                        $('#createCategoryModal').addClass('hidden');
                        $('#createCategoryForm')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ An error occurred while adding the category.',
                                'Error');
                        }
                    }
                });
            })
        });
    </script>
@endpush
