<div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
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
        <table id="sourceTable" class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                <tr class="border-b">
                    <th class="">ID</th>
                    <th class="w-full">Name</th>
                    <th class="text-end">Actions</th>
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
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Source
                    Name</label>
                <input type="text" name="name" id="name" class="w-full form-control" placeholder="Enter source name"
                    required>
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
                <input type="text" name="name" id="editSourceName" class="w-full form-control" required>
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