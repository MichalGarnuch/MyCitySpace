<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::all();
        return view('amenities.index', compact('amenities'));
    }

    public function create()
    {
        return view('amenities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Amenity::create($validated);

        return redirect()->route('amenities.index')->with('success', 'Udogodnienie dodane.');
    }

    public function show(Amenity $amenity)
    {
        return view('amenities.show', compact('amenity'));
    }

    public function edit(Amenity $amenity)
    {
        return view('amenities.edit', compact('amenity'));
    }

    public function update(Request $request, Amenity $amenity)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $amenity->update($validated);

        return redirect()->route('amenities.index')->with('success', 'Udogodnienie zaktualizowane.');
    }

    public function destroy(Amenity $amenity)
    {
        $amenity->delete();

        return redirect()->route('amenities.index')->with('success', 'Udogodnienie usunięte.');
    }
}
