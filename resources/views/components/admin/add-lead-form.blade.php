<form id="addLeadForm" class="row g-3 max-h-[90vh] flex flex-col gap-3 overflow-y-auto px-5">
    @csrf
    <!-- Title -->
    <h2 class="text-2xl font-semibold text-gray-800">Add Lead Contact Info</h2>

    <!-- Lead Contact Detail -->
    <div class=" flex flex-col gap-3">
        <div class="sm:flex gap-3">

            <!-- Salutation -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Salutation</label>
                <select name="salutation" class="form-select select2">
                    <option value="">Select</option>
                    <option>Mr</option>
                    <option>Mrs</option>
                    <option>Miss</option>
                    <option>Dr.</option>
                    <option>Sir</option>
                    <option>Madam</option>
                </select>
            </div>

            <!-- Name -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Full Name *</label>
                <div class="icon-field">
                    <span class="icon">
                        <iconify-icon icon="mage:user"></iconify-icon>
                    </span>
                    <input type="text" name="name" class="form-control" placeholder="Enter Lead Name">
                </div>
            </div>


            <!-- Email -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Email *</label>
                <div class="icon-field">
                    <span class="icon">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                </div>
            </div>
        </div>

        <div class="sm:flex gap-3">

            <!-- Lead Source -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Lead Source</label>
                <select name="lead_source_id" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($lead_sources as $e)
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Add By -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Add By</label>
                <select name="added_by" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($employees as $e)
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
            </div>



            <!-- Owner Id -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Lead Owner</label>
                <select name="lead_owner" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($employees as $e)
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Checkboxes -->
    <div class="flex items-center gap-6">
        <label class="flex items-center gap-2">
            <input type="checkbox" id="createDeal" name="has_deal"
                class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500">
            <span class="text-gray-700 font-medium">Create Deal</span>
        </label>
        <label class="flex items-center gap-2">
            <input type="checkbox" id="auto_convert_lead_to_client" name="auto_convert_lead_to_client"
                class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500">
            <span class="text-gray-700 font-medium">Auto Convert Lead to Client When Deal Stage is set to win</span>
        </label>
    </div>

    <!-- Deal Section -->
    <div id="dealSection" class="flex flex-col gap-3 hidden border-t pt-6">
        <h3 class="text-lg font-semibold text-gray-800">Deal Information</h3>
        <div class="sm:flex gap-3">

            <!--Deal  Name -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Deal Name *</label>
                <input type="text" name="deal_name" class="form-control" placeholder="Enter Deal Name">
            </div>

            <!-- Pipline -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Deal Pipeline</label>
                <select id="pipelineSelect" name="pipe_line_id" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($piplines as $p)
                        <option value="{{ $p->id }}" {{ $p->is_default === 'yes' ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Stages --}}
            <div class="w-full sm:w-1/3">
                <label class="form-label">Deal Stage</label>
                <select id="stageSelect" name="deal_stage_id" class="form-select select2">
                    <option value="">Select</option>
                    {{-- JS will filter and inject correct stages --}}
                </select>
            </div>
        </div>

        <div class="sm:flex gap-3">

            <!-- Deal Value -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Deal Value *</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 border rounded-e-0 border-e-0 rounded-s-md border-neutral-200 dark:border-neutral-600">
                        {{-- <iconify-icon icon="mynaui:envelope"></iconify-icon> --}}
                        $
                    </span>
                    <input type="number" name="deal_value" value="0" class="form-control" placeholder="45">
                </div>
            </div>

            <!-- Close Date -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Close Date *</label>
                <input type="date" name="close_date" class="form-control">
            </div>

            <!-- Deal Category -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Category</label>
                <select name="deal_category_id" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="sm:flex gap-3">
            <!--Deal  Name -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Deal Agent</label>
                <select name="deal_agent" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($dealAgents as $a)
                        <option value="{{ $a->id }}">{{ $a->aggent->name ?? 'Unknown' }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pipline -->
            {{-- <div class="w-full sm:w-1/3">
                <label class="form-label">Product</label>
                <select name="pipe_line_id" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div> --}}

            {{-- Stages --}}
            <div class="w-full sm:w-1/3">
                <label class="form-label">Deal Watcher</label>
                <select name="deal_watcher" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($employees as $e)
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <label class="flex items-center gap-2">
        <input type="checkbox" id="companyDetail" name="has_company_detail"
            class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500">
        <span class="text-gray-700 font-medium"> Company Details</span>
    </label>

    <!-- Company Section -->
    <div id="companySection" class="hidden border-t flex flex-col gap-3">
        <h3 class="text-lg font-semibold text-gray-800">Company Details</h3>
        <div class="sm:flex gap-3">

            <!-- Name -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Company Name *</label>
                <input type="text" name="company_name" class="form-control" placeholder="Enter Lead Name">
            </div>


            <!-- Website -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Website *</label>
                <input type="text" name="website" class="form-control" placeholder="Enter Website URL">
            </div>

            <!-- Mobile -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Mobile *</label>
                <input type="tel" name="mobile" class="form-control" placeholder="Enter Mobile Number">
            </div>


            <!-- Phone Number -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Office Phone Number *</label>
                <input type="tel" name="office_phone_number" class="form-control"
                    placeholder="Enter Office Number">
            </div>
        </div>
        <div class="sm:flex gap-3">

            <!-- Country -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Country *</label>
                <select name="country_id" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($countries as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>


            <!-- State -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">State *</label>
                <input type="text" name="state" class="form-control" placeholder="Enter State">
            </div>

            <!-- City -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">City *</label>
                <input type="text" name="city" class="form-control" placeholder="Enter city">
            </div>


            <!-- Postal Code -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Postal Code *</label>

                <input type="text" name="postal_code" class="form-control" placeholder="Enter State">
            </div>
        </div>
        <div class="col-md-12">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" placeholder="Enter Address" rows="2"></textarea>
        </div>
    </div>

    <!-- Buttons -->
    <div class="mt-8 mb-3 flex gap-4">
        <button class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 shadow">Save</button>
        <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 shadow">Save & Add
            More</button>
        <button class="text-gray-500 hover:text-gray-700">Cancel</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Safe Select2 init (won't throw if jQuery/select2 not loaded)
        if (window.jQuery && typeof jQuery.fn.select2 === 'function') {
            jQuery('.select2').select2({
                placeholder: "Search or select",
                allowClear: true,
                width: '100%'
            });
        } else {
            console.warn('jQuery or Select2 not found — skipping select2 init.');
        }


        // Convert PHP stages array into JS
        const stages = @json($stages);

        const pipelineSelect = document.getElementById('pipelineSelect');
        const stageSelect = document.getElementById('stageSelect');

        function loadStages(pipelineId) {
            // Clear old options
            stageSelect.innerHTML = '<option value="">Select</option>';

            // Filter stages by pipeline
            const filtered = stages.filter(s => s.lead_pipline_id == pipelineId);

            // Append filtered options
            filtered.forEach(stage => {
                const option = document.createElement('option');
                option.value = stage.id;
                option.textContent = stage.name;

                // Preselect default stage
                if (stage.is_default === 'yes') {
                    option.selected = true;
                }
                stageSelect.appendChild(option);
            });

            // Refresh select2 if active
            if (window.jQuery && jQuery(stageSelect).data('select2')) {
                jQuery(stageSelect).trigger('change.select2');
            }
        }

        // Load on first page load (default pipeline)
        if (pipelineSelect.value) {
            loadStages(pipelineSelect.value);
        }

        // Reload on pipeline change
        pipelineSelect.addEventListener('change', function() {
            loadStages(this.value);
        });
    });
    // Toggle sections
    document.getElementById("createDeal").addEventListener("change", function() {
        document.getElementById("dealSection").classList.toggle("hidden", !this.checked);
    });
    document.getElementById("companyDetail").addEventListener("change", function() {
        document.getElementById("companySection").classList.toggle("hidden", !this.checked);
    });
</script>
