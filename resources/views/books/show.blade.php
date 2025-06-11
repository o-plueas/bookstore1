@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-start mb-6">
                    <h1 class="text-2xl font-bold">{{ $book->title }}</h1>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        {{ $book->featured ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $book->featured ? 'Featured' : 'Regular' }}
                    </span>
                </div>

                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Left Column -->
                    <div class="md:w-1/3">
                        <img src="{{ asset('storage/'.$book->cover_image) }}" alt="{{ $book->title }}" class="w-full rounded-lg shadow">
                        
                        <div class="mt-4">
                            <a href="{{ asset('storage/'.$book->file_path) }}" target="_blank" 
                                class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                <i class="fas fa-download mr-2"></i> Download Book
                            </a>
                        </div>

                        <div class="mt-4 space-y-2">
                            <p><strong>Price:</strong> ${{ number_format($book->price, 2) }}</p>
                            <p><strong>Category:</strong> {{ $book->category->name ?? 'Uncategorized' }}</p>
                            <p><strong>Added by:</strong> {{ $book->seller->name }}</p>
                            <p><strong>Date Added:</strong> {{ $book->created_at->format('M d, Y') }}</p>
                            <p><strong>Downloads:</strong> {{ $book->download_count }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="md:w-2/3">
                        <h2 class="text-lg font-semibold mb-2">Description</h2>
                        <p class="text-gray-700 mb-6">{{ $book->description }}</p>

                        <div class="flex space-x-4 mt-8">
                            <a href="{{ route('books.edit', $book) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                <i class="fas fa-edit mr-2"></i> Edit Book
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" 
                                    onclick="return confirm('Are you sure you want to delete this book?')">
                                    <i class="fas fa-trash mr-2"></i> Delete Book
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection