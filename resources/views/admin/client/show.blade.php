@extends('layouts.adminlayout')

@section('title', 'Client Profile')

@section('content-admin')
    <div class="bg-white flex flex-col gap-3 rounded-2xl shadow-sm overflow-hidden">

        <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-6">
            <!-- Client Info -->
            <div
                class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-primary-600/10 to-bg-white">
                <div class="card-body p-0">
                    <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                        <div class="flex items-center gap-3">
                            <img src="{{ $client->profile_pic ? '/storage/' . $client->profile_pic : '/assets/images/avatar/avatar.png' }}"
                                alt="User"
                                class="w-24 h-24 aspect-square rounded-full border-4 border-[#8d35e3]/60 object-cover shadow-sm" />

                            <div>
                                <h4 class="font-semibold text-gray-800 dark:text-white text-base">{{ $client->name ?? '' }}
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-300">{{ $client->email ?? '' }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-300">{{ $client->mobile ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Projects -->
            <div
                class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-success-600/10 to-bg-white">
                <div class="card-body p-0">
                    <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                        <div class="flex items-center gap-2">
                            <span
                                class="mb-0 w-[44px] h-[44px] bg-success-600 shrink-0 text-white flex justify-center items-center rounded-full h6">
                                <iconify-icon icon="solar:folder-check-bold-duotone" class="text-xl"></iconify-icon>
                            </span>
                            <div>
                                <span class="mb-2 font-medium text-secondary-light text-sm">Total Projects</span>
                                <h6 class="font-semibold">0</h6>
                            </div>
                        </div>

                        <div id="totlal-projects-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="text-sm mb-0">Increase by
                        <span
                            class="bg-success-100 dark:bg-success-600/25 px-1 py-px rounded font-medium text-success-600 dark:text-success-400 text-sm">
                            +0
                        </span> this week
                    </p>
                </div>
            </div>

            <!-- Total Revenue -->
            <div
                class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-warning-600/10 to-bg-white">
                <div class="card-body p-0">
                    <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                        <div class="flex items-center gap-2">
                            <span
                                class="mb-0 w-[44px] h-[44px] bg-warning-600 text-white shrink-0 flex justify-center items-center rounded-full h6">
                                <iconify-icon icon="solar:dollar-bold-duotone" class="text-xl"></iconify-icon>
                            </span>
                            <div>
                                <span class="mb-2 font-medium text-secondary-light text-sm">Total Revenue</span>
                                <h6 class="font-semibold">$0</h6>
                            </div>
                        </div>

                        <div id="total-revenue-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="text-sm mb-0">Increase by
                        <span
                            class="bg-danger-100 dark:bg-danger-600/25 px-1 py-px rounded font-medium text-danger-600 dark:text-danger-400 text-sm">
                            -$0
                        </span> this week
                    </p>
                </div>
            </div>

            <!-- Due Invoices -->
            <div
                class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-purple-600/10 to-bg-white">
                <div class="card-body p-0">
                    <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                        <div class="flex items-center gap-2">
                            <span
                                class="mb-0 w-[44px] h-[44px] bg-purple-600 text-white shrink-0 flex justify-center items-center rounded-full h6">
                                <iconify-icon icon="solar:bill-list-bold-duotone" class="text-xl"></iconify-icon>
                            </span>
                            <div>
                                <span class="mb-2 font-medium text-secondary-light text-sm">Due Invoices</span>
                                <h6 class="font-semibold">0</h6>
                            </div>
                        </div>

                        <div id="due-invoice-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="text-sm mb-0">Increase by
                        <span
                            class="bg-success-100 dark:bg-success-600/25 px-1 py-px rounded font-medium text-success-600 dark:text-success-400 text-sm">
                            +5%
                        </span> this week
                    </p>
                </div>
            </div>
        </div>


        <!-- Tabs -->
        <div id="tabContent" class="relative h-auto p-6">
            <!-- Tab Navigation -->
            <div class="border-b mb-6 flex gap-6 text-gray-600 overflow-x-auto">
                @php $tabs = ['general' => 'General Info', 'company' => 'Company', 'projects' => 'Projects', 'tasks' => 'Tasks', 'social' => 'Social Links', 'account' => 'Account Settings', 'permissions' => 'Permissions']; @endphp

                @foreach ($tabs as $key => $label)
                    <button class="tab-btn pb-3 relative text-sm font-medium whitespace-nowrap transition-all duration-200 "
                        data-tab="{{ $key }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <!-- Tab: General -->
            <div id="tab-general" class="tab-content opacity-100 translate-x-0 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-5 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:information-outline" class="text-[#8d35e3] text-2xl"></iconify-icon>
                    General Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ([['Full Name', 'mdi:account-outline', $client->salutation . ' ' . $client->name], ['Email', 'mdi:email-outline', $client->email], ['Phone', 'mdi:phone-outline', $client->mobile], ['Gender', 'mdi:gender-male-female', ucfirst($client->gender)], ['Category', 'mdi:folder-outline', optional($client->category)->name], ['Sub Category', 'mdi:folder-multiple-outline', optional($client->subCategory)->name], ['Country', 'mdi:earth', optional($client->country)->name], ['Language', 'mdi:translate', optional($client->language)->name]] as [$label, $icon, $value])
                        <div class="bg-gray-50 rounded-xl border border-gray-100 px-5 py-1 hover:shadow-md transition-all">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm text-gray-500 uppercase tracking-wide">{{ $label }}</h4>
                                <iconify-icon icon="{{ $icon }}" class="text-[#8d35e3] text-lg"></iconify-icon>
                            </div>
                            <p class="text-base font-medium text-gray-800">
                                {{ $value ?: '----------' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab: Company -->
            <div id="tab-company" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:office-building-outline" class="text-[#8d35e3]"></iconify-icon>
                    Company Info
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Company Logo --}}
                    <div
                        class="bg-gray-50 rounded-xl border border-gray-100 px-5 py-3 hover:shadow-md transition-all flex flex-col">
                        <div class="flex items-center justify-between w-full mb-3">
                            <h4 class="text-sm text-gray-500 uppercase tracking-wide">Company Logo</h4>
                            <iconify-icon icon="mdi:image-outline" class="text-[#8d35e3] text-lg"></iconify-icon>
                        </div>
                        <div class="flex gap-3 items-center">
                            <img src="{{ $client->companyAddress->logo ? '/storage/' . $client->companyAddress->logo : '/assets/images/avatar/company-placeholder.png' }}"
                                alt="Company Logo"
                                class="w-12 h-12 rounded-full border-4 border-[#8d35e3]/60 object-cover shadow-sm" />
                            <p class="text-base font-medium text-gray-800">
                                {{ $client->companyAddress->name ?? 'Company Name Not Provided' }}
                            </p>
                        </div>
                    </div>

                    {{-- Other company info fields --}}
                    @foreach ([['Website', 'mdi:web', $client->companyAddress->website], ['Office Phone', 'mdi:phone-outline', $client->companyAddress->office_phone_number], ['City', 'mdi:city-variant-outline', ucfirst($client->companyAddress->city)], ['State', 'mdi:map-marker-outline', $client->companyAddress->state], ['Postal Code', 'mdi:mailbox-outline', $client->companyAddress->postal_code], ['Address', 'mdi:home-map-marker-outline', $client->companyAddress->address], ['Shipping Address', 'mdi:truck-delivery-outline', $client->companyAddress->shipping_address], ['Note', 'mdi:note-text-outline', $client->companyAddress->note]] as [$label, $icon, $value])
                        <div class="bg-gray-50 rounded-xl border border-gray-100 px-5 py-1 hover:shadow-md transition-all">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm text-gray-500 uppercase tracking-wide">{{ $label }}</h4>
                                <iconify-icon icon="{{ $icon }}" class="text-[#8d35e3] text-lg"></iconify-icon>
                            </div>
                            <p class="text-base font-medium text-gray-800">
                                {{ $value ?: '----------' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>


            <!-- Tab: Projects -->
            <div id="tab-projects" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:folder-cog-outline" class="text-[#8d35e3]"></iconify-icon>
                    Projects
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    View and manage all your ongoing and completed projects here. You can edit details, update statuses, and
                    organize project files easily.
                </p>
            </div>

            <!-- Tab: Tasks -->
            <div id="tab-tasks" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:check-circle-outline" class="text-[#8d35e3]"></iconify-icon>
                    Tasks
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    Track your assigned tasks, deadlines, and progress. You can also mark tasks as completed and assign new
                    ones to team members.
                </p>
            </div>


            <!-- Tab: Social -->
            <div id="tab-social" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:share-variant-outline" class="text-[#8d35e3]"></iconify-icon>
                    Social Links
                </h3>
                <ul class="space-y-3 text-sm">
                    @foreach (['facebook', 'twitter', 'linkedin'] as $social)
                        <li class="flex items-center gap-2 text-gray-700">
                            <iconify-icon icon="mdi:{{ $social }}"
                                class="{{ $social === 'twitter' ? 'text-sky-500' : ($social === 'linkedin' ? 'text-blue-700' : 'text-blue-600') }}"></iconify-icon>
                            {{ $client->{$social . '_url'} ?? 'Not connected' }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Tab: Account -->
            <div id="tab-account" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:account-cog-outline" class="text-[#8d35e3]"></iconify-icon>
                    Account Settings
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    Manage account preferences, passwords, and notifications.
                </p>
            </div>

            <!-- Tab: Permissions -->
            <div id="tab-permissions" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:lock-check-outline" class="text-[#8d35e3]"></iconify-icon>
                    Permissions
                </h3>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li>✔️ View Reports</li>
                    <li>✔️ Edit Client Info</li>
                    <li>❌ Delete Account</li>
                </ul>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tabContainer = document.querySelector(".border-b.mb-6");
            const tabs = tabContainer.querySelectorAll(".tab-btn");
            const contents = document.querySelectorAll(".tab-content");

            // Create underline bar
            const activeBar = document.createElement("div");
            activeBar.id = "activeBar";
            activeBar.className = "absolute bottom-0 h-[2px] bg-[#8D35E3] transition-all duration-300 ease-in-out";
            tabContainer.classList.add("relative");
            tabContainer.appendChild(activeBar);

            // Helper: activate specific tab
            function activateTab(tab) {
                const target = tab.dataset.tab;

                // Update text colors
                tabs.forEach(t => t.classList.remove("text-[#8D35E3]"));
                tab.classList.add("text-[#8D35E3]");

                // Move underline
                const {
                    offsetLeft,
                    offsetWidth
                } = tab;
                activeBar.style.left = offsetLeft + "px";
                activeBar.style.width = offsetWidth + "px";

                // Hide/show tab contents with transition
                contents.forEach(c => {
                    c.classList.add("hidden", "opacity-0", "-translate-x-10");
                    c.classList.remove("opacity-100", "translate-x-0");
                });
                const targetContent = document.getElementById(`tab-${target}`);
                targetContent.classList.remove("hidden");
                setTimeout(() => {
                    targetContent.classList.add("opacity-100", "translate-x-0");
                    targetContent.classList.remove("opacity-0", "-translate-x-10");
                }, 50);
            }

            // Add click listeners
            tabs.forEach(tab => {
                tab.addEventListener("click", () => activateTab(tab));
            });

            // Initialize first tab
            if (tabs.length > 0) {
                activateTab(tabs[0]);
            }
        });

        // ================================== Crm Home widgets charts Start =================================
        function createWidgetChart(chartId, chartColor) {

            let currentYear = new Date().getFullYear();

            var options = {
                series: [{
                    name: 'series1',
                    data: [35, 45, 38, 41, 36, 43, 37, 55, 40],
                }, ],
                chart: {
                    type: 'area',
                    width: 100,
                    height: 42,
                    sparkline: {
                        enabled: true // Remove whitespace
                    },

                    toolbar: {
                        show: false
                    },
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                    colors: [chartColor],
                    lineCap: 'round'
                },
                grid: {
                    show: true,
                    borderColor: 'transparent',
                    strokeDashArray: 0,
                    position: 'back',
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                    row: {
                        colors: undefined,
                        opacity: 0.5
                    },
                    column: {
                        colors: undefined,
                        opacity: 0.5
                    },
                    padding: {
                        top: -3,
                        right: 0,
                        bottom: 0,
                        left: 0
                    },
                },
                fill: {
                    type: 'gradient',
                    colors: [chartColor], // Set the starting color (top color) here
                    gradient: {
                        shade: 'light', // Gradient shading type
                        type: 'vertical', // Gradient direction (vertical)
                        shadeIntensity: 0.5, // Intensity of the gradient shading
                        gradientToColors: [`${chartColor}00`], // Bottom gradient color (with transparency)
                        inverseColors: false, // Do not invert colors
                        opacityFrom: .75, // Starting opacity
                        opacityTo: 0.3, // Ending opacity
                        stops: [0, 100],
                    },
                },
                // Customize the circle marker color on hover
                markers: {
                    colors: [chartColor],
                    strokeWidth: 2,
                    size: 0,
                    hover: {
                        size: 8
                    }
                },
                xaxis: {
                    labels: {
                        show: false
                    },
                    categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`, `Apr ${currentYear}`,
                        `May ${currentYear}`, `Jun ${currentYear}`, `Jul ${currentYear}`, `Aug ${currentYear}`,
                        `Sep ${currentYear}`, `Oct ${currentYear}`, `Nov ${currentYear}`, `Dec ${currentYear}`
                    ],
                    tooltip: {
                        enabled: false,
                    },
                },
                yaxis: {
                    labels: {
                        show: false
                    }
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
            chart.render();
        }

        // Call the function for each chart with the desired ID and color
        createWidgetChart('totlal-projects-chart', '#45b369');
        createWidgetChart('total-revenue-chart', '#f4941e');
        createWidgetChart('due-invoice-chart', '#8252e9');
        // ================================== Crm Home widgets charts End =================================
    </script>
@endpush
