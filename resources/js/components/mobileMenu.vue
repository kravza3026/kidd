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
                                <span class="block text-[12px] pb-1">Explore</span>
                            </span>
                        </a>
                    </div>


                    <div class="flex-1 group">
                        <a
                            class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500"
                            href="#"
                            @click.prevent="toggleSearch"
                        >
                            <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                                <img
                                    :src="searchIcon"
                                    alt="search"
                                    class="mx-auto pb-1 opacity-65"
                                />
                                <span class="block text-[12px] pb-1">Search</span>
                            </span>
                        </a>
                    </div>

                    <!-- Cart -->
                    <div class="flex-1 group">
                        <a
                            class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500"
                            href="#"
                        >
                          <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img
                                :src="cartIcon"
                                alt="cart"
                                class="mx-auto pb-1 opacity-65"
                            />
                            <span class="block text-[12px] pb-1">Cart</span>
                          </span>
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
                            <span class="block text-[12px] pb-1">Help</span>
                          </span>
                        </a>
                    </div>

                    <!-- Account -->
                    <div class="flex-1 group">
                        <a
                            class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500"
                            href="#"
                        >
                          <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img
                                :src="userIcon"
                                alt="account"
                                class="mx-auto pb-1 opacity-65"
                            />
                            <span class="block text-[12px] pb-1">Account</span>
                          </span>
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
                class="mobileMenuSearch container top-[72px] lg:hidden bg-white border-t border-t-light-border fixed z-50 w-full h-[calc(100%-162px)] left-0 overflow-auto"
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
import cartIcon from '@img/icons/card.svg';
import faqIcon from '@img/icons/faq.svg';
import userIcon from '@img/icons/user.svg';

export default {
    name: 'MobileMenu',
    components: {Search},
    data() {
        return {
            exploreOpen: false,
            searchOpen: false,
            menuIcon,
            menuOpenIcon,
            searchIcon,
            cartIcon,
            faqIcon,
            userIcon,
        };
    },
    methods: {
        toggleExplore() {
            this.exploreOpen = !this.exploreOpen;
            if (window.Alpine?.store('dropdown')) {
                window.Alpine.store('dropdown').toggle();
            }
        },
        toggleSearch() {
            if (this.exploreOpen) {
                this.exploreOpen = false;
            }

            this.searchOpen = !this.searchOpen;
            document.body.classList.toggle('overflow-hidden', this.searchOpen);

            if (this.searchOpen) {
                this.$nextTick(() => {
                    this.$refs.searchComponent?.openSearchFromOutside();
                });
            }
        },
        closeSearch() {
            this.searchOpen = false;
            document.body.classList.remove('overflow-hidden');
        },
    },
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
