@extends('layouts.app')

@section('title', 'Order #'.$order->id)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-start mb-6">
                    <h1 class="text-2xl font-bold">Order #{{ $order->id }}</h1>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                           ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="grid md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h2 class="text-lg font-medium mb-4">Customer Information</h2>
                        <div class="space-y-2">
                            <p><strong>Name:</strong> {{ $order->user->name }}</p>
                            <p><strong>Email:</strong> {{ $order->user->email }}</p>
                            <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y \a\t g:i a') }}</p>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-lg font-medium mb-4">Order Summary</h2>
                        <div class="space-y-2">
                            <p><strong>Subtotal:</strong> ${{ number_format($order->total, 2) }}</p>
                            <p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
                            <p><strong>Transaction ID:</strong> {{ $order->transaction_id ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-lg font-medium mb-4">Order Items</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded" src="{{ asset('storage/'.$item->book->cover_image) }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->book->title }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($item->price, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($item->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('orders.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Back to Orders
                    </a>
                    @if($order->status === 'pending')
                        <form action="{{ route('orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                Mark as Completed
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection