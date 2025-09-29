<div id="confirmModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div id="confirmPanel"
        class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl p-6 w-full max-w-sm transform scale-95 transition-transform duration-300">
        <h2 class="text-lg font-semibold mb-4">Are you sure?</h2>
        <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button id="cancelDelete"
                class="px-4 py-2 rounded bg-gray-300 dark:bg-gray-600 hover:bg-gray-400">Cancel</button>
            <button id="confirmDelete" class="px-4 py-2 rounded !bg-red-500 text-white hover:!bg-red-600">Delete</button>
        </div>
    </div>
</div>
