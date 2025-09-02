<x-app-layout>
    <div class="container my-10">
        <div class="flex w-full gap-x-16">
            <div class="mt-4 flex w-full shrink-1 grow basis-full">
                <div class="flex w-full flex-col space-y-6 last:[&>div]:border-b-0">
                    <div data-vue-component="Cart"></div>
                    <x-subscribe-form
                        title="{{ __('main.subscribe.title') }}"
                        secondaryTitle="{{ __('main.subscribe.subtitle') }}"
                        baseClass=""
                        contentWidth="w-full lg:flex justify-between gap-x-5 items-end bg-light-orange py-6 px-5 my-16 rounded-2xl"
                        titleClass="text-[24px] text-black"
                        formClass="w-full mt-5 lg:mt-0 lg:w-5/12"
                        subtitleClass="text-sm"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
