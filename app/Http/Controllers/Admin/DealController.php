<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealAgent;
use App\Models\DealCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DealController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $leads = Deal::with('leadOwner');

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
                ->rawColumns(['status', 'action']) // allow HTML
                ->make(true);
        }

        return view('admin.leads.index');
    }

    public function addCategory(Request $request){
        if ($request->ajax()) {
            $validated = $request->validate([
                'name'=> 'required',
            ]);

            $deals = DealCategory::create($validated);

            return response()->json([
                'message' => 'Category created successfully.',
                'data' => $deals,
            ], 201);

        }
    }

    public function allCategory(Request $request){
        if ($request->ajax()) {
            $category = DealCategory::all();

            return DataTables::of($category)
                ->addIndexColumn()
                ->rawColumns(['status','action'])
                ->make(true);
        }

        return response()->json([
            'message' => 'No category found',
        ], 201);
    }

    public function storeDealAgent(Request $request){
        if ($request->ajax()) {
            $validated = $request->validate([
                'aggent'=> 'required|exists:employees,id',
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
