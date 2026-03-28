<!--suppress CssCollapseDuplicateClass -->
<div class="relative flex grow flex-col overflow-y-auto border-r border-gray-200 bg-white px-6">
    <div class="relative flex h-16 shrink-0 items-center">
        <a href="{{ route('admin.home') }}">
            <img src="{{ Vite::image('logo.svg') }}" alt="kidd.md" class="h-8 w-auto" />
        </a>
    </div>
    <nav class="relative flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1.5">
                    <li>
                        <!-- Current: "bg-green-50 active text-dark-olive", Default: "text-gray-600 hover:text-dark-olive hover:bg-green-50" -->
                        {{-- {{ request()->routeIs('admin.orders.*') ? "bg-green-50 text-olive active" : "text-gray-600 hover:text-dark-olive hover:bg-green-50" }} --}}
                        {{-- {{ request()->route()->getName() == 'admin.home' ? 'text-olive active bg-green-50' : ' text-gray-600 ' }} --}}
                        <a
                            href="{{ route('admin.home') }}"
                            class="{{ request()->route()->getName() == 'admin.home' ? 'text-olive active bg-green-50' : ' text-gray-600 ' }} hover:text-dark-olive group flex items-center gap-x-3 rounded-md p-2 text-sm/6 font-semibold hover:bg-green-50"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                data-slot="icon"
                                aria-hidden="true"
                                class="group-hover:text-dark-olive group-[&.active]:text-olive size-5 shrink-0 text-gray-600"
                            >
                                <path
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <button
                            type="button"
                            command="--toggle"
                            commandfor="sub-menu-orders-customers"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500"
                            >
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            Orders & Customers
                        </button>
                        <el-disclosure
                            id="sub-menu-orders-customers"
                            {{ (request()->routeIs('admin.orders.*') || request()->routeIs('admin.customers.*')) ? 'open' : 'hidden' }}
                            class="contents"
                        >
                            <ul class="mt-1 px-2 font-normal">
                                <li>
                                    <a
                                        href="{{ route('admin.orders.index') }}"
                                        class="{{ request()->routeIs('admin.orders.*') ? 'text-olive active bg-green-50' : ' text-gray-600 ' }} flex w-full items-center gap-x-1.5 rounded-md py-1.5 pr-2 pl-8 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"
                                            />
                                        </svg>
                                        Orders
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('admin.customers.index') }}"
                                        class="{{ request()->routeIs('admin.customers.*') ? 'text-olive active bg-green-50' : ' text-gray-600 ' }} flex w-full items-center gap-x-1.5 rounded-md py-1.5 pr-2 pl-8 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                                            />
                                        </svg>
                                        Customers
                                    </a>
                                </li>
                            </ul>
                        </el-disclosure>
                    </li>
                    <li>
                        <button
                            type="button"
                            command="--toggle"
                            commandfor="sub-menu-products-categories"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            <svg
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500"
                            >
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            Products & Categories
                        </button>
                        <el-disclosure
                            id="sub-menu-products-categories"
                            {{ (request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*')) ? 'open' : 'hidden' }}
                            class="contents"
                        >
                            <ul class="mt-1 px-2 font-normal">
                                <li>
                                    <a
                                        href="{{ route('admin.categories.index') }}"
                                        class="{{ request()->routeIs('admin.categories.*') ? 'text-olive active bg-green-50' : ' text-gray-600 ' }} flex w-full items-center gap-x-1.5 rounded-md py-1.5 pr-2 pl-8 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Categories
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('admin.products.index') }}"
                                        class="{{ request()->routeIs('admin.products.*') ? 'text-olive active bg-green-50' : ' text-gray-600 ' }} flex w-full items-center gap-x-1.5 rounded-md py-1.5 pr-2 pl-8 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Products
                                    </a>
                                </li>
                            </ul>
                        </el-disclosure>
                    </li>
                    <li>
                        <button
                            type="button"
                            command="--toggle"
                            commandfor="sub-menu-inventory-warehouse"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            <svg
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500"
                            >
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            Inventory & Warehouses
                        </button>
                        <el-disclosure id="sub-menu-inventory-warehouse" hidden class="contents">
                            <ul class="mt-1 px-2 font-normal">
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Inventory
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Warehouses
                                    </a>
                                </li>
                            </ul>
                        </el-disclosure>
                    </li>
                    <li>
                        <button
                            type="button"
                            command="--toggle"
                            commandfor="sub-menu-sales-marketing"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            <svg
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500"
                            >
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            Sales & Marketing
                        </button>
                        <el-disclosure id="sub-menu-sales-marketing" hidden class="contents">
                            <ul class="mt-1 px-2 font-normal">
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Sales
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Marketing
                                    </a>
                                </li>
                            </ul>
                        </el-disclosure>
                    </li>
                    <li>
                        <button
                            type="button"
                            command="--toggle"
                            commandfor="sub-menu-wholesale"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            <svg
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500"
                            >
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            Wholesale
                        </button>
                        <el-disclosure id="sub-menu-wholesale" hidden class="contents">
                            <ul class="mt-1 px-2 font-normal">
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Wholesales
                                    </a>
                                </li>
                            </ul>
                        </el-disclosure>
                    </li>
                    <li>
                        <button
                            type="button"
                            command="--toggle"
                            commandfor="sub-menu-delivery-logistics"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            <svg
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500"
                            >
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            Delivery & Logistics
                        </button>
                        <el-disclosure id="sub-menu-delivery-logistics" hidden class="contents">
                            <ul class="mt-1 px-2 font-normal">
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Delivery
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Logistics
                                    </a>
                                </li>
                            </ul>
                        </el-disclosure>
                    </li>
                    <li>
                        <button
                            type="button"
                            command="--toggle"
                            commandfor="sub-menu-hr"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            <svg
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500"
                            >
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            HR
                        </button>
                        <el-disclosure id="sub-menu-hr" hidden class="contents">
                            <ul class="mt-1 px-2 font-normal">
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Employees
                                    </a>
                                </li>
                            </ul>
                        </el-disclosure>
                    </li>
                    <li>
                        <button
                            type="button"
                            command="--toggle"
                            commandfor="sub-menu-accounting"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            <svg
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500"
                            >
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            Accounting
                        </button>
                        <el-disclosure id="sub-menu-accounting" hidden class="contents">
                            <ul class="mt-1 px-2 font-normal">
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Categories
                                    </a>
                                </li>
                            </ul>
                        </el-disclosure>
                    </li>
                    <li>
                        <button
                            type="button"
                            command="--toggle"
                            commandfor="sub-menu-reports-analytics"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            <svg
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500"
                            >
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            Reports & Analytics
                        </button>
                        <el-disclosure id="sub-menu-reports-analytics" hidden class="contents">
                            <ul class="mt-1 px-2 font-normal">
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Reports
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Analytics
                                    </a>
                                </li>
                            </ul>
                        </el-disclosure>
                    </li>
                    <li>
                        <button
                            type="button"
                            command="--toggle"
                            commandfor="sub-menu-system-settings"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            <svg
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500"
                            >
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            System & Settings
                        </button>
                        <el-disclosure id="sub-menu-system-settings" hidden class="contents">
                            <ul class="mt-1 px-2 font-normal">
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        System Settings
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50"
                                    >
                                        Global Settings
                                    </a>
                                </li>
                            </ul>
                        </el-disclosure>
                    </li>
                </ul>
            </li>

            <li class="mt-auto mb-4">
                <a
                    href="#"
                    class="group hover:text-dark-olive -mx-2 flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-50"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        data-slot="icon"
                        aria-hidden="true"
                        class="group-hover:text-dark-olive size-6 shrink-0 text-gray-400"
                    >
                        <path
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Settings
                </a>
            </li>
        </ul>
    </nav>
</div>
