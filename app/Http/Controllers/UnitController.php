<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Property $property)
    {
        $units = $property->units;
        return view('units.index', compact('property', 'units'));
    }

    public function create(Property $property)
    {
        return view('units.create', compact('property'));
    }

    public function store(Request $request, Property $property)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:free,occupied',
        ]);

        $property->units()->create($validated);

        return redirect()->route('properties.units.index', $property)->with('success', 'Lokal dodany.');
    }

    public function show(Property $property, Unit $unit)
    {
        return view('units.show', compact('property', 'unit'));
    }

    public function edit(Property $property, Unit $unit)
    {
        return view('units.edit', compact('property', 'unit'));
    }

    public function update(Request $request, Property $property, Unit $unit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:free,occupied',
        ]);

        $unit->update($validated);

        return redirect()->route('properties.units.index', $property)->with('success', 'Lokal zaktualizowany.');
    }

    public function destroy(Property $property, Unit $unit)
    {
        $unit->delete();

        return redirect()->route('properties.units.index', $property)->with('success', 'Lokal usunięty.');
    }
}
