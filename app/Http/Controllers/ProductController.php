<?php

namespace App\Http\Controllers;

use App\Models\ProductQuotation;
use App\Models\Quotation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Products/Index');
    }

    public function requestNew(Request $request)
    {
        return $request->all();
    }

    public function quote(Request $request)
    {
        $request->validate([
            'products.*.product_id' => 'required|numeric|min:1',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.notes' => 'max:500',
        ]);

        $quotation = Quotation::create(['user_id' => auth()->id()]);
        foreach ($request->products as $product) {
            ProductQuotation::create($product + ['quotation_id' => $quotation->id]);
        }

        request()->session()->flash('flash.banner', 'Se ha enviado la solicitud de cotización, la generaremos lo más pronto posible. Revisa el status en el módulo de cotizaciones');
        request()->session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('quotations.index');
    }
}
