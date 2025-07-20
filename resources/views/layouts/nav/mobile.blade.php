<div class="menu lg:hidden fixed z-50 bottom-0 w-full pb-3 bg-white">
    <div class="bg-white py-1 border-y-1 border-gray-200 ">
        <div class="flex">
            <div class="flex-1 group"
                 x-data
                 @click="$store.dropdown.toggle()">
                <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img
                                class="mx-auto pb-1 opacity-65"
                                :src="$store.dropdown.open
                                ? '{{ asset('assets/images/icons/menu-open.svg') }}'
                                : '{{ asset('assets/images/icons/menu.svg') }}'"
                                alt="menu"
                            >
                            <span class="block text-[12px] pb-1 "
                                  x-data
                                  :class="$store.dropdown.open ? 'text-olive' : ''">Explore</span>
                        </span>
                </a>
            </div>
            <div class="flex-1 group">
                <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img class="mx-auto pb-1 opacity-65" src="{{ asset('assets/images/icons/search.svg') }}" alt="search">
                            <span class="block text-[12px] pb-1">Search</span>
                        </span>
                </a>
            </div>
            <div class="flex-1 group">
                <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                           <img  class="mx-auto pb-1 opacity-65" src="{{ asset('assets/images/icons/card.svg') }}" alt="cart">
                            <span class="block text-[12px] pb-1">Cart</span>
                        </span>
                </a>
            </div>
            <div class="flex-1 group">
                <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img class="mx-auto pb-1 opacity-65" src="{{ asset('assets/images/icons/faq.svg') }}" alt="faq">
                            <span class="block text-[12px] pb-1">Help</span>
                        </span>
                </a>
            </div>
            <div class="flex-1 group">
                <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img class="mx-auto pb-1 opacity-65" src="{{ asset('assets/images/icons/user.svg') }}" alt="account">
                            <span class="block text-[12px] pb-1">Account</span>
                        </span>
                </a>
            </div>
        </div>

    </div>
</div>
