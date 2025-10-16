@extends('layouts.adminlayout')
@section('title', 'Projects')

@section('content-admin')
    <div class="card-header flex items-center justify-between">
        <div class="flex gap-1">
            <iconify-icon icon="la:project-diagram" class="!text-[#8D35E3] text-2xl"></iconify-icon>
            <h6 class="card-title mb-0 text-xl">All Projects</h6>
        </div>
        <button id="openAddProjectModal"
            class="flex items-center gap-2 !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 text-white font-medium px-3 py-2.5 rounded-lg transition">
            <iconify-icon icon="simple-line-icons:plus" class="text-lg"></iconify-icon>
            <span class="text-sm">Add Project</span>
        </button>
    </div>

    {{-- Modals --}}
    @include('admin.projects.partial.add-edit-modal')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.select2').each(function() {
                const placeholder = $(this).data('placeholder') || 'Select option';

                $(this).select2({
                    width: '100%',
                    placeholder: placeholder,
                    allowClear: true,
                });
            });

            // =================== Modal Utilities =================== //
            function openModal(modalId, panelId) {
                $(`#${modalId}`).removeClass('hidden');
                setTimeout(() => $(`#${panelId}`).removeClass('translate-x-full'), 10);
            }

            function closeModal(modalId, panelId) {
                $(`#${panelId}`).addClass('translate-x-full');
                setTimeout(() => $(`#${modalId}`).addClass('hidden'), 150);
            }

            // =================== Add Modal =================== //
            $('#openAddProjectModal').on('click', function() {
                openModal('addProjectModal', 'addProjectPanel');
                setTimeout(() => initSelect2('#addProjectModal'), 200);
            });

            $(document).on('click', '.closeAddModal', function() {
                $('#addProjectForm')[0].reset();
                closeModal('addProjectModal', 'addProjectPanel');
            });

            $('#addProjectModal').on('click', function(e) {
                if (e.target.id === 'addProjectModal') {
                    $('#addProjectForm')[0].reset();
                    closeModal('addProjectModal', 'addProjectPanel');
                }
            });

            // =================== Edit Modal =================== //
            $(document).on('click', '.openEditProjectModal', function() {
                openModal('editProjectModal', 'editProjectPanel');
            });

            $(document).on('click', '.closeEditModal', function() {
                $('#editProjectForm')[0].reset();
                closeModal('editProjectModal', 'editProjectPanel');
            });

            $('#editProjectModal').on('click', function(e) {
                if (e.target.id === 'editProjectModal') {
                    $('#editProjectForm')[0].reset();
                    closeModal('editProjectModal', 'editProjectPanel');
                }
            });
        });
    </script>
@endpush
