<form id="{{ $formId ?? 'leadForm' }}" class="row g-3 max-h-[90vh] flex flex-col gap-3 overflow-y-auto px-5"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="ClientId">

    <!-- Lead Contact Detail -->
    <div class="flex flex-col gap-3">
        <div class="sm:flex gap-3">
            <!-- Left Section -->
            <div class="flex flex-col gap-3 sm:w-[calc(100%-208px)] w-full mr-4">
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
                            <input type="text" name="name" class="form-control" placeholder="Enter Last Name">
                        </div>
                    </div>


                    <!-- Email -->
                    <div class="w-full sm:w-1/2">
                        <label class="form-label">Email *</label>
                        <div class="icon-field">
                            <span class="icon">
                                <iconify-icon icon="mage:email"></iconify-icon>
                            </span>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                    </div>
                </div>

                <div class="sm:flex gap-3 w-full">

                    <!-- Password -->
                    <div class="w-full sm:w-1/2">
                        <label class="form-label">Password</label>
                        <div class="icon-field">
                            <span class="icon">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="*******">
                        </div>
                    </div>

                    <!-- Country -->
                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Country</label>
                        <select name="country_id" class="form-select select2">
                            <option value="">Select</option>
                            @foreach ($countries as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Mobile -->
                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Mobile</label>
                        <div class="icon-field">
                            <span class="icon">
                                <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                            </span>
                            <input type="text" name="mobile" class="form-control" placeholder="+1 (555) 000-0000">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Pic -->
            <div class="sm:w-52 relative">
                <label class="form-label block mb-2">Profile Picture</label>
                <div
                    class="sm:w-52 h-34 bg-neutral-200 dark:bg-neutral-600 rounded-md flex items-center justify-center overflow-hidden relative border border-gray-300">

                    <!-- Preview -->
                    <img id="profilePicPreview" src="" alt="Profile Picture" class="w-full h-full object-cover"
                        style="display:none;">

                    <!-- Placeholder Icon/Text -->
                    <span id="profilePicPlaceholder" class="text-gray-500 text-sm">Upload</span>

                    <!-- File Input Overlay -->
                    <input type="file" id="profilePicInput" name="profile_pic"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                </div>

                <!-- Remove Button -->
                <button type="button" id="removeProfilePicBtn" class="hidden mt-2 text-red-500 text-sm underline">
                    Remove
                </button>
            </div>
        </div>


        <div class="sm:flex gap-3 w-full">

            <div class="w-full sm:w-1/2 md:w-1/4">
                <label class="form-label">Gender *</label>
                <select name="gender" class="form-select select2" required>
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="w-full sm:w-1/2 md:w-1/4">
                <label class="form-label">Language</label>
                <select name="language" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($languages as $l)
                        <option value="{{ $l->id }}">{{ $l->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/4">
                <label class="form-label">Client Category</label>
                <select name="category_id" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/4">
                <label class="form-label">Client Sub Category</label>
                <select name="sub_category_id" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($sub_categories as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="w-full">
            <label class="form-label">Permissions</label>
            <div class="flex w-1/2 items-center gap-3">
                <!-- Login Allowed -->
                <div class="flex items-center gap-3 w-1/2">
                    <label class="form-label" style="margin-bottom: unset !important">Login Allowed</label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="login_allowed" class="sr-only peer toggle-input" checked>
                        <span
                            class="relative w-11 h-6 bg-gray-400 peer-focus:outline-none rounded-full peer dark:bg-gray-500
                       peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                       peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px]
                       after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                       after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600">
                        </span>
                        <span
                            class="line-height-1 font-medium ms-3 toggle-label text-md text-gray-600 dark:text-gray-300">
                            Yes
                        </span>
                    </label>
                </div>

                <!-- Email Notifications -->
                <div class="flex items-center gap-3 w-1/2">
                    <label class="form-label" style="margin-bottom: unset !important">Receive Email
                        Notifications</label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="receive_email_notification" class="sr-only peer toggle-input"
                            checked>
                        <span
                            class="relative w-11 h-6 bg-gray-400 peer-focus:outline-none rounded-full peer dark:bg-gray-500
                       peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                       peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px]
                       after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                       after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600">
                        </span>
                        <span
                            class="line-height-1 font-medium ms-3 toggle-label text-md text-gray-600 dark:text-gray-300">
                            Yes
                        </span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Company Section -->
    <div id="companySection" class="border-t flex flex-col gap-3">
        <h3 class="text-lg font-semibold text-gray-800">Company Details</h3>
        <div class="sm:flex gap-3">
            <!-- Left Section -->
            <div class="flex flex-col gap-3 sm:w-[calc(100%-208px)] w-full mr-4">
                <div class="sm:flex gap-3">
                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Company Name *</label>
                        <input type="text" name="company_name" id="company_name" class="form-control"
                            placeholder="Enter Company Name">
                    </div>

                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Tax Name</label>
                        <input type="text" name="tax_name" id="tax_name" class="form-control"
                            placeholder="Gst/Vat">
                    </div>

                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Gst/Vat Number</label>
                        <input type="text" name="tax_number" id="tax_number" class="form-control"
                            placeholder="e.g: 18AABCU000000000">
                    </div>
                </div>

                <div class="sm:flex gap-3">
                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Office Phone Number</label>
                        <input type="tel" name="office_phone_number" id="office_phone_number"
                            class="form-control" placeholder="Enter Office Number">
                    </div>



                    <div class="w-full sm:w-1/3">
                        <label class="form-label">Official Website</label>
                        <input type="text" name="website" id="website" class="form-control"
                            placeholder="Enter Website URL">
                    </div>

                    <div class="w-full sm:w-1/3">
                        <label class="form-label">State</label>
                        <input type="text" name="state" id="state" class="form-control"
                            placeholder="Enter State">
                    </div>
                </div>
            </div>

            <!-- Profile Pic -->
            <div class="sm:w-52 relative">
                <label class="form-label block mb-2">Company Logo</label>
                <div
                    class="sm:w-52 h-34 bg-neutral-200 dark:bg-neutral-600 rounded-md flex items-center justify-center overflow-hidden relative border border-gray-300">

                    <!-- Preview -->
                    <img id="companyLogoPreview"
                        src="{{ isset($client) && $client->company_logo ? asset('storage/' . $client->company_logo) : '' }}"
                        alt="Company Logo" class="w-full h-full object-cover"
                        style="display: {{ isset($client) && $client->company_logo ? 'block' : 'none' }};">

                    <!-- Placeholder -->
                    <span id="companyLogoPlaceholder"
                        class="text-gray-500 text-sm {{ isset($client) && $client->company_logo ? 'hidden' : '' }}">Upload
                        Logo</span>

                    <!-- File Input -->
                    <input type="file" id="companyLogoInput" name="company_logo"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                </div>

                <!-- Remove Button -->
                <button type="button" id="removeCompanyLogoBtn"
                    class="hidden mt-2 text-red-500 text-sm underline">Remove</button>
            </div>
        </div>

        <div class="flex gap-3">

            <div class="w-full sm:w-1/2">
                <label class="form-label">Added by</label>
                <select name="added_by" id="added_by" class="form-select select2">
                    <option value="">Select</option>
                    @foreach ($employees as $e)
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-1/2">
                <label class="form-label">City</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="Enter City">
            </div>

            <div class="w-full sm:w-1/2">
                <label class="form-label">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code" class="form-control"
                    placeholder="Enter Postal Code">
            </div>

        </div>
        <div class="sm:flex gap-3">
            <div class="w-full sm:w-1/2">
                <label class="form-label">Address</label>
                <textarea name="address" id="address" class="form-control" placeholder="Enter Address" rows="2"></textarea>
            </div>
            <div class="w-full sm:w-1/2">
                <label class="form-label">Shipping Address</label>
                <textarea name="shipping_address" id="shipping_address" class="form-control" placeholder="Enter Shipping Address"
                    rows="2"></textarea>
            </div>
        </div>

        <div class="w-full sm:w-1/2">
            <label class="form-label">Note</label>
            <textarea name="note" id="note" class="form-control" placeholder="Enter Note"></textarea>
        </div>

    </div>

    <!-- Buttons -->
    <div class="mt-8 mb-3 flex gap-4">
        <button id="saveBtn" type="submit"
            class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 shadow">
            Save
        </button>
        <button type="button" id={{ 'close' . $formId }} class="text-gray-500 hover:text-gray-700"
            data-dismiss="modal">Cancel</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoInput = document.getElementById('companyLogoInput');
        const logoPreview = document.getElementById('companyLogoPreview');
        const logoPlaceholder = document.getElementById('companyLogoPlaceholder');
        const removeLogoBtn = document.getElementById('removeCompanyLogoBtn');
        const profileInput = document.getElementById('profilePicInput');
        const profilePreview = document.getElementById('profilePicPreview');
        const profilePlaceholder = document.getElementById('profilePicPlaceholder');
        const removeProfileBtn = document.getElementById('removeProfilePicBtn');

        if (logoInput) {
            logoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        logoPreview.src = event.target.result;
                        logoPreview.style.display = 'block';
                        logoPlaceholder.classList.add('hidden');
                        removeLogoBtn.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeLogoBtn.addEventListener('click', function() {
                logoInput.value = '';
                logoPreview.src = '';
                logoPreview.style.display = 'none';
                logoPlaceholder.classList.remove('hidden');
                removeLogoBtn.classList.add('hidden');
            });
        }

        if (profileInput) {
            profileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        profilePreview.src = event.target.result;
                        profilePreview.style.display = 'block';
                        profilePlaceholder.classList.add('hidden');
                        removeProfileBtn.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeProfileBtn.addEventListener('click', function() {
                profileInput.value = '';
                profilePreview.src = '';
                profilePreview.style.display = 'none';
                profilePlaceholder.classList.remove('hidden');
                removeProfileBtn.classList.add('hidden');
            });
        }

        // 🧠 For edit mode, if an existing profile picture exists, show the remove button
        if (profilePreview && profilePreview.src && profilePreview.src.trim() !== '' && !profilePreview.src
            .includes('placeholder')) {
            removeProfileBtn.classList.remove('hidden');
        }

        // 🧠 For edit mode, if an existing logo exists, show the remove button
        if (logoPreview && logoPreview.src && logoPreview.src.trim() !== '') {
            removeLogoBtn.classList.remove('hidden');
        }
    });
</script>
