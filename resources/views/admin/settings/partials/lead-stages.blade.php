<div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
    <!-- Header -->
    <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Lead Stage</h2>
        <button id="opencreateStageModal"
            class="py-2 px-4 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
            + Create
        </button>
    </div>

    <!-- Table -->
    <div class="p-4">
        <table id="stageTable" class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                <tr class="border-b">
                    <th class="">ID</th>
                    <th class="w-full">Name</th>
                    <th class="text-center">Tag Color</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Create Stage Modal -->
<div id="createStageModal"
    class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
    <div
        class="bg-white dark:bg-gray-800 mt-10 w-full max-w-md rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Create Stage</h2>
        <form id="createStageForm">
            @csrf

            <!-- Stage Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Stage Name
                </label>
                <input type="text" name="name" id="name"
                    class="w-full form-control rounded-lg border-gray-300 dark:border-gray-600"
                    placeholder="Enter Stage name" required>
            </div>

            <!-- Tag Color -->
            <div class="mb-4">
                <label for="tag_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Tag Color
                </label>
                <input type="color" name="tag_color" id="tag_color"
                    class="w-16 h-10 cursor-pointer border border-gray-300 dark:border-gray-600 rounded-md">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" id="closecreateStageModal"
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

<!-- Edit Stage Modal -->
<div id="editStageModal"
    class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
    <div
        class="bg-white dark:bg-gray-800 mt-10 w-full max-w-md rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Edit Stage</h2>
        <form id="editStageForm">
            @csrf
            <input type="hidden" name="id" id="editStageId">

            <!-- Stage Name -->
            <div class="mb-4">
                <label for="editStageName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Stage Name
                </label>
                <input type="text" name="name" id="editStageName"
                    class="w-full form-control rounded-lg border-gray-300 dark:border-gray-600" required>
            </div>

            <!-- Tag Color -->
            <div class="mb-4">
                <label for="editTagColor" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Tag Color
                </label>
                <input type="color" name="tag_color" id="editTagColor"
                    class="w-16 h-10 cursor-pointer border border-gray-300 dark:border-gray-600 rounded-md">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" id="closeEditStageModal"
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
