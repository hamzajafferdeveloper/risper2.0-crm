<div class="flex items-center justify-center w-full bg-white dark:bg-gray-800 shadow-lg rounded-xl p-1 transition-all duration-300 border border-gray-100 dark:border-gray-700">
    <div
        class="flex px-3 flex-wrap justify-center items-center gap-3 ">

        <!-- Column visibility dropdown -->
        <div class="relative">
            <button id="columnToggleBtn"
                class="text-xl px-4 py-2 rounded-lg flex items-center gap-2 shadow-md transition-all duration-200">
                <iconify-icon icon="mynaui:sidebar"></iconify-icon>
            </button>

            <div id="columnToggleMenu"
                class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg p-4 z-20 transition-all duration-200">

                <h3
                    class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3 border-b border-gray-200 dark:border-gray-700 pb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#8c35e3]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2H3V4zm0 4h18v12a1 1 0 01-1 1H4a1 1 0 01-1-1V8z" />
                    </svg>
                    Toggle Columns
                </h3>

                <div class="space-y-2">
                    @foreach ([['Image', 1], ['Name', 2], ['Email', 3], ['Mobile', 4], ['Company', 5], ['Category', 6], ['Added By', 7], ['Date', 8]] as [$label, $column])
                        <label
                            class="flex items-center gap-2 p-2 rounded-md hover:bg-[#8c35e308] dark:hover:bg-gray-700 cursor-pointer transition-all">
                            <input type="checkbox" class="toggle-vis accent-[#8c35e3]" data-column="{{ $column }}"
                                checked>
                            <span class="text-sm text-gray-700 dark:text-gray-200">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <select id="filterCompany" data-placeholder="Select Company Address"
            class="select2 border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-200 rounded-lg px-3 py-2 text-sm w-48 focus:ring-2 focus:ring-[#8c35e3] focus:border-[#8c35e3] transition-all">
            <option value="">All Company Adress</option>
            @foreach (\App\Models\ClientCompanyAddress::all() as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select>

        <select id="filterCategory" data-placeholder="Select Category"
            class="select2 border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-200 rounded-lg px-3 py-2 text-sm w-48 focus:ring-2 focus:ring-[#8c35e3] focus:border-[#8c35e3] transition-all">
            <option value="">All Category</option>
            @foreach (\App\Models\ClientCategory::where('parent_id' , null)->get() as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <select id="filterAddedBy" data-placeholder="Select Added By"
            class="select2 border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-200 rounded-lg px-3 py-2 text-sm w-48 focus:ring-2 focus:ring-[#8c35e3] focus:border-[#8c35e3] transition-all">
            <option value="">All Employee</option>
            @foreach (\App\Models\Employee::all() as $employee)
                <option value="{{ $employee->id }}">EMP-{{ $employee->id }} {{ $employee->name }}
                </option>
            @endforeach
        </select>

        <!-- Date range -->
        <div
            class="flex items-center gap-2 bg-gray-50 dark:bg-gray-700 py-2 rounded-lg  hover:border-[#8c35e3] transition-all duration-200">
            <input type="date" id="startDate"
                class="filterDatePicker bg-transparent text-sm border-none focus:ring-0 dark:text-gray-200"
                placeholder="Start date">
            <span class="text-gray-400">–</span>
            <input type="date" id="endDate"
                class="filterDatePicker bg-transparent text-sm border-none focus:ring-0 dark:text-gray-200"
                placeholder="End date">
        </div>

    </div>
</div>

<style>
    #filterAddedBy+.select2 .select2-selection--single,
    #filterCompany+.select2 .select2-selection--single,
    #filterCategory+.select2 .select2-selection--single {
        border-radius: 0.5rem;
        border: 1px solid #8c35e373;
        height: 35px;
        display: flex;
        align-items: center;
        padding-left: 0.5rem;
    }

    /* Text inside dropdown */
    #filterAddedBy+.select2 .select2-selection__rendered,
    #filterCompany+.select2 .select2-selection__rendered,
    #filterCategory+.select2 .select2-selection__rendered {
        color: #111827;
        line-height: 35px;
    }

    /* Dropdown arrow */
    #filterAddedBy+.select2 .select2-selection__arrow,
    #filterCompany+.select2 .select2-selection__arrow,
    #filterCategory+.select2 .select2-selection__arrow {
        height: 35px;
        right: 6px;
    }

    #filterAddedBy+.select2 .select2-selection__arrow,
    #filterCompany+.select2 .select2-selection__arrow,
    #filterCategory+.select2 .select2-selection__arrow {
        height: 15px;
        right: 6px;
    }
</style>
