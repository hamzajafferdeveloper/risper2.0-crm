<!-- Edit Employee Modal -->
<div id="editEmployeeModal"
    class="hidden flex fixed inset-0 z-50  justify-end bg-black/50 transition-opacity duration-300">

    <!-- Modal Panel -->
    <div id="editEmployeePanel"
        class="relative bg-white dark:bg-gray-800 rounded-l-xl shadow-2xl p-6 w-full max-w-7xl z-10 transform translate-x-full transition-transform duration-300">

        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h2 class="text-lg font-semibold">Edit Employee</h2>
            <button class="closeEditModal text-gray-500 hover:text-gray-700">✕</button>
        </div>

        <form id="editEmployeeForm" enctype="multipart/form-data"
            class="row g-3 max-h-[90vh] flex flex-col gap-3 overflow-y-auto px-5">
            @csrf

            <div class="sm:flex gap-3">
                <!-- Left Section -->
                <div class="flex flex-col gap-3 sm:w-[calc(100%-208px)] w-full mr-4">
                    <div class="sm:flex gap-3">
                        <!-- Employee ID -->
                        <div class="w-full sm:w-1/3">
                            <label class="form-label">Employee ID *</label>
                            <input disabled type="text" name="employee_id" class="form-control" required>
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
                                <input type="password" name="password" class="form-control" placeholder="*******">
                            </div>
                        </div>
                    </div>

                    <div class="sm:flex gap-3 w-full">

                        <div class="w-full sm:w-1/3">
                            <label class="form-label">Gender *</label>
                            <select name="gender" class="form-select select2" required>
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
                            </select>
                        </div>

                        <!-- Mobile -->
                        <div class="w-full sm:w-1/3">
                            <label class="form-label">Mobile</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                                </span>
                                <input type="text" name="mobile" class="form-control"
                                    placeholder="+1 (555) 000-0000">
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
                        <img id="editProfilePicPreview" src="" alt="Profile Picture"
                            class="w-full h-full object-cover" style="display:none;">

                        <!-- Placeholder Icon/Text -->
                        <span id="editProfilePicPlaceholder" class="text-gray-500 text-sm">Upload</span>

                        <!-- File Input Overlay -->
                        <input type="file" id="editProfilePicInput" name="profile_pic"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                    </div>
                    <!-- Remove Button -->
                    <button type="button" id="editRemoveProfilePicBtn"
                        class="hidden mt-2 text-red-500 text-sm underline">
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
                    </select>
                </div>

                <!-- Language -->
                <div class="w-full sm:w-1/4">
                    <label class="form-label">Language</label>
                    <select name="language_id" class="form-select select2">
                        <option value="">Select</option>
                    </select>
                </div>

                <!-- Designation -->
                <div class="w-full sm:w-1/4">
                    <label class="form-label">Designation</label>
                    <select name="designation_id" class="form-select select2">
                        <option value="">Select</option>
                    </select>
                </div>

                <!-- Department -->
                <div class="w-full sm:w-1/4">
                    <label class="form-label">Department</label>
                    <select name="department_id" class="form-select select2">
                        <option value="">Select</option>
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
                    <input type="text" id="skill-input" class="form-control border"
                        placeholder="Type and press Enter" />
                </div>
                <input type="hidden" name="skills" class="form-control" id="skills-hidden">
            </div>

            {{-- Seperator --}}
            <div class="my-6 flex items-center">
                <div class="flex-grow border-t border-neutral-300 dark:border-neutral-600"></div>
                <span class="px-4 text-sm font-medium text-gray-600 dark:text-gray-300">Other Details</span>
                <div class="flex-grow border-t border-neutral-300 dark:border-neutral-600"></div>
            </div>

            <div class="sm:flex items-center gap-5">
                <div class="w-full sm:w-1/2">
                    <label class="form-label">Permissions</label>
                    <div class="flex w-full items-center gap-3">
                        <!-- Login Allowed -->
                        <div class="flex items-center gap-3 w-1/2">
                            <label class="form-label" style="margin-bottom: unset !important">Login Allowed</label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="login_allowed" class="sr-only peer toggle-input"
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

                        <!-- Email Notifications -->
                        <div class="flex items-center gap-3 w-1/2">
                            <label class="form-label" style="margin-bottom: unset !important">Receive Email
                                Notifications</label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="receive_email_notification"
                                    class="sr-only peer toggle-input" checked>
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
                <!-- Slack ID -->
                {{-- <div class="w-full sm:w-1/3">
            <label class="form-label">Slack Member ID</label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 border rounded-e-0 border-e-0 rounded-s-md border-neutral-200 dark:border-neutral-600">
                    @
                </span>
                <input type="text" name="slack_member_id"
                    class="form-control grow rounded-ss-none rounded-es-none" placeholder="info@gmail.com">
            </div>
        </div> --}}

                <div class="w-full sm:w-1/2">
                    <label class="form-label">Hourly Rate</label>
                    <div class="flex">
                        <span
                            class="inline-flex items-center px-3 border rounded-e-0 border-e-0 rounded-s-md border-neutral-200 dark:border-neutral-600">
                            $
                        </span>
                        <input type="number" name="hourly_rate"
                            class="form-control grow rounded-ss-none rounded-es-none" placeholder="45">
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
                    </select>
                </div>
            </div>

            <!-- Submit -->
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary !bg-[#8D35E3] px-4">Save Employee</button>
            </div>
        </form>
    </div>
</div>
