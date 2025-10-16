@extends('layouts.adminlayout')
@section('title', 'Banners')

@section('content-admin')
    <div class="p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Banners</h2>
            <button id="addBannerBtn" class="!bg-[#8D35E3] hover:!bg-[#8D35E3]/80 text-white px-4 py-2 rounded-lg">
                + Add Banner
            </button>
        </div>

        <!-- Grid List -->
        <div id="bannerGrid" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($banners as $banner)
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-200">
                    <div class="relative">
                        @if ($banner->image)
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}"
                                class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400">No Image
                            </div>
                        @endif
                        <span
                            class="absolute top-2 right-2 px-2 py-1 text-xs rounded-full
                    {{ $banner->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($banner->status) }}
                        </span>
                    </div>

                    <div class="p-4 space-y-2">
                        <h3 class="text-base font-semibold text-gray-800 truncate">{{ $banner->title }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2">{{ $banner->description ?: 'No description' }}</p>
                        <div class="flex justify-end gap-2 mt-3">
                            <button onclick="editBanner({{ $banner->id }})"
                                class="!text-indigo-600 hover:!text-indigo-800 text-sm font-medium">Edit</button>
                            <button onclick="deleteBanner({{ $banner->id }})"
                                class="!text-red-600 hover:!text-red-800 text-sm font-medium">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div id="bannerModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg w-full p-3 max-w-lg">
            <div class=" max-h-[90vh] overflow-y-auto p-3">

                <h3 id="modalTitle" class="text-lg font-semibold mb-4">Add Banner</h3>
                <form id="bannerForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="bannerId">

                    <div class="flex flex-col gap-2">
                        <div>
                            <label class="text-sm font-medium">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div>
                            <label class="text-sm font-medium">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Button Text</label>
                            <input type="text" name="button_text" id="button_text" class="form-control">
                        </div>
                        <div>
                            <label class="text-sm font-medium">Button Link</label>
                            <input type="text" name="link" id="link" class="form-control">
                        </div>
                        <div>
                            <label class="text-sm font-medium">Image</label>
                            <input type="file" name="image" id="image" class="">

                        </div>
                        <div>
                            <label class="text-sm font-medium">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-5 flex justify-end gap-2">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-lg">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 text-white rounded-lg">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        const modal = document.getElementById('bannerModal');
        const form = document.getElementById('bannerForm');
        const addBtn = document.getElementById('addBannerBtn');
        const titleEl = document.getElementById('modalTitle');
        const bannerId = document.getElementById('bannerId');

        addBtn.onclick = () => {
            form.reset();
            bannerId.value = '';
            titleEl.textContent = 'Add Banner';
            modal.classList.remove('hidden');
        };

        function closeModal() {
            modal.classList.add('hidden');
        }

        // Fetch and re-render grid dynamically
        async function reloadGrid() {
            const res = await fetch(`/admin/banners`);
            const html = await res.text();
            const parser = new DOMParser();
            const newGrid = parser.parseFromString(html, 'text/html').querySelector('#bannerGrid').innerHTML;
            document.querySelector('#bannerGrid').innerHTML = newGrid;
        }

        form.onsubmit = async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const id = bannerId.value;
            const url = id ? `/admin/banners/${id}` : `/admin/banners/add`;
            if (id) formData.append('_method', 'PUT');

            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            if (res.ok) {
                closeModal();
                reloadGrid();
            } else {
                alert('Something went wrong!');
            }
        };

        async function editBanner(id) {
            const res = await fetch(`/admin/banners/${id}/edit`);
            const data = await res.json();
            bannerId.value = data.id;
            titleEl.textContent = 'Edit Banner';
            document.getElementById('title').value = data.title;
            document.getElementById('button_text').value = data.button_text;
            document.getElementById('link').value = data.link;
            document.getElementById('description').value = data.description ?? '';
            document.getElementById('status').value = data.status;
            modal.classList.remove('hidden');
        }

        async function deleteBanner(id) {
            confirmDelete(() => {
                const res = await fetch(`/admin/banners/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                if (res.ok) reloadGrid();
            });

        }
    </script>
@endsection
