@extends('layouts.app')

@section('title', 'Marketing Campaigns')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 bg-gray-100 border-b flex justify-between items-center">
        <h2 class="text-xl font-semibold">Marketing Campaigns</h2>
        <a href="{{ route('seller.marketing.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>New Campaign
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($campaigns as $campaign)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900">{{ $campaign->name }}</div>
                        <div class="text-sm text-gray-500">ID: {{ $campaign->fb_campaign_id }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded" src="{{ asset('storage/' . $campaign->book->cover_image) }}" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $campaign->book->title }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                           