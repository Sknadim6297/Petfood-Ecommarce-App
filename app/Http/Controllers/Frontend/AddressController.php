<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display user addresses
     */
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->latest()->get();
        return response()->json([
            'success' => true,
            'addresses' => $addresses
        ]);
    }

    /**
     * Store a new address
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'postal_code' => 'required|string|max:10',
                'country' => 'required|string|max:100',
                'type' => 'required|in:shipping,billing',
                'is_default' => 'boolean'
            ]);

            // If setting as default, remove default from other addresses
            if ($request->is_default) {
                Address::where('user_id', Auth::id())
                       ->where('type', $request->type)
                       ->update(['is_default' => false]);
            }

            $address = Address::create(array_merge($request->all(), ['user_id' => Auth::id()]));

            return response()->json([
                'success' => true,
                'message' => 'Address added successfully',
                'address' => $address
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create address. Please try again.'
            ], 500);
        }
    }

    /**
     * Update an address
     */
    public function update(Request $request, Address $address)
    {
        // Check if address belongs to authenticated user
        if ($address->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:100',
            'type' => 'required|in:shipping,billing',
            'is_default' => 'boolean'
        ]);

        // If setting as default, remove default from other addresses
        if ($request->is_default) {
            Address::where('user_id', Auth::id())
                   ->where('type', $request->type)
                   ->where('id', '!=', $address->id)
                   ->update(['is_default' => false]);
        }

        $address->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Address updated successfully',
            'address' => $address
        ]);
    }

    /**
     * Delete an address
     */
    public function destroy(Address $address)
    {
        // Check if address belongs to authenticated user
        if ($address->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully'
        ]);
    }

    /**
     * Set address as default
     */
    public function setDefault(Request $request, Address $address)
    {
        // Check if address belongs to authenticated user
        if ($address->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Remove default from other addresses of same type
        Address::where('user_id', Auth::id())
               ->where('type', $address->type)
               ->update(['is_default' => false]);

        // Set this address as default
        $address->update(['is_default' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Default address updated successfully'
        ]);
    }
}
