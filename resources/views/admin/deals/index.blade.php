@extends('layouts.adminlayout')

@section('title', 'Dashboard')

@section('content-admin')
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <div class="card border-0 overflow-hidden">
                <div class="card-header flex items-center justify-between">
                    <h6 class="card-title mb-0 text-lg">All Deals</h6>
                    <div>
                        <button id="openAddDealModal"
                            class="flex items-center gap-2 !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 text-white font-medium px-2.5 py-2.5 rounded-lg float-end me-4 transition">
                            <iconify-icon icon="simple-line-icons:plus" class="text-lg"></iconify-icon>
                            <p class="text-sm">Add Deals</p>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="deal-table"
                        class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate">
                        <thead>
                            <tr>
                                <th>S.L</th>
                                <th>Deal Name</th>
                                <th>Lead Name</th>
                                <th>Email</th>
                                <th>Value</th>
                                <th>Close Date</th>
                                <th>Deal Agent</th>
                                <th>Deal Watcher</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="addDealModal" class="hidden flex fixed inset-0 z-50  justify-end bg-black/50 transition-opacity duration-300">

        <!-- Modal Panel -->
        <div id="addDealPanel"
            class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl p-6 w-full max-w-7xl z-10 transform translate-x-full transition-transform duration-300">

            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-lg font-semibold">Add New Lead</h2>
                <button class="closeAddDealModal text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <x-admin.add-deal-form />
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let table;

        $(function() {
            table = $('#deal-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.deals.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'lead.email',
                        name: 'email'
                    },
                    {
                        data: 'deal_value',
                        name: 'deal_value'
                    },
                    {
                        data: 'close_date',
                        name: 'close_date'
                    },
                    {
                        data: 'deal_agent_name',
                        name: 'deal_agent_name'
                    },
                    {
                        data: 'deal_watcher_name',
                        name: 'deal_watcher_name'
                    },
                ],
                order: [
                    [1, 'asc']
                ],
                pagingType: "full_numbers",
                language: {
                    paginate: {
                        first: "« First",
                        last: "Last »",
                        previous: "‹",
                        next: "›"
                    }
                }
            });

            // =================== Modal Controls =================== //
            // Utility: open modal
            function openModal(modalId, panelId) {
                $(`#${modalId}`).removeClass('hidden');
                setTimeout(() => {
                    $(`#${panelId}`).removeClass('translate-x-full');
                }, 10);
            }

            // Utility: close modal
            function closeModal(modalId, panelId) {
                $(`#${panelId}`).addClass('translate-x-full');
                setTimeout(() => {
                    $(`#${modalId}`).addClass('hidden');
                }, 150);
            }

            // ========== Add Deal Modal ========== //
            $('#openAddDealModal').on('click', function() {
                openModal('addDealModal', 'addDealPanel');
            });

            $('.closeAddDealModal').on('click', function() {
                closeModal('addDealModal', 'addDealPanel');
            });

            $('#addDealModal').on('click', function(e) {
                if (e.target.id === 'addDealModal') {
                    closeModal('addDealModal', 'addDealPanel');
                }
            });

            $('#addDealForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.deals.store') }}",
                    method: 'post',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function() {
                        toastr.success('Deal added successfully!', 'Success');
                        table.ajax.reload();
                        $('#addDealModal').addClass('hidden');
                        $('#addDealForm')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0], 'Validation Error');
                            });
                        } else {
                            toastr.error('❌ An error occurred while adding the deal.',
                                'Error');
                        }
                    }
                });
            })
        });
    </script>
@endpush
