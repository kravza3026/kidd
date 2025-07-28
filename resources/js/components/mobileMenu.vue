<template>
    <div>
        <!-- Нижнє меню -->
        <div class="menu lg:hidden fixed z-50 bottom-0 w-full pb-3 bg-white">
            <div class="bg-white py-1 border-y border-gray-200">
                <div class="flex">
                    <!-- Explore -->
                    <div class="flex-1 group">
                        <a
                            class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500"
                            href="#"
                            @click.prevent="toggleExplore"
                        >
                            <span
                                :class="{ 'text-olive': exploreOpen }"
                                class="block text-charcoal/60 font-bold px-1 pt-1 pb-2"
                            >
                                  <img
                                      :src="exploreOpen ? menuOpenIcon : menuIcon"
                                      alt="menu"
                                      class="mx-auto pb-1 opacity-65"
                                  />
                                <span class="block text-[12px] pb-1">{{ this.$t('menu.catalog') }}</span>
                            </span>
                        </a>
                    </div>


                    <div class="flex-1 group">
                        <a
                            class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500"
                            href="#"
                            @click.prevent="toggleSearch"
                        >
                            <span
                                :class="{ 'text-olive': searchOpen }"
                                class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                                <img
                                    :src="searchOpen ?  searchOpenIcon : searchIcon"
                                    alt="search"
                                    class="mx-auto pb-1 opacity-65 w-[24px] h-[24px]"
                                />
                                <span class="block text-[12px] pb-1">{{ this.$t('menu.search') }}</span>
                            </span>
                        </a>
                    </div>

                    <!-- Cart -->
                    <div class="flex-1 group">

                        <a
                            class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500"
                            href="#"
                            @click.prevent="toggleCart"
                        >
                          <div

                              class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                           <div class="mx-auto w-fit pb-1">
                            <CartDropdown></CartDropdown>
                           </div>
                            <span
                                :class="{ 'text-olive': cartOpen }"
                                class="block text-[12px] pb-1">{{ this.$t('menu.cart') }}</span>
                          </div>
                        </a>
                    </div>

                    <!-- Help -->
                    <div class="flex-1 group">
                        <a
                            class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500"
                            href="#"
                        >
                          <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img
                                :src="faqIcon"
                                alt="faq"
                                class="mx-auto pb-1 opacity-65"
                            />
                            <span class="block text-[12px] pb-1">{{ this.$t('menu.help') }}</span>
                          </span>
                        </a>
                    </div>

                    <!-- Account -->
                    <div class="flex-1 group">
                        <a
                            class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500"
                            href="#"
                            @click.prevent="toggleUser"
                        >
                          <div class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                           <div class="mx-auto w-fit pb-1">
                               <UserDropdown :user="user" :is-authenticated="isAuthenticated" />
                           </div>
                            <span class="block text-[12px] pb-1">{{ this.$t('menu.account') }}</span>
                          </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Мобільний пошук -->
        <transition name="fade">
            <div
                ref="mobileSearch"
                v-if="searchOpen"
                class=" top-[72px] lg:hidden bg-white border-t border-t-light-border fixed z-50 w-full h-[calc(100%-162px)] left-0 overflow-auto"
            >
                <Search ref="searchComponent" @close="closeSearch" />
            </div>
        </transition>
    </div>
</template>

<script>
import Search from './Search.vue';

import menuIcon from '@img/icons/menu.svg';
import menuOpenIcon from '@img/icons/menuOpen.svg';
import searchIcon from '@img/icons/search.svg';
import searchOpenIcon from '@img/icons/searchOpen.svg';
import cartIcon from '@img/icons/cart.svg';
import faqIcon from '@img/icons/faq.svg';
import userIcon from '@img/icons/user.svg';
import CartDropdown from "@/components/CartDropdown.vue";
import UserDropdown from "@/components/UserDropdown.vue";

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
    components: {UserDropdown, CartDropdown, Search},
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
            userIcon,
        };
    },
    methods: {
        toggleExplore() {
            // Закриваємо інші
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
            // Закриваємо інші
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
            // Закриваємо інші
            this.exploreOpen = false;
            this.searchOpen = false;
            this.userOpen = false;

            this.cartOpen = !this.cartOpen;
            document.body.classList.toggle('overflow-hidden', this.cartOpen);
        },
        toggleUser() {
            // Закриваємо інші
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
    }

};
</script>

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
