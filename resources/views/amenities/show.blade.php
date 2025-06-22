<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Szczegóły udogodnienia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>ID:</strong> {{ $amenity->id }}</li>
                    <li><strong>Nazwa:</strong> {{ $amenity->name }}</li>
                </ul>
                <div class="mt-6">
                    <x-link-button :href="route('amenities.edit', $amenity)">
                        {{ __('Edytuj') }}
                    </x-link-button>
                    <form action="{{ route('amenities.destroy', $amenity) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Na pewno usunąć?');">
                        @csrf @method('DELETE')
                        <x-danger-button>{{ __('Usuń') }}</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
