<div class="mt-6 w-full px-4 sm:mt-0 sm:px-10">
    <h2 class="text-2xl leading-4 font-bold tracking-[-2%] text-[#020202]/80 sm:hidden">
        {{ __('account.account_title') }}
    </h2>
    <div class="flex flex-col py-4 sm:flex-row sm:border-b-[1px] sm:border-gray-100 sm:py-0">
        <a
            class="{{ request()->routeIs('profile.edit') ? 'sm:border-0 sm:border-b-olive sm:border-b-2 text-olive opacity-100 ' : 'sm:border-0 sm:border-b-[1px] text-gray-900 ' }}group hover:text-olive -mb-px inline-flex items-center justify-between gap-x-4 border border-gray-100 p-4 pl-3 text-sm font-semibold first:mt-0 first:rounded-t-xl last:rounded-b-xl focus:z-10 focus:ring-0 focus:outline-none sm:pb-5"
            href="{{ url(route('profile.edit')) }}"
        >
            <div class="inline-flex items-center gap-x-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="text-olive size-6 flex-shrink-0 sm:hidden"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                    />
                </svg>
                <span class="text-sm leading-[18px] font-bold -tracking-[2%]">
                    {{ __('account.nav_profile') }}
                </span>
            </div>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="{{ request()->routeIs('profile.edit') ? 'opacity-100 ' : 'opacity-20' }} size-4 group-hover:opacity-100 sm:hidden"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
            </svg>
        </a>
        <a
            class="{{ request()->routeIs('favorites.index') ? 'sm:border-0 sm:border-b-olive sm:border-b-2 text-olive ' : 'sm:border-0 sm:border-b-[1px] text-gray-900 ' }}group hover:text-olive -mb-px inline-flex items-center justify-between gap-x-4 border border-gray-100 p-4 pl-3 text-sm font-semibold first:mt-0 first:rounded-t-xl last:rounded-b-xl focus:z-10 focus:ring-0 focus:outline-none sm:pb-5"
            href="{{ url(route('favorites.index')) }}"
        >
            <div class="inline-flex items-center gap-x-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="text-olive size-6 flex-shrink-0 sm:hidden"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                </svg>
                <span class="text-sm leading-[18px] font-bold -tracking-[2%]">
                    {{ __('account.nav_favorites') }}
                </span>
                <span
                    class="group-hover:bg-olive {{ request()->routeIs('favorites.*') ? 'bg-olive' : '' }} -ml-1 flex min-h-[18px] min-w-[18px] items-center justify-center rounded-full bg-[#020202]/40 p-0.5 text-xs leading-3 font-extrabold tracking-[02%] text-white"
                >
                    {{ auth()->user()->favorites()->count() }}
                </span>
            </div>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="{{ request()->routeIs('favorites.index') ? 'opacity-100 ' : 'opacity-20' }} size-4 group-hover:opacity-100 sm:hidden"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
            </svg>
        </a>
        <a
            class="{{ request()->routeIs('orders.index') ? 'sm:border-0 sm:border-b-olive sm:border-b-2 text-olive ' : 'sm:border-0 sm:border-b-[1px] text-gray-900 ' }} group hover:text-olive -mb-px inline-flex items-center justify-between gap-x-4 border border-gray-100 p-4 pl-3 text-sm font-semibold first:mt-0 first:rounded-t-xl last:rounded-b-xl focus:z-10 focus:ring-0 focus:outline-none sm:pb-5"
            href="{{ url(route('orders.index')) }}"
        >
            <div class="inline-flex items-center gap-x-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="text-olive size-6 flex-shrink-0 sm:hidden"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"
                    />
                </svg>
                <span class="text-sm leading-[18px] font-bold -tracking-[2%]">
                    {{ __('account.nav_orders') }}
                </span>
                <span
                    class="group-hover:bg-olive {{ request()->routeIs('orders.*') ? 'bg-olive' : '' }} -ml-1 flex min-h-[18px] min-w-[18px] items-center justify-center rounded-full bg-[#020202]/40 p-0.5 text-xs leading-3 font-extrabold tracking-[02%] text-white"
                >
                    {{ auth()->user()->orders()->count() }}
                </span>
            </div>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="{{ request()->routeIs('orders.index') ? 'opacity-100 ' : 'opacity-20' }} size-4 group-hover:opacity-100 sm:hidden"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
            </svg>
        </a>
        <a
            class="{{ request()->routeIs('addresses.index') ? 'sm:border-0 sm:border-b-olive sm:rounded-b-none sm:border-b-2 text-olive ' : 'sm:border-0 sm:border-b-[1px] sm:rounded-b-lg text-gray-900 ' }}group hover:text-olive -mb-px inline-flex items-center justify-between gap-x-4 border border-gray-100 p-4 pl-3 text-sm font-semibold first:mt-0 first:rounded-t-xl last:rounded-b-xl focus:z-10 focus:ring-0 focus:outline-none sm:pb-5 sm:last:rounded-b-none"
            href="{{ url(route('addresses.index')) }}"
        >
            <div class="inline-flex items-center gap-x-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="text-olive size-6 flex-shrink-0 sm:hidden"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"
                    />
                </svg>
                <span class="text-sm leading-[18px] font-bold -tracking-[2%]">
                    {{ __('account.nav_addresses') }}
                </span>
                <span
                    class="group-hover:bg-olive {{ request()->routeIs('addresses.*') ? 'bg-olive' : '' }} -ml-1 flex min-h-[18px] min-w-[18px] items-center justify-center rounded-full bg-[#020202]/40 p-0.5 text-xs leading-3 font-extrabold tracking-[02%] text-white"
                >
                    {{ auth()->user()->addresses()->whereIn('address_type', [3, 4])->count() }}
                </span>
            </div>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="{{ request()->routeIs('addresses.index') ? 'opacity-100 ' : 'opacity-20' }} size-4 group-hover:opacity-100 sm:hidden"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
            </svg>
        </a>
    </div>
</div>
