<div class="{{ $baseClass ?? '' }}">
    <div class="{{ $contentWidth ?? '' }}">
        <div>
            <h2
                class="section-title {{ $titleClass ?? 'md:text-[24px] text-white xl:text-[40px] py-5' }} font-[700] text-balance xl:leading-12"
            >
                {{ $title }}
            </h2>

            @if (! empty($secondaryTitle))
                <p class="{{ $subtitleClass ?? 'text-white' }}">
                    {{ $secondaryTitle }}
                </p>
            @endif
        </div>

        <form class="{{ $formClass ?? '' }}" method="POST">
            @csrf
            <div class="relative">
                <input
                    class="w-full rounded-xl bg-white p-5 focus:outline-hidden"
                    type="email"
                    name="email"
                    placeholder="{{ __('main.subscribe.email_placeholder') }}"
                    required
                />
                <button
                    type="submit"
                    class="border-b-olive hover:bg-olive bg-charcoal animated absolute top-2 right-2 cursor-pointer rounded-xl border-b-2 px-7 py-3 font-bold text-white"
                >
                    {{ __('main.subscribe.subscribe_btn') }}
                </button>
            </div>
        </form>
    </div>
</div>
