<x-app-layout>
    <div class="mx-auto max-w-5xl bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 space-y-4 bg-white py-4 lg:col-span-7 lg:rounded-2xl lg:shadow">
                @include('store.account.orders.components._tracking-head')

                <form class="px-4">
                    <p class="text-sm font-medium">Select products</p>
                    <div class="mt-4 grid grid-cols-12 gap-x-4">
                        @foreach ($order->items as $product)
                            <div class="relative col-span-12 flex items-start lg:col-span-4">
                                <div class="relative top-4 mx-1 md:mx-2 lg:absolute lg:right-4 lg:mx-0">
                                    <label
                                        for="return_{{ $product->id }}"
                                        class="border-light-border inline-flex size-5 cursor-pointer items-center justify-center border bg-white lg:size-7 lg:rounded-full"
                                    >
                                        <input
                                            id="return_{{ $product->id }}"
                                            value="{{ $product->id }}"
                                            type="checkbox"
                                            class="peer hidden"
                                        />
                                        <img
                                            class="hidden size-4 peer-checked:block"
                                            src="{{ Vite::image('icons/olive/checked_ol.svg') }}"
                                            alt="Checked"
                                        />
                                    </label>
                                </div>
                                @include('store.account.orders.components._order-product-item', compact('product'))
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 py-6">
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
                    <x-ui.button as="submit" left_icon="false" right_icon="false" class="text-sm font-bold">
                        Send message
                    </x-ui.button>
                </form>
            </div>
            <div class="col-span-12 space-y-4 px-5 lg:col-span-5 lg:px-0">
                @include('store.account.orders.components._questions')
                @include('store.account.orders.components._response')
            </div>
        </div>
    </div>
</x-app-layout>
