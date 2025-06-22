<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Umowy najmu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <form method="GET" class="flex space-x-2">
                    <select name="tenant_id" class="border-gray-300 rounded-md">
                        <option value="">{{ __('Wszyscy najemcy') }}</option>
                        @foreach($tenants as $tenantOption)
                            <option value="{{ $tenantOption->id }}" @selected(request('tenant_id') == $tenantOption->id)>
                                {{ $tenantOption->first_name }} {{ $tenantOption->last_name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="unit_id" class="border-gray-300 rounded-md">
                        <option value="">{{ __('Wszystkie lokale') }}</option>
                        @foreach($units as $unitOption)
                            <option value="{{ $unitOption->id }}" @selected(request('unit_id') == $unitOption->id)>
                                {{ $unitOption->property->name }} / {{ $unitOption->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-primary-button>{{ __('Szukaj') }}</x-primary-button>
                </form>
                <x-primary-button-link :href="route('leases.create')">
                    {{ __('Nowa umowa') }}
                </x-primary-button-link>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Najemca</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Od</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Do</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Czynsz</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($leases as $lease)
                        <tr>
                            <td class="px-6 py-4">{{ $lease->id }}</td>
                            <td class="px-6 py-4">{{ $lease->unit->property->name }} / {{ $lease->unit->name }}</td>
                            <td class="px-6 py-4">{{ $lease->tenant->first_name }} {{ $lease->tenant->last_name }}</td>
                            <td class="px-6 py-4">{{ $lease->start_date }}</td>
                            <td class="px-6 py-4">{{ $lease->end_date }}</td>
                            <td class="px-6 py-4">{{ number_format($lease->rent, 2) }} PLN</td>
                            <td class="px-6 py-4 text-right">
                                <x-link-button :href="route('leases.show', $lease)" class="mr-2">{{ __('Pokaż') }}</x-link-button>
                                <x-link-button :href="route('leases.edit', $lease)" class="mr-2">{{ __('Edytuj') }}</x-link-button>
                                <form action="{{ route('leases.destroy', $lease) }}" method="POST" class="inline" onsubmit="return confirm('Na pewno usunąć umowę?');">
                                    @csrf @method('DELETE')
                                    <x-danger-button>{{ __('Usuń') }}</x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
