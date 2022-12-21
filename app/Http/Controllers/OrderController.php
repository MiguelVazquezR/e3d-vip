<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
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
            ->with('sellOrderedProducts')
            ->filter($filters)
            ->latest('id')
            ->paginate());

            // return $sell_orders;

        return inertia('Orders/Index', compact('sell_orders', 'filters'));
    }

    public function create()
    {
        return inertia('Orders/Create');
    }

    public function edit($order_id)
    {
        $order = SellOrder::with('sellOrderedProducts')->find($order_id);
        $media = $order->getMedia('oce')->all();
        // return $order;
        return inertia('Orders/Edit', compact('order', 'media'));
    }
    
    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated() + ['user_id' => auth()->id()];
        
        $sell_order = SellOrder::create($validated);

        foreach($request->items as $item) {
            SellOrderedProduct::create($item + ['sell_order_id' => $sell_order->id]);
        }

        $sell_order->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection('oce'));

        request()->session()->flash('flash.banner', 'Se ha creado la orden correctamente');
        request()->session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('orders.index');
    }

    public function update(UpdateOrderRequest $request, SellOrder $order)
    {
        $order->update($request->validated());

        return redirect()->route('orders.index')->with('message', 'Se ha actualizado la orden correctamente');
    }

    public function updateWithResources(UpdateOrderRequest $request, SellOrder $order)
    {
        $order->update($request->validated());
        $order->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection());

        return redirect()->route('orders.index')->with('message', 'Se ha actualizado la orden correctamente'); 
    }

    public function destroy(SellOrder $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('message', 'Se ha eliminado la orden correctamente');
    }

    public function deleteFile(Request $request)
    {
        SellOrder::find($request->order_id)->deleteMedia($request->file_id);

        return response()->json(['success' => 'success'], 200);
    }
}
