@csrf
@if($method === 'PUT') @method('PUT') @endif

<div>
    <x-input-label for="name" :value="__('Nazwa lokalu')" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                  :value="old('name', $unit->name ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="status" :value="__('Status')" />
    <select id="status" name="status" class="mt-1 block w-full border rounded px-3 py-2">
        <option value="free"  {{ (old('status', $unit->status ?? '') == 'free') ? 'selected' : '' }}>{{ __('Wolny') }}</option>
        <option value="occupied" {{ (old('status', $unit->status ?? '') == 'occupied') ? 'selected' : '' }}>{{ __('Zajęty') }}</option>
    </select>
    <x-input-error :messages="$errors->get('status')" class="mt-2" />
</div>
