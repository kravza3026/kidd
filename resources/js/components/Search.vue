<script>
import _ from 'lodash';
import searchIcon from '@img/search.svg';
import loop from '@img/icons/loop.svg';
import back from '@img/icons/back.svg';
import gender from '@img/icons/unisex.svg';
export default {
    name: 'Search',
    data() {
        return {
            locale: document.documentElement.lang || 'ro',
            open: false,
            searchQuery: '',
            processed: false,
            searchIcon,loop,gender,back,
            isMobile: window.innerWidth < 1024,
            products: [],
            recommended:[]
        };
    },

    computed: {
        hasSearchNoResults() {
            return this.searchQuery.trim() !== '' && this.processed;
        }
    },

    created() {
        this.fetchTags();
    },

    methods: {
        async search() {
            if (!this.searchQuery.trim()) return [];

            const query = this.searchQuery.trim().toLowerCase();

            // TODO - set url from global storage and easy accessible.
            await axios.get(this.locale + this.route('search', {term:query}, false) )
                .then(response => {
                    this.products = response.data.results;
                    this.processed = true;
                })
                .catch(error => {
                    console.error('Search error:', error);
                });

        },

        async fetchTags() {
            // TODO - Implement API tags for recommended searches.
            // TODO - Make them clickable, @click set as searchQuery
            this.recommended = ['summer cotton jumpsuit','floral print summer dress','summer shorts for boys','floral sun hat','blue sundress'];
        },

        handleType: _.debounce(function() {
            this.search();
        }, 350),

        openSearchFromOutside() {
            this.$refs.searchInput?.focus();
        },

        handleClickOutside(event) {

            const wrapper = this.$refs.searchWrapper;
            const toggle = this.$refs.searchToggle;


            if (!this.open) return;
            if (
                wrapper && !wrapper.contains(event.target) &&
                toggle && !toggle.contains(event.target)
            ) {
                this.closeSearch();
            }
        },
        highlightMatch(text) {
            const query = this.searchQuery.trim();
            if (!query) return text;

            const escapedQuery = query.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'); // escape спец. символи
            const regex = new RegExp(`(${escapedQuery})`, 'gi');

            return text.replace(regex, '<strong class="font-bold">$1</strong>');
        },
        closeSearch() {
            this.open = false;
        },
        onEnter(el) {
            el.style.opacity = '0';
            setTimeout(() => {
                el.style.transition = 'opacity 0.3s ease';
                el.style.opacity = '100';
            }, 10);
        },
        onAfterEnter(el) {
            el.style.transition = '';
            this.$refs.searchInput.focus();
        },
        onLeave(el) {
            el.style.transition = 'opacity 0.3s ease';
            el.style.opacity = '100';
            setTimeout(() => {
                el.style.transition = 'opacity 0.3s ease';
                el.style.opacity = '';
            }, 300);
        },
        handleResize() {
            this.isMobile = window.innerWidth < 1024;
        },

    },

    mounted() {
        document.addEventListener('click', this.handleClickOutside);
        window.addEventListener('resize', this.handleResize);
        window.addEventListener('toggle-mobile-search', this.openSearchFromOutside);
    },
    beforeUnmount() {
        document.removeEventListener('click', this.handleClickOutside);
        window.removeEventListener('resize', this.handleResize);
        window.removeEventListener('toggle-mobile-search',this.openSearchFromOutside);
    },
};
</script>

<template>
    <div>
        <div
            class="search hidden cursor-pointer w-full h-full lg:flex items-center gap-x-5"
            @click="open = true"
            ref="searchToggle"
        >
            <img :src="searchIcon" alt="search" width="24" height="24" />
            <span>{{ $t('menu.search') }}</span>
        </div>

        <transition name="slide-fade" @enter="onEnter" @after-enter="onAfterEnter" @leave="onLeave">
            <div
                v-show="open || isMobile"
                ref="searchWrapper"
                class="search-input absolute lg:bottom-0 right-0 bg-white flex flex-col h-auto w-full z-50"
            >
                <div class="relative flex items-center w-full lg:w-10/11 mx-auto pt-0 lg:top-[-10px]">
                    <img class="absolute lg:hidden left-6 pr-4 py-2 border-r border-r-light2-border" :src=back alt="">
                    <input
                        ref="searchInput"
                        v-model="searchQuery"
                        @input="handleType"
                        type="text"
                        class="w-full focus:outline-hidden h-[50px] m-2 pl-12 lg:pl-5 pr-12 rounded-md bg-light-orange"
                        placeholder=""
                        @keydown.esc="closeSearch"
                    />
                    <svg
                        class="absolute text-olive right-4 top-1/3 transform  pointer-events-none"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M16.007 16.007L22 22M18.4103 10.2051C18.4103 14.7367 14.7367 18.4103 10.2051 18.4103C5.67356 18.4103 2 14.7367 2 10.2051C2 5.67356 5.67356 2 10.2051 2C14.7367 2 18.4103 5.67356 18.4103 10.2051Z"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>

                    <div v-if="products.length" @enter="onEnter" @after-enter="onAfterEnter" @leave="onLeave"
                         class="w-full absolute left-0 h-fit lg:max-h-[50vh] overflow-auto top-22  mx-auto -mt-3 mb-4 bg-white   rounded-md lg:shadow p-0">
                        <ul  class="relative mt-2 w-full z-50">
                            <li v-for="item in products"
                                :key="item.id"
                                class="px-2 py-4 lg:p-4  hover:bg-gray-100 flex justify-between items-center gap-4 border-b border-b-light-border"
                            >
                                <a :href="item.url" class="flex gap-x-2 w-full">
                                    <div class="bg-card-bg size-14 p-2 text-center flex items-center justify-center rounded-md">
                                        <img :src="'/assets/images/' + item.main_image" alt='product' class="max-w-[50px] max-h-[50px] object-cover rounded-md" />
                                    </div>
                                    <div class="w-full">
                                        <div class="flex justify-start items-center w-full gap-x-2">
                                            <p v-html="highlightMatch(item.name[locale])" class="font-normal w-fit max-w-[calc(100%-20px)] leading-5 text-base lg:text-lg"></p>
                                            <div v-if="item.gender" :class="item.gender?.bg_color" class="p-1 group relative flex items-center justify-center rounded-full" >
                                                <span class="flex items-center size-3" v-html="item.gender?.svg ?? ''" ></span>
                                                <div class="absolute tooltip left-2/3 -translate-x-2/5 top-full mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100  transition-opacity duration-300 z-10">
                                                   {{item.gender?.name[locale]}}
                                                    <div class="absolute -top-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-1 flex flex-wrap w-full items-center gap-x-[1px]">
                                            <p v-for="(variant, index) in item.variants"
                                                :key="variant.color.id"
                                                class="text-xs lg:text-base pr-1  text-charcoal/40 font-light lg:pr-2 tracking-tighter"
                                            >
                                                {{ variant.color.name[locale] }}<span v-if="index < item.variants.length - 1">,</span>
                                            </p>
                                            <span class="h-full block py-2 mr-2 border-r border-r-light2-border"></span>
                                            <p v-for="(variant, index) in item.variants"
                                               :key="variant.size.id"
                                                class="text-xs lg:text-base text-charcoal/40 font-light lg:pr-2">
                                                {{ variant.size.name[locale]}}<span v-if="index < item.variants.length - 1">,</span>
                                            </p>
                                        </div>
                                    </div>
                                   <div class="grid align-top justify-items-end">
                                       <p class="text-base w-fit text-nowrap  lg:text-sm text-olive font-bold">{{ item.variants[0]?.price_final / 100 }} {{ $t('product.mdl') }}</p>
                                       <p v-if="item.variants[0].price_online" class="text-xs w-fit text-nowrap lg:text-sm text-charcoal/20 line-through font-bold">{{ item.variants[0].price_online / 100}} {{ $t('product.mdl') }}</p>
                                   </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div v-else-if="hasSearchNoResults" @enter="onEnter" @after-enter="onAfterEnter" @leave="onLeave"
                         class="w-full absolute left-0 h-fit top-22  mx-auto -mt-3 mb-4 bg-white rounded-md shadow p-4">
                        <div>
                            <p class="text-sm">No relevant results found</p>
                            <p class="text-sm opacity-60 font-normal">You can change your query or choose from suggested search options</p>
                            <div class="flex  flex-wrap gap-x-6 gap-y-2 mt-4">
                                <a href="#" v-for="item in recommended" class="flex items-center gap-x-2">
                                    <img class="opacity-60" :src="loop" alt="recommended">
                                    <p class="text-sm">{{item}}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>
