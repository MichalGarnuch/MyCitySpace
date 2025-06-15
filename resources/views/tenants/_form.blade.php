@csrf
@if($method === 'PUT')
    @method('PUT')
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <x-input-label for="first_name" :value="__('Imię')" />
        <x-text-input
            id="first_name"
            name="first_name"
            type="text"
            class="mt-1 block w-full"
            :value="old('first_name', $tenant->first_name ?? '')"
            required
            autofocus
        />
        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="last_name" :value="__('Nazwisko')" />
        <x-text-input
            id="last_name"
            name="last_name"
            type="text"
            class="mt-1 block w-full"
            :value="old('last_name', $tenant->last_name ?? '')"
            required
        />
        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="email" :value="__('E-mail')" />
        <x-text-input
            id="email"
            name="email"
            type="email"
            class="mt-1 block w-full"
            :value="old('email', $tenant->email ?? '')"
        />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="phone" :value="__('Telefon')" />
        <x-text-input
            id="phone"
            name="phone"
            type="text"
            class="mt-1 block w-full"
            :value="old('phone', $tenant->phone ?? '')"
        />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>
</div>
