@extends('layouts.app')

@section('title', isset($category) ? 'Edit Category' : 'Create Category')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 bg-gray-100 border-b">
        <h2 class="text-xl font-semibold">{{ isset($category) ? 'Edit' : 'Create' }} Category</h2>
    </div>
    
    <form method="POST" action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" class="p-4">
        @csrf
        @if(isset($category)) @method('PUT') @endif
        
        <div class="mb-4">
            <label for="name" class="block text-gray-700 mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" 
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        
        <div class="mb-4">
            <label for="description" class="block text-gray-700 mb-2">Description</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('description', $category->description ?? '') }}</textarea>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ isset($category) ? 'Update' : 'Create' }} Category
            </button>
        </div>
    </form>
</div>
@endsection