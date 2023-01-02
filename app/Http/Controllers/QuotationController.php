<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuotationResource;
use App\Models\ProductQuotation;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $quotations = QuotationResource::collection(Quotation::where('user_id', auth()->id())
            ->with('seller', 'user', 'products')
            ->latest()
            ->paginate(15));

        // return $quotations;
        return inertia('Quotations/Index', compact('quotations'));
    }

    public function show(Quotation $quotation)
    {
        if ($quotation->user_id !== auth()->id()) {
            abort(404);
        }

        // add relations to instance
        $quotation = QuotationResource::make(Quotation::with('seller', 'user', 'products')
            ->find($quotation->id));

        return inertia('Quotations/Show', compact('quotation'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'products.*.product_id' => 'required|numeric|min:1',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.notes' => 'max:600',
        ]);

        foreach ($request->products as $product_info) {
            $product = ProductQuotation::find($product_info['id']);
            $product->update($product_info);
        }

        request()->session()->flash('flash.banner', 'Se han guardado los cambios');
        request()->session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('quotations.index');
    }
}
