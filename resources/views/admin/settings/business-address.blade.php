@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
        <!-- Header -->
        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">All Business Addresses</h2>
            <button id="openCreateAddressModal"
                class="py-2 px-4 rounded-lg !bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium shadow hover:opacity-90 transition">
                + Add Address
            </button>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="businessAddressTable"
                class="!w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Country</th>
                        <th class="px-4 py-3 border-b">Location</th>
                        <th class="px-4 py-3 border-b">Tax Name</th>
                        <th class="px-4 py-3 border-b">Tax Number</th>
                        <th class="px-4 py-3 border-b">Address</th>
                        <th class="px-4 py-3 border-b">Coordinates</th>
                        <th class="px-4 py-3 border-b text-center">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- CREATE MODAL -->
    <div id="createAddressModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div
            class="bg-white dark:bg-gray-800 w-full max-w-3xl rounded-xl shadow-lg p-6 animate__animated animate__fadeInDown relative">
            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Add Business Address</h2>
            <form id="createAddressForm" class="flex flex-col gap-3">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="country_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                        <select name="country_id" id="country_id" class="form-select select2 w-full">
                            <option value="">-- Select Country --</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="location"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                        <input type="text" name="location" id="location" class="w-full form-control"
                            placeholder="Enter location" required>
                    </div>

                    <div>
                        <label for="tax_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tax
                            Name</label>
                        <input type="text" name="tax_name" id="tax_name" class="w-full form-control"
                            placeholder="Enter tax name">
                    </div>

                    <div>
                        <label for="tax_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tax
                            Number</label>
                        <input type="text" name="tax_number" id="tax_number" class="w-full form-control"
                            placeholder="Enter tax number">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="address"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <textarea name="address" id="address" class="w-full form-control" rows="2" placeholder="Enter full address"
                            required></textarea>
                    </div>

                    <div>
                        <label for="latitude"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Latitude</label>
                        <input type="text" name="latitude" id="latitude" class="w-full form-control"
                            placeholder="Latitude">
                    </div>

                    <div>
                        <label for="longitude"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Longitude</label>
                        <input type="text" name="longitude" id="longitude" class="w-full form-control"
                            placeholder="Longitude">
                    </div>
                </div>

                <div class="flex justify-end mt-4 gap-2">
                    <button type="button" id="closeCreateAddressModal"
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

    <!-- EDIT MODAL -->
    <div id="editAddressModal"
        class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex justify-center items-start pt-20 z-50">
        <div class="bg-white dark:bg-gray-800 w-full max-w-3xl rounded-xl shadow-lg p-6 relative">
            <h2 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Edit Business Address</h2>
            <form id="editAddressForm" class="flex flex-col gap-3">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_country_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                        <select name="country_id" id="edit_country_id" class="form-select select2 w-full">
                            <option value="">-- Select Country --</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="edit_location">Location</label>
                        <input type="text" name="location" id="edit_location" class="w-full form-control">
                    </div>

                    <div>
                        <label for="edit_tax_name">Tax Name</label>
                        <input type="text" name="tax_name" id="edit_tax_name" class="w-full form-control">
                    </div>

                    <div>
                        <label for="edit_tax_number">Tax Number</label>
                        <input type="text" name="tax_number" id="edit_tax_number" class="w-full form-control">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="edit_address">Address</label>
                        <textarea name="address" id="edit_address" class="w-full form-control" rows="2"></textarea>
                    </div>

                    <div>
                        <label for="edit_latitude">Latitude</label>
                        <input type="text" name="latitude" id="edit_latitude" class="w-full form-control">
                    </div>

                    <div>
                        <label for="edit_longitude">Longitude</label>
                        <input type="text" name="longitude" id="edit_longitude" class="w-full form-control">
                    </div>
                </div>

                <div class="flex justify-end mt-4 gap-2">
                    <button type="button" id="closeEditAddressModal"
                        class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 !bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#businessAddressTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.settings.business-address') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'country_name',
                        name: 'country_name',
                        defaultContent: '-'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'tax_name',
                        name: 'tax_name'
                    },
                    {
                        data: 'tax_number',
                        name: 'tax_number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: null,
                        render: (data) => `${data.latitude ?? '-'}, ${data.longitude ?? '-'}`
                    },
                    {
                        data: 'id',
                        render: (id) =>
                            `
                    <button class="editAddress !bg-blue-500 hover:!bg-blue-600 text-white px-3 py-1 rounded text-xs" data-id="${id}">Edit</button>
                    <button class="deleteAddress !bg-red-500 hover:!bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${id}">Delete</button>`
                    }
                ]
            });

            // Select2 init
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });

            // Open create modal
            $('#openCreateAddressModal').on('click', () => $('#createAddressModal').removeClass('hidden'));
            $('#closeCreateAddressModal').on('click', () => $('#createAddressModal').addClass('hidden'));

            // Create form submit
            $('#createAddressForm').on('submit', function(e) {
                e.preventDefault();
                $.post("{{ route('admin.business-addresses.store') }}", $(this).serialize())
                    .done(() => {
                        toastr.success('Business address added successfully!');
                        $('#createAddressModal').addClass('hidden');
                        this.reset();
                        table.ajax.reload();
                    })
                    .fail(() => toastr.error('Failed to create address.'));
            });

            // Edit
            $(document).on('click', '.editAddress', function() {
                const id = $(this).data('id');
                $.get(`/admin/business-addresses/${id}/edit`, (res) => {
                    $('#edit_id').val(res.id);
                    $('#edit_country_id').val(res.country_id).trigger('change');
                    $('#edit_location').val(res.location);
                    $('#edit_tax_name').val(res.tax_name);
                    $('#edit_tax_number').val(res.tax_number);
                    $('#edit_address').val(res.address);
                    $('#edit_latitude').val(res.latitude);
                    $('#edit_longitude').val(res.longitude);
                    $('#editAddressModal').removeClass('hidden');
                });
            });

            $('#closeEditAddressModal').on('click', () => $('#editAddressModal').addClass('hidden'));

            $('#editAddressForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_id').val();
                $.ajax({
                    url: `/admin/settings/business-addresses/${id}`,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: () => {
                        toastr.success('Business address updated successfully!');
                        $('#editAddressModal').addClass('hidden');
                        table.ajax.reload();
                    },
                    error: () => toastr.error('Failed to update address.')
                });
            });

            // Delete
            $(document).on('click', '.deleteAddress', function() {
                const id = $(this).data('id');
                confirmDelete(() => {

                    $.ajax({
                        url: `/admin/business-addresses/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: () => {
                            toastr.success('Business address deleted!');
                            table.ajax.reload();
                        },
                        error: () => toastr.error('Failed to delete address.')
                    });

                });
            });
        });
    </script>
@endpush
