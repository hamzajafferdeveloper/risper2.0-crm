<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealAgent;
use App\Models\DealCategory;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;
use Yajra\DataTables\DataTables;

class DealController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $deals = Deal::with(['lead', 'dealAgent', 'dealWatcher', 'dealStage'])->get();

            return DataTables::of($deals)
                ->addIndexColumn()
                ->addColumn('lead_name', fn ($row) => $row->lead?->name ?? '-')
                ->addColumn('lead_email', fn ($row) => $row->lead?->email ?? '-')
                ->addColumn('deal_agent_name', fn ($row) => $row->dealAgent?->aggentEmployee?->name ?? '-')
                ->addColumn('deal_watcher_name', fn ($row) => $row->dealWatcher?->name ?? '-')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.deals.index');
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate input
        $validator = Validator::make($request->all(), [
            'lead_id' => 'required|exists:leads,id',
            'name' => 'required|string|max:255',
            'pipe_line_id' => 'required|exists:lead_piplines,id',
            'deal_stage_id' => 'required|exists:deal_stages,id',
            'deal_value' => 'required|numeric|min:0',
            'close_date' => 'required|date',
            'deal_category_id' => 'required|exists:deal_categories,id',
            'deal_agent' => 'nullable|exists:deal_agents,id',
            'deal_watcher_id' => 'nullable|exists:employees,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            Deal::create([
                'lead_id' => $request->lead_id,
                'name' => $request->name,
                'pipe_line_id' => $request->pipe_line_id,
                'deal_stage_id' => $request->deal_stage_id,
                'currency_id' => 1, // default currency
                'deal_value' => $request->deal_value,
                'close_date' => $request->close_date,
                'deal_category_id' => $request->deal_category_id,
                'deal_agent_id' => $request->deal_agent ?? auth()->id(),
                'deal_watcher_id' => $request->deal_watcher_id,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Deal created successfully.',
            ], 201);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function addCategory(Request $request)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'name' => 'required',
            ]);

            $deals = DealCategory::create($validated);

            return response()->json([
                'message' => 'Category created successfully.',
                'data' => $deals,
            ], 201);

        }
    }

    public function updateCategory(Request $request, $id)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'name' => 'required',
            ]);

            $deals = DealCategory::where('id', $id)->update($validated);

            return response()->json([
                'message' => 'Category updated successfully.',
                'data' => $deals,
            ], 201);
        }
    }

    public function deleteCategory(Request $request, $id)
    {
        if ($request->ajax()) {
            $deals = DealCategory::where('id', $id)->delete();

            return response()->json([
                'message' => 'Category deleted successfully.',
                'data' => $deals,
            ], 201);
        }
    }

    public function allCategory(Request $request)
    {
        if ($request->ajax()) {
            $category = DealCategory::all();

            return DataTables::of($category)
                ->addIndexColumn()
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return response()->json([
            'message' => 'No category found',
        ], 201);
    }

    public function dealAgents(Request $request)
    {
        if ($request->ajax()) {
            $Agent = DealAgent::with('aggentEmployee', 'category')->get();

            return DataTables::of($Agent)
                ->addIndexColumn()
                ->addColumn('employee_name', fn ($row) => $row->aggentEmployee?->name ?? '-')
                ->addColumn('employee_email', fn ($row) => $row->aggentEmployee?->email ?? '-')
                ->rawColumns(['status', 'action'])
                ->make(true);

        }
    }

    public function storeDealAgent(Request $request)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'aggent' => 'required|exists:employees,id',
                'deal_category_id' => 'required|exists:deal_categories,id',
            ]);

            $deals = DealAgent::create($validated);

            return response()->json([
                'message' => 'Category created successfully.',
                'data' => $deals,
            ], 201);
        }
    }
}
