<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Tenant;
use App\Models\Unit;
use App\Http\Requests\LeaseRequest;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index(Request $request)
    {
        $leases = Lease::with(['unit.property', 'tenant'])
            ->when(
                $request->query('tenant_id'),
                fn($query, $tenantId) => $query->where('tenant_id', $tenantId)
            )
            ->when(
                $request->query('unit_id'),
                fn($query, $unitId) => $query->where('unit_id', $unitId)
            )
            ->get();
        $tenants = Tenant::all();
        $units = Unit::with('property')->get();

        return view('leases.index', compact('leases', 'tenants', 'units'));
    }

    public function create()
    {
        $tenants = Tenant::all();
        $units = Unit::with('property')->get();
        return view('leases.create', compact('tenants', 'units'));
    }

    public function store(LeaseRequest $request)
    {
        Lease::create($request->validated());

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

    public function update(LeaseRequest $request, Lease $lease)
    {
        $lease->update($request->validated());

        return redirect()->route('leases.index')->with('success', 'Umowa zaktualizowana.');
    }

    public function destroy(Lease $lease)
    {
        $lease->delete();

        return redirect()->route('leases.index')->with('success', 'Umowa usunięta.');
    }
}
