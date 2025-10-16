<!-- Add Project Modal -->
<div id="addProjectModal" class="hidden fixed inset-0 z-50 flex justify-end bg-black/50 transition-opacity duration-300">
    <div id="addProjectPanel"
        class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl w-full max-w-7xl z-10 transform translate-x-full transition-transform duration-300 overflow-y-auto p-6">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h2 class="text-lg font-semibold">Add New Project</h2>
            <button class="closeAddModal text-gray-500 hover:text-gray-700">✕</button>
        </div>
        <x-admin.project-form formId="addProjectForm" />
    </div>
</div>

<!-- Edit Project Modal -->
<div id="editProjectModal" class="hidden fixed inset-0 z-50 flex justify-end bg-black/50 transition-opacity duration-300">
    <div id="editProjectPanel"
        class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl w-full max-w-7xl z-10 transform translate-x-full transition-transform duration-300 overflow-y-auto p-6">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h2 class="text-lg font-semibold">Edit Project</h2>
            <button class="closeEditModal text-gray-500 hover:text-gray-700">✕</button>
        </div>
        <x-admin.project-form formId="editProjectForm" />
    </div>
</div>
