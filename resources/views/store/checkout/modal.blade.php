<div class="modal grid grid-cols-12 gap-6 p-0">
    <div class="col-span-12 flex flex-col justify-between gap-6 p-6 md:col-span-6">
        <div>
            <div class="flex items-center justify-between">
                <p class="text-3xl font-bold md:text-4xl">
                    {{ __('auth.register.form.title') }}
                </p>
                <button
                    class="closeSignIn cursor-pointer text-[46px] leading-none opacity-45 duration-300 hover:opacity-100"
                >
                    <img src="{{ Vite::image('icons/close_dark.svg') }}" alt="icon_close" />
                </button>
            </div>
            <div class="my-6 grid gap-x-6 gap-y-4 md:grid-cols-2 md:gap-y-8">
                <div class="col-span-1 flex grid-cols-12 items-center justify-start gap-x-2 md:grid">
                    <div class="border-light-border bg-light-orange col-span-3 size-10 rounded-full border p-2">
                        <img class="w-full" src="{{ Vite::image('icons/gradients/g_like.png') }}" alt="icon_like" />
                    </div>
                    <p class="text-charcoal w-auto text-sm font-medium md:col-span-9">
                        {{ __('auth.register.banner.cart_and_favorites') }}
                    </p>
                </div>
                <div class="col-span-1 flex grid-cols-12 items-center justify-start gap-x-2 md:grid">
                    <div class="border-light-border bg-light-orange col-span-3 size-10 rounded-full border p-2">
                        <img class="w-full" src="{{ Vite::image('icons/gradients/g_child.png') }}" alt="icon_child" />
                    </div>
                    <p class="text-charcoal col-span-9 w-auto text-sm font-medium">
                        {{ __('auth.register.banner.family') }}
                    </p>
                </div>
                <div class="col-span-1 flex grid-cols-12 items-center justify-start gap-x-2 md:grid">
                    <div class="border-light-border bg-light-orange col-span-3 size-10 rounded-full border p-2">
                        <img
                            class="w-full"
                            src="{{ Vite::image('icons/gradients/g_present.png') }}"
                            alt="icon_present"
                        />
                    </div>
                    <p class="text-charcoal col-span-9 w-auto text-sm font-medium">
                        {{ __('auth.register.banner.offers_and_discounts') }}
                    </p>
                </div>
                <div class="col-span-1 flex grid-cols-12 items-center justify-start gap-x-2 md:grid">
                    <div class="border-light-border bg-light-orange col-span-3 size-10 rounded-full border p-2">
                        <img class="w-full" src="{{ Vite::image('icons/gradients/g_car.png') }}" alt="icon_car" />
                    </div>
                    <p class="text-charcoal col-span-9 w-auto text-sm font-medium">
                        {{ __('auth.register.banner.order_tracking') }}
                    </p>
                </div>
                <div class="col-span-1 flex grid-cols-12 items-center justify-start gap-x-2 md:grid">
                    <div class="border-light-border bg-light-orange col-span-3 size-10 rounded-full border p-2">
                        <img class="w-full" src="{{ Vite::image('icons/gradients/g_mark.png') }}" alt="icon_mark" />
                    </div>
                    <p class="text-charcoal col-span-9 w-auto text-sm font-medium">
                        {{ __('auth.register.banner.easy_checkout') }}
                    </p>
                </div>
                <div class="col-span-1 flex grid-cols-12 items-center justify-start gap-x-2 md:grid">
                    <div class="border-light-border bg-light-orange col-span-3 size-10 rounded-full border p-2">
                        <img
                            class="w-full"
                            src="{{ Vite::image('icons/gradients/g_return.png') }}"
                            alt="icon_return"
                        />
                    </div>
                    <p class="text-charcoal col-span-9 w-auto text-sm font-medium">
                        {{ __('auth.register.banner.easy_returns_or_exchanges') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <x-ui.button
                right_icon="false"
                as="button"
                form="checkoutForm"
                type="submit"
                class="!bg-light-orange !text-olive !shadow-light-orange !border-light-border !my-0 !w-full !border !border-b-2 !text-base"
            >
                {{-- No, checkout as guest --}}
                {{ __('auth.login.modal.continue_as_guest') }}
            </x-ui.button>
            <x-ui.button right_icon="false" as="a" href="{{route('register')}}" class="!my-0 !w-full">
                {{-- Yes, create account --}}
                {{ __('auth.login.modal.create_account') }}
            </x-ui.button>
        </div>
    </div>
    <div class="col-span-6 hidden md:block">
        <img class="w-full rounded-r-2xl" src="{{ Vite::image('contactUs_bg.jpg') }}" alt="familie" />
    </div>
</div>

<style>
    .my-swal-rounded {
        border-radius: 1rem !important;
        text-align: start;
        padding: 0 !important;

        .swal2-html-container {
            text-align: start;
            padding: 0 !important;
            margin: 0 !important;
        }

        .swal2-close:hover {
            color: var(--color-olive);
        }
    }
</style>
