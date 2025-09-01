<x-app-layout>
<div class="container my-10">
    <div class="w-full flex gap-x-16">
        <div class="w-full flex grow basis-full shrink-1 mt-4">
            <div class="flex flex-col space-y-6 w-full last:[&>div]:border-b-0">
                <div data-vue-component="Cart"></div>
                <x-subscribe-form
                    title="Subscribe to newsletter and get 25% off your first order"
                    secondaryTitle="Receive the latest updates and take advantage of great offers"
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
