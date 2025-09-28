<form id="addEmployeeForm" action="{{ route('admin.employees.store') }}" enctype="multipart/form-data"
    class="row g-3 max-h-[90vh] flex flex-col gap-3 overflow-y-auto px-5">
    @csrf

    <div class="sm:flex gap-3">
        <!-- Left Section -->
        <div class="flex flex-col gap-3 sm:w-[calc(100%-208px)] w-full mr-4">
            <div class="sm:flex gap-3">
                <!-- Employee ID -->
                <div class="w-full sm:w-1/3">
                    <label class="form-label">Employee ID *</label>
                    <input type="text" name="employee_id" value="{{ old('employee_id', $employee->employee_id ?? '') }}" class="form-control" required>
                </div>

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
            </div>

            <div class="sm:flex gap-3 w-full">
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

                <!-- Password -->
                <div class="w-full sm:w-1/2">
                    <label class="form-label">Password *</label>
                    <div class="icon-field">
                        <span class="icon">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" name="password" class="form-control" required placeholder="*******">
                    </div>
                </div>
            </div>

            <div class="sm:flex gap-3 w-full">

                <div class="w-full sm:w-1/3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select select2">
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
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
                class="sm:w-52 h-52 bg-neutral-200 dark:bg-neutral-600 rounded-md flex items-center justify-center overflow-hidden relative border border-gray-300">

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

    <div class="sm:flex gap-3">
        <!-- Reporting To -->
        <div class="w-full sm:w-1/4">
            <label class="form-label">Reporting To</label>
            <select name="reporting_to" class="form-select select2">
                <option value="">Select</option>
                @foreach ($employees as $e)
                    <option value="{{ $e->id }}">{{ $e->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Language -->
        <div class="w-full sm:w-1/4">
            <label class="form-label">Language</label>
            <select name="language_id" class="form-select select2">
                <option value="">Select</option>
                @foreach ($languages as $l)
                    <option value="{{ $l->id }}">{{ $l->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Designation -->
        <div class="w-full sm:w-1/4">
            <label class="form-label">Designation</label>
            <select name="designation_id" class="form-select select2">
                <option value="">Select</option>
                @foreach ($designations as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Department -->
        <div class="w-full sm:w-1/4">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-select select2">
                <option value="">Select</option>
                @foreach ($departments as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="sm:flex gap-3">
        <!-- Joining Date -->
        <div class="w-full sm:w-1/2">
            <label class="form-label">Joining Date *</label>
            <input type="date" name="joining_date" class="form-control" required>
        </div>

        <!-- DOB -->
        <div class="w-full sm:w-1/2">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control">
        </div>
    </div>

    <!-- Address -->
    <div class="col-md-12">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" rows="2"></textarea>
    </div>

    <!-- About -->
    <div class="col-md-12">
        <label class="form-label">About</label>
        <textarea name="about" class="form-control" rows="3"></textarea>
    </div>

    <!-- Skills (Multi-select with tagging) -->
    <div class="col-md-6">
        <label class="form-label">Skills</label>
        <div id="skills-container" class="d-flex flex-wrap" style="gap: 6px; min-height: 38px;">
            <input type="text" id="skill-input" class="form-control border" placeholder="Type and press Enter" />
        </div>
        <input type="hidden" name="skills" class="form-control" id="skills-hidden">
    </div>

    {{-- Seperator --}}
    <div class="my-6 flex items-center">
        <div class="flex-grow border-t border-neutral-300 dark:border-neutral-600"></div>
        <span class="px-4 text-sm font-medium text-gray-600 dark:text-gray-300">Other Details</span>
        <div class="flex-grow border-t border-neutral-300 dark:border-neutral-600"></div>
    </div>

    <div class="sm:flex gap-3">
        <div class="flex w-full sm:w-1/3 gap-3">
            <!-- Login Allowed -->
            <div>
                <label class="form-label">Login Allowed</label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="login_allowed" class="sr-only peer toggle-input" checked>
                    <span
                        class="relative w-11 h-6 bg-gray-400 peer-focus:outline-none rounded-full peer dark:bg-gray-500
                       peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                       peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px]
                       after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                       after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600">
                    </span>
                    <span class="line-height-1 font-medium ms-3 toggle-label text-md text-gray-600 dark:text-gray-300">
                        Yes
                    </span>
                </label>
            </div>

            <!-- Email Notifications -->
            <div>
                <label class="form-label">Receive Email Notifications</label>
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
                    <span class="line-height-1 font-medium ms-3 toggle-label text-md text-gray-600 dark:text-gray-300">
                        Yes
                    </span>
                </label>
            </div>
        </div>
        <!-- Slack ID -->
        <div class="w-full sm:w-1/3">
            <label class="form-label">Slack Member ID</label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 border rounded-e-0 border-e-0 rounded-s-md border-neutral-200 dark:border-neutral-600">
                    {{-- <iconify-icon icon="mynaui:envelope"></iconify-icon> --}}
                    @
                </span>
                <input type="text" name="slack_member_id"
                    class="form-control grow rounded-ss-none rounded-es-none" placeholder="info@gmail.com">
            </div>
        </div>

        <div class="w-full sm:w-1/3">
            <label class="form-label">Hourly Rate</label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 border rounded-e-0 border-e-0 rounded-s-md border-neutral-200 dark:border-neutral-600">
                    {{-- <iconify-icon icon="mynaui:envelope"></iconify-icon> --}}
                    $
                </span>
                <input type="number" name="hourly_rate" class="form-control grow rounded-ss-none rounded-es-none"
                    placeholder="45">
            </div>
        </div>

    </div>

    <div class="sm:flex gap-3">
        <!-- Probation End Date -->
        <div class="w-full sm:w-1/3">
            <label class="form-label">Probation End Date</label>
            <input type="date" name="probation_end_date" class="form-control">
        </div>

        <!-- Notice Period -->
        <div class="w-full sm:w-1/3">
            <label class="form-label">Notice Period Start</label>
            <input type="date" name="notice_period_start_date" class="form-control">
        </div>
        <div class="w-full sm:w-1/3">
            <label class="form-label">Notice Period End</label>
            <input type="date" name="notice_period_end_date" class="form-control">
        </div>
    </div>

    <div class="sm:flex gap-3">
        <!-- Employee Type -->
        <div class="w-full sm:w-1/3">
            <label class="form-label">Employee Type</label>
            <select name="employee_type_id" class="form-select select2">
                <option value="">Select</option>
                @foreach ($employment_types as $et)
                    <option value="{{ $et->id }}">{{ $et->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Marital Status -->
        <div class="w-full sm:w-1/3">
            <label class="form-label">Marital Status *</label>
            <select name="marital_status" class="form-select select2" required>
                <option value="">Select</option>
                <option>Single</option>
                <option>Married</option>
                <option>Widower</option>
                <option>Widow</option>
                <option>Separate</option>
                <option>Divorced</option>
                <option>Engaged</option>
            </select>
        </div>

        <!-- Business Address -->
        <div class="w-full sm:w-1/3">
            <label class="form-label">Business Address</label>
            <select name="business_address_id" class="form-select select2">
                <option value="">Select</option>
                @foreach ($business_addresses as $ba)
                    <option value="{{ $ba->id }}">{{ $ba->address }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Submit -->
    <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary px-4">Save Employee</button>
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

        document.querySelectorAll('.toggle-input').forEach(function(input) {
            input.addEventListener('change', function() {
                const label = this.closest('label').querySelector('.toggle-label');
                label.textContent = this.checked ? 'Yes' : 'No';
            });
        });

        // Skills input logic (robust, case-insensitive dedupe, preserve display case)
        const skillInput = document.getElementById('skill-input');
        const skillsContainer = document.getElementById('skills-container');
        const hiddenInput = document.getElementById('skills-hidden');
        const fileInput = document.getElementById("profilePicInput");
        const preview = document.getElementById("profilePicPreview");
        const placeholder = document.getElementById("profilePicPlaceholder");
        const removeBtn = document.getElementById("removeProfilePicBtn");

        fileInput.addEventListener("change", () => {
            const file = fileInput.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = "block";
                placeholder.style.display = "none";
                removeBtn.classList.remove("hidden");
            }
        });

        removeBtn.addEventListener("click", () => {
            fileInput.value = "";
            preview.src = "";
            preview.style.display = "none";
            placeholder.style.display = "block";
            removeBtn.classList.add("hidden");
        });

        if (!skillInput || !skillsContainer || !hiddenInput) {
            console.warn('Skills elements not found — skills widget disabled.');
            return;
        }

        // stores normalized skills for dedupe
        let skills = []; // e.g. ['php', 'react']
        // map normalized => display (original casing)
        let displayMap = {};

        // helper: escape HTML for safe insertion
        function escapeHtml(str) {
            return String(str).replace(/[&<>"']/g, function(m) {
                return ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                })[m];
            });
        }

        function updateHidden() {
            hiddenInput.value = skills.join(',');
        }

        function createBadge(normalized, display) {
            const badge = document.createElement('span');
            badge.className = 'skill-badge inline-flex items-center gap-2';
            badge.setAttribute('data-skill', normalized);

            // badge content (preserve display case)
            badge.innerHTML = '<span class="skill-text">' + escapeHtml(display) + '</span>' +
                '<button type="button" class="remove-skill" aria-label="Remove skill">×</button>';

            // remove handler
            badge.querySelector('.remove-skill').addEventListener('click', function(e) {
                e.stopPropagation();
                badge.remove();
                skills = skills.filter(s => s !== normalized);
                delete displayMap[normalized];
                updateHidden();
            });

            return badge;
        }

        function addSkillRaw(value) {
            if (!value) return;
            const cleaned = value.trim().replace(/,+$/, ''); // remove trailing commas
            if (!cleaned) return;

            // allow multiple comma-separated entered text
            const parts = cleaned.split(',').map(p => p.trim()).filter(Boolean);
            parts.forEach(part => {
                const normalized = part.toLowerCase();
                if (!skills.includes(normalized)) {
                    skills.push(normalized);
                    displayMap[normalized] = part;
                    const badge = createBadge(normalized, part);
                    // insert before the input
                    skillsContainer.insertBefore(badge, skillInput);
                    updateHidden();
                } else {
                    // visual feedback for duplicate
                    skillInput.classList.add('shake');
                    setTimeout(() => skillInput.classList.remove('shake'), 350);
                }
            });
        }

        // handle Enter, comma, and Backspace behaviour
        skillInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                // if user pressed comma, we still want to add current content
                addSkillRaw(this.value);
                this.value = '';
            } else if (e.key === 'Backspace' && this.value === '') {
                // remove last tag if input empty
                const last = skills[skills.length - 1];
                if (last) {
                    const lastBadge = skillsContainer.querySelector('span[data-skill="' + last + '"]');
                    if (lastBadge) lastBadge.remove();
                    skills = skills.slice(0, -1);
                    delete displayMap[last];
                    updateHidden();
                }
            }
        });

        // paste support: if user pastes "a,b,c" add them
        skillInput.addEventListener('paste', function(e) {
            // small delay so pasted text is available
            setTimeout(() => {
                const val = this.value;
                if (val.includes(',')) {
                    addSkillRaw(val);
                    this.value = '';
                }
            }, 0);
        });

        // click on container focuses input
        skillsContainer.addEventListener('click', function() {
            skillInput.focus();
        });

        // Expose addSkillRaw to window if you want to add programmatically
        window.addSkill = addSkillRaw;
    });
</script>
<style>
    /* small badge styling (Tailwind-like; falls back if tailwind present) */
    .skill-badge {
        background: #0d6efd;
        /* bootstrap primary */
        color: #fff;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-right: 6px;
        margin-bottom: 6px;
    }

    .skill-badge .remove-skill {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.95);
        font-weight: 700;
        cursor: pointer;
        line-height: 1;
        padding: 0;
        font-size: 14px;
    }

    /* shake animation for duplicate */
    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-4px);
        }

        75% {
            transform: translateX(4px);
        }
    }

    .shake {
        animation: shake 0.35s;
    }

    .form-control,
    .form-select {
        padding-top: 0.4rem;
        padding-bottom: 0.4rem;
    }

    .icon-field .icon {
        top: unset !important;
        font-size: 17px;
    }

    .icon-field {
        display: flex;
        align-items: center;
    }

    .peer:checked~.peer-checked\:after\:translate-x-full::after {
        --tw-translate-x: 48%
    }

    /* Beautify Select2 dropdown */
    .select2-container .select2-selection--single,
    .select2-container .select2-selection--multiple {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 6px 10px;
        height: auto;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #0d6efd;
        border-radius: 12px;
        color: #fff;
        padding: 3px 8px;
        margin: 3px 5px 3px 0;
        font-size: 13px;
    }

    .select2-container--default .select2-results__option--highlighted {
        background: #0d6efd;
        color: #fff;
    }

    .selection {
        width: 100%;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 10px;
    }

    /* Search box inside dropdown */
    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid #d1d5db;
        /* Tailwind gray-300 */
        border-radius: 0.5rem;
        /* rounded */
        padding: 6px 10px;
        font-size: 14px;
        outline: none;
    }

    /* Dropdown results box */
    .select2-container--default .select2-results>.select2-results__options {
        max-height: 220px;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        padding: 4px;
        font-size: 14px;
    }

    /* Each option */
    .select2-container--default .select2-results__option {
        padding: 8px 12px;
        border-radius: 0.375rem;
        /* rounded-md */
        transition: background 0.2s;
    }

    /* Hover state */
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #2563eb;
        /* Tailwind blue-600 */
        color: white;
    }

    /* Selected option */
    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #e0f2fe;
        /* Tailwind blue-100 */
        color: #1e3a8a;
    }

    /* The main box (before dropdown opens) */
    .select2-container--default .select2-selection--single {
        height: 40px;
        border-radius: 0.35rem;
        /* rounded-xl */
        border: 1px solid #d1d5db;
        padding: 6px 12px;
        display: flex;
        align-items: center;
        font-size: 15px;
    }

    /* Placeholder text */
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #9ca3af;
        /* gray-400 */
    }
</style>
