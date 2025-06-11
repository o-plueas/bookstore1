@extends('layouts.app')

@section('title', 'Edit Order #'.$order->id)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-6">Edit Order #{{ $order->id }}</h1>

                <form method="POST" action="{{ route('orders.update', $order) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <!-- Customer Selection -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                            <select id="user_id" name="user_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Order Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="mb-8">
                        <h2 class="text-lg font-medium mb-4">Order Items</h2>
                        <div id="order-items-container">
                            @foreach($order->items as $index => $item)
                            <div class="order-item grid md:grid-cols-4 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Book</label>
                                    <select name="items[{{ $index }}][book_id]" class="w-full rounded-md border-gray-300 shadow-sm">
                                        @foreach($books as $book)
                                            <option value="{{ $book->id }}" data-price="{{ $book->price }}" 
                                                {{ $item->book_id == $book->id ? 'selected' : '' }}>
                                                {{ $book->title }} (${{ number_format($book->price, 2) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                    <input type="number" name="items[{{ $index }}][price]" value="{{ $item->price }}" 
                                        class="price-input w-full rounded-md border-gray-300 shadow-sm" step="0.01" min="0">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                    <input type="number" name="items[{{ $index }}][quantity]" value="{{ $item->quantity }}" min="1" 
                                        class="w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div class="flex items-end">
                                    @if($index > 0)
                                    <button type="button" class="remove-item px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">
                                        Remove
                                    </button>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-item" class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-sm">
                            + Add Another Item
                        </button>
                    </div>

                    <!-- Payment Information -->
                    <div class="mb-6">
                        <h2 class="text-lg font-medium mb-4">Payment Information</h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                                <select id="payment_method" name="payment_method" class="w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="credit_card" {{ $order->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="paypal" {{ $order->payment_method == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="bank_transfer" {{ $order->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                </select>
                            </div>
                            <div>
                                <label for="transaction_id" class="block text-sm font-medium text-gray-700 mb-1">Transaction ID</label>
                                <input type="text" id="transaction_id" name="transaction_id" value="{{ $order->transaction_id }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('orders.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="px