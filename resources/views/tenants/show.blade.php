<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Szczegóły lokatora') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>ID:</strong> {{ $tenant->id }}</li>
                    <li><strong>Imię:</strong> {{ $tenant->first_name }} {{ $tenant->last_name }}</li>
                    <li><strong>E-mail:</strong> {{ $tenant->email }}</li>
                    <li><strong>Telefon:</strong> {{ $tenant->phone }}</li>
                    <li><strong>Utworzono:</strong> {{ $tenant->created_at->format('Y-m-d') }}</li>
                    <li><strong>Aktualizowano:</strong> {{ $tenant->updated_at->format('Y-m-d') }}</li>
                </ul>
                <div class="mt-6">
                    <x-link-button :href="route('tenants.edit', $tenant)">
                        {{ __('Edytuj') }}
                    </x-link-button>
                    <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Na pewno usunąć?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>{{ __('Usuń') }}</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
