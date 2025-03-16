<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    // Display a listing of cities
    public function index(Request $request)
    {
        $cities = City::paginate(10); // Adjust the per-page count as needed
        return view('admin.cities.index', compact('cities')); // Ensure this view exists
    }

    // Store a newly created city in storage
    public function store(CityRequest $request)
    {
        City::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
        ]);

        return redirect()->route('admin.cities.index')
            ->with('success', 'City created successfully.');
    }

    // Show the form for editing the specified city
    public function edit(Request $request, City $city)
    {
        return view('admin.cities.edit', compact('city')); // Ensure this view exists
    }

    // Update the specified city in storage
    public function update(CityRequest $request, City $city)
    {
        $city->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
        ]);

        return redirect()->route('admin.cities.index')
            ->with('success', 'City updated successfully.');
    }

    // Remove the specified city from storage
    public function destroy(Request $request, City $city)
    {
        $city->delete();

        return redirect()->route('admin.cities.index')
            ->with('success', 'City deleted successfully.');
    }
}
