<section
    class="border-light-border sm:border-dark-snow {{ ($user->family->count() > 0) ? 'bg-white' : 'from-olive/15 via-olive/25 to-olive/15 border-[#eeeeee]/50 bg-gradient-to-r sm:bg-none' }} rounded-xl border sm:border-0 sm:p-0 lg:py-0"
>
    <header class="p-2 lg:p-0">
        <h2 class="text-2xl font-bold text-gray-900">
            {{ __('account.profile.family.title') }}
        </h2>

        <p class="mt-1 max-w-[70%] text-sm text-balance text-gray-600 sm:max-w-none">
            {!! __('account.profile.family.description') !!}
        </p>
    </header>

    {{-- @foreach (auth()->user()->family as $family) --}}
    {{-- {{ $family->name }} --}}
    {{-- {{ var_dump($family->compatible_sizes_ids) }} --}}
    {{-- @endforeach --}}

    <div class="family_list mt-6 mb-8 flex flex-grow flex-col gap-y-4">
        <div data-vue-component="Family"></div>
    </div>
</section>
