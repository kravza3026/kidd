<x-app-layout>
    <div class="bg-white sm:bg-transparent sm:pt-16 sm:pb-20 max-w-8/12 mx-auto sm:px-4 lg:px-8 space-y-2">
        <div class="bg-white shadow sm:rounded-xl">
            @include('store.account.nav')
            <div class="p-6 md:px-10">

                <div class="self-stretch pt-8 pb-10 flex-col justify-start items-start gap-8 flex">
                    <div class="self-stretch flex-col justify-start items-start flex">
                        <div class="self-stretch pb-4 justify-between px-4 items-start grid grid-cols-12 gap-4">
                            <div class="col-span-3 text-center grow shrink basis-0 opacity-40 text-charcoal text-[10px] font-bold  uppercase leading-[10px] tracking-wide">
                                Order ID
                            </div>
                            <div class="col-span-2 text-center opacity-40 text-charcoal text-[10px] font-bold  uppercase leading-[10px] tracking-wide">
                                Status
                            </div>
                            <div class="col-span-1 text-center opacity-40  text-charcoal text-[10px] font-bold  uppercase leading-[10px] tracking-wide">
                                items
                            </div>
                            <div class="col-span-2 text-center opacity-40 text-charcoal text-[10px] font-bold  uppercase leading-[10px] tracking-wide">
                                Date placed
                            </div>
                            <div class="col-span-2 text-center opacity-40 text-charcoal text-[10px] font-bold  uppercase leading-[10px] tracking-wide">
                                Delivery date
                            </div>
                            <div class="col-span-2 text-center opacity-40 text-charcoal text-[10px] font-bold  uppercase leading-[10px] tracking-wide">
                                Price
                            </div>
                        </div>
                        <div class="self-stretch flex-col justify-start items-start gap-2 flex">
                            <div class="self-stretch rounded-xl border border-[#eeeeee] flex-col justify-start items-start flex">
                                <div class="self-stretch relative pl-6 pr-5 py-[18px] bg-[#f8f7f2] justify-start items-center  grid grid-cols-12 gap-4">
                                    <div class="col-span-3 text-center grow shrink basis-0 h-[18px] justify-start items-center gap-4 flex">
                                        <div class="grow shrink basis-0 text-charcoal text-[18px] font-bold  leading-[18px]">
                                            Order #874720
                                        </div>
                                    </div>
                                    <div class="col-span-2 text-center h-6 justify-center items-start flex">
                                        <div class="px-2.5 py-1.5 bg-[#e7c200] rounded-xl justify-center items-center flex">
                                            <div class="text-center text-white text-xs font-bold  leading-3">
                                                Waiting
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1 text-center text-charcoal text-base font-normal  leading-none">
                                        <p>5</p>
                                    </div>
                                    <div class="col-span-2 text-center text-charcoal text-base font-normal  leading-none">15 Apr
                                        2023
                                    </div>
                                    <div class="col-span-2 text-center text-charcoal text-base font-normal  leading-none">~22 Apr
                                        2023
                                    </div>
                                    <div class="col-span-2 text-center text-[#a8ba66] text-base font-extrabold  leading-none">889 lei
                                    </div>
                                    <div class="absolute right-2 justify-end items-center gap-2 flex cursor-pointer">
                                        <div class="w-8 h-8 bg-white rounded-[100px] border border-light-border justify-center items-center flex">
                                                <img src="{{ Vite::image('icons/top_arrow.svg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="self-stretch h-[1348px] flex-col justify-start items-start flex">
                                    <div class="self-stretch h-[296px] px-6 py-8 border-b border-[#eeeeee] flex-col justify-start items-start flex">
                                        <div class="self-stretch justify-between items-center inline-flex">
                                            <div class="text-charcoal text-lg font-bold  leading-[18px]">Delivery
                                                details
                                            </div>
                                            <div class="px-3.5 py-2 bg-white rounded-[100px] border border-[#eeeeee] flex justify-center items-center gap-1.5 flex">
                                                <div class="w-4 h-4 relative">
                                                    <img src="{{ Vite::image('icons/truck_active.svg') }}" alt="">


                                                </div>
                                                <div class="text-center text-[#a8ba66] text-sm font-bold  leading-[14px]">
                                                    Track order
                                                </div>
                                            </div>
                                        </div>
                                        <div class="self-stretch h-[200px] pt-5 flex-col justify-start items-start gap-6 flex">
                                            <div class="self-stretch justify-start items-start gap-4 inline-flex">
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Region
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        mun. Chișinău
                                                    </div>
                                                </div>
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Localty
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        or. Chișinău
                                                    </div>
                                                </div>
                                                <div class="w-[181px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Street name
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        str. Alba Iulia
                                                    </div>
                                                </div>
                                                <div class="w-[131px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Building
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        113
                                                    </div>
                                                </div>
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Entrance
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        6
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="self-stretch justify-start items-start gap-4 inline-flex">
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Floor
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        5
                                                    </div>
                                                </div>
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Appartment
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        314
                                                    </div>
                                                </div>
                                                <div class="w-[181px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Postal code
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        MD-2071
                                                    </div>
                                                </div>
                                                <div class="w-[131px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Intercom
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        314
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="self-stretch justify-start items-start gap-4 inline-flex">
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Delivery metod
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        Delivery of gift
                                                    </div>
                                                </div>
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Tracking code
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  underline leading-normal">
                                                        UE239931833HK
                                                    </div>
                                                </div>
                                                <div class="w-[181px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Sent with
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  underline leading-normal">
                                                        Nova Poshta Moldova
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="self-stretch h-[146px] px-6 py-8 border-b border-[#eeeeee] flex-col justify-start items-start flex">
                                        <div class="text-charcoal text-lg font-bold  leading-[18px]">Gift
                                            recipient
                                        </div>
                                        <div class="self-stretch h-16 pt-5 flex-col justify-start items-start gap-6 flex">
                                            <div class="self-stretch justify-start items-start gap-4 inline-flex">
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        First name
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        Marina
                                                    </div>
                                                </div>
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Last name
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        Boicenco
                                                    </div>
                                                </div>
                                                <div class="w-[181px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Phone number
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        +373 68 796 720
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="self-stretch h-40 px-6 py-8 border-b border-[#eeeeee] flex-col justify-start items-start flex">
                                        <div class="self-stretch justify-between items-center inline-flex">
                                            <div class="text-charcoal text-lg font-bold  leading-[18px]">Contact
                                                info
                                            </div>
                                            <div class="px-3.5 py-2 bg-white rounded-[100px] border border-[#eeeeee] justify-center items-center gap-1.5 flex">
                                                <div class="w-4 h-4 relative">
                                                    <img src="{{ Vite::image('icons/user_active.svg') }}" alt="">
                                                </div>
                                                <div class="text-center text-[#a8ba66] text-sm font-bold  leading-[14px]">
                                                    Edit profile
                                                </div>
                                            </div>
                                        </div>
                                        <div class="self-stretch h-16 pt-5 flex-col justify-start items-start gap-6 flex">
                                            <div class="self-stretch justify-start items-start gap-4 inline-flex">
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        First name
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        Dionisie
                                                    </div>
                                                </div>
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Last name
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        Ghețu
                                                    </div>
                                                </div>
                                                <div class="w-[181px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Phone number
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        +373 60 394 474
                                                    </div>
                                                </div>
                                                <div class="grow shrink basis-0 flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        E-mail address
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        ghetsudionysiy@gmail.com
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="self-stretch h-[364px] px-6 py-8 border-b border-[#eeeeee] flex-col justify-start items-start flex">
                                        <div class="text-charcoal text-lg font-bold  leading-[18px]">Products</div>
                                        <div class="self-stretch pt-5 justify-start items-start gap-4 inline-flex">
                                            <div class="grow shrink basis-0 rounded-xl border border-[#eeeeee] flex-col justify-start items-start gap-4 inline-flex">
                                                <div class="self-stretch h-40 bg-[#f6f6f6] rounded-tl-xl rounded-tr-xl border border-[#eeeeee] flex-col justify-center items-center gap-1 flex">
                                                    <img class="w-[120px] h-[120px] mix-blend-multiply"
                                                         src="https://via.placeholder.com/120x120"/>
                                                </div>
                                                <div class="self-stretch h-9 px-4 flex-col justify-start items-start gap-2 flex">
                                                    <div class="self-stretch h-3.5 text-charcoal text-sm font-normal  leading-[14px]">
                                                        Summer Cotton Jumpsuit
                                                    </div>
                                                    <div class="justify-start items-start gap-3 inline-flex">
                                                        <div class="rounded-xl justify-start items-center gap-1 flex">
                                                            <div class="w-3 h-3 bg-[#ece1de] rounded-[60px] shadow-inner border border-black/10"></div>
                                                            <div class="opacity-40 text-charcoal text-sm font-normal  leading-[14px]">
                                                                Beige
                                                            </div>
                                                        </div>
                                                        <div class="w-3.5 self-stretch origin-top-left rotate-90 opacity-20 border border-[#bbbbbb]"></div>
                                                        <div class="opacity-40 text-charcoal text-sm font-normal  leading-[14px]">
                                                            0–3M
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="self-stretch px-4 pb-4 justify-between items-center inline-flex">
                                                    <div class="text-right text-[#a8ba66] text-base font-bold  leading-none">
                                                        240 lei
                                                    </div>
                                                    <div class="text-charcoal text-sm font-bold  leading-[18.20px]">
                                                        ×1
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grow shrink basis-0 rounded-xl border border-[#eeeeee] flex-col justify-start items-start gap-4 inline-flex">
                                                <div class="self-stretch h-40 bg-[#f6f6f6] rounded-tl-xl rounded-tr-xl border border-[#eeeeee] flex-col justify-center items-center gap-1 flex">
                                                    <img class="w-[120px] h-[120px] mix-blend-multiply"
                                                         src="https://via.placeholder.com/120x120"/>
                                                </div>
                                                <div class="self-stretch h-9 px-4 flex-col justify-start items-start gap-2 flex">
                                                    <div class="self-stretch h-3.5 text-charcoal text-sm font-medium  leading-[14px]">
                                                        Thin Pants
                                                    </div>
                                                    <div class="justify-start items-start gap-3 inline-flex">
                                                        <div class="rounded-xl justify-start items-center gap-1 flex">
                                                            <div class="w-3 h-3 bg-[#020202] rounded-[60px] shadow-inner border border-black/10"></div>
                                                            <div class="opacity-40 text-charcoal text-sm font-normal  leading-[14px]">
                                                                Black
                                                            </div>
                                                        </div>
                                                        <div class="w-3.5 self-stretch origin-top-left rotate-90 opacity-20 border border-[#bbbbbb]"></div>
                                                        <div class="opacity-40 text-charcoal text-sm font-normal  leading-[14px]">
                                                            6–9M
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="self-stretch px-4 pb-4 justify-between items-center inline-flex">
                                                    <div class="text-right text-[#a8ba66] text-base font-bold  leading-none">
                                                        330 lei
                                                    </div>
                                                    <div class="text-charcoal text-sm font-bold  leading-[18.20px]">
                                                        ×2
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grow shrink basis-0 rounded-xl border border-[#eeeeee] flex-col justify-start items-start gap-4 inline-flex">
                                                <div class="self-stretch h-40 bg-[#f6f6f6] rounded-tl-xl rounded-tr-xl border border-[#eeeeee] flex-col justify-center items-center gap-1 flex">
                                                    <img class="w-[120px] h-[120px] mix-blend-multiply"
                                                         src="https://via.placeholder.com/120x120"/>
                                                </div>
                                                <div class="self-stretch h-9 px-4 flex-col justify-start items-start gap-2 flex">
                                                    <div class="self-stretch h-3.5 text-charcoal text-sm font-normal  leading-[14px]">
                                                        Flutter Sleeve Dress
                                                    </div>
                                                    <div class="justify-start items-start gap-3 inline-flex">
                                                        <div class="rounded-xl justify-start items-center gap-1 flex">
                                                            <div class="w-3 h-3 bg-[#09fff0] rounded-[60px] shadow-inner border border-black/10"></div>
                                                            <div class="opacity-40 text-charcoal text-sm font-normal  leading-[14px]">
                                                                Turquoise
                                                            </div>
                                                        </div>
                                                        <div class="w-3.5 self-stretch origin-top-left rotate-90 opacity-20 border border-[#bbbbbb]"></div>
                                                        <div class="opacity-40 text-charcoal text-sm font-normal  leading-[14px]">
                                                            0–3M
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="self-stretch px-4 pb-4 justify-between items-center inline-flex">
                                                    <div class="text-right text-[#a8ba66] text-base font-bold  leading-none">
                                                        415 lei
                                                    </div>
                                                    <div class="text-charcoal text-sm font-bold  leading-[18.20px]">
                                                        ×2
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grow shrink basis-0 rounded-xl"></div>
                                        </div>
                                    </div>
                                    <div class="self-stretch h-[382px] px-6 pt-8 pb-6 border-b border-[#eeeeee] flex-col justify-start items-start flex">
                                        <div class="self-stretch justify-between items-center inline-flex">
                                            <div class="text-charcoal text-lg font-bold  leading-[18px]">Payment
                                                details
                                            </div>
                                            <div class="justify-start items-center gap-2 flex">
                                                <div class="px-3.5 bg-white rounded-[100px] border border-[#eeeeee] justify-center items-center gap-1.5 flex">
                                                    <div class="w-4 h-4 relative"></div>
                                                    <div class="text-center text-[#a8ba66] text-sm font-bold  leading-[14px]">
                                                        Print invoice
                                                    </div>
                                                    <div class="w-3 h-3 relative"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="self-stretch h-[294px] pt-5 flex-col justify-start items-start gap-6 flex">
                                            <div class="self-stretch justify-start items-start gap-4 inline-flex">
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        First name
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        Dionisie
                                                    </div>
                                                </div>
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Last name
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        Ghețu
                                                    </div>
                                                </div>
                                                <div class="w-[181px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Payment method
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        VISA ××× 4695
                                                    </div>
                                                </div>
                                                <div class="grow shrink basis-0 flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Used coupon
                                                    </div>
                                                    <div class="self-stretch justify-start items-start gap-1 inline-flex">
                                                        <div class="text-charcoal text-base font-bold  leading-normal">
                                                            SUMMER2023
                                                        </div>
                                                        <div class="text-right text-[#eac2c3] text-base font-bold  leading-normal">
                                                            -25%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="self-stretch justify-start items-start gap-4 inline-flex">
                                                <div class="w-[132px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Postal code
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        MD-2071
                                                    </div>
                                                </div>
                                                <div class="w-[329px] flex-col justify-end items-start gap-1 inline-flex">
                                                    <div class="self-stretch opacity-40 text-charcoal text-base font-normal  leading-none">
                                                        Billing address
                                                    </div>
                                                    <div class="self-stretch text-charcoal text-base font-bold  leading-normal">
                                                        mun. Chișinău, or. Chișinău, str. Alba Iulia 113
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="self-stretch h-[138px] border-t border-[#eeeeee] flex-col justify-start items-start flex">
                                                <div class="self-stretch h-[120px] py-5 flex-col justify-start items-start gap-4 flex">
                                                    <div class="self-stretch justify-between items-center inline-flex">
                                                        <div class="opacity-40 text-charcoal text-base font-normal  leading-none">
                                                            Subtotal price
                                                        </div>
                                                        <div class="text-charcoal text-base font-bold  leading-none">
                                                            985 lei
                                                        </div>
                                                    </div>
                                                    <div class="self-stretch justify-between items-center inline-flex">
                                                        <div class="opacity-40 text-charcoal text-base font-normal  leading-none">
                                                            Discount
                                                        </div>
                                                        <div class="text-charcoal text-base font-bold  leading-none">
                                                            -246 lei
                                                        </div>
                                                    </div>
                                                    <div class="self-stretch justify-between items-center inline-flex">
                                                        <div class="opacity-40 text-charcoal text-base font-normal  leading-none">
                                                            Delivery price
                                                        </div>
                                                        <div class="text-charcoal text-base font-bold  leading-none">
                                                            100 lei
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="self-stretch h-[18px] flex-col justify-start items-start gap-6 flex">
                                                    <div class="self-stretch h-[18px] flex-col justify-start items-start gap-4 flex">
                                                        <div class="self-stretch justify-between items-center inline-flex">
                                                            <div class="text-charcoal text-lg font-bold  leading-[18px]">
                                                                Total price
                                                            </div>
                                                            <div class="text-[#a8ba66] text-lg font-bold  leading-[18px]">
                                                                889 lei
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="self-stretch h-[68px] rounded-xl border border-[#eeeeee] flex-col justify-start items-start flex">
                                <div class="self-stretch pl-6 pr-5 py-[18px] bg-[#f8f7f2] justify-start items-center gap-6 inline-flex">
                                    <div class="grow shrink basis-0 h-[18px] justify-start items-center gap-4 flex">
                                        <div class="grow shrink basis-0 text-charcoal text-lg font-bold  leading-[18px]">
                                            Order #274037
                                        </div>
                                    </div>
                                    <div class="h-6 justify-start items-start flex">
                                        <div class="px-2.5 py-1.5 bg-[#a8ba66] rounded-xl justify-center items-center flex">
                                            <div class="text-center text-white text-xs font-bold  leading-3">
                                                Shipped
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-9 text-center text-charcoal text-base font-normal  leading-none">
                                        2
                                    </div>
                                    <div class="w-[120px] text-charcoal text-base font-normal  leading-none">12 Apr
                                        2023
                                    </div>
                                    <div class="w-[120px] text-charcoal text-base font-normal  leading-none">17 Apr
                                        2023
                                    </div>
                                    <div class="w-20 text-[#a8ba66] text-base font-extrabold  leading-none">440 lei
                                    </div>
                                    <div class="justify-end items-center gap-2 flex">
                                        <div class="w-8 h-8 bg-white rounded-[100px] border border-[#eeeeee] justify-center items-center flex">
                                            <img src="{{ Vite::image('icons/top_arrow.svg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="w-full divide-y divide-gray-300 text-sm text-left">

                    @forelse($user->orders as $order)
                        <tr class="border-b border-gray-300 font-light text-black text-center hover:bg-gray-50">
                            <td class="py-2 px-4 border-r">
                                {{ $order->id }}
                            </td>
                            <td>
                                {{ $order->created_at->format('d.m.Y H:i') }}
                            </td>
                            <td class="text-left">
                                {{--                                <strong class="font-semibold decoration-dotted underline underline-offset-4">{{ $order->price->getAmount() }}</strong> {{ $order->price->getCurrency() }}--}}
                                <strong class="font-semibold decoration-dotted underline underline-offset-4">{{ $order->id*rand(100,1000) }}</strong>
                                MDL
                            </td>
                            <td class="text-left font-semibold">
                                {{ rand(0, 1) ? '✓' : '✗' }}
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                         stroke="currentColor" class="inline-flex size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <div class="flex flex-col justify-center items-center my-12 py-12">
                            <div class="flex justify-center items-center -mb-6">
                                <img src="{{ Vite::image('empty_orders.jpg') }}" alt=""/>
                            </div>
                            <h3 class="flex justify-center items-center font-extrabold text-lg text-gray-900">
                                {{ __('You have no orders') }}
                            </h3>
                            <p class="flex justify-center items-center mt-1 mb-6 text-sm text-gray-500">
                                {{ __('Let\'s find something cute') }}
                            </p>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center w-full py-2.5 sm:w-auto sm:px-6 sm:py-2 bg-green-500 border border-transparent rounded-xl
                            font-semibold text-sm text-white hover:bg-green-600 focus:bg-green-550 active:bg-green-550 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 cursor-pointer transition ease-in-out duration-150">
                                Explore outfits
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                     stroke="currentColor" class="size-4 ml-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"/>
                                </svg>
                            </a>
                        </div>
                    @endforelse
                </table>
            </div>
        </div>
    </div>

    {{--    --------------------------------------}}

</x-app-layout>
