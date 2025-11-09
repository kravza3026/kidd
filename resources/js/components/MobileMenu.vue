<script>
import Search from './Search.vue';
import menuIcon from '@img/icons/menu.svg';
import menuOpenIcon from '@img/icons/olive/menuOpen.svg';
import searchIcon from '@img/icons/search.svg';
import searchOpenIcon from '@img/icons/olive/searchOpen.svg';
import cartIcon from '@img/icons/cart.svg';
import faqIcon from '@img/icons/faq.svg';
import faqOpenIcon from '@img/icons/olive/faq_active.svg';
import userIcon from '@img/icons/user.svg';
import CartDropdown from '@/components/cart/CartDropdown.vue';
import UserDropdown from '@/components/account/UserDropdown.vue';
import { emitter } from '@/eventBus.js';
import { inject, onMounted, ref } from 'vue';
import { useI18n } from 'vue-i18n';

const currentPath = '/' + (window.location.pathname.split('/')[2] || '');
export default {
    name: 'MobileMenu',
    props: {
        isAuthenticated: {
            type: Boolean,
            default: false,
        },
        user: {
            type: Object,
            default: () => ({}),
        },
    },

    components: { UserDropdown, CartDropdown, Search },
    data() {
        return {
            exploreOpen: false,
            searchOpen: false,
            cartOpen: false,
            userOpen: false,
            menuIcon,
            menuOpenIcon,
            searchIcon,
            searchOpenIcon,
            cartIcon,
            faqIcon,
            faqOpenIcon,
            userIcon,
            currentPath,
        };
    },
    setup() {
        const { locale, t, n } = useI18n();
        const cartItems = ref([]);
        const route = inject('route');
        const getCartItems = async () => {
            await window.axios
                .get('cart')
                .then((response) => {
                    cartItems.value = response.data.items;
                })
                .catch((error) => {
                    console.error('Server error:', error);
                    cartItems.value = [];
                });
        };
        emitter.on('cart-updated', getCartItems);

        onMounted(() => {
            getCartItems();
            emitter.on('cart-updated', getCartItems);
        });
        return {
            cartItems,
        };
    },

    computed: {
        locale() {
            return document.documentElement.lang || 'ro';
        },
        isHelpActive() {
            return window.location.pathname.includes('/help');
        },
    },

    methods: {
        toggleExplore() {
            this.searchOpen = false;
            this.cartOpen = false;
            this.userOpen = false;

            this.exploreOpen = !this.exploreOpen;

            if (window.Alpine?.store('dropdown')) {
                window.Alpine.store('dropdown').toggle();
            }

            document.body.classList.toggle('overflow-hidden', this.exploreOpen);
        },
        toggleSearch() {

            this.exploreOpen = false;
            this.cartOpen = false;
            this.userOpen = false;

            this.searchOpen = !this.searchOpen;
            document.body.classList.toggle('overflow-hidden', this.searchOpen);

            if (this.searchOpen) {
                this.$nextTick(() => {
                    this.$refs.searchComponent?.openSearchFromOutside();
                });
            }
        },
        toggleCart() {

            this.exploreOpen = false;
            this.searchOpen = false;
            this.userOpen = false;

            this.cartOpen = !this.cartOpen;
            document.body.classList.toggle('overflow-hidden', this.cartOpen);
        },
        toggleUser() {
            this.exploreOpen = false;
            this.searchOpen = false;
            this.cartOpen = false;

            this.userOpen = !this.userOpen;
            document.body.classList.toggle('overflow-hidden', this.userOpen);
        },
        closeSearch() {
            this.searchOpen = false;
            document.body.classList.remove('overflow-hidden');
        },
    },
};
</script>
<template>

        <div class="menu bottom-0 w-screen z-10  bg-white lg:hidden">
            <div class="border-y border-gray-200 bg-white py-1">
                <div class="flex justify-between items-center px-0 py-2">
                    <!-- Explore -->
                    <div class="group flex-1">
                        <a
                            class="mx-auto flex w-full items-end justify-center px-2 pt-2 text-center text-gray-400 group-hover:text-indigo-500"
                            href="#"
                            @click.prevent="toggleExplore"
                        >
                            <span
                                :class="{ 'text-olive': exploreOpen }"
                                class="text-charcoal/60 block px-1 pt-1 pb-2 font-bold"
                            >
                                <img
                                    :src="exploreOpen ? menuOpenIcon : menuIcon"
                                    alt="menu"
                                    class="mx-auto pb-1 opacity-65"
                                />
                                <span class="block pb-1 text-[12px]">{{ this.$t('menu.catalog') }}</span>
                            </span>
                        </a>
                    </div>

                    <div class="group flex-1">
                        <a
                            class="mx-auto flex w-full items-end justify-center px-2 pt-2 text-center text-gray-400 group-hover:text-indigo-500"
                            href="#"
                            @click.prevent="toggleSearch"
                        >
                            <span
                                :class="{ 'text-olive': searchOpen }"
                                class="text-charcoal/60 block px-1 pt-1 pb-2 font-bold"
                            >
                                <img
                                    :src="searchOpen ? searchOpenIcon : searchIcon"
                                    alt="search"
                                    class="mx-auto h-[24px] w-[24px] pb-1 opacity-65"
                                />
                                <span class="block pb-1 text-[12px]">{{ this.$t('menu.search') }}</span>
                            </span>
                        </a>
                    </div>

                    <!-- Cart -->
                    <div class="group flex-1">
                        <a
                            :href="`/${locale}/cart`"
                            class="mx-auto flex w-full items-end justify-center px-2 pt-2 text-center text-gray-400 group-hover:text-indigo-500"
                        >
                            <div class="text-charcoal/60 block px-1 pt-1 pb-2 font-bold">
                                <div class="mx-auto w-fit pb-1">
                                    <div class="group relative">
                                        <img
                                            :src="cartIcon"
                                            alt="cart"
                                            class="opacity-65 md:opacity-100"
                                            height="24"
                                            width="24"
                                        />
                                        <div
                                            v-if="cartItems.length > 0"
                                            class="bg-olive absolute -top-2 -right-2 flex h-[16px] w-[16px] items-center justify-center rounded-full p-1"
                                        >
                                            <span class="text-[10px] text-white">{{ cartItems.length }}</span>
                                        </div>

                                        <div
                                            class="absolute top-full left-2/3 z-10 mt-2 w-max -translate-x-2/5 rounded-full bg-black px-3 py-1 text-sm text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                                        >
                                            {{ $t('cart.tooltip') }}
                                            <div
                                                class="absolute -top-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                                <span :class="{ 'text-olive': cartOpen }" class="block pb-1 text-[12px]">{{
                                    this.$t('menu.cart')
                                }}</span>
                            </div>
                        </a>
                    </div>

                    <!-- Help -->
                    <div class="group flex-1">
                        <a
                            :href="'/' + locale + '' + route('help', {}, false)"
                            class="mx-auto flex w-full items-end justify-center px-2 pt-2 text-center text-gray-400"
                        >
                            <span class="text-charcoal/60 block px-1 pt-1 pb-2 font-bold">
                                <img
                                    :src="isHelpActive ? faqOpenIcon : faqIcon"
                                    alt="faq"
                                    class="mx-auto pb-1 opacity-65"
                                />
                                <span :class="{ 'text-olive': isHelpActive }" class="block pb-1 text-[12px]">{{
                                    this.$t('menu.help')
                                }}</span>
                            </span>
                        </a>
                    </div>

                    <!-- Account -->
                    <div class="group flex-1">
                        <a
                            class="mx-auto flex w-full items-end justify-center px-1 pt-2 text-center text-gray-400 group-hover:text-indigo-500"
                            href="#"
                            @click.prevent="toggleUser"
                        >
                            <div class="text-charcoal/60 block px-1 pt-1 pb-2 font-bold">
                                <div class="mx-auto w-fit pb-1">
                                    <UserDropdown :is-authenticated="isAuthenticated" :user="user" />
                                </div>
                                <span class="block pb-1 text-[12px]">{{ this.$t('menu.account') }}</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Мобільний пошук -->
        <transition name="fade">
            <div
                v-if="searchOpen"
                ref="mobileSearch"
                class="border-t-light-border fixed top-[72px] left-0 z-50 h-[calc(100%-162px)] w-full overflow-auto border-t bg-white lg:hidden"
            >
                <Search ref="searchComponent" @close="closeSearch" />
            </div>
        </transition>

</template>



<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
