<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this
use App\Models\User; // Add this
use App\Models\SellerProfile; // Add this

class SellerProfileController extends Controller
{
    public function edit()

    {
        $user = Auth::user();

        $profile = $user->sellerProfile ?? new \App\Models\SellerProfile();
        return view('seller.profile', compact('profile'));
    }

    public function update(Request $request)
    {

        // More robust validation
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'facebook_page' => 'nullable|url',
            'website' => 'nullable|url',
            'bank_account' => 'required|string|max:50',
            'tax_id' => 'required|string|max:50'
        ]);



        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->sellerProfile()->updateOrCreate(
            ['user_id' => $user->id], // Use $user->id instead of auth()->id()
            $validated

        );




        return redirect()->route('seller.dashboard')
            ->with('success', 'Profile updated successfully');
    }
}
