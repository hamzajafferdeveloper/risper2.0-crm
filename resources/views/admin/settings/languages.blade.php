@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
        <!-- Header -->
        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">All Language</h2>
            <button id="opencreateLanguageModal"
                class="py-2 px-4 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                + Create
            </button>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="languageTable" class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Name</th>
                        <th class="px-4 py-3 border-b">RTL Status</th>
                        <th class="px-4 py-3 border-b">Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div id="createLanguageModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full max-w-2xl mt-10 transition-all rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Create Language</h2>
            <form id="createLanguageForm" class="flex flex-col gap-3">
                @csrf
                <div class="flex gap-3">
                    <div class="w-1/2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Language
                            Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full form-control"
                            placeholder="Enter language name" required>
                    </div>
                    <div class="w-1/2">
                        <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Language
                            Code</label>
                        <input type="text" name="code" id="code"
                            class="w-full form-control"
                            placeholder="Enter language code" required>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-1/2">
                        <label for="rtl_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Language RTL Status
                        </label>
                        <select name="rtl_status" id="rtl_status" class="form-select select2">
                            <option value="">-- Select RTL Status --</option>
                            <option value="1">Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                    </div>

                    <div class="w-1/2">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Language Status
                        </label>
                        <select name="status" id="status" class="form-select select2">
                            <option value="">-- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="closecreateLanguageModal"
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

            if ($.fn.DataTable.isDataTable('#languageTable')) {
                $('#languageTable').DataTable().destroy();
            }

            table = $('#languageTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.settings.languages') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'rtl_status',
                        name: 'RTL Status'
                    },
                    {
                        data: 'status',
                        name: 'Status'
                    },
                ],
            });

            // Initialize Select2
            // Safe Select2 init (won't throw if jQuery/select2 not loaded)
            if (window.jQuery && typeof jQuery.fn.select2 === 'function') {
                jQuery('.select2').select2({
                    placeholder: "Search or select",
                    allowClear: true,
                    width: '100%'
                });
            } else {
                console.warn('jQuery or Select2 not found — skipping select2 init.');
            }


            // ======================| Modal States| ======================== //
            // Open modal
            $('#opencreateLanguageModal').on('click', function() {
                $('#createLanguageModal').removeClass('hidden');
            });

            // Close modal
            $('#closecreateLanguageModal').on('click', function() {
                $('#createLanguageModal').addClass('hidden');
                $('#createLanguageForm')[0].reset();
            });

            // Close modal on outside click
            $(document).on('click', function(e) {
                if ($(e.target).is('#createLanguageModal')) {
                    $('#createLanguageModal').addClass('hidden');
                    $('#createLanguageForm')[0].reset();
                }
            });

            // ====================| Forms States |============================ //

            $('#createLanguageForm').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.settings.languages.store') }}",
                    type: "POST",
                    data: formData,
                    success: function() {
                        toastr.success('Category added successfully!', 'Success');
                        table.ajax.reload();
                        $('#createLanguageModal').addClass('hidden');
                        $('#createLanguageForm')[0].reset();
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
