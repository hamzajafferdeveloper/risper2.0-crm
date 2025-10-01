<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DealStage;
use App\Models\Lead;
use App\Models\LeadPipline;
use App\Models\LeadSource;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $leads = Lead::with('leadOwner');

            return DataTables::of($leads)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 focus:!bg-[#8D35E3]/80 active:!bg-[#8D35E3]/80 dark:!bg-[#8D35E3]/80 dark:hover:!bg-[#8D35E3]/80 dark:focus:!bg-[#8D35E3]/80 dark:active:!bg-[#8D35E3]/80 text-white p-2 rounded editEmployee"
                                data-id="'.$row->id.'" title="Edit">
                            <iconify-icon icon="mdi:pencil" class="text-lg"></iconify-icon>
                        </button>

                        <button data-id="'.$row->id.'" class="btn btn-sm !bg-red-500 hover:!bg-red-500/80 focus:!bg-red-500/80 active:!bg-red-500/80 dark:!bg-red-500/80 dark:hover:!bg-red-500/80 dark:focus:!bg-red-500/80 dark:active:!bg-red-500/80 text-white p-2 rounded deleteEmployee" title="Delete">
                            <iconify-icon icon="mage:trash" class="text-lg"></iconify-icon>
                        </button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.leads.index');
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

    public function allSource(Request $request)
    {
        if ($request->ajax()) {
            $source = LeadSource::all();

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
                    'lead_pipline_id' => 'required|exists:lead_piplines,id',
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
}
