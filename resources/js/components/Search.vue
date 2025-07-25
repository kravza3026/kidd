<script>
import searchIcon from '@img/search.svg';

import loop from '@img/icons/loop.svg';
import back from '@img/icons/back.svg';
import img1 from '@img/products/product_3.png';
import img2 from '@img/products/product_2.png';
import gender from '@img/icons/unisex.svg';
export default {
    name: 'Search',
    props: {
        modelValue: Boolean
    },
    data() {
        return {
            timeout: null,
            locale: document.documentElement.lang || 'ro',
            open: false,
            searchQuery: '',
            searchIcon,loop,gender,back,
            isMobile: window.innerWidth < 1024,
            items: [
                {
                    id: 1,
                    name: 'Summer Cotton Jumpsuit',
                    colors: ['Beige','Pink','White','Gray','Ivory'],
                    image: img1,
                    price: 240,
                    oldPrice: null,
                    size:['0–12M'],
                    gender:false
                },
                {
                    id: 2,
                    name: 'Fleece Jumpsuit',
                    colors: ['Beige', 'Pink', 'White', 'Gray',],
                    image: img2,
                    price: 236,
                    oldPrice: 240,
                    size:['0–8M'],
                    gender:false
                },
                {
                    id: 3,
                    name: 'Elegant Jumpsuit',
                    colors: ['White', 'Gray',],
                    image: img1,
                    price: 435,
                    oldPrice: null,
                    size:['0–12M'],
                    gender:true
                },
                {
                    id: 4,
                    name: 'Cotton Jumpsuit',
                    colors: ['White', 'Gray',],
                    image: img1,
                    price: 315,
                    oldPrice: null,
                    size:['0–18M'],
                    gender:true
                },

            ],
            recommended:['summer cotton jumpsuit','floral print summer dress','summer shorts for boys','floral sun hat','blue sundress']
        };
    },

    computed: {
        filteredResults() {
            if (!this.searchQuery.trim()) return [];

            const query = this.searchQuery.trim().toLowerCase();

            return this.items.filter(item =>
                item.name.toLowerCase().includes(query) ||
                item.colors.some(color => color.toLowerCase().includes(query)) ||
                item.size.some(size => size.toLowerCase().includes(query))
            );
        },
        hasSearchNoResults() {
            return this.searchQuery.trim() !== '' && this.filteredResults.length === 0;
        },
        handleType: function() {
            if (this.timeout)
                clearTimeout(this.timeout);

            this.timeout = setTimeout(() => {
                this.search();
            }, 500); // delay
        }
    },

    methods: {
        async search() {
            if (!this.searchQuery.trim()) return [];

            const query = this.searchQuery.trim().toLowerCase();

            try {
                await axios.get(`/${this.locale}/search?term=${query}`)
                    .then(response => {
                        this.items = response.data.results;
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                    });
            } catch (error) {
                console.error('Search error:', error);
            }
        },
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
            <span>Search</span>
        </div>

        <transition name="slide-fade" @enter="onEnter" @after-enter="onAfterEnter" @leave="onLeave">
            <div
                v-show="open || isMobile"
                ref="searchWrapper"
                class="search-input absolute lg:bottom-0 right-0 bg-white flex flex-col h-auto w-full z-50"
            >
                <div class="relative flex items-center w-full lg:w-10/11 mx-auto pt-0">
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

                    <div v-if="items.length" @enter="onEnter" @after-enter="onAfterEnter" @leave="onLeave"
                         class="w-full absolute left-0 h-fit top-22  mx-auto -mt-3 mb-4 bg-white   rounded-md lg:shadow p-0 lg:p-4">
                        <ul  class="relative mt-2 w-full z-50">
                            <li v-for="item in items"
                                :key="item.id"
                                class="px-2 py-4 lg:p-4  hover:bg-gray-100 flex justify-between items-center gap-4 border-b border-b-light-border"
                            >
                                <a href="#" class="flex gap-x-2 w-full">
                                    <div class="bg-card-bg size-14 p-2 text-center flex items-center justify-center rounded-md">
                                        <img :src="'/assets/images/' + item.main_image" alt='product' class="max-w-[50px] max-h-[50px] object-cover rounded-md" />
                                    </div>
                                    <div class="w-full">
                                        <div class="flex justify-start w-full gap-x-1">
                                            <p v-html="highlightMatch(item.name[locale])" class="font-normal w-fit max-w-[calc(100%-20px)] leading-5 text-base lg:text-xl"></p>
<!--                                            <img class="size-5" v-if="item.gender?.name[locale] ?? false" :src="gender" alt="unisex">-->
                                        </div>
                                        <div class="flex flex-wrap w-full">
                                            <p v-for="(variant, index) in item.variants"
                                                :key="variant.color.id"
                                                class="text-xs lg:text-base border-r border-r-light2-border pr-1  opacity-40 font-normal lg:pr-2 tracking-tighter"
                                            >
                                                {{ variant.color.name[locale] }}<span v-if="index < item.variants.length - 1">,</span>
                                            </p>
                                            <p v-for="(variant, index) in item.variants"
                                               :key="variant.size.id"
                                                class="text-xs lg:text-base opacity-40 font-normal pl-1 lg:pr-2">
                                                {{ variant.size.name[locale]}}
                                            </p>
                                        </div>
                                    </div>
                                   <div class="grid align-top">
<!--                                       <p class="text-base w-fit text-nowrap  lg:text-sm text-olive font-bold">{{ item.variants[0].price_final / 100 }} lei</p>-->
<!--                                       <p v-if="item.variants[0].price_online" class="text-xs w-fit text-nowrap lg:text-sm text-charcoal/20 line-through font-bold">{{ item.variants[0].price_online.toFixed(0) }}-->
<!--                                           lei</p>-->
                                   </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div v-else-if="hasSearchNoResults" @enter="onEnter" @after-enter="onAfterEnter" @leave="onLeave" class="w-full absolute left-0 h-fit top-22  mx-auto -mt-3 mb-4 bg-white rounded-md shadow p-4">
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
