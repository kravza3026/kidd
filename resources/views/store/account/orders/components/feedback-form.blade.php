<div class="flex items-center justify-center">
    <div class="mx-auto w-lg max-w-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold md:text-[32px]">
                Share feedback
            </h1>
            <button class="closeSignIn cursor-pointer text-5xl leading-none opacity-65 duration-300 hover:opacity-100">
                <img src="{{ Vite::image('icons/close_dark.svg') }}" alt="" />
            </button>
        </div>
        <form method="POST" action="{{ LaravelLocalization::localizeURL('/login') }}">
            @csrf
            <div class="grid grid-cols-12 gap-x-4 ">
                <div class="col-span-12 mt-4">
                    <p class="font-medium text-sm">Rate your experience</p>
                    <div
                        x-data="{
                        rating: 0,
                         hoverRating: 0,
                        starEmpty: '{{ Vite::image('/icons/white/star.svg') }}',
                        starFilled: '{{ Vite::image('/icons/olive/star.svg') }}',
                        starHover: '{{ Vite::image('/icons/olive/star.svg') }}'
                    }"
                        class="col-span-12 mt-4 flex gap-2"
                    >

                        <template x-for="star in 5" :key="star">
                            <label
                                class="cursor-pointer"
                                @mouseenter="hoverRating = star"
                                @mouseleave="hoverRating = 0"
                            >
                                <input
                                    type="radio"
                                    name="rating"
                                    :value="star"
                                    x-model="rating"
                                    class="hidden"
                                />
                                <img
                                    :src="hoverRating >= star ? starHover : (rating >= star ? starFilled : starEmpty)"
                                    class="w-8 h-8 transition"
                                    :alt="'Зірка ' + star"
                                >
                            </label>
                        </template>
                    </div>
                </div>

                <div class="mt-4 col-span-12 lg:col-span-6">

                    <x-ui.input-label id="first_name" autocomplete="given-name" :value="auth()->user()->first_name" name="first_name" :label="__('First name')"/>

                    <x-input-error class="mt-2" :messages="$errors->profile->get('first_name')"/>
                </div>
                <div class="mt-4 col-span-12 lg:col-span-6">

                    <x-ui.input-label id="first_name" autocomplete="given-name" :value="auth()->user()->last_name" name="first_name" :label="__('Last name')"/>

                    <x-input-error class="mt-2" :messages="$errors->profile->get('last_name')"/>
                </div>
                <div class="mt-4 col-span-12">
                    <x-ui.input-label
                        for="email"
                        type="email"
                        :value="auth()->user()->email"
                        placeholder="{{ __('auth.login.form.email_placeholder') }}"
                        name="email"
                        :label="__('auth.login.form.email')"
                        required
                        autofocus
                        autocomplete="email"
                    />
                </div>

                <div class="mt-4 col-span-12">
                    <x-ui.textarea
                        label="Message"
                        id="message"
                        name="message"
                        value="{{ old('message') }}"
                        placeholder="{{ __('contacts.form.message_placeholder') }}"
                    />
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                </div>


                <div class="mt-4 col-span-12">
                    <x-primary-button class="ms-3 w-full" :class="'!w-full'">
                        Send message
                    </x-primary-button>
                </div>
            </div>
        </form>

    </div>
</div>
<style>
    #swal2-html-container {
        @media screen and (max-width: 768px) {
            width: 100% !important;
            padding: 15px 5px !important;
        }
    }

    .my-swal-rounded {
        border-radius: 10px;
        text-align: start;
        padding: 15px !important;

        .swal2-html-container {
            text-align: start;
        }

        .swal2-close:hover {
            color: var(--color-olive);
        }
    }
</style>
