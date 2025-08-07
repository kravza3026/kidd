@php
    $genders = \App\Models\Gender::all(['id', 'name'])->toArray();
@endphp
<div data-member-id="{{ $member->id }}">
    <form
        hx-put="{{ route('family.update', $member) }}"
        hx-target="div[data-member-id='{{ $member->id }}']"
        hx-swap="outerHTML"
        class="w-full rounded-xl border border-gray-100 p-4"
    >
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-4">
            <div>
                <div class="mt-4">
                    <x-ui.input-label for="name" value="{{ $member->name }}" :type="'name'" :placeholder="'Enter yor e-mail'" name="name" :label="__('Name')" required autocomplete="name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

            </div>

            <div>
                <label for="gender_id" class="block font-medium text-gray-700">Gender</label>
                <select id="gender_id" name="gender_id" class="mt-1 block w-full border rounded px-2 py-1" required>
                    @foreach(\App\Models\Gender::all() as $gender)
                        <option value="{{ $gender->id }}" @if($gender->id == $member->gender_id) selected @endif>
                            {{ $gender->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="birth_date" class="block font-medium text-gray-700">Birth Date</label>
                <input type="date" id="birth_date" name="birth_date" value="{{ $member->birth_date->format('Y-m-d') }}" class="mt-1 block w-full border rounded px-2 py-1" required>
            </div>

            <div>
                <label for="height" class="block font-medium text-gray-700">Height (cm)</label>
                <input type="number" id="height" name="height" value="{{ $member->height }}" min="10" max="300" class="mt-1 block w-full border rounded px-2 py-1" required>
            </div>

            <div>
                <label for="weight" class="block font-medium text-gray-700">Weight (grams)</label>
                <input type="number" id="weight" name="weight" value="{{ $member->weight }}" min="100" max="200000" class="mt-1 block w-full border rounded px-2 py-1" required>
            </div>

            <div>
                <label for="notes" class="block font-medium text-gray-700">Notes</label>
                <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border rounded px-2 py-1">{{ $member->notes }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-olive text-white px-4 py-2 rounded hover:bg-olive-dark">
                    Save
                </button>
                <button type="button"
                        hx-get="{{ route('family.show', $member) }}"
                        hx-target="div[data-member-id='{{ $member->id }}']"
                        hx-swap="outerHTML"
                        class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400"
                >
                    Cancel
                </button>
            </div>
        </div>
    </form>
</div>
