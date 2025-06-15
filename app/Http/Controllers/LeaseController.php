<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Tenant;
use App\Models\Unit;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index()
    {
        $leases = Lease::with(['unit.property', 'tenant'])->get();
        return view('leases.index', compact('leases'));
    }

    public function create()
    {
        $tenants = Tenant::all();
        $units = Unit::with('property')->get();
        return view('leases.create', compact('tenants', 'units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id'  => 'required|exists:tenants,id',
            'unit_id'    => 'required|exists:units,id',
            'start_date' => 'required|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'rent'       => 'required|numeric|min:0',
        ]);

        Lease::create($validated);

        return redirect()->route('leases.index')->with('success', 'Umowa dodana.');
    }

    public function show(Lease $lease)
    {
        return view('leases.show', compact('lease'));
    }

    public function edit(Lease $lease)
    {
        $tenants = Tenant::all();
        $units = Unit::with('property')->get();
        return view('leases.edit', compact('lease', 'tenants', 'units'));
    }

    public function update(Request $request, Lease $lease)
    {
        $validated = $request->validate([
            'tenant_id'  => 'required|exists:tenants,id',
            'unit_id'    => 'required|exists:units,id',
            'start_date' => 'required|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'rent'       => 'required|numeric|min:0',
        ]);

        $lease->update($validated);

        return redirect()->route('leases.index')->with('success', 'Umowa zaktualizowana.');
    }

    public function destroy(Lease $lease)
    {
        $lease->delete();

        return redirect()->route('leases.index')->with('success', 'Umowa usunięta.');
    }
}
