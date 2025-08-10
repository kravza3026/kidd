@php
    $genders = \App\Models\Gender::all(['id', 'name']);
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
            <x-select
                id="gender_id"
                name="gender_id"
                :label="'Gender'"
                :options="$genders"
                :selected="old('gender_id', $member->gender_id ?? null)"
                :placeholder="true"
                :placeholder-option="[0, 'Select gender']"
                class="mt-1 block w-full border rounded px-2 py-1"
            >

            </x-select>

{{--            <div>--}}
{{--                <label for="gender_id" class="block font-medium text-gray-700">Gender</label>--}}
{{--                <select id="gender_id" name="gender_id" class="mt-1 block w-full border rounded px-2 py-1" required>--}}
{{--                    @foreach(\App\Models\Gender::all() as $gender)--}}
{{--                        <option value="{{ $gender->id }}" @if($gender->id == $member->gender_id) selected @endif>--}}
{{--                            {{ $gender->name }}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}



            <div class="mt-4">
                <x-ui.input-label id="birth_date" for="birth_date" value="{{ $member->birth_date->format('Y-m-d') }}" :type="'date'" required :placeholder="'Birth Date'" name="name" :label="'Height (cm)'" />
                <x-input-error :messages="$errors->get('height')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-ui.input-label id="height" for="height" value="{{ $member->height }}" :type="'name'" :placeholder="'Height (cm)'" name="name" :label="'Height (cm)'" />
                <x-input-error :messages="$errors->get('height')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-ui.input-label id="weight" for="weight" value="{{ $member->weight }}" :type="'number'" :placeholder="'Weight (grams)'" name="weight" :label="'Weight (grams)'" />
                <x-input-error :messages="$errors->get('height')" class="mt-2"/>
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
