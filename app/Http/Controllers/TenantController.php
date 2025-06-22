<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index(Request $request)
    {
        $tenants = Tenant::query()
            ->when(
                $request->query('last_name'),
                fn($query, $last) => $query->where('last_name', 'like', "%$last%")
            )
            ->when(
                $request->query('email'),
                fn($query, $email) => $query->where('email', 'like', "%$email%")
            )
            ->get();

        return view('tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('tenants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:20',
        ]);

        Tenant::create($validated);

        return redirect()->route('tenants.index')->with('success', 'Lokator dodany.');
    }

    public function show(Tenant $tenant)
    {
        return view('tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:20',
        ]);

        $tenant->update($validated);

        return redirect()->route('tenants.index')->with('success', 'Dane lokatora zaktualizowane.');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return redirect()->route('tenants.index')->with('success', 'Lokator usunięty.');
    }
}
