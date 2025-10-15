<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealStage;
use App\Models\Lead;
use App\Models\LeadCompanyDetail;
use App\Models\LeadPipline;
use App\Models\LeadSource;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = Lead::with(['deal.dealStage', 'leadOwner', 'deal.dealWatcher', 'leadAddedBy']);

            // 🔍 Search by name
            if ($request->search_name) {
                $query->where('name', 'like', "%{$request->search_name}%");
            }

            // 🧑 Filter by Added By
            if ($request->added_by) {
                $query->where('added_by', $request->added_by);
            }

            // 🧍 Filter by Owner
            if ($request->owner_id) {
                $query->where('lead_owner', $request->owner_id);
            }

            // 👁️ Filter by Watcher
            if ($request->watcher_id) {
                $query->whereHas('deal.dealWatcher', function ($q) use ($request) {
                    $q->where('id', $request->watcher_id);
                });
            }

            // 📊 Filter by Stage
            if ($request->stage_id) {
                $query->whereHas('deal', function ($q) use ($request) {
                    $q->where('deal_stage_id', $request->stage_id);
                });
            }

            // 📅 Filter by Date Range
            if ($request->start_date && $request->end_date) {
                $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
            } elseif ($request->start_date) {
                $query->whereDate('created_at', '>=', $request->start_date);
            } elseif ($request->end_date) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            // ✅ DataTable
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('lead_added_by_name', function ($row) {
                    $user = $row->leadAddedBy;
                    if (!$user) return '-';

                    $image = $user->profile_pic
                        ? asset('storage/' . $user->profile_pic)
                        : asset('assets/images/avatar/avatar.png');

                    return '
                        <div class="flex items-center gap-2">
                            <img src="' . $image . '" alt="' . e($user->name) . '" class="w-8 h-8 rounded-full object-cover">
                            <span>' . e($user->name) . '</span>
                        </div>
                    ';
                })
                ->addColumn('lead_owner_name', function ($row) {
                    $user = $row->leadOwner;
                    if (!$user) return '-';

                    $image = $user->profile_pic
                        ? asset('storage/' . $user->profile_pic)
                        : asset('assets/images/avatar/avatar.png');

                    return '
                        <div class="flex items-center gap-2">
                            <img src="' . $image . '" alt="' . e($user->name) . '" class="w-8 h-8 rounded-full object-cover">
                            <span>' . e($user->name) . '</span>
                        </div>
                    ';
                })
                ->addColumn('deal_watcher_name', function ($row) {
                    $user = $row->deal?->dealWatcher;
                    if (!$user) return '-';

                    $image = $user->profile_pic
                        ? asset('storage/' . $user->profile_pic)
                        : asset('assets/images/avatar/avatar.png');

                    return '
                        <div class="flex items-center gap-2">
                            <img src="' . $image . '" alt="' . e($user->name) . '" class="w-8 h-8 rounded-full object-cover">
                            <span>' . e($user->name) . '</span>
                        </div>
                    ';
                })
                ->addColumn('deal_stage_name', function ($row) {
                    $stages = DealStage::all();
                    $currentStageId = $row->deal?->deal_stage_id ?? null;

                    $options = '<option value="">Select Stage</option>';
                    foreach ($stages as $stage) {
                        $selected = $stage->id == $currentStageId ? 'selected' : '';
                        $options .= "<option value='{$stage->id}' {$selected}>{$stage->name}</option>";
                    }

                    $dotColor = $row->deal?->dealStage?->tag_color ?? '#d1d5db'; // default gray

                    return '
                        <div class="flex items-center gap-2">
                            <span class="inline-block w-2.5 h-2.5 rounded-full" style="background-color: '.$dotColor.'"></span>
                            <select id="" class="deal-stage-select  text-sm rounded-md border-gray-300 focus:ring-0"
                                data-lead-id="'.$row->id.'">
                                '.$options.'
                            </select>
                        </div>
                    ';
                })

                ->addColumn('action', function ($row) {
                    return '
                    <div class="flex gap-2">
                        <button class="btn btn-sm !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 text-white p-2 rounded editLead"
                            data-id="'.$row->id.'" title="Edit">
                            <iconify-icon icon="mdi:pencil" class="text-lg"></iconify-icon>
                        </button>

                        <button data-id="'.$row->id.'"
                            class="btn btn-sm !bg-red-500 hover:!bg-red-500/80 text-white p-2 rounded deleteLead"
                            title="Delete">
                            <iconify-icon icon="mage:trash" class="text-lg"></iconify-icon>
                        </button>
                    </div>';
                })
                ->rawColumns(['deal_stage_name', 'action', 'lead_added_by_name', 'lead_owner_name', 'deal_watcher_name'])
                ->make(true);
        }

        // Normal (non-AJAX) page load
        return view('admin.leads.index');
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate input
        $validator = Validator::make($request->all(), [
            'salutation' => 'required|in:Mr,Mrs,Miss,Dr.,Sir,Madam',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'lead_source_id' => 'nullable|exists:lead_sources,id',
            'added_by' => 'nullable|exists:employees,id',
            'lead_owner' => 'nullable|exists:employees,id',

            // deal validation (only if has_deal)
            'deal_name' => 'nullable|string|max:255',
            'pipe_line_id' => 'nullable|exists:lead_piplines,id',
            'deal_stage_id' => 'nullable|exists:deal_stages,id',
            'deal_value' => 'nullable|numeric|min:0',
            'close_date' => 'nullable|date',
            'deal_category_id' => 'nullable|exists:deal_categories,id',
            'deal_agent' => 'nullable|exists:deal_agents,id',
            'deal_watcher' => 'nullable|exists:employees,id',

            // company detail (only if has_company_detail)
            'company_name' => 'required_if:has_company_detail,on|string|max:255',
            'website' => 'nullable|string|max:255',
            'mobile' => 'required_if:has_company_detail,on|string|max:20',
            'office_phone_number' => 'nullable|string|max:20',
            'country_id' => 'nullable|exists:countries,id',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            // ✅ Step 2: Create Lead
            $lead = Lead::create([
                'salutation' => $request->salutation,
                'name' => $request->name,
                'email' => $request->email,
                'lead_source_id' => $request->lead_source_id,
                'added_by' => $request->added_by,
                'lead_owner' => $request->lead_owner,
                'auto_convert_lead_to_client' => $request->has('auto_convert_lead_to_client') ? 'yes' : 'no',
            ]);

            // ✅ Step 3: Add company details if needed
            if ($request->has('has_company_detail')) {
                LeadCompanyDetail::create([
                    'lead_id' => $lead->id,
                    'name' => $request->company_name,
                    'website' => $request->website,
                    'mobile' => $request->mobile,
                    'office_phone_number' => $request->office_phone_number,
                    'country_id' => $request->country_id,
                    'state' => $request->state,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'address' => $request->address,
                ]);
            }

            Deal::create([
                'lead_id' => $lead->id,
                'name' => $request->deal_name,
                'pipe_line_id' => $request->pipe_line_id,
                'deal_stage_id' => $request->deal_stage_id,
                'currency_id' => 1, // default currency
                'deal_value' => $request->deal_value,
                'close_date' => $request->close_date,
                'deal_category_id' => $request->deal_category_id,
                'deal_agent_id' => $request->deal_agent ?? auth()->id(),
                'deal_watcher_id' => $request->deal_watcher,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lead created successfully',
                'data' => $lead,
            ], 201);

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Lead creation failed: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the lead.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id){
        $lead = Lead::with(['companyDetail', 'deal.dealWatcher', 'deal.dealStage', 'leadOwner', 'leadAddedBy', 'source'])->findOrFail($id);

        return view('admin.leads.show', compact('lead'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Step 1: Validate input
        $validator = Validator::make($request->all(), [
            'salutation' => 'required|in:Mr,Mrs,Miss,Dr.,Sir,Madam',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email,'.$id,
            'lead_source_id' => 'nullable|exists:lead_sources,id',
            'added_by' => 'nullable|exists:employees,id',
            'lead_owner' => 'nullable|exists:employees,id',

            // deal validation (only if has_deal)
            'deal_name' => 'nullable|string|max:255',
            'pipe_line_id' => 'nullable|exists:lead_piplines,id',
            'deal_stage_id' => 'nullable|exists:deal_stages,id',
            'deal_value' => 'nullable|numeric|min:0',
            'close_date' => 'nullable|date',
            'deal_category_id' => 'nullable|exists:deal_categories,id',
            'deal_agent' => 'nullable|exists:deal_agents,id',
            'deal_watcher' => 'nullable|exists:employees,id',

            // company detail (only if has_company_detail)
            'company_name' => 'required_if:has_company_detail,on|string|max:255',
            'website' => 'nullable|string|max:255',
            'mobile' => 'required_if:has_company_detail,on|string|max:20',
            'office_phone_number' => 'nullable|string|max:20',
            'country_id' => 'nullable|exists:countries,id',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            // ✅ Step 2: Find existing Lead
            $lead = Lead::findOrFail($id);

            // ✅ Step 3: Update Lead
            $lead->update([
                'salutation' => $request->salutation,
                'name' => $request->name,
                'email' => $request->email,
                'lead_source_id' => $request->lead_source_id,
                'added_by' => $request->added_by,
                'lead_owner' => $request->lead_owner,
                'auto_convert_lead_to_client' => $request->has('auto_convert_lead_to_client') ? 'yes' : 'no',
            ]);

            // ✅ Step 4: Update or delete company details
            if ($request->has('has_company_detail')) {
                $company = LeadCompanyDetail::firstOrNew(['lead_id' => $lead->id]);
                $company->fill([
                    'name' => $request->company_name,
                    'website' => $request->website,
                    'mobile' => $request->mobile,
                    'office_phone_number' => $request->office_phone_number,
                    'country_id' => $request->country_id,
                    'state' => $request->state,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'address' => $request->address,
                ]);
                $company->save();
            } else {
                // Remove company detail if unchecked
                LeadCompanyDetail::where('lead_id', $lead->id)->delete();
            }

            $deal = Deal::firstOrNew(['lead_id' => $lead->id]);
            $deal->fill([
                'name' => $request->deal_name,
                'pipe_line_id' => $request->pipe_line_id,
                'deal_stage_id' => $request->deal_stage_id,
                'currency_id' => $deal->currency_id ?? 1,
                'deal_value' => $request->deal_value,
                'close_date' => $request->close_date,
                'deal_category_id' => $request->deal_category_id,
                'deal_agent_id' => $request->deal_agent ?? auth()->id(),
                'deal_watcher_id' => $request->deal_watcher,
            ]);

            $deal->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lead updated successfully',
                'data' => $lead->fresh(['companyDetail', 'deal']),
            ], 200);

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Lead update failed: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while updating the lead.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(string $id)
    {
        $lead = Lead::with('leadAddedBy', 'leadOwner', 'source', 'deal', 'companyDetail')->findOrFail($id);

        return response()->json([
            'lead' => $lead,
        ]);
    }

    public function destroy(string $id)
    {
        try {
            $lead = Lead::findOrFail($id);
            $lead->deal()->delete();
            $lead->companyDetail()->delete();
            $lead->delete();
        } catch (Exception $e) {
            Log::error('Error while deleting lead: '.$e->getMessage());

            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function updateDealStage(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'stage_id' => 'nullable|exists:deal_stages,id',
        ]);

        $lead = Lead::findOrFail($request->lead_id);

        if ($lead->deal) {
            $lead->deal->deal_stage_id = $request->stage_id;
            $lead->deal->save();
        } else {
            // If no deal exists yet, you can optionally create one
            $lead->deal()->create([
                'deal_stage_id' => $request->stage_id,
            ]);
        }

        return response()->json(['message' => 'Deal stage updated successfully.']);
    }

    public function addSource(Request $request)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'name' => 'required',
            ]);

            $deals = LeadSource::create($validated);

            return response()->json([
                'message' => 'Category created successfully.',
                'data' => $deals,
            ], 201);

        }
    }

    public function updateSource(Request $request, $id)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'name' => 'required',
            ]);

            $deals = LeadSource::where('id', $id)->update($validated);

            return response()->json([
                'message' => 'Category updated successfully.',
                'data' => $deals,
            ], 201);
        }
    }

    public function deleteSource(Request $request, $id)
    {
        if ($request->ajax()) {
            $deals = LeadSource::where('id', $id)->delete();

            return response()->json([
                'message' => 'Category deleted successfully.',
                'data' => $deals,
            ], 201);
        }
    }

    public function allSource(Request $request)
    {
        if ($request->ajax()) {
            $source = LeadSource::orderBy('id', 'desc');

            return DataTables::of($source)
                ->addIndexColumn()
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return response()->json([
            'message' => 'No category found',
        ], 201);
    }

    public function storePipline(Request $request)
    {
        try {
            if ($request->ajax()) {
                $validated = $request->validate([
                    'tag_color' => 'required',
                    'name' => 'required',
                ]);

                $leadpipeline = LeadPipline::create($validated);

                return response()->json([
                    'message' => 'Category created successfully.',
                    'data' => $leadpipeline,
                ], 201);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function allLeadPipline()
    {
        try {
            $leadpline = LeadPipline::all();

            return response()->json($leadpline);
        } catch (Exception $e) {
            throw $e;
        }

    }

    public function storeDealStage(Request $request)
    {
        try {
            if ($request->ajax()) {
                $validated = $request->validate([
                    'tag_color' => 'required',
                    'name' => 'required',
                ]);

                $deal_stages = DealStage::create($validated);

                return response()->json([
                    'message' => 'Category created successfully.',
                    'data' => $deal_stages,
                ], 201);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function dealStages(Request $request)
    {
        try {

            $pipelineId = $request->pipeline_id;

            $deal_stages = DealStage::where('lead_pipline_id', $pipelineId)->get();

            return response()->json($deal_stages);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateDefaultStage(Request $request)
    {
        try {
            $request->validate([
                'stage_id' => 'required|integer',
                'pipline_id' => 'required|integer',
            ]);

            // Reset old defaults in this pipeline
            DealStage::where('lead_pipline_id', $request->pipline_id)
                ->update(['is_default' => 'no']);

            // Set new default
            DealStage::where('id', $request->stage_id)
                ->update(['is_default' => 'yes']);

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateDefaultPipline(Request $request)
    {
        try {
            $request->validate([
                'pipeline_id' => 'required|integer',
            ]);

            // Reset old defaults in this pipeline
            LeadPipline::where('id', '!=', $request->pipeline_id)
                ->update(['is_default' => 'no']);

            // Set new default
            LeadPipline::where('id', $request->pipeline_id)
                ->update(['is_default' => 'yes']);

            return response()->json(['success' => true]);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateStage(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tag_color' => 'nullable|string|max:20',
        ]);

        $stage = DealStage::findOrFail($id);
        $stage->update($validated);

        return response()->json(['message' => 'Stage updated successfully']);
    }

    public function deleteDealStage(string $id)
    {
        $deal_stage = DealStage::findOrFail($id);

        $deal_stage->delete();

        return response()->json([
            'message' => 'Deal Stage deleted successfully.',
        ]);
    }
}
