<x-app-layout>
    <div class="max-w-5xl mx-auto bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="bg-white shadow sm:rounded-xl">
            @include('store.account.nav')
            <div class="p-6 md:px-10">

                <h2>
                    Это надо верстать заново ( плохо сгенерил AI ))
                </h2>

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
                                <img src="{{ Vite::image('common/empty_orders.jpg') }}" alt=""/>
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

</x-app-layout>
