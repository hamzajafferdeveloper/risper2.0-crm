<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
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
            'symbol' => 'required|string|max:10',
            'code' => 'required|string|max:10|unique:currencies,code',
            'is_cryptocurrency' => 'in:yes,no',
            'is_default' => 'in:yes,no',
            'exchange_rate' => 'required|numeric|min:0',
            'currency_position' => 'in:left,right,left_with_space,right_with_space',
            'thousand_separator' => 'required|string|max:2',
            'decimal_separator' => 'required|string|max:2',
            'number_of_decimal' => 'required|integer|min:0|max:10',
        ]);

        $currency = Currency::create($validated);

        return response()->json([
            'message' => 'Currency created successfully.',
            'data' => $currency,
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
        $currency = Currency::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10',
            'code' => 'required|string|max:10|unique:currencies,code,' . $currency->id,
            'is_cryptocurrency' => 'in:yes,no',
            'is_default' => 'in:yes,no',
            'exchange_rate' => 'required|numeric|min:0',
            'currency_position' => 'in:left,right,left_with_space,right_with_space',
            'thousand_separator' => 'required|string|max:2',
            'decimal_separator' => 'required|string|max:2',
            'number_of_decimal' => 'required|integer|min:0|max:10',
        ]);

        $currency->update($validated);

        return response()->json([
            'message' => 'Currency updated successfully.',
            'data' => $currency,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currency = Currency::findOrFail($id);

        $currency->delete();

        return response()->json([
            'message' => 'Currency deleted successfully.',
        ], 200);
    }
}
