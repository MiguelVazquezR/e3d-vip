<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuotationResource;
use App\Models\ProductQuotation;
use App\Models\Quotation;
use App\Models\SellOrder;
use App\Models\SellOrderedProduct;
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

        // return $quotation;

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

        return to_route('quotations.index');
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        request()->session()->flash('flash.banner', 'Se ha eliminado la cotización');
        request()->session()->flash('flash.bannerStyle', 'success');

        return to_route('quotations.index');
    }

    public function approve(Request $request)
    {
        $request->validate(['requirement_date' => 'required|date|after:'.now()->addDays(6)->toDateString()]);

        $quotation = Quotation::find($request->quotation_id);

        // mark quotation as approved
        $quotation->update(['status' => Quotation::STATUS_APPROVED]);

        // create new order from qoutation
        $sell_order = SellOrder::create([
            'freight_cost' => $quotation->freight_cost,
            'notes' => "Orden creada mediante cotización " . 'VIPC-' . str_pad($quotation->id, 4, "0", STR_PAD_LEFT),
            'user_id' => $quotation->user_id,
            'requirement_date' => $request->requirement_date,
        ]);

        foreach ($quotation->products as $item) {
            SellOrderedProduct::create([
                'quantity' => $item->quantity,
                'product_id' => $item->product_id,
                'sell_order_id' => $sell_order->id,
            ]);
        }

        // notify admins

        // redirect to orders table
        request()->session()->flash('flash.banner', 'Se ha creado la orden desde la cotización');
        request()->session()->flash('flash.bannerStyle', 'success');

        return to_route('orders.index');
    }
}
