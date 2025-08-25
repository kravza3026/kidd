<div class="modal grid grid-cols-12 gap-x-6">
    <div class="col-span-6 flex justify-between flex-col gap-6">
        <div>
            <div class="flex items-center justify-between">
                <p class="font-bold text-[32px]">Save account</p>
                <button class="closeSignIn opacity-45 hover:opacity-100 duration-300 cursor-pointer text-[46px] leading-none">
                    <img src="{{Vite::image('icons/close_dark.svg')}}" alt="">
                </button>
            </div>
            <div class="grid grid-cols-2 gap-6 my-6">
                <div class="col-span-1 grid grid-cols-12 gap-x-2 items-center justify-start">
                    <div class="border col-span-3 border-light-border p-2 size-10 bg-light-orange rounded-full">
                        <img class="w-full" src="{{Vite::image('icons/gradients/g_like.png')}}" alt="">
                    </div>
                    <p class="font-medium col-span-9 text-sm w-auto">Save cart and favorites for later</p>
                </div>
                <div class="col-span-1 grid grid-cols-12 gap-x-2 items-center justify-start">
                    <div class="border col-span-3 border-light-border p-2 size-10 bg-light-orange rounded-full">
                        <img class="w-full" src="{{Vite::image('icons/gradients/g_child.png')}}" alt="">
                    </div>
                    <p class="font-medium col-span-9 text-sm w-auto">Manage personal and family data</p>
                </div>
                <div class="col-span-1 grid grid-cols-12 gap-x-2 items-center justify-start">
                    <div class="border col-span-3 border-light-border p-2 size-10 bg-light-orange rounded-full">
                        <img class="w-full" src="{{Vite::image('icons/gradients/g_present.png')}}" alt="">
                    </div>
                    <p class="font-medium col-span-9 text-sm w-auto">Get personalised offers & discounts</p>
                </div>
                <div class="col-span-1 grid grid-cols-12 gap-x-2 items-center justify-start">
                    <div class="border col-span-3 border-light-border p-2 size-10 bg-light-orange rounded-full">
                        <img class="w-full" src="{{Vite::image('icons/gradients/g_car.png')}}" alt="">
                    </div>
                    <p class="font-medium col-span-9 text-sm w-auto">Keep track of your
                        orders on the go</p>
                </div>
                <div class="col-span-1 grid grid-cols-12 gap-x-2 items-center justify-start">
                    <div class="border col-span-3 border-light-border p-2 size-10 bg-light-orange rounded-full">
                        <img class="w-full" src="{{Vite::image('icons/gradients/g_like.png')}}" alt="">
                    </div>
                    <p class="font-medium col-span-9 text-sm w-auto">Save shipping info
                        for easy checkout</p>
                </div>
                <div class="col-span-1 grid grid-cols-12 gap-x-2 items-center justify-start">
                    <div class="border col-span-3 border-light-border p-2 size-10 bg-light-orange rounded-full">
                        <img class="w-full" src="{{Vite::image('icons/gradients/g_return.png')}}" alt="">
                    </div>
                    <p class="font-medium col-span-9 text-sm w-auto">Get smooth return
                        or exchange  </p>
                </div>

            </div>
        </div>
        <div class="flex flex-col gap-2">
            <x-primary-button class="!w-full">No, checkout as guest</x-primary-button>
            <x-primary-button class="!w-full">Yes, create account</x-primary-button>
        </div>
    </div>
    <div class="col-span-6">
        <img class="w-full" src="{{Vite::image('contactUs_bg.jpg')}}" alt="">
    </div>

</div>

<style>
    .my-swal-rounded{
        border-radius: 10px;
        text-align: start;
        padding: 15px!important;

        .swal2-html-container{
            text-align: start;
        }

        .swal2-close:hover{
            color: var(--color-olive);
        }
    }
</style>
