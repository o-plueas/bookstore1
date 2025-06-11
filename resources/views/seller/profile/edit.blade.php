@extends('layouts.app')

@section('title', 'Seller Profile')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 bg-gray-100 border-b">
        <h2 class="text-xl font-semibold">Seller Profile</h2>
    </div>
    
    <form method="POST" action="{{ route('seller.profile.update') }}" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label for="store_name" class="block text-gray-700 mb-2">Store Name</label>
                <input type="text" name="store_name" id="store_name" value="{{ old('store_name', $profile->store_name ?? '') }}" 
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                @error('store_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="tax_id" class="block text-gray-700 mb-2">Tax ID</label>
                <input type="text" name="tax_id" id="tax_id" value="{{ old('tax_id', $profile->tax_id ?? '') }}" 
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                @error('tax_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="bank_account" class="block text-gray-700 mb-2">Bank Account</label>
                <input type="text" name="bank_account" id="bank_account" value="{{ old('bank_account', $profile->bank_account ?? '') }}" 
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                @error('bank_account') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="facebook_page" class="block text-gray-700 mb-2">Facebook Page</label>
                <input type="url" name="facebook_page" id="facebook_page" value="{{ old('facebook_page', $profile->facebook_page ?? '') }}" 
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
        </div>
        
        <div class="mt-6">
            <label for="bio" class="block text-gray-700 mb-2">Bio</label>
            <textarea name="bio" id="bio" rows="4" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('bio', $profile->bio ?? '') }}</textarea>
        </div>
        
        <div class="mt-6">
            <label for="website" class="block text-gray-700 mb-2">Website</label>
            <input type="url" name="website" id="website" value="{{ old('website', $profile->website ?? '') }}" 
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>
        
        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Update Profile
            </button>
        </div>
    </form>
</div>
@endsection