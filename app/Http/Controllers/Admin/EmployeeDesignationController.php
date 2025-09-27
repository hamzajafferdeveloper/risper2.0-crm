<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeDesignation;
use Illuminate\Http\Request;

class EmployeeDesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:employee_designations,id',
        ]);

        $employee_designation = EmployeeDesignation::create($validated);

        return response()->json([
            'message' => 'Employee Designation created successfully.',
            'data' => $employee_designation,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee_designation = EmployeeDesignation::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:employee_designations,id|not_in:' . $employee_designation->id,
        ]);

        $employee_designation->update($validated);

        return response()->json([
            'message' => 'Employee Designation updated successfully.',
            'data' => $employee_designation,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee_designation = EmployeeDesignation::findOrFail($id);

        $employee_designation->delete();

        return response()->json([
            'message' => 'Employee Designation deleted successfully'
        ], 200);
    }
}
