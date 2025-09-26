<div class="w-64 border border-gray-50 shadow-xl rounded-xl max-h-[80vh] h-screen bg-gray-100 dark:bg-gray-800 p-4 flex flex-col">
    <style>
        .setting-sidebar-search {
            width: 14.25rem !important;
        }
    </style>

    @php
        $settingLinks = [
            ['name' => 'Company Settings', 'route' => 'admin.settings.index'],
            ['name' => 'Business Address', 'route' => 'admin.settings.business-address'],
        ];
        $currentRoute = Route::currentRouteName();
    @endphp

    <!-- Title -->
    <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200">Settings</h2>

    <!-- Search -->
    <div class="navbar-search mb-4 relative">
        <input type="text" name="settingsSearch" id="settingsSearch" class="setting-sidebar-search" placeholder="Search">
        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
    </div>

    <!-- Links -->
    <ul id="settingsLinks" class="flex-1 overflow-y-auto">
        @foreach ($settingLinks as $link)
            @php
                $isActive = $currentRoute === $link['route'];
            @endphp
            <li>
                <a href="{{ route($link['route']) }}"
                    class="block py-2 px-3 rounded
                    {{ $isActive ? 'bg-blue-500 text-white dark:bg-blue-600' : 'hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600' }}">
                    {{ $link['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<script>
    // Simple search filter
    const searchInput = document.getElementById('settingsSearch');
    const links = document.querySelectorAll('#settingsLinks li');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        links.forEach(link => {
            const text = link.textContent.toLowerCase();
            link.style.display = text.includes(query) ? 'block' : 'none';
        });
    });
</script>
