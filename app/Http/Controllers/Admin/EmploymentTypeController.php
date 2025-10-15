<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmploymentType;
use Illuminate\Http\Request;

class EmploymentTypeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $employment_type = EmploymentType::create($validated);

        return response()->json([
            'message' => 'Employment type created successfully.',
            'data' => $employment_type,
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employeeDesignation = EmploymentType::findOrFail($id);

        return response()->json($employeeDesignation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employment_type = EmploymentType::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $employment_type->update($validated);

        return response()->json([
            'message' => 'Employment type updated successfully.',
            'data' => $employment_type,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employment_type = EmploymentType::findOrFail($id);

        $employment_type->delete();

        return response()->json([
            'message' => 'Employment type deleted successfully.',
        ], 200);

    }
}
