@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-4">Welcome to Your Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Stats Cards -->
        <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="font-semibold text-blue-800">Total Books</h3>
            <p class="text-3xl font-bold">42</p>
        </div>
        <div class="bg-green-50 p-4 rounded-lg">
            <h3 class="font-semibold text-green-800">Total Sales</h3>
            <p class="text-3xl font-bold">$1,234</p>
        </div>
        <div class="bg-purple-50 p-4 rounded-lg">
            <h3 class="font-semibold text-purple-800">Active Campaigns</h3>
            <p class="text-3xl font-bold">3</p>
        </div>
    </div>
</div>
@endsection