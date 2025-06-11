<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function edit(OrderItem $orderItem)
    {
        return view('order_items.edit', compact('orderItem'));
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $orderItem->update([
            'price' => $request->price
        ]);

        return redirect()->route('orders.show', $orderItem->order_id)
            ->with('success', 'Order item updated successfully');
    }
}