<x-app-layout>
    <div class="bg-white sm:bg-transparent sm:pt-16 sm:pb-20 max-w-4xl mx-auto sm:px-4 lg:px-8 space-y-2">
        <div class="bg-white shadow sm:rounded-xl">
            @include('store.account.nav')

            <div class=" bg-white shadow sm:rounded-xl p-5">
                <h1 class="text-[24px] font-bold">Shipping addresses</h1>
                <div v-for="(address, index) in addresses.filter(a => a.type === 'billing')"
                     :key="address.id" class="location duration-500 my-4 border border-light-border rounded-xl p-5">
                    <div  class="flex items-center justify-between ">
                        <div class="flex items-center gap-x-2">
                            <div class="p-2 bg-light-orange rounded-full">
                                <img class="opacity-65" :src="iconMarker" alt="">
                            </div>
                            <BaseInput
                                :disabled="!address.isEditing"
                                customClass="p-0 min-h-7.5 placeholder-text-sm"
                                name="title"
                                id="title"
                                :value="address.title"
                                v-model="address.title"
                                aria-label="title"
                                class="shadow-sm text-charcoal/60 rounded-2xl focus:outline-hidden duration-500 font-bold text-[20px]"
                                :class="{'cursor-not-allowed border-none !shadow-none': !address.isEditing,'': address.isEditing}"
                            />

                        </div>
                        <div class="flex items-center gap-x-2">
                            <button v-if="address.default" class="gradient_r-b_dark relative shadow-sm cursor-pointer">
                                <span class="absolute inset-0 bg-black/15 rounded-full"></span>
                                <div class="flex items-center gap-x-2 relative z-10 py-2 px-3">
                                    <img :src="iconFavorite" alt="">
                                    <p class="text-white font-bold text-[14px]">Default</p>
                                </div>
                            </button>
                            <button v-else class=" relative border border-light-border shadow-sm cursor-pointer rounded-full">
                                <div class="flex items-center justify-center gap-x-2 relative z-10 py-2 px-3">
                                    <p class="text-olive font-bold text-[14px]">Make default</p>
                                </div>
                            </button>
                            <div
                                class="cursor-pointer group p-2 border border-light-border rounded-full shadow-sm relative"
                                @click="address.confirmingDelete = !address.confirmingDelete"
                                v-click-outside="() => address.confirmingDelete = false"
                            >
                                <img class="size-4" :src="iconTrash" alt="" />
                                <div class="absolute left-2/3 -translate-x-2/5 -top-10 mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                    {{ __('address.delete') }}
                                    <div class="absolute -bottom-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
                                </div>
                                <transition name="fade-slide" appear>
                                    <div

                                        v-if="address.confirmingDelete"
                                        class="absolute w-[100px] -right-9 flex gap-x-2 justify-between items-center -bottom-8"
                                    >
                                        <!-- Cancel -->
                                        <div
                                            class="hover:opacity-100 opacity-85 duration-300 transition-all ease-in-out shadow-sm rounded-2xl  text-center py-1 flex justify-center bg-olive w-full h-5"
                                            @click.stop="address.confirmingDelete = false"
                                        >
                                            <img :src="iconClose" alt="" />
                                        </div>

                                        <!-- Confirm -->
                                        <div
                                            class="hover:opacity-100 opacity-85 duration-300 transition-all ease-in-out shadow-sm rounded-2xl w-full text-center py-1 flex justify-center bg-danger h-5"
                                            @click.stop="confirmRemoveAddress(address.id)"
                                        >
                                            <img :src="iconCheck" alt="" />
                                        </div>
                                    </div>
                                </transition>
                            </div>
                            <button class="settings cursor-pointer p-2 border border-light-border  rounded-full shadow-sm duration-500 relative group"
                                    :class="{'text-olive': !address.isEditing,'text-white bg-olive': address.isEditing}"
                                    @click="toggleEdit(address.id)"
                            >
                                <div class="absolute left-2/3 -translate-x-2/5 -top-10 mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                    {{ __('address.edit') }}
                                    <div class="absolute -bottom-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
                                </div>
                                <svg class="size-4" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.7238 1.0313C12.7664 -0.343766 14.8336 -0.343766 15.8762 1.0313L16.2293 1.49696C16.7982 2.24724 17.7277 2.63222 18.6605 2.50397L19.2394 2.42437C20.949 2.18931 22.4107 3.65102 22.1756 5.3606L22.096 5.93954C21.9678 6.87235 22.3528 7.80178 23.103 8.37068L23.5687 8.72377C24.9438 9.76642 24.9438 11.8336 23.5687 12.8762L23.103 13.2293C22.3528 13.7982 21.9678 14.7277 22.096 15.6605L22.1756 16.2394C22.4107 17.949 20.949 19.4107 19.2394 19.1756L18.6605 19.096C17.7277 18.9678 16.7982 19.3528 16.2293 20.103L15.8762 20.5687C14.8336 21.9438 12.7664 21.9438 11.7238 20.5687L11.3707 20.103C10.8018 19.3528 9.87235 18.9678 8.93954 19.096L8.3606 19.1756C6.65102 19.4107 5.18931 17.949 5.42437 16.2394L5.50397 15.6605C5.63222 14.7277 5.24724 13.7982 4.49696 13.2293L4.0313 12.8762C2.65623 11.8336 2.65623 9.76642 4.0313 8.72377L4.49696 8.37068C5.24724 7.80178 5.63222 6.87235 5.50397 5.93954L5.42437 5.3606C5.18931 3.65102 6.65102 2.18931 8.3606 2.42437L8.93954 2.50397C9.87235 2.63222 10.8018 2.24724 11.3707 1.49696L11.7238 1.0313Z" fill="currentColor" fill-opacity="0.15"/>
                                    <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M9.92377 2.23125C10.9664 0.856185 13.0336 0.856185 14.0762 2.23125L14.4293 2.69691C14.9982 3.44719 15.9277 3.83218 16.8605 3.70392L17.4394 3.62432C19.149 3.38926 20.6107 4.85097 20.3756 6.56055L20.296 7.13949C20.1678 8.0723 20.5528 9.00173 21.303 9.57064L21.7687 9.92372C23.1438 10.9664 23.1438 13.0335 21.7687 14.0762L21.303 14.4293C20.5528 14.9982 20.1678 15.9276 20.296 16.8604L20.3756 17.4394C20.6107 19.1489 19.149 20.6106 17.4394 20.3756L16.8605 20.296C15.9277 20.1677 14.9982 20.5527 14.4293 21.303L14.0762 21.7687C13.0336 23.1437 10.9664 23.1437 9.92377 21.7687L9.57068 21.303C9.00178 20.5527 8.07234 20.1677 7.13954 20.296L6.5606 20.3756C4.85102 20.6106 3.38931 19.1489 3.62437 17.4394L3.70397 16.8604C3.83222 15.9276 3.44724 14.9982 2.69695 14.4293L2.23129 14.0762C0.856231 13.0335 0.856231 10.9664 2.23129 9.92372L2.69695 9.57064C3.44724 9.00173 3.83222 8.0723 3.70397 7.13949L3.62437 6.56055C3.38931 4.85097 4.85102 3.38926 6.5606 3.62432L7.13954 3.70392C8.07234 3.83218 9.00178 3.44719 9.57068 2.69691L9.92377 2.23125Z" stroke="currentColor" stroke-width="2"/>
                                </svg>

                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-17 justify-between gap-x-4 my-4 w-full">
                        <!-- City dropdown -->
                        <div class="relative col-span-3 rounded-lg shadow-sm">
                            <div
                                class="border border-light-border px-3 py-1 rounded-lg w-full flex justify-between items-center "
                                :class="{'cursor-not-allowed': !address.isEditing,'': address.isEditing}"
                                @click="address.isEditing && (address.dropdownCityOpen = !address.dropdownCityOpen)"
                                v-click-outside="() => address.dropdownCityOpen = false"
                            >
                                <p class="flex items-center opacity-60 text-[14px]">
                                    {{ address.city || 'Select city' }}
                                </p>
                                <img class="duration-500" :src="selectIcon"  alt="selectIcon"
                                     :class="{'opacity-0': !address.isEditing,'opacity-40': address.isEditing}"  />
                            </div>

                            <ul
                                v-if="address.dropdownCityOpen"
                                class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
                            >
                                <li
                                    v-for="city in cityOptions"
                                    :key="city"
                                    class="px-3 flex gap-x-2 py-2 cursor-pointer hover:bg-gray-100"
                                    @click="address.city = city; address.dropdownCityOpen = false"
                                >
                                    {{ city }}
                                </li>
                            </ul>
                        </div>

                        <!-- District dropdown -->
                        <div class="relative col-span-3 rounded-lg shadow-sm">
                            <div
                                class="border border-light-border px-3 py-1 rounded-lg  w-full flex justify-between items-center"
                                :class="{'cursor-not-allowed': !address.isEditing,'': address.isEditing}"
                                @click="address.isEditing && (address.dropdownDistrictOpen = !address.dropdownDistrictOpen)"
                                v-click-outside="() => address.dropdownDistrictOpen = false"
                            >
                                <p class="flex items-center opacity-60 text-[14px]">
                                    {{ address.district || 'Select district' }}
                                </p>
                                <img :src="selectIcon" alt="selectIcon" class="duration-500"
                                     :class="{'opacity-0': !address.isEditing,'opacity-40': address.isEditing}"   />
                            </div>

                            <ul
                                v-if="address.dropdownDistrictOpen"
                                class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
                            >
                                <li
                                    v-for="district in districtOptions"
                                    :key="district"
                                    class="px-3 flex gap-x-2 py-2 cursor-pointer hover:bg-gray-100"
                                    @click="address.district = district; address.dropdownDistrictOpen = false"
                                >
                                    {{ district }}
                                </li>
                            </ul>

                        </div>

                        <BaseInput
                            :disabled="!address.isEditing"
                            customClass="p-0 h-7.5 placeholder-text-sm"
                            name="street"
                            id="street"
                            :value="address.street"
                            v-model="address.street"
                            aria-label="street"
                            class="shadow-sm text-charcoal/60 text-[14px] rounded-2xl focus:outline-hidden col-span-3 duration-500"
                        />
                        <BaseInput
                            :disabled="!address.isEditing"
                            customClass="p-0 min-h-7.5 placeholder-text-sm"
                            name="houseNumber"
                            id="houseNumber"
                            :value="address.houseNumber"
                            v-model="address.houseNumber"
                            aria-label="houseNumber"
                            class="shadow-sm text-charcoal/60 text-[14px] rounded-2xl focus:outline-hidden col-span-2 duration-500"
                        />
                        <BaseInput
                            :disabled="!address.isEditing"
                            customClass="p-0 min-h-7.5 placeholder-text-sm"
                            name="apartmentNumber"
                            id="apartmentNumber"
                            :value="address.apartmentNumber"
                            v-model="address.apartmentNumber"
                            aria-label="apartmentNumber"
                            class="shadow-sm text-charcoal/60 text-[14px] rounded-2xl focus:outline-hidden col-span-2 duration-500"
                        />
                        <BaseInput
                            :disabled="!address.isEditing"
                            customClass="p-0 min-h-7.5 placeholder-text-sm"
                            name="entrance"
                            id="entrance"
                            :value="address.entrance"
                            v-model="address.entrance"
                            aria-label="entrance"
                            class="shadow-sm text-charcoal/60 text-[14px] rounded-2xl focus:outline-hidden col-span-2 duration-500"
                        />
                        <BaseInput
                            :disabled="!address.isEditing"
                            customClass="p-0 min-h-7.5 placeholder-text-sm"
                            name="floor"
                            id="floor"
                            :value="address.floor"
                            v-model="address.floor"
                            aria-label="floor"
                            class="shadow-sm text-charcoal/60 text-[14px] rounded-2xl focus:outline-hidden col-span-2 duration-500"
                        />
                    </div>
                    <div class="flex justify-end">
                        <Button customClass="mx-auto !m-0 p-0 h-1" :class="{'hidden':!address.isEditing}">Save</Button>
                    </div>
                </div>
            </div>

            <div class="p-6 md:px-10">

                <h2 class="p-6 pl-4 text-2xl text-black font-bold">
                    Shipping addresses
                </h2>

                <table class="w-full divide-y divide-gray-300 text-sm text-left">
                    <thead>
                    <tr class="border-b border-gray-300 text-sm font-medium uppercase tracking-wider">
                        <th class="py-3 px-4 border-r">
                            Lbl
                        </th>
                        <th>
                            Contact
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            City, Region, Country
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    @forelse($user->shippingAddresses()->get() as $address)
                        <tr class="border-b border-gray-300 font-light text-black hover:bg-gray-50">
                            <td class="py-2 px-4 border-r">
                                {{ $address->label }} {{ $address->is_default ? __('(Def)') : '-' }}
                            </td>
                            <td>
                                {{ $address->contact_first_name }} {{ $address->contact_last_name }} [{{ $address->contact_phone }}]
                            </td>
                            <td>
                                ({{ $address->address_type->name }})
                                {{ $address->street_name }} {{ $address->building }}, Ap {{ $address->apartment }}
                                [sc:{{ $address->entrance }}, et:{{ $address->floor }},
                                i:{{ $address->intercom }}]
                            </td>
                            <td>
                                or. Chisinău, {{ $address->region->name }},
                                {{ $address->region->country->name }}, {{ $address->postal_code }}
                            </td>
                            <td>
                                {{ $address->notes }}
                            </td>
                        </tr>
                    @empty
                        <div class="flex flex-col justify-center items-center my-12 py-12">
                            <div class="flex justify-center items-center -mb-6">
                                <img src="{{ Vite::image('empty_addresses.jpg') }}" alt=""/>
                            </div>
                            <h3 class="flex justify-center items-center font-extrabold text-lg text-gray-900">
                                {{ __('No saved addresses') }}
                            </h3>
                        </div>
                    @endforelse
                    <tfoot>
                    <tr class="border-b border-gray-300 font-light text-black hover:bg-gray-50">
                        <td colspan="3" class="py-2 px-4 font-bold">
                            Total:
                        </td>
                        <td colspan="2" class="font-black text-left">
                            123.45
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="p-6 md:px-10">

                {{--                ------------------------}}
                <div class="h-[480px] p-10 bg-white rounded-xl border border-[#eeeeee]/50 flex-col justify-start items-start gap-8 inline-flex">
                    <div class="text-[#020202] text-2xl font-bold  leading-normal">Billing addresses</div>
                    <div class="self-stretch h-64 flex-col justify-start items-start gap-2 flex">
                        <div class="self-stretch h-[124px] bg-white rounded-xl border border-[#eeeeee]/50 flex-col justify-start items-start flex">
                            <div class="self-stretch px-5 pt-4 justify-between items-center inline-flex">
                                <div class="justify-start items-center gap-3 flex">
                                    <div class="w-9 h-9 p-2 bg-[#f8f7f2] rounded-[100px] border border-[#eeeeee]/50 justify-center items-center flex">
                                        <div class="w-5 h-5 relative opacity-40 flex-col justify-start items-start flex"></div>
                                    </div>
                                    <div class="text-[#020202] text-xl font-normal  leading-tight">Home</div>
                                </div>
                                <div class="bg-white justify-end items-center gap-2 flex">
                                    <div class="pl-3 pr-3.5 bg-gradient-to-l from-[#eac2c3] to-[#97c4fd] rounded-[100px] justify-center items-center gap-1.5 flex">
                                        <div class="w-3 h-3 relative"></div>
                                        <div class="text-center text-white text-sm font-bold  leading-[14px]">Default
                                        </div>
                                    </div>
                                    <div class="w-8 h-8 rounded-[100px] border border-[#eeeeee] justify-between items-center flex">
                                        <div class="w-4 h-4 relative"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="self-stretch p-5 justify-start items-center gap-2 inline-flex">
                                <div class="h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        mun. Chișinău
                                    </div>
                                    <div class="w-4 h-4 relative opacity-40"></div>
                                </div>
                                <div class="h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        or. Chișinău
                                    </div>
                                    <div class="w-4 h-4 relative opacity-40"></div>
                                </div>
                                <div class="w-[188px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        str. Alba Iulia
                                    </div>
                                </div>
                                <div class="w-[66px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        bl. 204
                                    </div>
                                </div>
                                <div class="w-[66px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        ap. 312
                                    </div>
                                </div>
                                <div class="w-[66px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        sc. 5
                                    </div>
                                </div>
                                <div class="w-[66px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        et. 4
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="self-stretch h-[124px] bg-white rounded-xl border border-[#eeeeee]/50 flex-col justify-start items-start flex">
                            <div class="self-stretch px-5 pt-4 justify-between items-center inline-flex">
                                <div class="justify-start items-center gap-3 flex">
                                    <div class="w-9 h-9 p-2 bg-[#f8f7f2] rounded-[100px] border border-[#eeeeee]/50 justify-center items-center flex">
                                        <div class="w-5 h-5 relative opacity-40 flex-col justify-start items-start flex"></div>
                                    </div>
                                    <div class="text-[#020202] text-xl font-normal  leading-tight">Gift for Marina</div>
                                </div>
                                <div class="bg-white justify-end items-center gap-2 flex">
                                    <div class="px-3.5 bg-white rounded-[100px] border border-[#eeeeee] justify-center items-center gap-1.5 flex">
                                        <div class="text-center text-[#a8ba66] text-sm font-bold  leading-[14px]">Make
                                            default
                                        </div>
                                    </div>
                                    <div class="w-8 h-8 rounded-[100px] border border-[#eeeeee] justify-between items-center flex">
                                        <div class="w-4 h-4 relative"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="self-stretch p-5 justify-start items-center gap-2 inline-flex">
                                <div class="h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        mun. Edineț
                                    </div>
                                    <div class="w-4 h-4 relative opacity-40"></div>
                                </div>
                                <div class="h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        or. Cupcini
                                    </div>
                                    <div class="w-4 h-4 relative opacity-40"></div>
                                </div>
                                <div class="w-[188px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        str. Ștefan cel Mare
                                    </div>
                                </div>
                                <div class="w-[66px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        bl. 24
                                    </div>
                                </div>
                                <div class="w-[66px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        ap. —
                                    </div>
                                </div>
                                <div class="w-[66px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        sc. —
                                    </div>
                                </div>
                                <div class="w-[66px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                                    <div class="grow shrink basis-0 opacity-60 text-[#020202] text-sm font-normal  leading-[14px]">
                                        et. —
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-14 px-8 bg-[#a8ba66] rounded-xl border-b-2 border-[#94a652] justify-center items-center gap-2 inline-flex">
                        <div class="w-4 h-4 relative"></div>
                        <div class="text-white text-base font-bold  leading-none">Add new address</div>
                    </div>
                </div>

                <h2 class="p-6 pl-4 text-2xl text-black font-bold">
                    Billing addresses
                </h2>

                <table class="w-full divide-y divide-gray-300 text-sm text-left">
                    <thead>
                    <tr class="border-b border-gray-300 text-sm font-medium uppercase tracking-wider">
                        <th class="py-3 px-4 border-r">
                            Lbl
                        </th>
                        <th>
                            Contact
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            City, Region, Country
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    @forelse($user->billingAddresses()->get() as $address)
                        <tr class="border-b border-gray-300 font-light text-black hover:bg-gray-50">
                            <td class="py-2 px-4 border-r">
                                {{ $address->label }} {{ $address->is_default ? __('(Def)') : '-' }}
                            </td>
                            <td>
                                {{ $address->contact_first_name }} {{ $address->contact_last_name }} [{{ $address->contact_phone }}]
                            </td>
                            <td>
                                ({{ $address->address_type->name }})
                                {{ $address->street_name }} {{ $address->building }}, Ap {{ $address->apartment }}
                                [sc:{{ $address->entrance }}, et:{{ $address->floor }},
                                i:{{ $address->intercom }}]
                            </td>
                            <td>
                                or. Chisinău, {{ $address->region->name }},
                                {{ $address->region->country->name }}, {{ $address->postal_code }}
                            </td>
                            <td>
                                {{ $address->notes }}
                            </td>
                        </tr>
                    @empty
                        <div class="flex flex-col justify-center items-center my-12 py-12">
                            <div class="flex justify-center items-center -mb-6">
                                <img src="{{ Vite::image('empty_addresses.jpg') }}" alt=""/>
                            </div>
                            <h3 class="flex justify-center items-center font-extrabold text-lg text-gray-900">
                                {{ __('No saved addresses') }}
                            </h3>
                        </div>
                    @endforelse
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
