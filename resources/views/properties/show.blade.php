<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Szczegóły nieruchomości') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>ID:</strong> {{ $property->id }}</li>
                    <li><strong>Nazwa:</strong> {{ $property->name }}</li>
                    <li><strong>Adres:</strong> {{ $property->address }}</li>
                    <li><strong>Utworzono:</strong> {{ $property->created_at->format('Y-m-d') }}</li>
                    <li><strong>Aktualizowano:</strong> {{ $property->updated_at->format('Y-m-d') }}</li>
                </ul>
                <div class="mt-6">
                    <x-link-button :href="route('properties.edit', $property)">
                        {{ __('Edytuj') }}
                    </x-link-button>
                    <form action="{{ route('properties.destroy', $property) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Na pewno usunąć?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>{{ __('Usuń') }}</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
