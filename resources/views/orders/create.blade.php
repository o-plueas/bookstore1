@extends('layouts.app')

@section('title', 'Create New Order')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-6">Create New Order</h1>

                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <!-- Customer Selection -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                            <select id="user_id" name="user_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Order Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="mb-8">
                        <h2 class="text-lg font-medium mb-4">Order Items</h2>
                        <div id="order-items-container">
                            <div class="order-item grid md:grid-cols-4 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Book</label>
                                    <select name="items[0][book_id]" class="w-full rounded-md border-gray-300 shadow-sm">
                                        @foreach($books as $book)
                                            <option value="{{ $book->id }}" data-price="{{ $book->price }}">
                                                {{ $book->title }} (${{ number_format($book->price, 2) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                    <input type="number" name="items[0][price]" class="price-input w-full rounded-md border-gray-300 shadow-sm" step="0.01" min="0">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                    <input type="number" name="items[0][quantity]" value="1" min="1" class="w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div class="flex items-end">
                                    <button type="button" class="remove-item px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">
                                        Remove
                                    </button>
                                </div>
                            </div>
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
                                    <option value="credit_card">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                            </div>
                            <div>
                                <label for="transaction_id" class="block text-sm font-medium text-gray-700 mb-1">Transaction ID</label>
                                <input type="text" id="transaction_id" name="transaction_id" class="w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('orders.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Create Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add new item
        document.getElementById('add-item').addEventListener('click', function() {
            const container = document.getElementById('order-items-container');
            const itemCount = document.querySelectorAll('.order-item').length;
            const newItem = document.querySelector('.order-item').cloneNode(true);
            
            // Update indexes
            newItem.innerHTML = newItem.innerHTML.replace(/items\[0\]/g, `items[${itemCount}]`);
            
            // Reset values
            const inputs = newItem.querySelectorAll('input');
            inputs.forEach(input => {
                if (input.type === 'number') input.value = input.name.includes('quantity') ? 1 : '';
            });
            
            container.appendChild(newItem);
        });

        // Remove item
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                if (document.querySelectorAll('.order-item').length > 1) {
                    e.target.closest('.order-item').remove();
                }
            }
        });

        // Auto-fill price when book is selected
        document.addEventListener('change', function(e) {
            if (e.target.name && e.target.name.includes('book_id')) {
                const selectedOption = e.target.options[e.target.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                const priceInput = e.target.closest('.order-item').querySelector('.price-input');
                if (priceInput) {
                    priceInput.value = price;
                }
            }
        });
    });
</script>
@endsection