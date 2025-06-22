<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::query()
            ->when(
                $request->query('name'),
                fn($query, $name) => $query->where('name', 'like', "%$name%")
            )
            ->when(
                $request->query('address'),
                fn($query, $address) => $query->where('address', 'like', "%$address%")
            )
            ->get();

        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        Property::create($validated);

        return redirect()->route('properties.index')->with('success', 'Nieruchomość dodana.');
    }

    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $property->update($validated);

        return redirect()->route('properties.index')->with('success', 'Nieruchomość zaktualizowana.');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Nieruchomość usunięta.');
    }
}
