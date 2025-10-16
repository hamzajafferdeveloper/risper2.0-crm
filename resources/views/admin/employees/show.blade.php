@extends('layouts.adminlayout')

@section('title', 'Employees Details')

@section('content-admin')
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 3xl:grid-cols-5 gap-3">
            <!-- Employee Info -->
            <div
                class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-primary-600/10 to-bg-white">
                <div class="card-body p-0">
                    <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                        <div class="flex items-center gap-3">
                            <img src="{{ $employee->profile_pic ? '/storage/' . $employee->profile_pic : '/assets/images/avatar/avatar.png' }}"
                                alt="User"
                                class="w-24 h-24 aspect-square rounded-full border-4 border-[#8d35e3]/60 object-cover shadow-sm" />

                            <div>
                                <h4 class="font-semibold text-gray-800 dark:text-white text-base">{{ $employee->name ?? '' }}
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-300">{{ $employee->email ?? '' }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-300">{{ $employee->mobile ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AI Widgets Start -->
            <div
                class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-cyan-600/10 to-white/10">
                <div class="card-body p-5">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <p class="font-medium text-neutral-900 dark:text-white mb-1">Open Projects</p>
                            <h6 class="mb-0 dark:text-white">22</h6>
                        </div>
                        <div class="w-[50px] h-[50px] bg-cyan-600 rounded-full flex justify-center items-center">
                            <iconify-icon icon="mdi:folder-open" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +5
                        </span>
                        Last 30 days projects
                    </p>
                </div>
            </div><!-- card end -->

            <div
                class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-purple-600/10 to-white/10">
                <div class="card-body p-5">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <p class="font-medium text-neutral-900 dark:text-white mb-1">Projects Completed</p>
                            <h6 class="mb-0 dark:text-white">7</h6>
                        </div>
                        <div class="w-[50px] h-[50px] bg-purple-600 rounded-full flex justify-center items-center">
                            <iconify-icon icon="mdi:check-decagram" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1 text-danger-600 dark:text-danger-400">
                            <iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> -2
                        </span>
                        Last 30 days completions
                    </p>
                </div>
            </div><!-- card end -->

            <div
                class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-blue-600/10 to-white/10">
                <div class="card-body p-5">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <p class="font-medium text-neutral-900 dark:text-white mb-1">Total Hours Worked</p>
                            <h6 class="mb-0 dark:text-white">218.42</h6>
                        </div>
                        <div class="w-[50px] h-[50px] bg-blue-600 rounded-full flex justify-center items-center">
                            <iconify-icon icon="mdi:clock-time-eight-outline"
                                class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +12.5
                        </span>
                        Last 30 days hours
                    </p>
                </div>
            </div><!-- card end -->

            <div
                class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-emerald-600/10 to-white/10">
                <div class="card-body p-5">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <p class="font-medium text-neutral-900 dark:text-white mb-1">Total Project Hours</p>
                            <h6 class="mb-0 dark:text-white">242.34</h6>
                        </div>
                        <div class="w-[50px] h-[50px] bg-emerald-600 rounded-full flex justify-center items-center">
                            <iconify-icon icon="mdi:chart-line" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +24.3
                        </span>
                        Last 30 days total
                    </p>
                </div>
            </div><!-- card end -->
            <!-- AI Widgets End -->

        </div>


        <div id="tabContent" class="relative h-auto p-6">

            <!-- Tab Navigation -->
            <div class="border-b mb-6 flex gap-6 text-gray-600 overflow-x-auto">
                @php
                    $tabs = [
                        'general' => 'General Info',
                        'job' => 'Job Info',
                        'projects' => 'Projects',
                        'tasks' => 'Tasks',
                    ];
                @endphp

                @foreach ($tabs as $key => $label)
                    <button class="tab-btn pb-3 relative text-sm font-medium whitespace-nowrap transition-all duration-200"
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
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ([['Full Name', 'mdi:account-badge-outline', $employee->salutation . ' ' . $employee->name], ['Email', 'mdi:email-outline', $employee->email], ['Mobile', 'mdi:phone-outline', $employee->mobile], ['Date of Birth', 'mdi:cake-variant-outline', \Carbon\Carbon::parse($employee->date_of_birth)->format('d M Y')], ['Address', 'mdi:map-marker-outline', $employee->address], ['Language', 'mdi:translate', $employee->language?->name], ['Country', 'mdi:earth', $employee->country?->name], ['Gender', 'mdi:gender-male-female', ucfirst($employee->gender)], ['About', 'mdi:note-text-outline', $employee->about], ['Marital Status', 'mdi:note-text-outline', $employee->marital_status]] as [$label, $icon, $value])
                        <div
                            class="bg-gray-50 hover:bg-whitecursor-pointer rounded-xl border border-gray-100 px-5 py-3 transition-all duration-300 ease-in-out">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm text-gray-500 uppercase tracking-wide">{{ $label }}</h4>
                                <iconify-icon icon="{{ $icon }}" class="text-[#8d35e3] text-lg"></iconify-icon>
                            </div>
                            <p class="text-base font-medium text-gray-800">{{ $value ?: '----------' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab: Company -->
            <div id="tab-job" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:office-building-outline" class="text-[#8d35e3]"></iconify-icon>
                    Job Info
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ([['Designation', 'mdi:briefcase-outline', $employee->designation->name], ['Department', 'mdi:office-building-outline', $employee->department?->name], ['Bussniess Address', 'mdi:map-marker-outline', $employee->businessAddress?->address], ['Joining Date', 'mdi:calendar-check-outline', \Carbon\Carbon::parse($employee->joining_date)->format('d M Y')], ['Probation End Date', 'mdi:calendar-alert-outline', \Carbon\Carbon::parse($employee->probation_end_date)->format('d M Y')], ['Notice Period Start Date', 'mdi:calendar-range-outline', \Carbon\Carbon::parse($employee->notice_period_start_date)->format('d M Y')], ['Notice Period End Date', 'mdi:cake-variant-outline', \Carbon\Carbon::parse($employee->notice_period_end_date)->format('d M Y')]] as [$label, $icon, $value])
                        <div
                            class="bg-gray-50 hover:bg-whitecursor-pointer rounded-xl border border-gray-100 px-5 py-3 transition-all duration-300 ease-in-out">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm text-gray-500 uppercase tracking-wide">{{ $label }}</h4>
                                <iconify-icon icon="{{ $icon }}" class="text-[#8d35e3] text-lg"></iconify-icon>
                            </div>
                            <p class="text-base font-medium text-gray-800">{{ $value ?: '----------' }}</p>
                        </div>
                    @endforeach

                    <!-- Reporting To -->
                    <div class="bg-gray-50 rounded-xl border border-gray-100 px-5 py-3 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm text-gray-500 uppercase tracking-wide">Assigned To</h4>
                            <iconify-icon icon="mdi:account-tie-outline" class="text-[#8d35e3] text-lg"></iconify-icon>
                        </div>
                        <div class="text-base flex items-center gap-3 font-medium text-gray-800">
                            <img class="h-12 w-12 rounded-full object-cover border"
                                src="{{ $employee->reportingTo?->profile_pic ? '/storage/' . $employee->reportingTo->profile_pic : '/assets/images/avatar/avatar.png' }}" />
                            <div>
                                <p> {{ $employee->reportingTo?->name ?: '----------' }}</p>
                                <p class=" font-light text-sm "> {{ $employee->reportingTo->email ?: '----------' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Deals -->
            <div id="tab-projects" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:handshake-outline" class="text-[#8d35e3]"></iconify-icon>
                    Projects
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                </div>
            </div>

            <!-- Tab: Estimates -->
            <div id="tab-tasks" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:file-document-outline" class="text-[#8d35e3]"></iconify-icon>
                    Tasks
                </h3>
                <p class="text-gray-600">No tasks added yet.</p>
            </div>

            <!-- Tab: Proposals -->
            <div id="tab-proposals" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:file-sign-outline" class="text-[#8d35e3]"></iconify-icon>
                    Proposals
                </h3>
                <p class="text-gray-600">Manage client proposals and documents.</p>
            </div>

            <!-- Tab: Files -->
            <div id="tab-files" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:folder-outline" class="text-[#8d35e3]"></iconify-icon>
                    Files
                </h3>
                <p class="text-gray-600">Uploaded files will appear here.</p>
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

            const activeBar = document.createElement("div");
            activeBar.id = "activeBar";
            activeBar.className = "absolute bottom-0 h-[2px] bg-[#8D35E3] transition-all duration-300 ease-in-out";
            tabContainer.classList.add("relative");
            tabContainer.appendChild(activeBar);

            function activateTab(tab) {
                const target = tab.dataset.tab;
                tabs.forEach(t => t.classList.remove("text-[#8D35E3]"));
                tab.classList.add("text-[#8D35E3]");
                const {
                    offsetLeft,
                    offsetWidth
                } = tab;
                activeBar.style.left = offsetLeft + "px";
                activeBar.style.width = offsetWidth + "px";
                contents.forEach(c => c.classList.add("hidden", "opacity-0", "-translate-x-10"));
                const targetContent = document.getElementById(`tab-${target}`);
                targetContent.classList.remove("hidden");
                setTimeout(() => {
                    targetContent.classList.add("opacity-100", "translate-x-0");
                    targetContent.classList.remove("opacity-0", "-translate-x-10");
                }, 50);
            }

            tabs.forEach(tab => tab.addEventListener("click", () => activateTab(tab)));
            if (tabs.length > 0) activateTab(tabs[0]);
        });
    </script>
@endpush
