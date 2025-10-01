@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="container">
        <!-- Header -->
        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Pipelines</h2>
            <div class="flex gap-3">
                <button id="openCreatePipelineModal"
                    class="py-2 px-4 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                    + Create Pipeline
                </button>
                <button id="openCreateDealStageModal"
                    class="py-2 px-4 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                    + Create Stage
                </button>
            </div>
        </div>

        <!-- Pipelines will load here -->
        <div id="pipelines" class="mt-4"></div>
    </div>

    <!-- Create Pipeline Modal -->
    <div id="createPipelineModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full mt-10 max-w-2xl rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Create Pipeline</h2>
            <form id="createPipelineForm">
                @csrf
                <div class="grid  grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Pipeline Name -->
                    <div class="flex flex-col">
                        <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Pipeline Name
                        </label>
                        <input type="text" name="name" id="name"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2
                   focus:ring-2 focus:ring-purple-400 focus:border-purple-500
                   dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Enter pipeline name" required>
                    </div>

                    <!-- Tag Color -->
                    <div class="flex flex-col">
                        <label for="tag_color" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Tag Color
                        </label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="tag_color" id="tag_color"
                                class="h-10 w-16 cursor-pointer border border-gray-300 dark:border-gray-600 rounded-lg">
                            <span id="tagColorPreview" class="text-sm text-gray-500 dark:text-gray-400">
                                Pick a color
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="closeCreatePipelineModal"
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

    <div id="createDealStageModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full mt-10 max-w-2xl rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Create Deal Stage</h2>
            <form id="createDealStageForm">
                @csrf
                <div class="grid  grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Pipeline -->
                    <div class="flex flex-col">
                        <label for="lead_pipline_id" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Pipline
                        </label>
                        <select name="lead_pipline_id" id="lead_pipline_id" class="select2 form-select w-full">
                            <option value="active">-- Select PipLine --</option>
                        </select>
                    </div>

                    <!-- Deal Stage -->
                    <div class="flex flex-col">
                        <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Deal Stage*
                        </label>
                        <input type="text" name="name" id="name"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2
                   focus:ring-2 focus:ring-purple-400 focus:border-purple-500
                   dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Enter Deal Stage name" required>
                    </div>

                    <!-- Tag Color -->
                    <div class="flex flex-col">
                        <label for="tag_color" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Tag Color
                        </label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="tag_color" id="tag_color"
                                class="h-10 w-16 cursor-pointer border border-gray-300 dark:border-gray-600 rounded-lg">
                            <span id="tagColorPreview" class="text-sm text-gray-500 dark:text-gray-400">
                                Pick a color
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="closeCreateDealStageModal"
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
        $(document).ready(function() {

            // 🔹 Fetch pipelines from server
            function fetchPipelines() {
                $.ajax({
                    url: "{{ route('admin.settings.lead-pipline.all') }}",
                    type: "GET",
                    success: function(response) {
                        renderPipelines(response);
                    }
                });
            }
            // 🔹 Render pipelines dynamically
            function renderPipelines(pipelines) {
                let html = '';
                if (pipelines.length > 0) {
                    pipelines.forEach(pipeline => {
                        html += `
                <div class="pipeline-box border rounded p-4 mb-4 shadow-sm bg-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold flex items-center gap-2">
                            <span style="color:${pipeline.tag_color}">●</span> ${pipeline.name}
                        </h3>

                        <div class="flex items-center gap-4">
                            <!-- Custom styled checkbox (radio-like) -->
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox"
                                    class="setDefaultPipeline hidden"
                                    name="default_pipeline"
                                    data-id="${pipeline.id}"
                                    ${pipeline.is_default === 'yes' ? 'checked' : ''}>
                                <span class="w-5 h-5 flex items-center justify-center rounded border border-gray-400
                                             checked:bg-purple-600 checked:border-purple-600 transition">
                                    <svg class="hidden w-3 h-3 text-white pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                                <span class="text-sm text-gray-600">Default</span>
                            </label>

                            <!-- Deal stages button -->
                            <button class="px-4 py-2 rounded-lg border !border-[#8D35E3] !text-[#8D35E3]
                                        hover:!bg-[#8D35E3] hover:!text-white font-medium shadow toggle-stages"
                                    data-pipeline-id="${pipeline.id}">
                                Deal Stages
                            </button>
                        </div>
                    </div>

                    <div class="deal-stages mt-3 hidden" id="stages-${pipeline.id}">
                        <table class="table table-bordered w-full">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Deal Stage</th>
                                    <th>Default</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="stages-body" data-pipeline-id="${pipeline.id}">
                                <tr><td colspan="4" class="text-center text-gray-500">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            `;
                    });
                } else {
                    html = `<p class="text-gray-500">No pipelines found</p>`;
                }
                $('#pipelines').html(html);

                // Ensure checkbox UI updates
                updateCheckboxUI();
            }

            function updateCheckboxUI() {
                $('.setDefaultPipeline').each(function() {
                    let isChecked = $(this).is(':checked');
                    let box = $(this).next('span');
                    let icon = box.find('svg');

                    if (isChecked) {
                        box.addClass('bg-purple-600 border-purple-600');
                        icon.removeClass('hidden');
                    } else {
                        box.removeClass('bg-purple-600 border-purple-600');
                        icon.addClass('hidden');
                    }
                });
            }

            // 🔹 Toggle stages (load via AJAX)
            $(document).on('click', '.toggle-stages', function() {
                let pipelineId = $(this).data('pipeline-id');
                let $stagesDiv = $('#stages-' + pipelineId);
                let $stagesBody = $stagesDiv.find('.stages-body');

                if ($stagesDiv.is(':visible')) {
                    $stagesDiv.slideUp();
                    return;
                }

                // Show container + loading text
                $stagesDiv.slideDown();
                $stagesBody.html(
                    `<tr><td colspan="4" class="text-center text-gray-500">Loading...</td></tr>`);

                // Fetch stages via AJAX
                $.ajax({
                    url: "{{ route('admin.settings.deal-stages.byPipeline') }}",
                    type: "GET",
                    data: {
                        pipeline_id: pipelineId
                    },
                    success: function(response) {
                        let html = '';

                        if (response.length > 0) {
                            response.forEach((stage, index) => {
                                html += `
                                        <tr>
                                            <td>${index + 1}</td>
                                            <td>
                                                <span style="color:${stage.tag_color}; font-size:18px;">●</span>
                                                ${stage.name}
                                            </td>
                                            <td class="text-center">
                                                <input type="radio"
                                                    name="default_stage_${stage.lead_pipline_id}"
                                                    class="setDefaultStage"
                                                    data-id="${stage.id}"
                                                    data-pipeline-id="${stage.lead_pipline_id}"
                                                    ${stage.is_default == 'yes' ? 'checked' : ''}>
                                            </td>
                                            <td class="flex gap-2 justify-center">
                                                <button class="editStage text-blue-600 hover:text-blue-800" data-id="${stage.id}" title="Edit">
                                                    <iconify-icon icon="solar:pen-2-bold-duotone" class="text-xl"></iconify-icon>
                                                </button>
                                                <button class="deleteStage text-red-600 hover:text-red-800" data-id="${stage.id}" title="Delete">
                                                    <iconify-icon icon="solar:trash-bin-trash-bold-duotone" class="text-xl"></iconify-icon>
                                                </button>
                                            </td>
                                        </tr>

                                        `;
                            });
                        } else {
                            html =
                                `<tr><td colspan="4" class="text-center text-gray-500">No stages found</td></tr>`;
                        }

                        $stagesBody.html(html);
                    },
                    error: function() {
                        $stagesBody.html(
                            `<tr><td colspan="4" class="text-center text-red-500">Failed to load stages</td></tr>`
                        );
                    }
                });
            });


            // 🔹 Open Pipline modal
            $('#openCreatePipelineModal').on('click', function() {
                $('#createPipelineModal').removeClass('hidden');
            });

            // 🔹 Close Pipline modal
            $('#closeCreatePipelineModal').on('click', function() {
                $('#createPipelineModal').addClass('hidden');
            });

            // Close Pipline modal on outside click
            $(document).on('click', function(e) {
                if ($(e.target).is('#createPipelineModal')) {
                    $('#createPipelineModal').addClass('hidden');
                }
            });

            // 🔹 Open Deal Stage modal
            $('#openCreateDealStageModal').on('click', function() {
                $('#createDealStageModal').removeClass('hidden');

                $.ajax({
                    url: "{{ route('admin.settings.lead-pipline.all') }}",
                    type: "GET",
                    success: function(response) {
                        console.log(response)
                        let leadPiplineSelect = $('#lead_pipline_id');

                        leadPiplineSelect.empty().append(
                            '<option value="">-- Select PipLine --</option>');

                        $.each(response, function(index, pipline) {
                            leadPiplineSelect.append(
                                `<option value="${pipline.id}">${pipline.name}</option>`
                            );
                        });
                        // Initialize Select2 for Category
                        leadPiplineSelect.select2({
                            dropdownParent: $('#createDealStageModal .p-6'),
                            placeholder: "-- Select PipLine --",
                            width: '100%'
                        });
                    },
                    error: function() {
                        toastr.error('Failed to load employees');
                    }
                });
            });

            // 🔹 Close Deal Stage modal
            $('#closeCreateDealStageModal').on('click', function() {
                $('#createDealStageModal').addClass('hidden');
            });

            // Close Deal Stage modal on outside click
            $(document).on('click', function(e) {
                if ($(e.target).is('#createDealStageModal')) {
                    $('#createDealStageModal').addClass('hidden');
                }
            });

            // 🔹 Submit create pipeline form
            $('#createPipelineForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.settings.lead-pipline.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        toastr.success('Pipeline added successfully!', 'Success');
                        $('#createPipelineModal').addClass('hidden');
                        $('#createPipelineForm')[0].reset();
                        fetchPipelines();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ Something went wrong', 'Error');
                        }
                    }
                });
            });

            $('#createDealStageForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.settings.deal-stages.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        toastr.success('Deal Stage added successfully!', 'Success');
                        $('#createDealStageModal').addClass('hidden');
                        $('#createDealStageForm')[0].reset();
                        fetchPipelines();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ Something went wrong', 'Error');
                        }
                    }
                });
            });

            $(document).on('change', '.setDefaultStage', function() {
                let stageId = $(this).data('id');
                let pipline_id = $(this).data('pipeline-id');


                $.ajax({
                    url: "{{ route('admin.settings.deal-stages.setDefault') }}", // 🔹 create this route
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        stage_id: stageId,
                        pipline_id: pipline_id
                    },
                    success: function(response) {
                        toastr.success("Default stage updated successfully ✅");

                        // Ensure only one radio is checked (UI sync)
                        $(`input[name="default_stage_${pipline_id}"]`).prop('checked', false);
                        $(`input[data-id="${stageId}"]`).prop('checked', true);
                    },
                    error: function(xhr) {
                        toastr.error("Failed to update default stage ❌");
                    }
                });
            });

            $(document).on('change', '.setDefaultPipeline', function() {

                $('.setDefaultPipeline').prop('checked', false);
                // Check only the clicked one
                $(this).prop('checked', true);

                // Update UI states
                updateCheckboxUI();


                let pipelineId = $(this).data('id');
                let isChecked = $(this).is(':checked') ? 1 : 0;


                $.ajax({
                    url: "{{ route('admin.settings.pipelines.setDefault') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        pipeline_id: pipelineId,
                        is_default: isChecked
                    },
                    success: function(response) {
                        toastr.success("Pipeline default status updated ✅");
                    },
                    error: function(xhr) {
                        toastr.error("Failed to update pipeline ❌");
                        console.log(xhr.responseJSON);
                    }
                });
            });
            // Initial load
            fetchPipelines();
        });
    </script>
@endpush
