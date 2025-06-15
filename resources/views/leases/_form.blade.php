@csrf
@if($method === 'PUT') @method('PUT') @endif

<div class="mb-4">
    <x-input-label for="tenant_id" :value="__('Najemca')" />
    <select name="tenant_id" id="tenant_id" class="mt-1 block w-full border rounded px-3 py-2">
        @foreach($tenants as $t)
            <option value="{{ $t->id }}" {{ (old('tenant_id', $lease->tenant_id ?? '') == $t->id) ? 'selected' : '' }}>
                {{ $t->first_name }} {{ $t->last_name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('tenant_id')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="unit_id" :value="__('Lokal')" />
    <select name="unit_id" id="unit_id" class="mt-1 block w-full border rounded px-3 py-2">
        @foreach($units as $u)
            <option value="{{ $u->id }}" {{ (old('unit_id', $lease->unit_id ?? '') == $u->id) ? 'selected' : '' }}>
                {{ $u->property->name }} / {{ $u->name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('unit_id')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="start_date" :value="__('Data rozpoczęcia')" />
    <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
                  :value="old('start_date', $lease->start_date ?? '')" required />
    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="end_date" :value="__('Data zakończenia')" />
    <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full"
                  :value="old('end_date', $lease->end_date ?? '')" />
    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="rent" :value="__('Czynsz (PLN)')" />
    <x-text-input id="rent" name="rent" type="number" step="0.01" class="mt-1 block w-full"
                  :value="old('rent', $lease->rent ?? '')" required />
    <x-input-error :messages="$errors->get('rent')" class="mt-2" />
</div>
