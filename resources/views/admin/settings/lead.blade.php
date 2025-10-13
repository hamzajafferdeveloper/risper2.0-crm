@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="w-full mx-auto p-5">
        <header class="relative border-b mb-6">
            <ul id="tabList" class="flex gap-6 text-lg font-medium relative">
                @php
                    $tabs = ['Lead Source', 'Lead Stages', 'Lead Category', 'Lead Agent'];
                @endphp
                @foreach ($tabs as $index => $tab)
                    <li class="cursor-pointer pb-2 transition-colors duration-200 hover:text-[#8D35E3]" data-tab="{{ $index }}">
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
                @include("admin.settings.partials.lead-source")
            </div>

            <div class="tab-pane hidden" data-tab="1">
                @include("admin.settings.partials.lead-stages")
            </div>

            <div class="tab-pane hidden" data-tab="2">
                @include("admin.settings.partials.lead-category")
            </div>

            <div class="tab-pane hidden" data-tab="3">
                @include("admin.settings.partials.lead-agent")
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let sourceTable;
        let agentTable;
        let categoryTable;
        let stageTable;

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
        $(document).ready(function () {

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
                    render: function (data) {
                        return `
                                                            <div class="flex justify-end gap-2">
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
            $('#opencreateSourceModal').on('click', function () {
                $('#createSourceModal').removeClass('hidden');
            });

            // Close modal
            $('#closecreateSourceModal').on('click', function () {
                $('#createSourceModal').addClass('hidden');
            });

            // Close modal on outside click
            $(document).on('click', function (e) {
                if ($(e.target).is('#createSourceModal')) {
                    $('#createSourceModal').addClass('hidden');
                }
            });

            // ====================| Forms States |============================ //

            $('#createSourceForm').on('submit', function (e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.lead-sources.store') }}",
                    type: "POST",
                    data: formData,
                    success: function () {
                        toastr.success('Category added successfully!', 'Success');
                        sourceTable.ajax.reload();
                        $('#createSourceModal').addClass('hidden');
                        $('#createSourceForm')[0].reset();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
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
            $(document).on("click", ".editSource", function () {
                const id = $(this).data("id");
                const name = $(this).data("name");

                $("#editSourceId").val(id);
                $("#editSourceName").val(name);
                $("#editSourceModal").removeClass("hidden");
            });

            $("#closeEditSourceModal").on("click", function () {
                $("#editSourceModal").addClass("hidden");
            });

            $("#editSourceForm").on("submit", function (e) {
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
                    success: function () {
                        toastr.success("Source updated successfully!");
                        $("#editSourceModal").addClass("hidden");
                        sourceTable.ajax.reload();
                    },
                    error: function () {
                        toastr.error("Error updating source");
                    },
                });
            });

            $(document).on("click", ".deleteSource", function () {
                const id = $(this).data("id");

                confirmDelete(() => {
                    $.ajax({
                        url: `/admin/lead-source/${id}`,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function () {
                            toastr.success("Source deleted successfully!");
                            sourceTable.ajax.reload();
                        },
                        error: function () {
                            toastr.error("Error deleting source");
                        },
                    });
                });
            });
        });

        $(document).ready(function () {

            if ($.fn.DataTable.isDataTable('#stageTable')) {
                $('#stageTable').DataTable().destroy();
            }

            stageTable = $('#stageTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.deal-stages.all') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'tag_color',
                    name: 'tag_color',
                    render: function (data) {
                        return `
                             <div class="flex justify-center"><span class="w-6 h-6 rounded-full" style="background-color:${data};"></span></div>
                        `;
                    }
                },

                {
                    data: null,
                    render: function (data) {
                        return `
                                                            <div class="flex justify-end gap-2">
                                                                <button class="editStage !bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs" data-id="${data.id}" data-name="${data.name}">Edit</button>
                                                                <button class="deleteStage !bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${data.id}">Delete</button>
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
            $('#opencreateStageModal').on('click', function () {
                $('#createStageModal').removeClass('hidden');
            });

            // Close modal
            $('#closecreateStageModal').on('click', function () {
                $('#createStageModal').addClass('hidden');
            });

            // Close modal on outside click
            $(document).on('click', function (e) {
                if ($(e.target).is('#createStageModal')) {
                    $('#createStageModal').addClass('hidden');
                }
            });

            // ====================| Forms States |============================ //

            $('#createStageForm').on('submit', function (e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.deal-stages.store') }}",
                    type: "POST",
                    data: formData,
                    success: function () {
                        toastr.success('Stage added successfully!', 'Success');
                        stageTable.ajax.reload();
                        $('#createStageModal').addClass('hidden');
                        $('#createStageForm')[0].reset();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ An error occurred while adding the category.',
                                'Error');
                        }
                    }
                });
            });

            // ====================| Lead Stage Edit/Delete |============================
            $(document).on("click", ".editStage", function () {
                const id = $(this).data("id");
                const name = $(this).data("name");

                $("#editStageId").val(id);
                $("#editStageName").val(name);
                $("#editStageModal").removeClass("hidden");
            });

            $("#closeeditStageModal").on("click", function () {
                $("#editStageModal").addClass("hidden");
            });

            $("#editStageForm").on("submit", function (e) {
                e.preventDefault();

                const id = $("#editStageId").val();
                const name = $("#editStageName").val();

                $.ajax({
                    url: `/admin/deal-stages/${id}`,
                    type: "PUT",
                    data: {
                        name,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function () {
                        toastr.success("Stage updated successfully!");
                        $("#editStageModal").addClass("hidden");
                        stageTable.ajax.reload();
                    },
                    error: function () {
                        toastr.error("Error updating Stage");
                    },
                });
            });

            $(document).on("click", ".deleteStage", function () {
                const id = $(this).data("id");

                confirmDelete(() => {
                    $.ajax({
                        url: `/admin/deal-stages/${id}`,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function () {
                            toastr.success("Stage deleted successfully!");
                            stageTable.ajax.reload();
                        },
                        error: function () {
                            toastr.error("Error deleting Stage");
                        },
                    });
                });
            });
        });



        // Agent Table
        $(document).ready(function () {

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
                {
                    data: null,
                    render: function (data) {
                        return `
                                                            <div class="flex gap-2">
                                                                <button class="editAgent !bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs" data-id="${data.id}" data-name="${data.name}">Edit</button>
                                                                <button class="deleteAgent !bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${data.id}">Delete</button>
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
            $('#opencreateAgentModal').on('click', function () {
                $('#createAgentModal').removeClass('hidden');

                // Fetch employees via AJAX
                $.ajax({
                    url: "{{ route('admin.settings.employees') }}",
                    type: "GET",
                    success: function (response) {
                        let employeeSelect = $('#aggent');
                        let categorySelect = $('#deal_category_id');
                        employeeSelect.empty().append(
                            '<option value="">-- Select Employee --</option>');

                        $.each(response.employees, function (index, employee) {
                            employeeSelect.append(
                                `<option value="${employee.id}">${employee.name}</option>`
                            );
                        });

                        categorySelect.empty().append(
                            '<option value="">-- Select Category --</option>');

                        $.each(response.categories, function (index, employee) {
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
                    error: function () {
                        toastr.error('Failed to load employees');
                    }
                });
            });

            // Close modal
            $('#closecreateAgentModal').on('click', function () {
                $('#createAgentModal').addClass('hidden');
            });

            // Close modal on outside click
            $(document).on('click', function (e) {
                if ($(e.target).is('#createAgentModal')) {
                    $('#createAgentModal').addClass('hidden');
                }
            });

            $('#createAgentForm').on('submit', function (e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.settings.deal-agents.store') }}",
                    type: "POST",
                    data: formData,
                    success: function () {
                        toastr.success('Agent added successfully!', 'Success');
                        agentTable.ajax.reload();
                        $('#createAgentModal').addClass('hidden');
                        $('#createAgentForm')[0].reset();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ An error occurred while adding the agent.',
                                'Error');
                        }
                    }
                })
            })

            // ====================| Lead Agent Edit/Delete |============================
            $(document).on("click", ".editAgent", function () {
                const id = $(this).data("id");

                // Step 1: Fetch agent details
                $.ajax({
                    url: `/admin/settings/deal-agents/${id}/edit`,
                    type: "GET",
                    success: function (response) {
                        $("#editAgentId").val(response.id);

                        // Step 2: Fetch employees & categories
                        $.ajax({
                            url: "{{ route('admin.settings.employees') }}", // endpoint returning { employees:[], categories:[] }
                            type: "GET",
                            success: function (data) {
                                const empSelect = $("#editAgentEmployee");
                                const catSelect = $("#editAgentCategory");

                                // Populate employees
                                empSelect.empty().append(`<option value="">-- Select Employee --</option>`);
                                $.each(data.employees, function (index, emp) {
                                    empSelect.append(`<option value="${emp.id}">${emp.name}</option>`);
                                });

                                // Populate categories
                                catSelect.empty().append(`<option value="">-- Select Category --</option>`);
                                $.each(data.categories, function (index, cat) {
                                    catSelect.append(`<option value="${cat.id}">${cat.name}</option>`);
                                });

                                // Step 3: Set the selected values
                                empSelect.val(response.employee_id).trigger('change');
                                catSelect.val(response.deal_category_id).trigger('change');

                                // Step 4: Initialize Select2
                                $("#editAgentEmployee, #editAgentCategory").select2({
                                    dropdownParent: $("#editAgentModal .p-6"),
                                    width: "100%"
                                });

                                // Step 5: Show modal
                                $("#editAgentModal").removeClass("hidden");
                            },
                            error: function () {
                                toastr.error("Failed to load employees or categories.");
                            }
                        });
                    },
                    error: function () {
                        toastr.error("Failed to fetch agent details.");
                    }
                });
            });


            $("#closeEditAgentModal").on("click", function () {
                $("#editAgentModal").addClass("hidden");
            });

            $("#editAgentForm").on("submit", function (e) {
                e.preventDefault();

                const id = $("#editAgentId").val();
                const formData = $(this).serialize();

                $.ajax({
                    url: `/admin/settings/deal-agents/${id}`,
                    type: "PUT",
                    data: formData,
                    success: function () {
                        toastr.success("Agent updated successfully!");
                        $("#editAgentModal").addClass("hidden");
                        agentTable.ajax.reload();
                    },
                    error: function () {
                        toastr.error("Error updating agent.");
                    }
                });
            });

            $("#updateAgentForm").on("submit", function (e) {
                e.preventDefault();

                const id = $("#editAgentId").val();
                const formData = {
                    aggent: $("#editAgentEmployee").val(),
                    deal_category_id: $("#editAgentCategory").val(),
                };

                $.ajax({
                    url: `/admin/settings/deal-agents/${id}`,
                    type: "PUT",
                    data: formData,
                    success: function (response) {
                        toastr.success(response.message);
                        $("#editAgentModal").addClass("hidden");
                        // Optionally reload your table here
                    },
                    error: function (xhr) {
                        toastr.error("Failed to update deal agent.");
                    }
                });
            });

            $(document).on("click", ".deleteAgent", function () {
                const id = $(this).data("id");

                confirmDelete(() => {
                    $.ajax({
                        url: `/admin/settings/deal-agents/${id}`,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            toastr.success(response.message);
                            agentTable.ajax.reload();
                        },
                        error: function () {
                            toastr.error("Failed to delete deal agent.");
                        }

                    });
                });
            });

        });

        // Category Table
        $(document).ready(function () {

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
                    render: function (data) {
                        return `
                                                            <div class="flex justify-end gap-2">
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
            $('#opencreateCategoryModal').on('click', function () {
                $('#createCategoryModal').removeClass('hidden');
            });

            // Close modal
            $('#closecreateCategoryModal').on('click', function () {
                $('#createCategoryModal').addClass('hidden');
            });

            // Close modal on outside click
            $(document).on('click', function (e) {
                if ($(e.target).is('#createCategoryModal')) {
                    $('#createCategoryModal').addClass('hidden');
                }
            });

            // ====================| Forms States |============================ //

            $('#createCategoryForm').on('submit', function (e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.deal-categories.store') }}",
                    type: "POST",
                    data: formData,
                    success: function () {
                        toastr.success('Category added successfully!', 'Success');
                        categoryTable.ajax.reload();
                        $('#createCategoryModal').addClass('hidden');
                        $('#createCategoryForm')[0].reset();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
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
            $(document).on("click", ".editCategory", function () {
                const id = $(this).data("id");
                const name = $(this).data("name");

                $("#editCategoryId").val(id);
                $("#editCategoryName").val(name);
                $("#editCategoryModal").removeClass("hidden");
            });

            $("#closeEditCategoryModal").on("click", function () {
                $("#editCategoryModal").addClass("hidden");
            });

            $("#editCategoryForm").on("submit", function (e) {
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
                    success: function () {
                        toastr.success("Category updated successfully!");
                        $("#editCategoryModal").addClass("hidden");
                        categoryTable.ajax.reload();
                    },
                    error: function () {
                        toastr.error("Error updating category");
                    },
                });
            });

            $(document).on("click", ".deleteCategory", function () {
                const id = $(this).data("id");

                confirmDelete(() => {
                    $.ajax({
                        url: `/admin/deal-categories/${id}`,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function () {
                            toastr.success("Category deleted successfully!");
                            categoryTable.ajax.reload();
                        },
                        error: function () {
                            toastr.error("Error deleting category");
                        },
                    });
                });
            });
        });
    </script>
@endpush
