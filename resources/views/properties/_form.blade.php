@csrf
@if($method === 'PUT')
    @method('PUT')
@endif

<div>
    <x-input-label for="name" :value="__('Nazwa')" />
    <x-text-input
        id="name"
        name="name"
        type="text"
        class="mt-1 block w-full"
        :value="old('name', $property->name ?? '')"
        required
        autofocus
    />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="address" :value="__('Adres')" />
    <x-text-input
        id="address"
        name="address"
        type="text"
        class="mt-1 block w-full"
        :value="old('address', $property->address ?? '')"
        required
    />
    <x-input-error :messages="$errors->get('address')" class="mt-2" />
</div>
