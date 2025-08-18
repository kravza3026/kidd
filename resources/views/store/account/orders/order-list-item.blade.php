

<div class="border border-light-border rounded-2xl accordion-item my-2">
    <input type="checkbox" checked id="acc{{ $index }}" class="peer hidden" />
    <label for="acc{{ $index }}"
           class="hidden lg:grid lg:grid-cols-12 items-center relative rounded-2xl bg-light-orange duration-300 p-6
         cursor-pointer
         peer-checked:[&_.accordion-arrow]:rotate-180">
        <span class="font-bold text-lg col-span-3">Order #<span>00000</span></span>
        <span class="text-xs col-span-2"><span class="bg-olive text-white px-2 py-1 rounded-full font-bold">Shipped</span></span>
        <span class="text-base col-span-1">2</span>
        <span class="text-base col-span-2">12 Apr 2023</span>
        <span class="text-base col-span-2">17 Apr 2023</span>
        <span class="text-base font-bold text-olive col-span-2">440 lei</span>

        <span class="absolute right-6 border border-light-border rounded-full p-2 w-8 h-8 flex items-center justify-center bg-white">
      <img
          class="accordion-arrow opacity-40 transition-transform duration-300"
          src="{{ Vite::image('icons/top_arrow.svg') }}"
          alt=""
      >
    </span>
    </label>



    <label for="acc{{ $index }}"
           class="block rounded-2xl lg:hidden accordion-header border border-light-border duration-300 p-0
              peer-checked:[&_.accordion-arrow]:rotate-0 peer-checked:[&_.accordion-arrow]:text-olive"

    > <!-- arbitrary variant для svg -->
        <span class="grid grid-cols-2 items-center relative rounded-2xl bg-light-orange p-6 peer-checked:!rounded-b-0">
        <span class="col-span-1">
            <span class="flex items-center gap-x-2 font-bold">
                <span class="text-xl">#874720</span>
                <span class="size-4 rounded-full bg-olive"></span>
            </span>
            <span class="opacity-40 text-sm leading-0 py-1">Placed 15 Apr 2023</span>
        </span>
        <span class="col-span-1 flex justify-end items-center gap-x-2 font-bold">
            <span class="font-bold text-olive">889 lei</span>
            <span>
                <svg class="accordion-arrow rotate-180 transition-transform duration-300"
                     width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.3346 6.66668L7.0013 1.33334L1.66797 6.66668" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        </span>
    </span>
    </label>

    <div class="origin-top scale-y-0 h-0 opacity-0 transition-transform duration-300 peer-checked:scale-y-100 peer-checked:h-auto peer-checked:opacity-100">
        <div class="p-6 ">
            <div class="flex justify-between items-center font-bold">
                <p class="text-lg">Delivery details</p>
                <a href="#" class="flex items-center gap-2 border border-light-border rounded-full py-2 px-3 ">
                    <img src="{{ Vite::image('icons/truck_active.svg') }}" alt="">
                    <span class="text-olive text-sm">Track order</span>
                </a>
            </div>
            <div class="flex flex-wrap justify-start gap-9 items-center mt-6">
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Region</span>
                    <span class="font-bold">mun. Chișinău</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Localty</span>
                    <span class="font-bold">or. Chișinău</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Street name</span>
                    <span class="font-bold">str. Alba Iulia</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Building</span>
                    <span class="font-bold">113</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Entrance</span>
                    <span class="font-bold">6</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Floor</span>
                    <span class="font-bold">5</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Appartment</span>
                    <span class="font-bold">314</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Postal code</span>
                    <span class="font-bold">MD-2071</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Intercom</span>
                    <span class="font-bold">314</span>
                </p>
            </div>
            <div class="flex flex-wrap justify-start gap-9 items-center mt-6">
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Delivery metod</span>
                    <span class="font-bold">Regular</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Tracking code</span>
                    <span class="font-bold">UE239931833HK</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Sent with</span>
                    <span class="font-bold">Nova Poshta Moldova</span>
                </p>

            </div>
        </div>
        <div class="p-6 border-y border-light-border">
            <div class="flex justify-between items-center font-bold">
                <p class="text-lg">Contact info</p>
                <a href="#" class="flex items-center gap-2 border border-light-border rounded-full py-2 px-3 ">
                    <img src="{{ Vite::image('icons/user_active.svg') }}" alt="">
                    <span class="text-olive text-sm">Edit profile</span>
                </a>
            </div>
            <div class="flex flex-wrap justify-start gap-9 items-center mt-6">
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">First name</span>
                    <span class="font-bold">Dionisie</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Last name</span>
                    <span class="font-bold">Ghețu</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Phone number</span>
                    <span class="font-bold">+373 60 394 474</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">E-mail address</span>
                    <span class="font-bold">ghetsudionysiy@gmail.com</span>
                </p>

            </div>
        </div>
        <div class="p-1 lg:p-6 ">
            <h2 class="text-lg font-bold">Products </h2>
            <div class="py-2 grid grid-cols-1 lg:grid-cols-4 gap-4">
                <div class=" lg:border flex items-center lg:block border-light-border lg:rounded-2xl p-1 lg:p-0">
                    <div class="bg-light-orange rounded-2xl lg:rounded-t-2xl lg:rounded-b-none max-w-1/4 lg:max-w-full h-fit">
                        <img class=" lg:max-w-full" src="{{ Vite::image('common/product-1.png') }}" alt="product name">
                    </div>
                    <div class="p-4">
                        <p class=" text-nowrap truncate text-sm font-medium">Summer Cotton Jumpsuit</p>
                        <div class="flex justify-start items-center gap-x-1 py-1">
                            <span class="size-4 bg-olive rounded-full border border-light-border"></span>
                            <span class="opacity-40 text-sm">Beige</span>
                            <p class="pl-2 border-l border-l-light-border opacity-40 text-sm"> 0–3M</p>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <p class="text-olive font-bold text-base">240 lei</p>
                            <p class="flex items-center">× <span>1</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="p-0 lg:p-6 lg:border-t lg:border-light-border">
            <div class="flex justify-between items-center font-bold">
                <h2 class="text-lg">Payment details </h2>
                <a href="#" class="flex items-center gap-2 border border-light-border rounded-full py-2 px-3 ">
                    <img src="{{ Vite::image('icons/print.svg') }}" alt="">
                    <span class="text-olive text-sm">Print invoice</span>
                    <img class="rotate-180" src="{{ Vite::image('icons/top_arrow.svg') }}" alt="">
                </a>
            </div>
            <div class="flex flex-wrap justify-start gap-9 items-center mt-6">
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">First name</span>
                    <span class="font-bold">Dionisie</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Last name</span>
                    <span class="font-bold">Ghețu</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Payment method</span>
                    <span class="font-bold">VISA ××× 4695</span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Used coupon</span>
                    <span class="font-bold">SUMMER2023 <span>-25%</span></span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Postal code</span>
                    <span class="font-bold">MD-2071 </span>
                </p>
                <p class="grid text-base min-w-1/6">
                    <span class="opacity-40">Billing address</span>
                    <span class="font-bold">mun. Chișinău, or. Chișinău, str. Alba Iulia 113</span>
                </p>

            </div>
            <hr class="mt-6 border-light-border">
        </div>
        <div class="p-6 pt-0 grid gap-y-4">
            <div class="flex justify-between items-center">
                <p class="opacity-40 text-base">Subtotal price</p>
                <p class="text-base font-bold">520 lei</p>
            </div>
            <div class="flex justify-between items-center">
                <p class="opacity-40 text-base">Discount</p>
                <p class="text-base font-bold">-130 lei</p>
            </div>
            <div class="flex justify-between items-center">
                <p class="opacity-40 text-base">Delivery price</p>
                <p class="text-base font-bold">50 lei</p>
            </div>
            <div class="flex justify-between items-center">
                <p class="text-base font-bold">Total price</p>
                <p class="text-base font-bold text-olive">440 lei</p>
            </div>
        </div>
        <div class="px-6">
            <div class="p-6 my-6 bg-light-orange rounded-2xl">
                <h2 class="text-bold text-2xl font-bold">Product doesn't match of fit?</h2>
                <p class="opacity-60 text-base py-4">Product doesn't match of fit? You can contact us for return within 14 days of receiving it!</p>
                <x-ui.button left_icon="false" right_icon="false">
                    <img src="{{ Vite::image('icons/return.svg') }}" alt="">
                    Ask for return
                </x-ui.button>
            </div>
        </div>
    </div>
</div>
