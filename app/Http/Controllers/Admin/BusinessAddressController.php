<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessAddress;
use Illuminate\Http\Request;

class BusinessAddressController extends Controller
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
            'country_id' => 'nullable|exists:countries,id',
            'location' => 'required|string|max:255',
            'tax_name' => 'nullable|string|max:255',
            'tax_number' => 'nullable|string|max:255',
            'address' => 'required|string|max:500',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
        ]);

        $business_address = BusinessAddress::create($validated);

        return response()->json([
            'message' => 'Business address created successfully.',
            'data' => $business_address,
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
        $business_address = BusinessAddress::findOrFail($id);

        $validated = $request->validate([
            'country_id' => 'nullable|exists:countries,id',
            'location' => 'required|string|max:255',
            'tax_name' => 'nullable|string|max:255',
            'tax_number' => 'nullable|string|max:255',
            'address' => 'required|string|max:500',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
        ]);

        $business_address->update($validated);

        return response()->json([
            'message' => 'Business address updated successfully.',
            'data' => $business_address,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $business_address = BusinessAddress::findOrFail($id);

        $business_address->delete();

        return response()->json([
            'message' => 'Business address deleted successfully.',
        ], 200);
    }
}
