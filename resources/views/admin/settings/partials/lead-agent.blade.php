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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Category</th>
                    <th class="text-end">Actions</th>

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

<!-- ✅ NEW Edit Agent Modal -->
<div id="editAgentModal"
    class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
    <div
        class="bg-white dark:bg-gray-800 w-full mt-10 max-w-2xl rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Edit Agent</h2>
        <form id="editAgentForm">@csrf
            <input type="hidden" name="id" id="editAgentId">
            <div class="flex gap-2">
                <div class="mb-4 w-1/2">
                    <label for="editAgentEmployee"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Employee</label>
                    <select name="employee_id" id="editAgentEmployee" class="select2 form-select w-full" required>
                        <option value="">-- Select Employee --</option>
                    </select>
                </div>
                <div class="mb-4 w-1/2">
                    <label for="editAgentCategory"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                    <select name="deal_category_id" id="editAgentCategory" class="select2 form-select w-full" required>
                        <option value="">-- Select Category --</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="closeEditAgentModal"
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