<x-app-layout>
    <div class="mx-auto max-w-5xl bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 space-y-4 bg-white py-4 lg:col-span-7 lg:rounded-2xl lg:shadow">
                @include('store.account.orders.components._tracking-head', ['title' => 'Order return'])

                <form
                    class="px-4"
                    method="POST"
                    action="{{ route('orders.return.store', $order) }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <p class="text-sm font-medium">{{ __('order.return.select_products') }}</p>
                    <x-input-error :messages="$errors->get('items')" class="mt-1" />
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
                                            name="items[]"
                                            value="{{ $product->id }}"
                                            type="checkbox"
                                            class="peer hidden"
                                            @checked(in_array($product->id, old('items', [])))
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
                        <x-custom-select
                            name="reason"
                            id="reason"
                            label="{{ __('order.return.reason_label') }}"
                            :options="$reasons"
                            :selected="old('reason')"
                            placeholder="{{ __('order.return.reason_placeholder') }}"
                        />
                        <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        @include('store.account.orders.components._file-return')
                        <x-input-error :messages="$errors->get('images')" class="mt-2" />
                        <x-input-error :messages="$errors->get('images.0')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-ui.textarea
                            label="{{ __('order.return.comment_label') }}"
                            id="comment"
                            name="comment"
                            value="{{ old('comment') }}"
                            placeholder="{{ __('contacts.form.message_placeholder') }}"
                        />
                        <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                    </div>
                    <x-ui.button as="button" type="submit" left_icon="false" right_icon="false" class="text-sm font-bold">
                        {{ __('order.return.send_button') }}
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
