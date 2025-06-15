<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Szczegóły umowy') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>ID:</strong> {{ $lease->id }}</li>
                    <li><strong>Lokal:</strong> {{ $lease->unit->property->name }} / {{ $lease->unit->name }}</li>
                    <li><strong>Najemca:</strong> {{ $lease->tenant->first_name }} {{ $lease->tenant->last_name }}</li>
                    <li><strong>Od:</strong> {{ $lease->start_date }}</li>
                    <li><strong>Do:</strong> {{ $lease->end_date }}</li>
                    <li><strong>Czynsz:</strong> {{ number_format($lease->rent,2) }} PLN</li>
                </ul>
                <div class="mt-6">
                    <x-link-button :href="route('leases.edit', $lease)">{{ __('Edytuj') }}</x-link-button>
                    <form action="{{ route('leases.destroy', $lease) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Na pewno usunąć?');">
                        @csrf @method('DELETE')
                        <x-danger-button>{{ __('Usuń') }}</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
