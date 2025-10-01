@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
        <!-- Header -->
        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Deal Categories</h2>
            <button id="opencreateAgentModal"
                class="py-2 px-4 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                + Create
            </button>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="agentTable" class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Name</th>
                        <th class="px-4 py-3 border-b">Email</th>
                        <th class="px-4 py-3 border-b">Category</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Create Agent Modal -->
    <div id="createAgentModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full mt-10 max-w-2xl rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Create Agent</h2>
            <form id="createAgentForm">
                @csrf
                <div class="flex gap-2">
                    <div class="mb-4 w-1/2">
                        <label for="aggent"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Employee</label>
                        <select name="aggent" id="aggent" class="select2 form-select w-full">
                            <option value="">-- Select Employee --</option>
                        </select>
                    </div>

                    <div class="mb-4 w-1/2">
                        <label for="deal_category_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="deal_category_id" id="deal_category_id" class="select2 form-select w-full">
                            <option value="active">-- Select Category --</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="closecreateAgentModal"
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

            table = $('#agentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.settings.deal-agents') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'aggent.name',
                        name: 'Name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'aggent.email',
                        name: 'Email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'category.name',
                        name: 'Category',
                        orderable: true,
                        searchable: true
                    },
                ],
            });

            // ======================| Modal States| ======================== //
            // Open modal
            $('#opencreateAgentModal').on('click', function() {
                $('#createAgentModal').removeClass('hidden');

                // Fetch employees via AJAX
                $.ajax({
                    url: "{{ route('admin.settings.employees') }}",
                    type: "GET",
                    success: function(response) {
                        console.log(response)
                        let employeeSelect = $('#aggent');
                        let categorySelect = $('#deal_category_id');
                        employeeSelect.empty().append(
                            '<option value="">-- Select Employee --</option>');

                        $.each(response.employees, function(index, employee) {
                            employeeSelect.append(
                                `<option value="${employee.id}">${employee.name}</option>`
                            );
                        });

                        categorySelect.empty().append(
                            '<option value="">-- Select Category --</option>');

                        $.each(response.categories, function(index, employee) {
                            categorySelect.append(
                                `<option value="${employee.id}">${employee.name}</option>`
                            );
                        });

                        // Initialize Select2 for Employee
                        employeeSelect.select2({
                            dropdownParent: $('#createAgentModal .p-6'),
                            placeholder: "-- Select Employee --",
                            width: '100%'
                        });

                        // Initialize Select2 for Category
                        categorySelect.select2({
                            dropdownParent: $('#createAgentModal .p-6'),
                            placeholder: "-- Select Category --",
                            width: '100%'
                        });
                    },
                    error: function() {
                        toastr.error('Failed to load employees');
                    }
                });
            });

            // Close modal
            $('#closecreateAgentModal').on('click', function() {
                $('#createAgentModal').addClass('hidden');
            });

            // Close modal on outside click
            $(document).on('click', function(e) {
                if ($(e.target).is('#createAgentModal')) {
                    $('#createAgentModal').addClass('hidden');
                }
            });

            $('#createAgentForm').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.settings.deal-agents.store') }}",
                    type: "POST",
                    data: formData,
                    success: function() {
                        toastr.success('Agent added successfully!', 'Success');
                        table.ajax.reload();
                        $('#createAgentModal').addClass('hidden');
                        $('#createAgentForm')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ An error occurred while adding the agent.', 'Error');
                        }
                    }
                })
            })
        });
    </script>
@endpush
