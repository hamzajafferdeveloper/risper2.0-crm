<aside class="sidebar">
    <button type="button" class="sidebar-close-btn !mt-4">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            {{-- <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> AI</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-warning-600 w-auto"></i> CRM</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-info-600 w-auto"></i> eCommerce</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-danger-600 w-auto"></i> Cryptocurrency</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-success-600 w-auto"></i> Investment</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-purple-600 w-auto"></i> LMS / Learning System</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-info-600 w-auto"></i> NFT & Gaming</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-danger-600 w-auto"></i> Medical</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-purple-600 w-auto"></i> Analytics</a>
                    </li>
                </ul>
            </li> --}}
            <li class="sidebar-menu-group-title">Application</li>
            <li>
                <a href={{ route('admin.employees.index') }}>
                    <iconify-icon icon="mage:email" class="menu-icon"></iconify-icon>
                    <span>Employee</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                    <span>Chat</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
                    <span>Calendar</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                    <span>Kanban</span>
                </a>
            </li>
            {{-- <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="heroicons:document" class="menu-icon"></iconify-icon>
                    <span>Forms</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Input Forms</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-warning-600 w-auto"></i> Input Layout</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-success-600 w-auto"></i> Form Validation</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-danger-600 w-auto"></i> Form Wizard</a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</aside>
