@extends('layouts.adminlayout')

@section('title', 'Dashboard')

@section('content-admin')
    <div>
        <div id="tabContent" class="relative h-auto p-6">

            <!-- Tab Navigation -->
            <div class="border-b mb-6 flex gap-6 text-gray-600 overflow-x-auto">
                @php
                    $tabs = [
                        'general' => 'General Info',
                        'company' => 'Company',
                        'deals' => 'Deals',
                        'estimates' => 'Estimates',
                        'proposals' => 'Proposals',
                        'files' => 'Files',
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
                    @foreach ([['Full Name', 'mdi:account-badge-outline', $lead->salutation . ' ' . $lead->name], ['Email', 'mdi:email-outline', $lead->email], ['Lead Source', 'mdi:source-branch', $lead->source->name]] as [$label, $icon, $value])
                        <div
                            class="bg-gray-50 hover:bg-whitecursor-pointer rounded-xl border border-gray-100 px-5 py-3 transition-all duration-300 ease-in-out">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm text-gray-500 uppercase tracking-wide">{{ $label }}</h4>
                                <iconify-icon icon="{{ $icon }}" class="text-[#8d35e3] text-lg"></iconify-icon>
                            </div>
                            <p class="text-base font-medium text-gray-800">{{ $value ?: '----------' }}</p>
                        </div>
                    @endforeach

                    <!-- Assigned To -->
                    <div class="bg-gray-50 rounded-xl border border-gray-100 px-5 py-3 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm text-gray-500 uppercase tracking-wide">Assigned To</h4>
                            <iconify-icon icon="mdi:account-tie-outline" class="text-[#8d35e3] text-lg"></iconify-icon>
                        </div>
                        <div class="text-base flex items-center gap-3 font-medium text-gray-800">
                            <img class="h-12 w-12 rounded-full object-cover border"
                                src="{{ $lead->leadOwner->profile_pic ? '/storage/' . $lead->leadOwner->profile_pic : '/assets/images/avatar/avatar.png' }}" />
                            <div>
                                <p> {{ $lead->leadOwner->name ?: '----------' }}</p>
                                <p class=" font-light text-sm "> {{ $lead->leadOwner->email ?: '----------' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Added By -->
                    <div class="bg-gray-50 rounded-xl border border-gray-100 px-5 py-3 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm text-gray-500 uppercase tracking-wide">Added By</h4>
                            <iconify-icon icon="mdi:account-plus-outline" class="text-[#8d35e3] text-lg"></iconify-icon>
                        </div>
                        <div class="text-base flex items-center gap-3 font-medium text-gray-800">
                            <img class="h-12 w-12 rounded-full object-cover border"
                                src="{{ $lead->leadAddedBy->profile_pic ? '/storage/' . $lead->leadAddedBy->profile_pic : '/assets/images/avatar/avatar.png' }}" />
                            <div>
                                <p> {{ $lead->leadAddedBy->name ?: '----------' }}</p>
                                <p class=" font-light text-sm "> {{ $lead->leadAddedBy->email ?: '----------' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Company -->
            <div id="tab-company" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:office-building-outline" class="text-[#8d35e3]"></iconify-icon>
                    Company Info
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ([['Name', 'mdi:domain', $lead->companyDetail->name], ['Website', 'mdi:web', $lead->companyDetail->website], ['Office Phone', 'mdi:phone-outline', $lead->companyDetail->office_phone_number], ['City', 'mdi:city-variant-outline', ucfirst($lead->companyDetail->city)], ['State', 'mdi:map-marker-outline', $lead->companyDetail->state], ['Postal Code', 'mdi:mailbox-outline', $lead->companyDetail->postal_code], ['Address', 'mdi:home-map-marker-outline', $lead->companyDetail->address]] as [$label, $icon, $value])
                        <div class="bg-gray-50 rounded-xl border border-gray-100 px-5 py-3 hover:shadow-md transition-all">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm text-gray-500 uppercase tracking-wide">{{ $label }}</h4>
                                <iconify-icon icon="{{ $icon }}" class="text-[#8d35e3] text-lg"></iconify-icon>
                            </div>
                            <p class="text-base font-medium text-gray-800">{{ $value ?: '----------' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab: Deals -->
            <div id="tab-deals" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:handshake-outline" class="text-[#8d35e3]"></iconify-icon>
                    Deals
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <div class="bg-gray-50 rounded-xl border border-gray-100 px-5 py-3 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm text-gray-500 uppercase tracking-wide">Deal Watcher</h4>
                            <iconify-icon icon="mdi:eye-outline" class="text-[#8d35e3] text-lg"></iconify-icon>
                        </div>
                        <div class="text-base flex items-center gap-3 font-medium text-gray-800">
                            <img class="h-10 w-10 rounded-full object-cover border"
                                src="{{ $lead->deal->dealWatcher->profile_pic ? '/storage/' . $lead->deal->dealWatcher->profile_pic : '/assets/images/avatar/avatar.png' }}" />

                            <div>
                                <p> {{ $lead->deal->dealWatcher->name ?: '----------' }}</p>
                                <p class=" font-light text-sm "> {{ $lead->deal->dealWatcher->email ?: '----------' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl border border-gray-100 px-5 py-3 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm text-gray-500 uppercase tracking-wide">Deal Stage</h4>
                            <iconify-icon icon="mdi:flag-outline" class="text-[#8d35e3] text-lg"></iconify-icon>
                        </div>
                        <p class="text-base font-medium text-gray-800"> <span class="h-2.5 w-2.5 rounded-full"
                                style="background: {{ $lead->deal->dealStage->tag_color ?: '#fff' }}"></span>
                            {{ $lead->deal->dealStage->name ?: '----------' }}</p>
                    </div>
                </div>
            </div>

            <!-- Tab: Estimates -->
            <div id="tab-estimates" class="tab-content hidden opacity-0 -translate-x-10 transition-all duration-500">
                <h3 class="font-semibold text-xl mb-4 text-gray-800 flex items-center gap-2">
                    <iconify-icon icon="mdi:file-document-outline" class="text-[#8d35e3]"></iconify-icon>
                    Estimates
                </h3>
                <p class="text-gray-600">No estimates added yet.</p>
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
