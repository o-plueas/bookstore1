@extends('layouts.app')

@section('title', 'Add New Book')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-6">Add New Book</h1>

                <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div>
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                                <select id="category_id" name="category_id" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                                <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} 
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600">Featured Book</span>
                                </label>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                                <textarea id="description" name="description" rows="4" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
                                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-1">Cover Image *</label>
                                <input type="file" id="cover_image" name="cover_image" accept="image/*" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                @error('cover_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="file_path" class="block text-sm font-medium text-gray-700 mb-1">Book File (PDF) *</label>
                                <input type="file" id="file_path" name="file_path" accept=".pdf" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                @error('file_path') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-6">
                        <a href="{{ route('books.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Save Book
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection