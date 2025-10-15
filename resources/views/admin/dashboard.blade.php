@extends('layouts.adminlayout')

@section('title', 'Dashboard')

@section('content-admin')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">
        <div class="lg:col-span-12 2xl:col-span-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div
                    class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-primary-600/10 to-bg-white">
                    <div class="card-body p-0">
                        <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                            <div class="flex items-center gap-2">
                                <span
                                    class="mb-0 w-[44px] h-[44px] bg-primary-600 shrink-0 text-white flex justify-center items-center rounded-full h6">
                                    <iconify-icon icon="mingcute:user-follow-fill" class="icon"></iconify-icon>
                                </span>
                                <div>
                                    <span class="mb-2 font-medium text-secondary-light text-sm">New Users</span>
                                    <h6 class="font-semibold">15,000</h6>
                                </div>
                            </div>

                            <div id="new-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                        <p class="text-sm mb-0">Increase by <span
                                class="bg-success-100 dark:bg-success-600/25 px-1 py-px rounded font-medium text-success-600 dark:text-success-400 text-sm">+200</span>
                            this week</p>
                    </div>
                </div>

                <div
                    class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-success-600/10 to-bg-white">
                    <div class="card-body p-0">
                        <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                            <div class="flex items-center gap-2">
                                <span
                                    class="mb-0 w-[44px] h-[44px] bg-success-600 shrink-0 text-white flex justify-center items-center rounded-full h6">
                                    <iconify-icon icon="mingcute:user-follow-fill" class="icon"></iconify-icon>
                                </span>
                                <div>
                                    <span class="mb-2 font-medium text-secondary-light text-sm">Active Users</span>
                                    <h6 class="font-semibold">8,000</h6>
                                </div>
                            </div>

                            <div id="active-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                        <p class="text-sm mb-0">Increase by <span
                                class="bg-success-100 dark:bg-success-600/25 px-1 py-px rounded font-medium text-success-600 dark:text-success-400 text-sm">+200</span>
                            this week</p>
                    </div>
                </div>

                <div
                    class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-warning-600/10 to-bg-white">
                    <div class="card-body p-0">
                        <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                            <div class="flex items-center gap-2">
                                <span
                                    class="mb-0 w-[44px] h-[44px] bg-warning-600 text-white shrink-0 flex justify-center items-center rounded-full h6">
                                    <iconify-icon icon="iconamoon:discount-fill" class="icon"></iconify-icon>
                                </span>
                                <div>
                                    <span class="mb-2 font-medium text-secondary-light text-sm">Total Sales</span>
                                    <h6 class="font-semibold">$5,00,000</h6>
                                </div>
                            </div>

                            <div id="total-sales-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                        <p class="text-sm mb-0">Increase by <span
                                class="bg-danger-100 dark:bg-danger-600/25 px-1 py-px rounded font-medium text-danger-600 dark:text-danger-400 text-sm">-$10k</span>
                            this week</p>
                    </div>
                </div>

                <div
                    class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-purple-600/10 to-bg-white">
                    <div class="card-body p-0">
                        <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                            <div class="flex items-center gap-2">
                                <span
                                    class="mb-0 w-[44px] h-[44px] bg-purple-600 text-white shrink-0 flex justify-center items-center rounded-full h6">
                                    <iconify-icon icon="mdi:message-text" class="icon"></iconify-icon>
                                </span>
                                <div>
                                    <span class="mb-2 font-medium text-secondary-light text-sm">Conversion</span>
                                    <h6 class="font-semibold">25%</h6>
                                </div>
                            </div>

                            <div id="conversion-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                        <p class="text-sm mb-0">Increase by <span
                                class="bg-success-100 dark:bg-success-600/25 px-1 py-px rounded font-medium text-success-600 dark:text-success-400 text-sm">+5%</span>
                            this week</p>
                    </div>
                </div>

                <div
                    class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-pink-600/10 to-bg-white">
                    <div class="card-body p-0">
                        <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                            <div class="flex items-center gap-2">
                                <span
                                    class="mb-0 w-[44px] h-[44px] bg-pink-600 text-white shrink-0 flex justify-center items-center rounded-full h6">
                                    <iconify-icon icon="mdi:leads" class="icon"></iconify-icon>
                                </span>
                                <div>
                                    <span class="mb-2 font-medium text-secondary-light text-sm">Leads</span>
                                    <h6 class="font-semibold">250</h6>
                                </div>
                            </div>

                            <div id="leads-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                        <p class="text-sm mb-0">Increase by <span
                                class="bg-success-100 dark:bg-success-600/25 px-1 py-px rounded font-medium text-success-600 dark:text-success-400 text-sm">+20</span>
                            this week</p>
                    </div>
                </div>

                <div
                    class="card px-4 py-5 shadow-2 rounded-lg border-gray-200 dark:border-neutral-600 h-full bg-gradient-to-l from-cyan-600/10 to-bg-white">
                    <div class="card-body p-0">
                        <div class="flex flex-wrap items-center justify-between gap-1 mb-2">
                            <div class="flex items-center gap-2">
                                <span
                                    class="mb-0 w-[44px] h-[44px] bg-cyan-600 text-white shrink-0 flex justify-center items-center rounded-full h6">
                                    <iconify-icon icon="streamline:bag-dollar-solid" class="icon"></iconify-icon>
                                </span>
                                <div>
                                    <span class="mb-2 font-medium text-secondary-light text-sm">Total Profit</span>
                                    <h6 class="font-semibold">$3,00,700</h6>
                                </div>
                            </div>

                            <div id="total-profit-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                        <p class="text-sm mb-0">Increase by <span
                                class="bg-success-100 dark:bg-success-600/25 px-1 py-px rounded font-medium text-success-600 dark:text-success-400 text-sm">+$15k</span>
                            this week</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Revenue Growth start -->
        <div class="lg:col-span-12 2xl:col-span-4">
            <div class="card h-full rounded-lg border-0">
                <div class="card-body p-6">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <div>
                            <h6 class="mb-2 font-bold text-lg">Revenue Growth</h6>
                            <span class="text-sm font-medium text-secondary-light">Weekly Report</span>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-2 font-bold text-lg">$50,000.00</h6>
                            <span
                                class="bg-success-100 dark:bg-success-600/25 px-3 py-1 rounded font-medium text-success-600 dark:text-success-400 text-sm">$10k</span>
                        </div>
                    </div>
                    <div id="revenue-chart" class="mt-0"></div>
                </div>
            </div>
        </div>
        <!-- Revenue Growth End -->
        <!-- Earning Static start -->
        <div class="lg:col-span-12 2xl:col-span-8">
            <div class="card h-full rounded-lg border-0">
                <div class="card-body p-6">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <div>
                            <h6 class="mb-2 font-bold text-lg">Earning Statistic</h6>
                            <span class="text-sm font-medium text-secondary-light">Yearly earning overview</span>
                        </div>
                        <div class="">
                            <select
                                class="form-select form-select-sm w-auto bg-white dark:bg-neutral-700 border text-secondary-light">
                                <option>Yearly</option>
                                <option>Monthly</option>
                                <option>Weekly</option>
                                <option>Today</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-5 flex justify-center flex-wrap gap-3">

                        <div
                            class="inline-flex items-center gap-2 p-2 rounded-lg border transition hover:border-primary-600 border-neutral-200 dark:border-neutral-500 dark:hover:border-primary-600 pe-[46px] br-hover-primary group">
                            <span
                                class="bg-neutral-100 dark:bg-neutral-600 w-[44px] h-[44px] text-2xl transition rounded-lg flex justify-center items-center text-secondary-light group-hover:text-white group-hover:bg-primary-600">
                                <iconify-icon icon="fluent:cart-16-filled" class="icon"></iconify-icon>
                            </span>
                            <div>
                                <span class="text-secondary-light text-sm font-medium">Sales</span>
                                <h6 class="text-base font-semibold mb-0">$200k</h6>
                            </div>
                        </div>

                        <div
                            class="inline-flex items-center gap-2 p-2 rounded-lg border transition hover:border-primary-600 border-neutral-200 dark:border-neutral-500 dark:hover:border-primary-600 pe-[46px] br-hover-primary group">
                            <span
                                class="bg-neutral-100 dark:bg-neutral-600 w-[44px] h-[44px] text-2xl transition rounded-lg flex justify-center items-center text-secondary-light group-hover:text-white group-hover:bg-primary-600">
                                <iconify-icon icon="uis:chart" class="icon"></iconify-icon>
                            </span>
                            <div>
                                <span class="text-secondary-light text-sm font-medium">Income</span>
                                <h6 class="text-base font-semibold mb-0">$200k</h6>
                            </div>
                        </div>

                        <div
                            class="inline-flex items-center gap-2 p-2 rounded-lg border transition hover:border-primary-600 border-neutral-200 dark:border-neutral-500 dark:hover:border-primary-600 pe-[46px] br-hover-primary group">
                            <span
                                class="bg-neutral-100 dark:bg-neutral-600 w-[44px] h-[44px] text-2xl transition rounded-lg flex justify-center items-center text-secondary-light group-hover:text-white group-hover:bg-primary-600">
                                <iconify-icon icon="ph:arrow-fat-up-fill" class="icon"></iconify-icon>
                            </span>
                            <div>
                                <span class="text-secondary-light text-sm font-medium">Profit</span>
                                <h6 class="text-base font-semibold mb-0">$200k</h6>
                            </div>
                        </div>
                    </div>

                    <div id="barChart"></div>
                </div>
            </div>
        </div>
        <!-- Earning Static End -->
        <!-- Campaign Static start -->
        <div class="lg:col-span-12 2xl:col-span-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-6 2xl:col-span-12 col-xxl-12 col-sm-6">
                    <div class="card h-full rounded-lg border-0">
                        <div class="card-body p-6">
                            <div class="flex items-center flex-wrap gap-2 justify-between">
                                <h6 class="mb-2 font-bold text-lg">Campaigns</h6>
                                <div class="">
                                    <select
                                        class="form-select form-select-sm w-auto bg-white dark:bg-neutral-700 border text-secondary-light">
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Today</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="flex items-center justify-between gap-3 mb-3">
                                    <div class="flex items-center">
                                        <span
                                            class="text-2xl line-height-1 flex align-content-center shrink-0 text-orange-500 dark:text-orange-500">
                                            <iconify-icon icon="majesticons:mail" class="icon"></iconify-icon>
                                        </span>
                                        <span
                                            class="text-neutral-600 dark:text-neutral-200 font-medium text-sm ps-4">Email</span>
                                    </div>
                                    <div class="flex items-center gap-2 w-full">
                                        <div class="ms-auto">
                                            <div class="w-[66px] bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                                <div class="bg-orange-500 h-2.5 rounded-full" style="width: 80%"></div>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light font-xs font-semibold">80%</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between gap-3 mb-3">
                                    <div class="flex items-center">
                                        <span
                                            class="text-2xl line-height-1 flex align-content-center shrink-0 text-success-500 dark:text-success-500">
                                            <iconify-icon icon="eva:globe-2-fill" class="icon"></iconify-icon>
                                        </span>
                                        <span
                                            class="text-neutral-600 dark:text-neutral-200 font-medium text-sm ps-4">Website</span>
                                    </div>
                                    <div class="flex items-center gap-2 w-full">
                                        <div class="ms-auto">
                                            <div class="w-[66px] bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                                <div class="bg-success-500 h-2.5 rounded-full" style="width: 80%"></div>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light font-xs font-semibold">80%</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between gap-3 mb-3">
                                    <div class="flex items-center">
                                        <span
                                            class="text-2xl line-height-1 flex align-content-center shrink-0 text-blue-600 dark:text-blue-500">
                                            <iconify-icon icon="fa6-brands:square-facebook" class="icon"></iconify-icon>
                                        </span>
                                        <span
                                            class="text-neutral-600 dark:text-neutral-200 font-medium text-sm ps-4">Facebook</span>
                                    </div>
                                    <div class="flex items-center gap-2 w-full">
                                        <div class="ms-auto">
                                            <div class="w-[66px] bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 80%"></div>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light font-xs font-semibold">80%</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between gap-3">
                                    <div class="flex items-center">
                                        <span
                                            class="text-2xl line-height-1 flex align-content-center shrink-0 text-purple-600 dark:text-purple-500">
                                            <iconify-icon icon="fluent:location-off-20-filled"
                                                class="icon"></iconify-icon>
                                        </span>
                                        <span
                                            class="text-neutral-600 dark:text-neutral-200 font-medium text-sm ps-4">Email</span>
                                    </div>
                                    <div class="flex items-center gap-2 w-full">
                                        <div class="ms-auto">
                                            <div class="w-[66px] bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                                <div class="bg-purple-600 h-2.5 rounded-full" style="width: 80%"></div>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light font-xs font-semibold">80%</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="lg:col-span-6 2xl:col-span-12 col-xxl-12 col-sm-6">
                    <div class="card h-full rounded-lg border-0 overflow-hidden">
                        <div class="card-body p-6">
                            <div class="flex items-center flex-wrap gap-2 justify-between">
                                <h6 class="mb-2 font-bold text-lg">Customer Overview</h6>
                                <div class="">
                                    <select
                                        class="form-select form-select-sm w-auto bg-white dark:bg-neutral-700 border text-secondary-light">
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Today</option>
                                    </select>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center mt-4">
                                <ul class="shrink-0">
                                    <li class="flex items-center gap-2 mb-7">
                                        <span class="w-3 h-3 rounded-full bg-success-600"></span>
                                        <span class="text-secondary-light text-sm font-medium">Total: 400</span>
                                    </li>
                                    <li class="flex items-center gap-2 mb-7">
                                        <span class="w-3 h-3 rounded-full bg-warning-600"></span>
                                        <span class="text-secondary-light text-sm font-medium">New: 400</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full bg-primary-600"></span>
                                        <span class="text-secondary-light text-sm font-medium">Active: 1400</span>
                                    </li>
                                </ul>
                                <div id="donutChart" class="grow apexcharts-tooltip-z-none title-style circle-none"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Campaign Static End -->
        <!-- Client Payment Status Start -->
        <div class="lg:col-span-6 2xl:col-span-4">
            <div class="card h-full rounded-lg border-0">
                <div class="card-body p-6">
                    <h6 class="mb-2 font-bold text-lg">Client Payment Status</h6>
                    <span class="text-sm font-medium text-secondary-light">Weekly Report</span>

                    <ul class="flex flex-wrap items-center justify-center mt-8">
                        <li class="flex items-center gap-2 me-7">
                            <span class="w-3 h-3 rounded-full bg-success-600"></span>
                            <span class="text-secondary-light text-sm font-medium">Paid: 400</span>
                        </li>
                        <li class="flex items-center gap-2 me-7">
                            <span class="w-3 h-3 rounded-full bg-info-600"></span>
                            <span class="text-secondary-light text-sm font-medium">Pending: 400</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-warning-600"></span>
                            <span class="text-secondary-light text-sm font-medium">Overdue: 1400</span>
                        </li>
                    </ul>
                    <div class="mt-[60px]">
                        <div id="paymentStatusChart" class="margin-16-minus"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Client Payment Status End -->
        <!-- Country Status Start -->
        <div class="lg:col-span-6 2xl:col-span-4">
            <div class="card rounded-lg border-0">

                <div class="card-body">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="mb-2 font-bold text-lg">Countries Status</h6>
                        <div class="">
                            <select
                                class="form-select form-select-sm w-auto bg-white dark:bg-neutral-700 border text-secondary-light">
                                <option>Yearly</option>
                                <option>Monthly</option>
                                <option>Weekly</option>
                                <option>Today</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="world-map" class="h-[200px] bg-neutral-100 dark:bg-neutral-600/30"></div>

                <div class="card-body p-6 max-h-[266px] scroll-sm overflow-y-auto">
                    <div class="">

                        <div class="flex items-center justify-between gap-3 mb-3 pb-2">
                            <div class="flex items-center w-full">
                                <img src="{{ asset('assets/images/flags/flag1.png') }}" alt=""
                                    class="w-10 h-10 rounded-full shrink-0 me-2 overflow-hidden">
                                <div class="grow">
                                    <h6 class="text-sm mb-0">USA</h6>
                                    <span class="text-xs text-secondary-light font-medium">1,240 Users</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <div class="w-[66px] bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                    <div class="bg-primary-600 h-2.5 rounded-full" style="width: 80%"></div>
                                </div>
                                <span class="text-secondary-light font-xs font-semibold">80%</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-3 mb-3 pb-2">
                            <div class="flex items-center w-full">
                                <img src="{{ asset('assets/images/flags/flag2.png') }}" alt=""
                                    class="w-10 h-10 rounded-full shrink-0 me-2 overflow-hidden">
                                <div class="grow">
                                    <h6 class="text-sm mb-0">Japan</h6>
                                    <span class="text-xs text-secondary-light font-medium">1,240 Users</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <div class="w-[66px] bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                    <div class="bg-orange-500 h-2.5 rounded-full" style="width: 60%"></div>
                                </div>
                                <span class="text-secondary-light font-xs font-semibold">60%</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-3 mb-3 pb-2">
                            <div class="flex items-center w-full">
                                <img src="{{ asset('assets/images/flags/flag3.png') }}" alt=""
                                    class="w-10 h-10 rounded-full shrink-0 me-2 overflow-hidden">
                                <div class="grow">
                                    <h6 class="text-sm mb-0">France</h6>
                                    <span class="text-xs text-secondary-light font-medium">1,240 Users</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <div class="w-[66px] bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                    <div class="bg-warning-600 h-2.5 rounded-full" style="width: 49%"></div>
                                </div>
                                <span class="text-secondary-light font-xs font-semibold">49%</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center w-full">
                                <img src="{{ asset('assets/images/flags/flag4.png') }}" alt=""
                                    class="w-10 h-10 rounded-full shrink-0 me-2 overflow-hidden">
                                <div class="grow">
                                    <h6 class="text-sm mb-0">Germany</h6>
                                    <span class="text-xs text-secondary-light font-medium">1,240 Users</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <div class="w-[66px] bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                    <div class="bg-success-600 h-2.5 rounded-full" style="width: 100%"></div>
                                </div>
                                <span class="text-secondary-light font-xs font-semibold">100%</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Country Status End -->
        <!-- Top performance Start -->
        <div class="lg:col-span-12 2xl:col-span-4">
            <div class="card border-0 overflow-hidden">

                <div class="card-body">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="mb-2 font-bold text-lg">Top Performer</h6>
                        <a href="javascript:void(0)"
                            class="text-primary-600 dark:text-primary-600 hover-text-primary flex items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>

                    <div class="mt-8">

                        <div class="flex items-center justify-between gap-3 mb-8">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/images/users/user1.png') }}" alt=""
                                    class="w-10 h-10 rounded-full shrink-0 me-2 overflow-hidden">
                                <div class="grow">
                                    <h6 class="text-base mb-0">Dianne Russell</h6>
                                    <span class="text-sm text-secondary-light font-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-neutral-600 dark:text-neutral-200 text-base font-medium">60/80</span>
                        </div>

                        <div class="flex items-center justify-between gap-3 mb-8">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/images/users/user2.png') }}" alt=""
                                    class="w-10 h-10 rounded-full shrink-0 me-2 overflow-hidden">
                                <div class="grow">
                                    <h6 class="text-base mb-0">Wade Warren</h6>
                                    <span class="text-sm text-secondary-light font-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-neutral-600 dark:text-neutral-200 text-base font-medium">50/70</span>
                        </div>

                        <div class="flex items-center justify-between gap-3 mb-8">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/images/users/user3.png') }}" alt=""
                                    class="w-10 h-10 rounded-full shrink-0 me-2 overflow-hidden">
                                <div class="grow">
                                    <h6 class="text-base mb-0">Albert Flores</h6>
                                    <span class="text-sm text-secondary-light font-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-neutral-600 dark:text-neutral-200 text-base font-medium">55/75</span>
                        </div>

                        <div class="flex items-center justify-between gap-3 mb-8">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/images/users/user4.png') }}" alt=""
                                    class="w-10 h-10 rounded-full shrink-0 me-2 overflow-hidden">
                                <div class="grow">
                                    <h6 class="text-base mb-0">Bessie Cooper</h6>
                                    <span class="text-sm text-secondary-light font-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-neutral-600 dark:text-neutral-200 text-base font-medium">60/80</span>
                        </div>

                        <div class="flex items-center justify-between gap-3 mb-8">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/images/users/user5.png') }}" alt=""
                                    class="w-10 h-10 rounded-full shrink-0 me-2 overflow-hidden">
                                <div class="grow">
                                    <h6 class="text-base mb-0">Arlene McCoy</h6>
                                    <span class="text-sm text-secondary-light font-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-neutral-600 dark:text-neutral-200 text-base font-medium">55/75</span>
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/images/users/user1.png') }}" alt=""
                                    class="w-10 h-10 rounded-full shrink-0 me-2 overflow-hidden">
                                <div class="grow">
                                    <h6 class="text-base mb-0">Arlene McCoy</h6>
                                    <span class="text-sm text-secondary-light font-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-neutral-600 dark:text-neutral-200 text-base font-medium">50/70</span>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Top performance End -->
        <!-- Latest Performance Start -->
        <div class="lg:col-span-12 2xl:col-span-6">
            <div class="card h-full border-0 overflow-hidden">
                <div
                    class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 ps-0 py-0 pe-6 flex items-center justify-between">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                            data-tabs-toggle="#default-styled-tab-content"
                            data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                            data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                            role="tablist">
                            <li class="" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 rounded-t-lg transition-colors ease-in-out duration-300 text-neutral-600 dark:text-white"
                                    id="todoList-styled-tab" data-tabs-target="#styled-todoList" type="button"
                                    role="tab" aria-controls="styled-todoList" aria-selected="false">To Do
                                    List</button>
                            </li>
                            <li class="" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 rounded-t-lg transition-colors ease-in-out duration-300 text-neutral-600 dark:text-white hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="recentLead-styled-tab" data-tabs-target="#styled-recentLead" type="button"
                                    role="tab" aria-controls="styled-recentLead" aria-selected="false">Recent
                                    Leads</button>
                            </li>
                        </ul>
                    </div>
                    <a href="javascript:void(0)"
                        class="text-primary-600 dark:text-primary-600 hover-text-primary flex items-center gap-1">
                        View All
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>

                <div class="card-body p-6">
                    <div id="default-styled-tab-content">
                        <div class="hidden rounded-lg" id="styled-todoList" role="tabpanel">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Task Name </th>
                                            <th scope="col">Assigned To </th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span
                                                        class="text-base block line-height-1 font-medium text-neutral-600 dark:text-neutral-200 text-w-200-px">Hotel
                                                        Management System</span>
                                                    <span
                                                        class="text-sm block font-normal text-secondary-light">#5632</span>
                                                </div>
                                            </td>
                                            <td>Kathryn Murphy</td>
                                            <td>27 Mar 2025</td>
                                            <td> <span
                                                    class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Active</span>
                                            </td>
                                            <td class="text-center text-neutral-700 text-xl">

                                                <button data-dropdown-toggle="dropdown1"
                                                    class="focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg px-4 py-2.5 text-neutral-700 text-2xl dark:text-white"
                                                    type="button">
                                                    <i class="ri-more-2-fill"></i>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown1"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-neutral-200 dark:border-neutral-600 shadow-lg w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Another
                                                                Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Something
                                                                else</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span
                                                        class="text-base block line-height-1 font-medium text-neutral-600 dark:text-neutral-200 text-w-200-px">Hotel
                                                        Management System</span>
                                                    <span
                                                        class="text-sm block font-normal text-secondary-light">#5632</span>
                                                </div>
                                            </td>
                                            <td>Darlene Robertson</td>
                                            <td>27 Mar 2025</td>
                                            <td> <span
                                                    class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Active</span>
                                            </td>
                                            <td class="text-center text-neutral-700 text-xl">
                                                <button data-dropdown-toggle="dropdown2"
                                                    class="focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg px-4 py-2.5 text-neutral-700 text-2xl dark:text-white"
                                                    type="button">
                                                    <i class="ri-more-2-fill"></i>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown2"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-neutral-200 dark:border-neutral-600 shadow-lg w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Another
                                                                Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Something
                                                                else</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span
                                                        class="text-base block line-height-1 font-medium text-neutral-600 dark:text-neutral-200 text-w-200-px">Hotel
                                                        Management System</span>
                                                    <span
                                                        class="text-sm block font-normal text-secondary-light">#5632</span>
                                                </div>
                                            </td>
                                            <td>Courtney Henry</td>
                                            <td>27 Mar 2025</td>
                                            <td> <span
                                                    class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Active</span>
                                            </td>
                                            <td class="text-center text-neutral-700 text-xl">
                                                <button data-dropdown-toggle="dropdown3"
                                                    class="focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg px-4 py-2.5 text-neutral-700 text-2xl dark:text-white"
                                                    type="button">
                                                    <i class="ri-more-2-fill"></i>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown3"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-neutral-200 dark:border-neutral-600 shadow-lg w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Another
                                                                Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Something
                                                                else</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span
                                                        class="text-base block line-height-1 font-medium text-neutral-600 dark:text-neutral-200 text-w-200-px">Hotel
                                                        Management System</span>
                                                    <span
                                                        class="text-sm block font-normal text-secondary-light">#5632</span>
                                                </div>
                                            </td>
                                            <td>Jenny Wilson</td>
                                            <td>27 Mar 2025</td>
                                            <td> <span
                                                    class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Active</span>
                                            </td>
                                            <td class="text-center text-neutral-700 text-xl">
                                                <button data-dropdown-toggle="dropdown4"
                                                    class="focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg px-4 py-2.5 text-neutral-700 text-2xl dark:text-white"
                                                    type="button">
                                                    <i class="ri-more-2-fill"></i>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown4"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-neutral-200 dark:border-neutral-600 shadow-lg w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Another
                                                                Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Something
                                                                else</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span
                                                        class="text-base block line-height-1 font-medium text-neutral-600 dark:text-neutral-200 text-w-200-px">Hotel
                                                        Management System</span>
                                                    <span
                                                        class="text-sm block font-normal text-secondary-light">#5632</span>
                                                </div>
                                            </td>
                                            <td>Leslie Alexander</td>
                                            <td>27 Mar 2025</td>
                                            <td> <span
                                                    class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Active</span>
                                            </td>
                                            <td class="text-center text-neutral-700 text-xl">
                                                <button data-dropdown-toggle="dropdown5"
                                                    class="focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg px-4 py-2.5 text-neutral-700 text-2xl dark:text-white"
                                                    type="button">
                                                    <i class="ri-more-2-fill"></i>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown5"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-neutral-200 dark:border-neutral-600 shadow-lg w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Another
                                                                Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Something
                                                                else</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-recentLead"
                            role="tabpanel">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Task Name </th>
                                            <th scope="col">Assigned To </th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span
                                                        class="text-base block line-height-1 font-medium text-neutral-600 dark:text-neutral-200 text-w-200-px">Hotel
                                                        Management System</span>
                                                    <span
                                                        class="text-sm block font-normal text-secondary-light">#5632</span>
                                                </div>
                                            </td>
                                            <td>Kathryn Murphy</td>
                                            <td>27 Mar 2025</td>
                                            <td> <span
                                                    class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Active</span>
                                            </td>
                                            <td class="text-center text-neutral-700 text-xl">

                                                <button data-dropdown-toggle="dropdown6"
                                                    class="focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg px-4 py-2.5 text-neutral-700 text-2xl dark:text-white"
                                                    type="button">
                                                    <i class="ri-more-2-fill"></i>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown6"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-neutral-200 dark:border-neutral-600 shadow-lg w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Another
                                                                Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Something
                                                                else</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span
                                                        class="text-base block line-height-1 font-medium text-neutral-600 dark:text-neutral-200 text-w-200-px">Hotel
                                                        Management System</span>
                                                    <span
                                                        class="text-sm block font-normal text-secondary-light">#5632</span>
                                                </div>
                                            </td>
                                            <td>Darlene Robertson</td>
                                            <td>27 Mar 2025</td>
                                            <td> <span
                                                    class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Active</span>
                                            </td>
                                            <td class="text-center text-neutral-700 text-xl">
                                                <button data-dropdown-toggle="dropdown7"
                                                    class="focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg px-4 py-2.5 text-neutral-700 text-2xl dark:text-white"
                                                    type="button">
                                                    <i class="ri-more-2-fill"></i>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown7"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-neutral-200 dark:border-neutral-600 shadow-lg w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Another
                                                                Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Something
                                                                else</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span
                                                        class="text-base block line-height-1 font-medium text-neutral-600 dark:text-neutral-200 text-w-200-px">Hotel
                                                        Management System</span>
                                                    <span
                                                        class="text-sm block font-normal text-secondary-light">#5632</span>
                                                </div>
                                            </td>
                                            <td>Courtney Henry</td>
                                            <td>27 Mar 2025</td>
                                            <td> <span
                                                    class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Active</span>
                                            </td>
                                            <td class="text-center text-neutral-700 text-xl">
                                                <button data-dropdown-toggle="dropdown8"
                                                    class="focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg px-4 py-2.5 text-neutral-700 text-2xl dark:text-white"
                                                    type="button">
                                                    <i class="ri-more-2-fill"></i>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown8"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-neutral-200 dark:border-neutral-600 shadow-lg w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Another
                                                                Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Something
                                                                else</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span
                                                        class="text-base block line-height-1 font-medium text-neutral-600 dark:text-neutral-200 text-w-200-px">Hotel
                                                        Management System</span>
                                                    <span
                                                        class="text-sm block font-normal text-secondary-light">#5632</span>
                                                </div>
                                            </td>
                                            <td>Jenny Wilson</td>
                                            <td>27 Mar 2025</td>
                                            <td> <span
                                                    class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Active</span>
                                            </td>
                                            <td class="text-center text-neutral-700 text-xl">
                                                <button data-dropdown-toggle="dropdown9"
                                                    class="focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg px-4 py-2.5 text-neutral-700 text-2xl dark:text-white"
                                                    type="button">
                                                    <i class="ri-more-2-fill"></i>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown9"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-neutral-200 dark:border-neutral-600 shadow-lg w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Another
                                                                Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Something
                                                                else</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span
                                                        class="text-base block line-height-1 font-medium text-neutral-600 dark:text-neutral-200 text-w-200-px">Hotel
                                                        Management System</span>
                                                    <span
                                                        class="text-sm block font-normal text-secondary-light">#5632</span>
                                                </div>
                                            </td>
                                            <td>Leslie Alexander</td>
                                            <td>27 Mar 2025</td>
                                            <td> <span
                                                    class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Active</span>
                                            </td>
                                            <td class="text-center text-neutral-700 text-xl">
                                                <button data-dropdown-toggle="dropdown10"
                                                    class="focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg px-4 py-2.5 text-neutral-700 text-2xl dark:text-white"
                                                    type="button">
                                                    <i class="ri-more-2-fill"></i>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown10"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-neutral-200 dark:border-neutral-600 shadow-lg w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Another
                                                                Actions</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Something
                                                                else</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="lg:col-span-12 2xl:col-span-6">
            <div class="card h-full border-0 overflow-hidden">
                <div
                    class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center justify-between">
                    <h6 class="text-lg font-semibold mb-0">Last Transaction</h6>
                    <a href="javascript:void(0)"
                        class="text-primary-600 dark:text-primary-600 hover-text-primary flex items-center gap-1">
                        View All
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
                <div class="card-body p-6">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table style-two mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>5986124445445</td>
                                    <td>27 Mar 2025</td>
                                    <td> <span
                                            class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-sm">Pending</span>
                                    </td>
                                    <td>$20,000.00</td>
                                </tr>
                                <tr>
                                    <td>5986124445445</td>
                                    <td>27 Mar 2025</td>
                                    <td> <span
                                            class="bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 px-6 py-1.5 rounded-full font-medium text-sm">Rejected</span>
                                    </td>
                                    <td>$20,000.00</td>
                                </tr>
                                <tr>
                                    <td>5986124445445</td>
                                    <td>27 Mar 2025</td>
                                    <td> <span
                                            class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Completed</span>
                                    </td>
                                    <td>$20,000.00</td>
                                </tr>
                                <tr>
                                    <td>5986124445445</td>
                                    <td>27 Mar 2025</td>
                                    <td> <span
                                            class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Completed</span>
                                    </td>
                                    <td>$20,000.00</td>
                                </tr>
                                <tr>
                                    <td>5986124445445</td>
                                    <td>27 Mar 2025</td>
                                    <td> <span
                                            class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Completed</span>
                                    </td>
                                    <td>$20,000.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Latest Performance End -->
    </div>

@endsection


@push('scripts')
    <script>
  // ================================== Crm Home widgets charts Start =================================
  function createChart(chartId, chartColor) {

    let currentYear = new Date().getFullYear();

    var options = {
      series: [
          {
              name: 'series1',
              data: [35, 45, 38, 41, 36, 43, 37, 55, 40],
          },
      ],
      chart: {
          type: 'area',
          width: 80,
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
              type: 'vertical',  // Gradient direction (vertical)
              shadeIntensity: 0.5, // Intensity of the gradient shading
              gradientToColors: [`${chartColor}00`], // Bottom gradient color (with transparency)
              inverseColors: false, // Do not invert colors
              opacityFrom: .75, // Starting opacity
              opacityTo: 0.3,  // Ending opacity
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
          categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`, `Apr ${currentYear}`, `May ${currentYear}`, `Jun ${currentYear}`, `Jul ${currentYear}`, `Aug ${currentYear}`, `Sep ${currentYear}`, `Oct ${currentYear}`, `Nov ${currentYear}`, `Dec ${currentYear}`],
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
  createChart('new-user-chart', '#487fff');
  createChart('active-user-chart', '#45b369');
  createChart('total-sales-chart', '#f4941e');
  createChart('conversion-user-chart', '#8252e9');
  createChart('leads-chart', '#de3ace');
  createChart('total-profit-chart', '#00b8f2');
  // ================================== Crm Home widgets charts End =================================


  // ================================ Revenue Growth Area Chart Start ================================
  function createChartTwo(chartId, chartColor) {

    var options = {
      series: [
          {
            name: 'This Day',
            data: [4, 18, 13, 40, 30, 50, 30, 60, 40, 75, 45, 90],
          },
      ],
      chart: {
          type: 'area',
          width: '100%',
          height: 162,
          sparkline: {
            enabled: false // Remove whitespace
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
          borderColor: 'red',
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
              top: -30,
              right: 0,
              bottom: -10,
              left: 0
          },
      },
      fill: {
          type: 'gradient',
          colors: [chartColor], // Set the starting color (top color) here
          gradient: {
              shade: 'light', // Gradient shading type
              type: 'vertical',  // Gradient direction (vertical)
              shadeIntensity: 0.5, // Intensity of the gradient shading
              gradientToColors: [`${chartColor}00`], // Bottom gradient color (with transparency)
              inverseColors: false, // Do not invert colors
              opacityFrom: .6, // Starting opacity
              opacityTo: 0.3,  // Ending opacity
              stops: [0, 100],
          },
      },
      // Customize the circle marker color on hover
      markers: {
        colors: [chartColor],
        strokeWidth: 3,
        size: 0,
        hover: {
          size: 10
        }
      },
      xaxis: {
          labels: {
              show: false
          },
          categories: [`Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec`],
          tooltip: {
              enabled: false,
          },
          tooltip: {
            enabled: false
          },
          labels: {
            formatter: function (value) {
              return value;
            },
            style: {
              fontSize: "14px"
            }
          },
      },
      yaxis: {
          labels: {
              show: false
          },
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
  createChartTwo('revenue-chart', '#487fff');
  // ================================ Revenue Growth Area Chart End ================================

  // ================================ Earning Statistics bar chart Start ================================
    var options = {
      series: [{
          name: "Sales",
          data: [{
              x: 'Jan',
              y: 85000,
          }, {
              x: 'Feb',
              y: 70000,
          }, {
              x: 'Mar',
              y: 40000,
          }, {
              x: 'Apr',
              y: 50000,
          }, {
              x: 'May',
              y: 60000,
          }, {
              x: 'Jun',
              y: 50000,
          }, {
              x: 'Jul',
              y: 40000,
          }, {
              x: 'Aug',
              y: 50000,
          }, {
              x: 'Sep',
              y: 40000,
          }, {
              x: 'Oct',
              y: 60000,
          }, {
              x: 'Nov',
              y: 30000,
          }, {
              x: 'Dec',
              y: 50000,
          }]
      }],
      chart: {
          type: 'bar',
          height: 310,
          toolbar: {
              show: false
          }
      },
      plotOptions: {
          bar: {
              borderRadius: 4,
              horizontal: false,
              columnWidth: '23%',
              endingShape: 'rounded',
          }
      },
      dataLabels: {
          enabled: false
      },
      fill: {
          type: 'gradient',
          colors: ['#487FFF'], // Set the starting color (top color) here
          gradient: {
              shade: 'light', // Gradient shading type
              type: 'vertical',  // Gradient direction (vertical)
              shadeIntensity: 0.5, // Intensity of the gradient shading
              gradientToColors: ['#487FFF'], // Bottom gradient color (with transparency)
              inverseColors: false, // Do not invert colors
              opacityFrom: 1, // Starting opacity
              opacityTo: 1,  // Ending opacity
              stops: [0, 100],
          },
      },
      grid: {
          show: true,
          borderColor: '#D1D5DB',
          strokeDashArray: 4, // Use a number for dashed style
          position: 'back',
      },
      xaxis: {
          type: 'category',
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
      },
      yaxis: {
          labels: {
              formatter: function (value) {
                  return (value / 1000).toFixed(0) + 'k';
              }
          }
      },
      tooltip: {
          y: {
              formatter: function (value) {
                  return value / 1000 + 'k';
              }
          }
      }
    };

    var chart = new ApexCharts(document.querySelector("#barChart"), options);
    chart.render();
  // ================================ Earning Statistics bar chart End ================================

  // ================================ Custom Overview Donut chart Start ================================
    var options = {
      series: [500, 500, 500],
      colors: ['#45B369', '#FF9F29', '#487FFF'],
      labels: ['Active', 'New', 'Total'] ,
      legend: {
          show: false
      },
      chart: {
        type: 'donut',
        height: 300,
        sparkline: {
          enabled: true // Remove whitespace
        },
        margin: {
            top: -100,
            right: -100,
            bottom: -100,
            left: -100
        },
        padding: {
          top: -100,
          right: -100,
          bottom: -100,
          left: -100
        }
      },
      stroke: {
        width: 0,
      },
      dataLabels: {
        enabled: false
      },
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },
          legend: {
            position: 'bottom'
          }
        }
      }],
      plotOptions: {
        pie: {
          startAngle: -90,
          endAngle: 90,
          offsetY: 10,
          customScale: 0.8,
          donut: {
            size: '70%',
            labels: {
              show: true,
              total: {
                showAlways: true,
                show: true,
                label: 'Customer Report',
                // formatter: function (w) {
                //     return w.globals.seriesTotals.reduce((a, b) => {
                //         return a + b;
                //     }, 0);
                // }
              }
            },
          }
        }
      },
    };

    var chart = new ApexCharts(document.querySelector("#donutChart"), options);
    chart.render();
  // ================================ Custom Overview Donut chart End ================================

  // ================================ Client Payment Status chart End ================================
    var options = {
      series: [{
        name: 'Net Profit',
        data: [44, 100, 40, 56, 30, 58, 50]
      }, {
        name: 'Revenue',
        data: [90, 140, 80, 125, 70, 140, 110]
      }, {
        name: 'Free Cash',
        data: [60, 120, 60, 90, 50, 95, 90]
      }],
      colors: ['#45B369', '#144bd6', '#FF9F29'],
      labels: ['Active', 'New', 'Total'] ,

      legend: {
          show: false
      },
      chart: {
        type: 'bar',
        height: 350,
        toolbar: {
          show: false
        },
      },
      grid: {
          show: true,
          borderColor: '#D1D5DB',
          strokeDashArray: 4, // Use a number for dashed style
          position: 'back',
      },
      plotOptions: {
        bar: {
          borderRadius: 4,
          columnWidth: 8,
        },
      },
      dataLabels: {
        enabled: false
      },
      states: {
        hover: {
        filter: {
            type: 'none'
            }
        }
    },
      stroke: {
        show: true,
        width: 0,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun'],
      },
      yaxis: {
        categories: ['0', '10,000', '20,000', '30,000', '50,000', '1,00,000', '1,00,000'],
      },
      fill: {
        opacity: 1,
        width: 18,
      },
    };

    var chart = new ApexCharts(document.querySelector("#paymentStatusChart"), options);
    chart.render();
  // ================================ Client Payment Status chart End ================================

  // ================================ J Vector Map Start ================================
  $('#world-map').vectorMap(
    {
      map: 'world_mill_en',
      backgroundColor: 'transparent',
      borderColor: '#fff',
      borderOpacity: 0.25,
      borderWidth: 0,
      color: '#000000',
      regionStyle : {
          initial : {
          fill : '#D1D5DB'
        }
      },
      markerStyle: {
      initial: {
                  r: 5,
                  'fill': '#fff',
                  'fill-opacity':1,
                  'stroke': '#000',
                  'stroke-width' : 1,
                  'stroke-opacity': 0.4
              },
          },
      markers : [{
          latLng : [35.8617, 104.1954],
          name : 'China : 250'
        },

        {
          latLng : [25.2744, 133.7751],
          name : 'AustrCalia : 250'
        },

        {
          latLng : [36.77, -119.41],
          name : 'USA : 82%'
        },

        {
          latLng : [55.37, -3.41],
          name : 'UK   : 250'
        },

        {
          latLng : [25.20, 55.27],
          name : 'UAE : 250'
      }],

      series: {
          regions: [{
              values: {
                  "US": '#487FFF ',
                  "SA": '#487FFF',
                  "AU": '#487FFF',
                  "CN": '#487FFF',
                  "GB": '#487FFF',
              },
              attribute: 'fill'
          }]
      },
      hoverOpacity: null,
      normalizeFunction: 'linear',
      zoomOnScroll: false,
      scaleColors: ['#000000', '#000000'],
      selectedColor: '#000000',
      selectedRegions: [],
      enableZoom: false,
      hoverColor: '#fff',
  });
  // ================================ J Vector Map End ================================

</script>
@endpush
