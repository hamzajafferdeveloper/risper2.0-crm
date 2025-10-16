<form id="{{ $formId ?? 'projectForm' }}" class="row g-3 max-h-[90vh] flex flex-col gap-3 overflow-y-auto px-5"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="projectId">
    <div class="flex gap-3">
        <div class="w-full sm:w-1/3">
            <label class="form-label">Short Code</label>
            <input class="form-control" id="short_code" name="short_code" placeholder="Project Unique Short Code" />
        </div>
        <div class="w-full sm:w-1/3">
            <label class="form-label">Name*</label>
            <input class="form-control" id="short_code" name="short_code" placeholder="Write Project Name" required />
        </div>
        <div class="w-full sm:w-1/3">
            <label class="form-label">Client</label>
            <select name="salutation" class="form-select select2" data-placeholder="Select Client">
                <option value="">Select</option>
                @foreach (\App\Models\Employee::all() as $employee)
                    <option value={{ $employee->id }}>{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="flex gap-3">
        <div class="w-full sm:w-1/3">
            <label class="form-label">Start Date*</label>
            <input class="form-control" type="date" id="start_date" name="start_date" required />
        </div>
        <div class="w-full sm:w-1/3">
            <label class="form-label">End Date*</label>
            <input class="form-control" type="date" id="end_date" name="end_date" required />
        </div>

        <div class="w-full sm:w-1/3">
            <label class="form-label">End Date*</label>
            <div class="p-3">
                <input type="checkbox" id="has_end_date" name="has_end_date">
                <label for="has_end_date" class="text-sm">There is no project deadline</label>
            </div>
        </div>
    </div>
    <div class="flex gap-3">
        <div class="w-full sm:w-1/3">
            <label class="form-label">Project Category</label>
            <select name="salutation" class="form-select select2" data-placeholder="Select Client">
                <option value="">Select</option>
                @foreach (\App\Models\ProjectCategory::all() as $procategory)
                    <option value={{ $procategory->id }}>{{ $procategory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full sm:w-1/3">
            <label class="form-label">Department</label>
            <select name="salutation" class="form-select select2" data-placeholder="Select Client">
                <option value="">Select</option>
                @foreach (\App\Models\Department::all() as $department)
                    <option value={{ $department->id }}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full sm:w-1/3">
            <label class="form-label">Label</label>
            <select name="salutation" class="form-select select2" data-placeholder="Select Client">
                <option value="">Select</option>
                @foreach (\App\Models\ProjectLabel::all() as $prolabel)
                    <option value={{ $prolabel->id }}>{{ $prolabel->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#has_end_date').on('change', function() {
                const endDateInput = $('#end_date');
                if ($(this).is(':checked')) {
                    endDateInput.closest('div').hide();
                    endDateInput.removeAttr('required');
                    endDateInput.val('');
                } else {
                    endDateInput.closest('div').show();
                    endDateInput.attr('required', true);
                }
            });
        });
    </script>
@endpush
