<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Szczegóły lokalu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>ID:</strong> {{ $unit->id }}</li>
                    <li><strong>Nazwa:</strong> {{ $unit->name }}</li>
                    <li><strong>Status:</strong> {{ ucfirst($unit->status) }}</li>
                    <li><strong>Dodano:</strong> {{ $unit->created_at->format('Y-m-d') }}</li>
                    <li><strong>Zmodyfikowano:</strong> {{ $unit->updated_at->format('Y-m-d') }}</li>
                </ul>
                <div class="mt-6">
                    <x-link-button :href="route('properties.units.edit', [$property, $unit])">
                        {{ __('Edytuj') }}
                    </x-link-button>
                    <form action="{{ route('properties.units.destroy', [$property, $unit]) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Na pewno usunąć?');">
                        @csrf @method('DELETE')
                        <x-danger-button>{{ __('Usuń') }}</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
