<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        
        return inertia('Orders/Index');
    }

    public function create(Request $request)
    {
        return inertia('Orders/Create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'array|min:1',
            'items.*.product_id' => 'required|numeric|min:1',
            'items.*.quantity' => 'required|numeric|min:1',
        ]);
        
        // store sell order via API
        // dd($request->all());

        request()->session()->flash('flash.banner', 'Se ha creado la orden correctamente');
        request()->session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('orders.index');
    }
}
