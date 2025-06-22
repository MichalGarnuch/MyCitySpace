<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista nieruchomości') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <x-primary-button-link :href="route('properties.create')">
                    {{ __('Dodaj nieruchomość') }}
                </x-primary-button-link>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nazwa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Adres</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Utworzono</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($properties as $property)
                        <tr>
                            <td class="px-6 py-4">{{ $property->id }}</td>
                            <td class="px-6 py-4">{{ $property->name }}</td>
                            <td class="px-6 py-4">{{ $property->address }}</td>
                            <td class="px-6 py-4">{{ $property->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 text-right">
                                <x-link-button :href="route('properties.show', $property)" class="mr-2">
                                    {{ __('Pokaż') }}
                                </x-link-button>
                                <x-link-button :href="route('properties.edit', $property)" class="mr-2">
                                    {{ __('Edytuj') }}
                                </x-link-button>
                                <form action="{{ route('properties.destroy', $property) }}" method="POST" class="inline" onsubmit="return confirm('Na pewno usunąć?');">
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
