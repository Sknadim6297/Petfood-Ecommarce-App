<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CookedFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CookedFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CookedFood::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->get('category'));
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $cookedFoods = $query->latest()->paginate(10);

        return view('admin.cooked-foods.index', compact('cookedFoods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cooked-foods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:cooked_foods,slug',
            'category' => 'required|in:fish,chicken,meat,egg,other',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($data['name']) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('uploads/cooked-foods', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        CookedFood::create($data);

        return redirect()->route('admin.cooked-foods.index')
                        ->with('success', 'Cooked food item created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CookedFood $cookedFood)
    {
        return view('admin.cooked-foods.show', compact('cookedFood'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CookedFood $cookedFood)
    {
        return view('admin.cooked-foods.edit', compact('cookedFood'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CookedFood $cookedFood)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:cooked_foods,slug,' . $cookedFood->id,
            'category' => 'required|in:fish,chicken,meat,egg,other',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($cookedFood->image) {
                Storage::disk('public')->delete($cookedFood->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($data['name']) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('uploads/cooked-foods', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $cookedFood->update($data);

        return redirect()->route('admin.cooked-foods.index')
                        ->with('success', 'Cooked food item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CookedFood $cookedFood)
    {
        // Delete image if exists
        if ($cookedFood->image) {
            Storage::disk('public')->delete($cookedFood->image);
        }

        $cookedFood->delete();

        return redirect()->route('admin.cooked-foods.index')
                        ->with('success', 'Cooked food item deleted successfully!');
    }

    /**
     * Toggle status of the cooked food
     */
    public function toggleStatus(CookedFood $cookedFood)
    {
        $cookedFood->update([
            'status' => $cookedFood->status === 'active' ? 'inactive' : 'active'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
            'status' => $cookedFood->status
        ]);
    }
}
