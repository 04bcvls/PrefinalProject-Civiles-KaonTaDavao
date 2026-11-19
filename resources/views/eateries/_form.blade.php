@if ($errors->any())
    <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800">
        <p class="font-bold">Please fix the following errors:</p>
        <ul class="mt-2 list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label for="name" class="block text-sm font-semibold text-stone-700">Eatery Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $eatery->name ?? '') }}"
               class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        @error('name')
            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="district_id" class="block text-sm font-semibold text-stone-700">District</label>
        <select id="district_id" name="district_id" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <option value="">Select a district</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(old('district_id', $eatery->district_id ?? '') == $district->id)>
                    {{ $district->name }}
                </option>
            @endforeach
        </select>
        @error('district_id')
            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="address" class="block text-sm font-semibold text-stone-700">Address</label>
        <input type="text" id="address" name="address" value="{{ old('address', $eatery->address ?? '') }}"
               class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        @error('address')
            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="price_range" class="block text-sm font-semibold text-stone-700">Price Range</label>
        <select id="price_range" name="price_range" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <option value="budget" @selected(old('price_range', $eatery->price_range ?? '') === 'budget')>Budget (₱)</option>
            <option value="mid" @selected(old('price_range', $eatery->price_range ?? '') === 'mid')>Mid (₱₱)</option>
            <option value="splurge" @selected(old('price_range', $eatery->price_range ?? '') === 'splurge')>Splurge (₱₱₱)</option>
        </select>
        @error('price_range')
            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="specialty" class="block text-sm font-semibold text-stone-700">Specialty (Optional)</label>
        <input type="text" id="specialty" name="specialty" value="{{ old('specialty', $eatery->specialty ?? '') }}"
               class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        @error('specialty')
            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="permit_no" class="block text-sm font-semibold text-stone-700">Business Permit No.</label>
        <input type="text" id="permit_no" name="permit_no" value="{{ old('permit_no', $eatery->permit?->permit_no ?? '') }}"
               placeholder="DVO-2026-0915" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        @error('permit_no')
            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="expires_on" class="block text-sm font-semibold text-stone-700">Permit Expiry Date</label>
        <input type="date" id="expires_on" name="expires_on"
               value="{{ old('expires_on', isset($eatery) && $eatery->permit ? $eatery->permit->expires_on->format('Y-m-d') : '') }}"
               class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        @error('expires_on')
            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="inline-flex items-center gap-2 text-sm font-semibold text-stone-700">
            <input type="checkbox" name="is_open" value="1"
                   @checked((bool) old('is_open', $eatery->is_open ?? true))
                   class="rounded border-stone-300 text-red-600">
            Currently Open for Customers
        </label>
        @error('is_open')
            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <span class="block text-sm font-semibold text-stone-700">Features</span>
        @php
            $selectedFeatures = old('features', isset($eatery) ? $eatery->features->pluck('id')->all() : []);
        @endphp
        <div class="mt-2 grid grid-cols-2 gap-2 sm:grid-cols-3">
            @foreach ($features as $feature)
                <label class="inline-flex items-center gap-2 text-sm text-stone-700">
                    <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                           @checked(in_array($feature->id, $selectedFeatures))
                           class="rounded border-stone-300 text-red-600">
                    {{ $feature->name }}
                </label>
            @endforeach
        </div>
        @error('features')
            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
        @enderror
        @error('features.*')
            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>