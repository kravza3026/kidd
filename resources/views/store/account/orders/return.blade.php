<x-app-layout>
    <div class="mx-auto max-w-5xl bg-white sm:bg-transparent sm:pt-16 sm:pb-20">

        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 lg:col-span-7 space-y-4 bg-white shadow rounded-2xl py-4">
                @include('store.account.orders.components._tracking-head')

                <div class="px-4">
                    <p class="text-sm font-medium">Select products</p>
                    <div class="grid grid-cols-12 gap-x-4 mt-4">
                        @foreach ($order->items as $product)
                           <div class="col-span-12 lg:col-span-4 relative">
                               <div class="absolute top-4 right-4">
                                   <label
                                       for="return_{{$product->id}}"
                                       class="size-7 inline-flex items-center justify-center bg-white border border-light-border rounded-full cursor-pointer"
                                   >
                                       <input id="return_{{$product->id}}" value="{{$product->id}}" type="checkbox" class="hidden peer">
                                       <img
                                           class="size-4 peer-checked:block hidden"
                                           src="{{ Vite::image('/icons/olive/checked_ol.svg') }}"
                                           alt="Checked"
                                       >
                                   </label>
                               </div>
                               @include('store.account.orders.components._order-product-item', compact('product'))
                           </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <x-select
                            :label="'Select the reason of return'"
                            name="vacancy_id"
                            :id="'vacancy_id'"
                            :placeholder="false"
                            {{--        TODO add options array                    --}}
                            :options="[
                            '100' => 'Select the reason',
                            '101' => 'First select',
                            '102' => 'Second select'
                        ]"
                            :selected="'100'"
                        ></x-select>
                    </div>
                    <div class="mt-4">
                        @include('store.account.orders.components._file-return')
                    </div>
                    <div class="mt-4">
                        <x-ui.textarea
                            label="Share some comments"
                            id="message"
                            name="message"
                            value="{{ old('message') }}"
                            placeholder="{{ __('contacts.form.message_placeholder') }}"
                        />
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-5 space-y-4">
                @include('store.account.orders.components._questions')
                @include('store.account.orders.components._response')
            </div>
        </div>
    </div>
</x-app-layout>
