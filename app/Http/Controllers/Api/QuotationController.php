<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index()
    {
        $quotation = Quotation::filter()->get();

        return $quotation;
    }

    public function store(Request $request)
    {
        //
    }

    public function show($quotation_id)
    {
        $quotation = Quotation::included()->findOrFail($quotation_id);

        return $quotation;
    }

    public function update(Request $request, Quotation $quotation)
    {
        $validated = $request->validate([
            'tooling_cost' => 'string|required',
            'first_production_days' => 'string|required',
            'currency' => 'required|string|max:5',
            'seller_id' => 'required|numeric|min:1',
        ]);

        $quotation->update($validated);

        return $quotation;
    }

    public function destroy(Quotation $quotation)
    {
        //
    }
}
