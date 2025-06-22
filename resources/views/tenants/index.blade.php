<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista lokatorów') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <form method="GET" class="flex space-x-2">
                    <x-text-input
                        name="last_name"
                        type="text"
                        placeholder="{{ __('Nazwisko') }}"
                        :value="request('last_name')"
                    />
                    <x-text-input
                        name="email"
                        type="text"
                        placeholder="{{ __('E-mail') }}"
                        :value="request('email')"
                    />
                    <x-primary-button>{{ __('Szukaj') }}</x-primary-button>
                </form>
                <x-primary-button-link :href="route('tenants.create')">
                    {{ __('Dodaj lokatora') }}
                </x-primary-button-link>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imię</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nazwisko</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">E-mail</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telefon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Utworzono</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tenants as $tenant)
                        <tr>
                            <td class="px-6 py-4">{{ $tenant->id }}</td>
                            <td class="px-6 py-4">{{ $tenant->first_name }}</td>
                            <td class="px-6 py-4">{{ $tenant->last_name }}</td>
                            <td class="px-6 py-4">{{ $tenant->email }}</td>
                            <td class="px-6 py-4">{{ $tenant->phone }}</td>
                            <td class="px-6 py-4">{{ $tenant->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <x-link-button :href="route('tenants.show', $tenant)">
                                    {{ __('Pokaż') }}
                                </x-link-button>
                                <x-link-button :href="route('tenants.edit', $tenant)">
                                    {{ __('Edytuj') }}
                                </x-link-button>
                                <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" class="inline" onsubmit="return confirm('Na pewno usunąć tego lokatora?');">
                                    @csrf
                                    @method('DELETE')
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
