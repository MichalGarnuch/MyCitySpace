<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Udogodnienia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <x-primary-button-link :href="route('amenities.create')">
                    {{ __('Dodaj udogodnienie') }}
                </x-primary-button-link>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Nazwa') }}</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($amenities as $amenity)
                            <tr>
                                <td class="px-6 py-4">{{ $amenity->id }}</td>
                                <td class="px-6 py-4">{{ $amenity->name }}</td>
                                <td class="px-6 py-4 text-right">
                                    <x-link-button :href="route('amenities.show', $amenity)" class="mr-2">
                                        {{ __('Pokaż') }}
                                    </x-link-button>
                                    <x-link-button :href="route('amenities.edit', $amenity)" class="mr-2">
                                        {{ __('Edytuj') }}
                                    </x-link-button>
                                    <form action="{{ route('amenities.destroy', $amenity) }}" method="POST" class="inline" onsubmit="return confirm('Na pewno usunąć?');">
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
