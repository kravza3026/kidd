<x-app-layout>
    <div class="bg-white sm:bg-transparent sm:pt-16 sm:pb-20 max-w-4xl mx-auto sm:px-4 lg:px-8 space-y-2">
        <div class="bg-white shadow sm:rounded-xl">
            @include('store.account.nav')

            <div class="p-10 flex flex-col justify-start items-start gap-8">
                <div class="text-[#020202] text-2xl font-bold  leading-normal">Shipping addresses</div>
                <div class="self-stretch flex-col justify-start items-start gap-2 flex">
                    <div class="self-stretch bg-white rounded-xl border border-[#eeeeee]/50 flex-col justify-start items-start flex">
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
                                    <div class="text-center text-white text-sm font-bold  leading-[14px]">Default</div>
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
