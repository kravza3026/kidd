@php
    $genders = \App\Models\Gender::all(['id', 'name']);
@endphp
<div data-member-id="new">
<form class="w-full bg-white rounded-xl border border-gray-100 p-4"
      method="POST" action="{{ route('family.store') }}" hx-post="{{ route('family.store') }}" hx-target="closest div[data-member-id='new']" hx-swap="outerHTML">
    @csrf

    <div class="flex flex-col items-start gap-1 w-full">
        <div class="flex flex-col gap-4 w-full">
            <div>
                <div class="mt-4">
                    <x-ui.input-label for="name" value="{{ $member->name }}" :type="'name'" name="name" :label="__('Name')" required autocomplete="name"/>
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
                <x-ui.input-label id="birth_date" for="birth_date" value="" :type="'date'" required :placeholder="'Birth Date'" name="name" :label="'Height (cm)'" />
                <x-input-error :messages="$errors->get('height')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-ui.input-label id="height" for="height" value="" :type="'name'" :placeholder="'Height (cm)'" name="name" :label="'Height (cm)'" />
                <x-input-error :messages="$errors->get('height')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-ui.input-label id="weight" for="weight" value="" :type="'number'" :placeholder="'Weight (grams)'" name="weight" :label="'Weight (grams)'" />
                <x-input-error :messages="$errors->get('height')" class="mt-2"/>
            </div>



            <div>
                <label for="notes" class="block font-medium text-gray-700">Notes</label>
                <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border rounded px-2 py-1">{{ $member->notes }}</textarea>
            </div>


        </div>
    </div>
    <div class="flex justify-end mt-4 gap-3">
        <x-secondary-button type="button" onclick="this.closest('div[data-member-id]').remove()">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-primary-button type="submit">
            {{ __('Save') }}
        </x-primary-button>
    </div>
</form>
</div>
