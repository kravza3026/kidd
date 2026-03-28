@use('App\Enums\AddressType as AddressType')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ config('app.name') }} - Moldova</title>
        <link href="https://fonts.googleapis.com/css2?family=Onest:wght@300..700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html {
                -webkit-print-color-adjust: exact;
            }
            @page {
                size: A4;
                break-after: auto;
            }
        </style>
    </head>
    <body class="font-onest text-charcoal relative min-h-screen bg-white">
        <main class="mx-auto my-6 w-full">
            <section class="my-6">
                <div class="grid grid-cols-17 justify-between gap-x-13">
                    <div class="col-span-3 space-y-10">
                        <div class="space-y-2">
                            <p class="text-[10px] font-bold tracking-widest uppercase opacity-35">
                                {{ __('invoice.heading.billing_date') }}
                            </p>
                            <p class="font-medium">{{ $order->placed_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-[10px] font-bold tracking-widest uppercase opacity-35">
                                {{ __('invoice.heading.due_date') }}
                            </p>
                            <p class="font-medium">{{ $order->placed_at->addWeekdays(3)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="col-span-7 space-y-2">
                        <p class="text-[10px] font-bold tracking-widest uppercase opacity-35">
                            {{ __('invoice.heading.seller.title') }}
                        </p>
                        <p class="font-medium">
                            {{ $company->name }}
                        </p>
                        <p class="text-sm">
                            <span>{{ __('invoice.heading.seller.address') }}</span>
                            {{ $company->addresses()->firstWhere('address_type', AddressType::Billing)->street_name }}
                            {{ $company->addresses()->firstWhere('address_type', AddressType::Billing)->building }}
                            {{ $company->addresses()->firstWhere('address_type', AddressType::Billing)->apartment }},</br>
                            {{ $company->addresses()->firstWhere('address_type', AddressType::Billing)->city->name }},
                            {{ $company->addresses()->firstWhere('address_type', AddressType::Billing)->region->name }}
                            {{ $company->addresses()->firstWhere('address_type', AddressType::Billing)->postal_code }}
                        </p>
                        <p class="text-sm">
                            <span>{{ __('invoice.heading.seller.idno') }}</span>
                            {{ $company->idno }}
                        </p>
                        <p class="text-sm">
                            <span>{{ __('invoice.heading.seller.bank') }}</span>
                            {{ $company->bank['bank_name'] }}
                            {{ $company->bank['bank_account'] }}
                        </p>
                        <p class="text-sm">
                            <span>BIC/{{ __('invoice.heading.seller.iban_mdl') }}</span>
                            {{ $company->bank['bank_bic'] }}/
                            {{ $company->bank['bank_iban'] }}
                        </p>
                    </div>
                    <div class="col-span-6 space-y-2">
                        <p class="text-[10px] font-bold tracking-widest uppercase opacity-35">
                            {{ __('invoice.heading.buyer.title') }}
                        </p>
                        <p class="font-medium">
                            {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                        </p>
                        <p class="text-sm">
                            <span>{{ __('invoice.heading.buyer.address') }}</span>
                            {{ $order->billing->street_name }} {{ $order->billing->building }},
                            @if ($order->billing->apartment)
                                {{ __('invoice.heading.buyer.address_apt') }}
                                {{ $order->billing->apartment }},
                            @endif

                            {{ $order->billing->city->name }}, {{ $order->billing->region->name }}
                            {{ $order->billing->postal_code }}
                        </p>
                        <p class="text-sm">
                            <span>{{ __('invoice.heading.buyer.phone') }}</span>
                            {{ $order->customer->phone }}
                        </p>
                        <p class="text-sm">
                            <span>{{ __('invoice.heading.buyer.email') }}</span>
                            {{ $order->customer->email }}
                        </p>
                    </div>
                </div>
            </section>
            <hr class="border-light-border my-4" />
            <section class="mt-8">
                <p class="text-4xl">
                    {{ __('invoice.heading.invoice') }}
                    <span class="opacity-35">#{{ $order->invoice_number }}</span>
                </p>
                <div class="mt-4">
                    <div class="grid grid-cols-17 gap-x-4">
                        <p class="col-span-1 text-[10px] font-bold tracking-widest uppercase opacity-35">#</p>
                        <p class="col-span-8 text-[10px] font-bold tracking-widest uppercase opacity-35">
                            {{ __('invoice.table_heading.product_name_color_size') }}
                        </p>
                        <p class="col-span-1 text-[10px] font-bold tracking-widest uppercase opacity-35">
                            {{ __('invoice.table_heading.quantity') }}
                        </p>
                        <p class="col-span-1 text-[10px] font-bold tracking-widest uppercase opacity-35"></p>
                        <p class="col-span-3 text-[10px] font-bold tracking-widest uppercase opacity-35">
                            {{ __('invoice.table_heading.price') }}
                        </p>
                        <p class="col-span-3 text-[10px] font-bold tracking-widest uppercase opacity-35">
                            {{ __('invoice.table_heading.amount') }}
                        </p>
                    </div>
                    <hr class="border-light-border my-4" />

                    @foreach ($order->items as $item)
                        <div class="my-2 grid grid-cols-17 gap-x-4 pt-2 pb-2">
                            <p class="col-span-1 text-sm tracking-widest opacity-35">
                                {{-- {{ sprintf('%02d', $i) }}. --}}
                                {{ sprintf('%02d', $loop->iteration) }}.
                            </p>
                            <div class="col-span-8 text-sm tracking-normal">
                                {{ $item->variant_snapshot['product']['name'][app()->getLocale()] }}
                                <br />
                                <p class="text-[12px] opacity-55">
                                    {{ $item->variant_snapshot['color']['name'][app()->getLocale()] }} /
                                    {{ $item->variant_snapshot['size']['name'][app()->getLocale()] }} /
                                    <span class="text-[11px] font-bold">
                                        {{ $item->variant_snapshot['sku'] }}
                                    </span>
                                </p>
                            </div>
                            <p class="col-span-1 text-sm tracking-widest">
                                {{ $item->quantity }}
                            </p>
                            <p class="col-span-1 text-sm tracking-widest">
                                <span class="font-normal opacity-35">×</span>
                            </p>
                            <p class="col-span-3 text-sm tracking-widest">
                                {{ __('invoice.table_row.price', ['price' => $item->variant_snapshot['price_final'] / 100]) }}
                            </p>
                            <p class="col-span-3 text-sm font-medium tracking-widest">
                                {{ __('invoice.table_row.price', ['price' => $item->variant_snapshot['price_final'] * $item->quantity / 100]) }}
                            </p>
                        </div>
                    @endforeach

                    {{-- @endfor --}}

                    <hr class="border-light-border my-4" />

                    <div class="my-4 grid grid-cols-17 items-center gap-4">
                        <p class="col-span-3 col-start-12 text-[10px] font-bold tracking-widest uppercase opacity-35">
                            {{ __('invoice.table_footer.subtotal') }}
                        </p>
                        <p class="col-span-3 text-base font-medium tracking-widest">1400 lei</p>

                        <p class="col-span-3 col-start-12 text-[10px] font-bold tracking-widest uppercase opacity-35">
                            {{ __('invoice.table_footer.shipping') }}
                        </p>
                        <p class="col-span-3 text-base font-medium tracking-widest">50 lei</p>
                        <hr class="border-light-border col-span-6 col-start-12 my-4" />
                        <p class="col-span-3 col-start-12 text-[10px] font-bold tracking-widest uppercase opacity-35">
                            {{ __('invoice.table_footer.total') }}
                        </p>
                        <p class="col-span-3 text-xl font-bold tracking-widest">1450 lei</p>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
