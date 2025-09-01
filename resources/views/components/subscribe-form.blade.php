<div class="{{$baseClass ?? ''}}">
    <div class="{{ $contentWidth ?? '' }}">
        <div>
            <h2 class="section-title text-balance xl:leading-12 font-[700] {{ $titleClass ?? 'md:text-[24px] text-white xl:text-[40px] py-5' }}">
                {{ $title }}
            </h2>

            @if(!empty($secondaryTitle))
                <p class="{{ $subtitleClass ?? 'text-white' }}">
                    {{ $secondaryTitle }}
                </p>
            @endif
        </div>

        <form class="{{ $formClass ?? '' }}" method="POST" >
            @csrf
            <div class="relative">
                <input
                    class="w-full focus:outline-hidden bg-white rounded-xl p-5"
                    type="email"
                    name="email"
                    placeholder="Your e-mail address"
                    required
                >
                <button
                    type="submit"
                    class="absolute cursor-pointer right-2 top-2 text-white font-bold border-b-2 border-b-olive hover:bg-olive bg-charcoal rounded-xl py-3 px-7 animated"
                >
                    Subscribe
                </button>
            </div>
        </form>
    </div>
</div>
