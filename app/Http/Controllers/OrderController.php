<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Book;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.book'])->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $books = Book::all();
        return view('orders.create', compact('books'));
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $request->total,
            'status' => 'pending'
        ]);

        foreach ($request->items as $item) {
            $order->items()->create([
                'book_id' => $item['book_id'],
                'price' => Book::find($item['book_id'])->price
            ]);
        }

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $books = Book::all();
        return view('orders.edit', compact('order', 'books'));
    }

    public function update(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }
}