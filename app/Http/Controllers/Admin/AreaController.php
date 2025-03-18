<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    // Display a listing of areas
    public function index(Request $request)
    {
        $areas = Area::paginate(10); // Adjust the per-page count as needed

        $cities = City::all();

        return view('admin.areas.index', compact('areas', 'cities')); // Ensure this view exists
    }

    // Store a newly created Area in storage
    public function store(AreaRequest $request)
    {
        Area::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'city_id' => $request->city_id,
        ]);

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area created successfully.');
    }

    // Show the form for editing the specified Area
    public function edit(Request $request, Area $area)
    {
        return view('admin.areas.edit', compact('Area')); // Ensure this view exists
    }

    // Update the specified Area in storage
    public function update(AreaRequest $request, Area $area)
    {
        $area->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'city_id' => $request->city_id,
        ]);

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area updated successfully.');
    }

    // Remove the specified Area from storage
    public function destroy(Request $request, Area $area)
    {
        $area->delete();

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area deleted successfully.');
    }
}
