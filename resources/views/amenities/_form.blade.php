@csrf
@if($method === 'PUT')
    @method('PUT')
@endif

<div>
    <x-input-label for="name" :value="__('Nazwa')" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                  :value="old('name', $amenity->name ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>
