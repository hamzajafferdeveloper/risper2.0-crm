<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Lead;
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
                ->rawColumns(['status', 'action']) // allow HTML
                ->make(true);
        }

        return view('admin.leads.index');
    }
}
