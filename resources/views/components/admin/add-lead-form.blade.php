<form id="{{ $formId ?? 'leadForm' }}" class="row g-3 max-h-[90vh] flex flex-col gap-3 overflow-y-auto px-5">
    @csrf
    <input type="hidden" name="id" id="leadId">

    <!-- Lead Contact Detail -->
    <div class="flex flex-col gap-3">
        <div class="sm:flex gap-3">
            <!-- Salutation -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Salutation</label>
                <select name="salutation" id="salutation" class="form-select select2">
                    <option value="">Select</option>
                    <option>Mr</option>
                    <option>Mrs</option>
                    <option>Miss</option>
                    <option>Dr.</option>
                    <option>Sir</option>
                    <option>Madam</option>
                </select>
                @error('salutation')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Name -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Full Name *</label>
                <div class="icon-field">
                    <span class="icon">
                        <iconify-icon icon="mage:user"></iconify-icon>
                    </span>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Lead Name">
                </div>
                @error('name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Email -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Email *</label>
                <div class="icon-field">
                    <span class="icon">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                </div>
                @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="sm:flex gap-3">
            <!-- Lead Source -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Lead Source</label>
                <select name="lead_source_id" id="lead_source_id" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($lead_sources as $e)
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
                @error('lead_source_id')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Added By -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Add By</label>
                <select name="added_by" id="added_by" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($employees as $e)
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
                @error('added_by')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Owner -->
            <div class="w-full sm:w-1/3">
                <label class="form-label">Assigning to</label>
                <select name="lead_owner" id="lead_owner" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($employees as $e)
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
                @error('lead_owner')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <!-- Checkboxes -->
    <div class="flex items-center gap-6">
        <label class="flex items-center gap-2">
            <input type="checkbox" id="auto_convert_lead_to_client" name="auto_convert_lead_to_client"
                class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500">
            <span class="text-gray-700 font-medium">Auto Convert Lead to Client When Deal Stage is set to win</span>
        </label>
    </div>

    <!-- Deal Section -->
    <div id="dealSection" class="flex flex-col gap-3 border-t pt-6">
        <h3 class="text-lg font-semibold text-gray-800">Deal Information</h3>
        <div class="sm:flex gap-3">
            <div class="w-full sm:w-1/2">
                <label class="form-label">Deal Watcher</label>
                <select name="deal_watcher" id="deal_watcher" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($employees as $e)
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
                @error('deal_watcher')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Stages -->
            <div class="w-full sm:w-1/2">
                <label class="form-label">Deal Stage</label>
                <select id="stageSelect" name="deal_stage_id" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($stages as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
                @error('deal_stage_id')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <!-- Company Detail Checkbox -->
    <label class="flex items-center gap-2">
        <input type="checkbox" id="companyDetail" name="has_company_detail" class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500">
        <span class="text-gray-700 font-medium">Company Details</span>
    </label>

    <!-- Company Section -->
    <div id="companySection" class="hidden border-t flex flex-col gap-3">
        <h3 class="text-lg font-semibold text-gray-800">Company Details</h3>
        <div class="sm:flex gap-3">
            <div class="w-full sm:w-1/3">
                <label class="form-label">Company Name *</label>
                <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name">
            </div>

            <div class="w-full sm:w-1/3">
                <label class="form-label">Website</label>
                <input type="text" name="website" id="website" class="form-control" placeholder="Enter Website URL">
            </div>

            <div class="w-full sm:w-1/3">
                <label class="form-label">Mobile *</label>
                <input type="tel" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile Number">
            </div>

            <div class="w-full sm:w-1/3">
                <label class="form-label">Office Phone Number</label>
                <input type="tel" name="office_phone_number" id="office_phone_number" class="form-control" placeholder="Enter Office Number">
            </div>
        </div>

        <div class="sm:flex gap-3">
            <div class="w-full sm:w-1/3">
                <label class="form-label">Country</label>
                <select name="country_id" id="country_id" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($countries as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-1/3">
                <label class="form-label">State</label>
                <input type="text" name="state" id="state" class="form-control" placeholder="Enter State">
            </div>

            <div class="w-full sm:w-1/3">
                <label class="form-label">City</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="Enter City">
            </div>

            <div class="w-full sm:w-1/3">
                <label class="form-label">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Enter Postal Code">
            </div>
        </div>

        <div class="col-md-12">
            <label class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" placeholder="Enter Address" rows="2"></textarea>
        </div>
    </div>

    <!-- Buttons -->
    <div class="mt-8 mb-3 flex gap-4">
        <button id="saveBtn" type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 shadow">
            Save
        </button>
        <button type="button" id={{ 'close'.$formId }} class="text-gray-500 hover:text-gray-700" data-dismiss="modal">Cancel</button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ✅ Use delegated event listener — works for all modals
    document.addEventListener('change', function (e) {
        if (e.target && e.target.id === 'companyDetail') {
            const form = e.target.closest('form');
            const section = form?.querySelector('#companySection');
            if (section) {
                section.classList.toggle('hidden', !e.target.checked);
            }
        }
    });

    // ✅ Run check AFTER modal is opened — ensures element exists
    $(document).on('shown.bs.modal', '#editLeadModal', function () {
        const checkbox = this.querySelector('#companyDetail');
        const section = this.querySelector('#companySection');
        if (checkbox && section) {
            section.classList.toggle('hidden', !checkbox.checked);
        }
    });
});
</script>
