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
            $leads = Lead::with('leadOwner', 'leadAddedBy');

            return DataTables::of($leads)
                ->addIndexColumn()
                ->addColumn('lead_added_by_name', function ($row) {
                    return $row->leadAddedBy?->name ?? '-';
                })
                ->addColumn('lead_owner_name', function ($row) {
                    return $row->leadOwner?->name ?? '-';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 focus:!bg-[#8D35E3]/80 active:!bg-[#8D35E3]/80 dark:!bg-[#8D35E3]/80 dark:hover:!bg-[#8D35E3]/80 dark:focus:!bg-[#8D35E3]/80 dark:active:!bg-[#8D35E3]/80 text-white p-2 rounded editEmployee"
                                data-id="' . $row->id . '" title="Edit">
                            <iconify-icon icon="mdi:pencil" class="text-lg"></iconify-icon>
                        </button>

                        <button data-id="' . $row->id . '" class="btn btn-sm !bg-red-500 hover:!bg-red-500/80 focus:!bg-red-500/80 active:!bg-red-500/80 dark:!bg-red-500/80 dark:hover:!bg-red-500/80 dark:focus:!bg-red-500/80 dark:active:!bg-red-500/80 text-white p-2 rounded deleteEmployee" title="Delete">
                            <iconify-icon icon="mage:trash" class="text-lg"></iconify-icon>
                        </button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

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

            // ✅ Step 4: Add deal if needed
            if ($request->has('has_deal')) {
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
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lead created successfully',
                'data' => $lead,
            ], 201);

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Lead creation failed: ' . $e->getMessage(), [
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
