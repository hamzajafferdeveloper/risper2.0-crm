@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="w-full mx-auto p-5">
        <header class="relative border-b mb-6">
            <ul id="tabList" class="flex gap-6 text-lg font-medium relative">
                @php
                    $tabs = ['Lead Source', 'Lead Stages', 'Lead Category', 'Lead Agent'];
                @endphp
                @foreach ($tabs as $index => $tab)
                    <li class="cursor-pointer pb-2 transition-colors duration-200 hover:text-[#8D35E3]"
                        data-tab="{{ $index }}">
                        {{ $tab }}
                    </li>
                @endforeach
                <!-- Quick snapping underline -->
                <span id="activeBar"
                    class="absolute bottom-0 left-0 h-[3px] w-[120px] bg-[#8D35E3] rounded-full transition-all duration-150 ease-linear"></span>
            </ul>
        </header>

        <!-- Tab content wrapper (no transition animation) -->
        <div id="tabContent" class="relative h-auto">
            <div class="tab-pane" data-tab="0">
                <div
                    class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                    <!-- Header -->
                    <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Lead Source</h2>
                        <button id="opencreateSourceModal"
                            class="py-2 px-4 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                            + Create
                        </button>
                    </div>

                    <!-- Table -->
                    <div class="p-4">
                        <table id="sourceTable"
                            class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                                <tr class="border-b">
                                    <th class="">ID</th>
                                    <th class="">Name</th>
                                    <th class="">Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <!-- Create Source Modal -->
                <div id="createSourceModal"
                    class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
                    <div
                        class="bg-white dark:bg-gray-800 mt-10  w-full max-w-md rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
                        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Create Source</h2>
                        <form id="createSourceForm">
                            @csrf
                            <div class="mb-4">
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Source
                                    Name</label>
                                <input type="text" name="name" id="name" class="w-full form-control"
                                    placeholder="Enter source name" required>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="button" id="closecreateSourceModal"
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

                <!-- Edit Source Modal -->
                <div id="editSourceModal"
                    class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
                    <div
                        class="bg-white dark:bg-gray-800 mt-10 w-full max-w-md rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
                        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Edit Source</h2>
                        <form id="editSourceForm">
                            @csrf
                            <input type="hidden" name="id" id="editSourceId">
                            <div class="mb-4">
                                <input type="text" name="name" id="editSourceName" class="w-full form-control"
                                    required>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="button" id="closeEditSourceModal"
                                    class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="tab-pane hidden" data-tab="1">
                <h2 class="text-xl font-semibold mb-2">Lead Stages</h2>
                <p>Set and edit your lead stages here.</p>
            </div>

            <div class="tab-pane hidden" data-tab="2">
                <div
                    class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
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
                        <table id="categoryTable"
                            class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                                <tr>
                                    <th class="px-4 py-3 border-b">ID</th>
                                    <th class="px-4 py-3 border-b">Name</th>
                                    <th class="px-4 py-3 border-b">Actions</th>

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
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category
                                    Name</label>
                                <input type="text" name="name" id="name" class="w-full form-control"
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

                <!-- Edit Source Modal -->
                <div id="editCategoryModal"
                    class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
                    <div
                        class="bg-white dark:bg-gray-800 mt-10 w-full max-w-md rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
                        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Edit Category</h2>
                        <form id="editCategoryForm">
                            @csrf
                            <input type="hidden" name="id" id="editCategoryId">
                            <div class="mb-4">
                                <input type="text" name="name" id="editCategoryName" class="w-full form-control"
                                    required>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="button" id="closeEditCategoryModal"
                                    class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane hidden" data-tab="3">
                <div
                    class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
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
                        <table id="agentTable"
                            class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                                <tr>
                                    <th class="px-4 py-3 border-b">ID</th>
                                    <th class="px-4 py-3 border-b">Name</th>
                                    <th class="px-4 py-3 border-b">Email</th>
                                    <th class="px-4 py-3 border-b">Category</th>
                                    <th class="px-4 py-3 border-b">Actions</th>

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
                                    <select name="deal_category_id" id="deal_category_id"
                                        class="select2 form-select w-full">
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
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let sourceTable;
        let agentTable;
        let categoryTable;

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

        document.addEventListener("DOMContentLoaded", () => {
            const tabs = document.querySelectorAll("#tabList li");
            const panes = document.querySelectorAll(".tab-pane");
            const activeBar = document.getElementById("activeBar");

            tabs.forEach((tab, index) => {
                tab.addEventListener("click", () => {
                    // Show selected tab content instantly
                    panes.forEach(p => p.classList.add("hidden"));
                    document.querySelector(`.tab-pane[data-tab="${index}"]`).classList.remove(
                        "hidden");

                    // Move underline bar quickly
                    const {
                        offsetLeft,
                        offsetWidth
                    } = tab;
                    activeBar.style.left = offsetLeft + "px";
                    activeBar.style.width = offsetWidth + "px";

                    // Update active tab color
                    tabs.forEach(t => t.classList.remove("text-[#8D35E3]"));
                    tab.classList.add("text-[#8D35E3]");
                });
            });

            // Initialize underline on first tab
            const firstTab = tabs[0];
            const {
                offsetLeft,
                offsetWidth
            } = firstTab;
            activeBar.style.left = offsetLeft + "px";
            activeBar.style.width = offsetWidth + "px";
            firstTab.classList.add("text-[#8D35E3]");
        });

        // Source Table
        $(document).ready(function() {

            if ($.fn.DataTable.isDataTable('#sourceTable')) {
                $('#sourceTable').DataTable().destroy();
            }

            sourceTable = $('#sourceTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.lead-sources.all') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `
                                <div class="flex gap-2">
                                    <button class="editSource !bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs" data-id="${data.id}" data-name="${data.name}">Edit</button>
                                    <button class="deleteSource !bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${data.id}">Delete</button>
                                </div>
                            `;
                        },
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            // ======================| Modal States| ======================== //
            // Open modal
            $('#opencreateSourceModal').on('click', function() {
                $('#createSourceModal').removeClass('hidden');
            });

            // Close modal
            $('#closecreateSourceModal').on('click', function() {
                $('#createSourceModal').addClass('hidden');
            });

            // Close modal on outside click
            $(document).on('click', function(e) {
                if ($(e.target).is('#createSourceModal')) {
                    $('#createSourceModal').addClass('hidden');
                }
            });

            // ====================| Forms States |============================ //

            $('#createSourceForm').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.lead-sources.store') }}",
                    type: "POST",
                    data: formData,
                    success: function() {
                        toastr.success('Category added successfully!', 'Success');
                        sourceTable.ajax.reload();
                        $('#createSourceModal').addClass('hidden');
                        $('#createSourceForm')[0].reset();
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
            });

            // ====================| Lead Source Edit/Delete |============================
            $(document).on("click", ".editSource", function() {
                const id = $(this).data("id");
                const name = $(this).data("name");

                $("#editSourceId").val(id);
                $("#editSourceName").val(name);
                $("#editSourceModal").removeClass("hidden");
            });

            $("#closeEditSourceModal").on("click", function() {
                $("#editSourceModal").addClass("hidden");
            });

            $("#editSourceForm").on("submit", function(e) {
                e.preventDefault();

                const id = $("#editSourceId").val();
                const name = $("#editSourceName").val();

                $.ajax({
                    url: `/admin/lead-source/${id}`,
                    type: "PUT",
                    data: {
                        name,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function() {
                        toastr.success("Source updated successfully!");
                        $("#editSourceModal").addClass("hidden");
                        sourceTable.ajax.reload();
                    },
                    error: function() {
                        toastr.error("Error updating source");
                    },
                });
            });

            $(document).on("click", ".deleteSource", function() {
                const id = $(this).data("id");

                confirmDelete(() => {
                    $.ajax({
                        url: `/admin/lead-source/${id}`,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            toastr.success("Source deleted successfully!");
                            sourceTable.ajax.reload();
                        },
                        error: function() {
                            toastr.error("Error deleting source");
                        },
                    });
                });
            });
        });

        // Agent Table
        $(document).ready(function() {

            if ($.fn.DataTable.isDataTable('#agentTable')) {
                $('#agentTable').DataTable().destroy();
            }

            agentTable = $('#agentTable').DataTable({
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
                        data: 'employee_name',
                        name: 'employee_name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'employee_email',
                        name: 'employee_email',
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
                        agentTable.ajax.reload();
                        $('#createAgentModal').addClass('hidden');
                        $('#createAgentForm')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ An error occurred while adding the agent.',
                                'Error');
                        }
                    }
                })
            })
        });

        // Category Table
        $(document).ready(function() {

            if ($.fn.DataTable.isDataTable('#categoryTable')) {
                $('#categoryTable').DataTable().destroy();
            }

            categoryTable = $('#categoryTable').DataTable({
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
                    {
                        data: null,
                        render: function(data) {
                            return `
                                <div class="flex gap-2">
                                    <button class="editCategory !bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs" data-id="${data.id}" data-name="${data.name}">Edit</button>
                                    <button class="deleteCategory !bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${data.id}">Delete</button>
                                </div>
                            `;
                        },
                        orderable: false,
                        searchable: false
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
                        categoryTable.ajax.reload();
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
            });

            // ====================| Lead Source Edit/Delete |============================
            $(document).on("click", ".editCategory", function() {
                const id = $(this).data("id");
                const name = $(this).data("name");

                $("#editCategoryId").val(id);
                $("#editCategoryName").val(name);
                $("#editCategoryModal").removeClass("hidden");
            });

            $("#closeEditCategoryModal").on("click", function() {
                $("#editCategoryModal").addClass("hidden");
            });

            $("#editCategoryForm").on("submit", function(e) {
                e.preventDefault();

                const id = $("#editCategoryId").val();
                const name = $("#editCategoryName").val();

                $.ajax({
                    url: `/admin/deal-categories/${id}`,
                    type: "PUT",
                    data: {
                        name,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function() {
                        toastr.success("Category updated successfully!");
                        $("#editCategoryModal").addClass("hidden");
                        categoryTable.ajax.reload();
                    },
                    error: function() {
                        toastr.error("Error updating category");
                    },
                });
            });

            $(document).on("click", ".deleteCategory", function() {
                const id = $(this).data("id");

                confirmDelete(() => {
                    $.ajax({
                        url: `/admin/deal-categories/${id}`,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            toastr.success("Category deleted successfully!");
                            categoryTable.ajax.reload();
                        },
                        error: function() {
                            toastr.error("Error deleting category");
                        },
                    });
                });
            });
        });
    </script>
@endpush
