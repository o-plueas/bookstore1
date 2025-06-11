<?php

namespace App\Http\Controllers;

use App\Models\MarketingCampaign;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this
use App\Models\User; // Add this
use App\Models\SellerProfile; // Add this


class MarketingCampaignController extends Controller
{
    public function index()
    {
        
        
        $user = Auth::user();
        $campaigns = \App\Models\User::find(Auth::id())
               ->marketingCampaigns()
               ->with('book')
               ->paginate(10);

        // $campaigns =$user->marketingCampaigns()->with('book')->paginate(10);
        // return view('marketing.index', compact('campaigns'));

        
    }

    public function create()
    {
                $user = Auth::user();

        $books = $user->books;
        return view('marketing.create', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'name' => 'required',
            'budget' => 'required|numeric|min:1'
        ]);                $user = Auth::user();


        $user->marketingCampaigns()->create($validated);

        return redirect()->route('marketing.index')
            ->with('success', 'Campaign created successfully');
    }

    public function edit(MarketingCampaign $campaign)
    {                $user = Auth::user();

        $books = $user->books;
        return view('marketing.edit', compact('campaign', 'books'));
    }

    public function update(Request $request, MarketingCampaign $campaign)
    {
        $campaign->update($request->validate([
            'status' => 'required|in:active,paused,completed',
            'budget' => 'sometimes|numeric|min:1'
        ]));

        return redirect()->route('marketing.index')
            ->with('success', 'Campaign updated successfully');
    }
}