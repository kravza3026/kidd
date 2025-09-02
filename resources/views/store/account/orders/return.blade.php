<x-app-layout>
    <div class="mx-auto max-w-5xl bg-white sm:bg-transparent sm:pt-16 sm:pb-20">

        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 lg:col-span-7 space-y-4 bg-white lg:shadow lg:rounded-2xl py-4">
                @include('store.account.orders.components._tracking-head')

                <form class="px-4">
                    <p class="text-sm font-medium">Select products</p>
                    <div class="grid grid-cols-12 gap-x-4 mt-4">
                        @foreach ($order->items as $product)
                           <div class="flex items-start col-span-12 lg:col-span-4 relative">
                               <div class="lg:absolute relative top-4 mx-2 lg:mx-0 lg:right-4">
                                   <label
                                       for="return_{{$product->id}}"
                                       class="size-5 lg:size-7 inline-flex items-center justify-center bg-white border border-light-border lg:rounded-full cursor-pointer"
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

                    <div class="py-6 mt-4">
                        @php
                            $options = [
                                0 => __('Select a option'),
                                1 => 'Chisinau',
                                2 => 'Balti',
                                3 => 'Tiraspol',
                            ];
                        @endphp

                        <x-custom-select
                            name="reason_of_return"
                            id="reason_of_return"
                            label="{{ __('Select the reason of return') }}"
                            :options="$options"
                            :selected="0"
                            placeholder="{{ __('Select a option') }}"
                        />
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
                    <x-ui.button as="submit" left_icon="false" right_icon="false"
                                 class=" font-bold text-sm">
                        Send message
                    </x-ui.button>
                </form>
            </div>
            <div class="px-5 lg:px-0 col-span-12 lg:col-span-5 space-y-4">
                @include('store.account.orders.components._questions')
                @include('store.account.orders.components._response')
            </div>
        </div>
    </div>
</x-app-layout>
