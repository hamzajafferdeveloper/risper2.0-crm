<!-- Add Employee Modal -->
<div id="addClientModal" class="hidden flex fixed inset-0 z-50  justify-end bg-black/50 transition-opacity duration-300">

    <!-- Modal Panel -->
    <div id="addClientPanel"
        class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl p-6 w-full max-w-7xl z-10 transform translate-x-full transition-transform duration-300">

        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h2 class="text-lg font-semibold">Add New Client</h2>
            <button class="closeAddModal text-gray-500 hover:text-gray-700">✕</button>
        </div>

        <x-admin.client-form formId="addClientForm" />
    </div>
</div>
<!-- Edit Employee Modal -->
<div id="editClientModal" class="hidden flex fixed inset-0 z-50  justify-end bg-black/50 transition-opacity duration-300">

    <!-- Modal Panel -->
    <div id="editClientPanel"
        class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl p-6 w-full max-w-7xl z-10 transform translate-x-full transition-transform duration-300">

        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h2 class="text-lg font-semibold">Edit Client</h2>
            <button class="closeEditModal text-gray-500 hover:text-gray-700">✕</button>
        </div>

        <x-admin.client-form formId="editClientForm" />
    </div>
</div>
