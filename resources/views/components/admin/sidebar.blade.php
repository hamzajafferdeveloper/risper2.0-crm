<aside class="sidebar">
    <button type="button" class="sidebar-close-btn !mt-4">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">

            <li>
                <a href="#">
                    <iconify-icon icon="hugeicons:computer" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href={{ route('admin.employees.index') }}>
                    <iconify-icon icon="mage:email" class="menu-icon"></iconify-icon>
                    <span>Employee</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <iconify-icon icon="streamline:baggage" class="menu-icon"></iconify-icon>
                    <span>Clients</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.leads.index') }}">
                    <iconify-icon icon="solar:layers-linear" class="menu-icon"></iconify-icon>
                    <span>Leads</span>
                </a>
            </li>
            {{-- <li>
                <a href={{ route('admin.deals.index') }}>
                    <iconify-icon icon="fluent-emoji-high-contrast:handshake" class="menu-icon"></iconify-icon>
                    <span>Deals</span>
                </a>
            </li> --}}
            <li>
                <a href="#">
                    <iconify-icon icon="uil:calender" class="menu-icon"></iconify-icon>
                    <span>Events</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <iconify-icon icon="solar:folder-with-files-linear" class="menu-icon"></iconify-icon>
                    <span>Files</span>
                </a>
            </li>
            <li>
                <a href={{ route('admin.settings.index') }}>
                    <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
