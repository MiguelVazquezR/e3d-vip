<?php

namespace App\Http\Controllers;

use App\Http\Resources\SellOrderResource;
use App\Models\SellOrder;
use App\Models\SellOrderedProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');

        $sell_orders = SellOrderResource::collection(auth()->user()->sellOrders()
            ->filter($filters)
            ->latest('id')
            ->paginate());

        return inertia('Orders/Index', compact('sell_orders', 'filters'));
    }

    public function create(Request $request)
    {
        return inertia('Orders/Create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'requirement_date' => 'required|date|after:'.now()->addDays(6)->toDateString(),
            'notes' => 'max:200',
            'freight_cost' => 'numeric|max:100000',
            'items' => 'array|min:1',
            'items.*.product_id' => 'required|numeric|min:1',
            'items.*.quantity' => 'required|numeric|min:1',
        ]);

        $validated['user_id'] = auth()->id();
        
        $sell_order = SellOrder::create($validated);

        foreach($request->items as $item) {
            SellOrderedProduct::create($item + ['sell_order_id' => $sell_order->id]);
        }

        $sell_order->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection('oce'));

        request()->session()->flash('flash.banner', 'Se ha creado la orden correctamente');
        request()->session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('orders.index');
    }
}
