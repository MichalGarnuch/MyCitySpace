<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Lokale w nieruchomości “{$property->name}”") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <form method="GET" class="flex space-x-2">
                    <x-text-input
                        name="name"
                        type="text"
                        placeholder="{{ __('Nazwa') }}"
                        :value="request('name')"
                    />
                    <select name="status" class="border-gray-300 rounded-md">
                        <option value="">{{ __('Dowolny status') }}</option>
                        <option value="free" @selected(request('status')==='free')>{{ __('Wolny') }}</option>
                        <option value="occupied" @selected(request('status')==='occupied')>{{ __('Zajęty') }}</option>
                    </select>
                    <x-primary-button>{{ __('Szukaj') }}</x-primary-button>
                </form>
                <x-primary-button-link :href="route('properties.units.create', $property)">
                    {{ __('Dodaj lokal') }}
                </x-primary-button-link>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nazwa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($units as $unit)
                        <tr>
                            <td class="px-6 py-4">{{ $unit->id }}</td>
                            <td class="px-6 py-4">{{ $unit->name }}</td>
                            <td class="px-6 py-4 capitalize">{{ $unit->status }}</td>
                            <td class="px-6 py-4 text-right">
                                <x-link-button :href="route('properties.units.show', [$property, $unit])" class="mr-2">
                                    {{ __('Pokaż') }}
                                </x-link-button>
                                <x-link-button :href="route('properties.units.edit', [$property, $unit])" class="mr-2">
                                    {{ __('Edytuj') }}
                                </x-link-button>
                                <form action="{{ route('properties.units.destroy', [$property, $unit]) }}" method="POST" class="inline" onsubmit="return confirm('Na pewno usunąć ten lokal?');">
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
