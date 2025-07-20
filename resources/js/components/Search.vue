<template>
    <div>
        <div
            class="search hidden cursor-pointer w-full h-full md:flex items-center gap-x-5"
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
                class="search-input absolute md:bottom-[20px] right-0 bg-white flex flex-col h-auto w-full z-50"
            >
                <div class="relative flex items-center w-10/11 mx-auto pt-4">
                    <img class="absolute md:hidden left-4 pr-4 py-2 border-r border-r-light2-border" :src=back alt="">
                    <input
                        ref="searchInput"
                        v-model="searchQuery"
                        type="text"
                        class="w-full focus:outline-hidden h-[50px] pl-12 md:pl-5 pr-12 rounded-md bg-light-orange"
                        placeholder=""
                        @keydown.esc="closeSearch"
                    />
                    <svg
                        class="absolute text-olive right-4 top-1/2 transform  pointer-events-none"
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
                    <div v-if="filteredResults.length" @enter="onEnter" @after-enter="onAfterEnter" @leave="onLeave" class="w-full absolute left-0 h-fit top-22  mx-auto -mt-3 mb-4 bg-white   rounded-md shadow p-4">
                        <ul  class="relative mt-2 w-full z-50">
                            <li
                                v-for="item in filteredResults"
                                :key="item.id"
                                class="p-4  hover:bg-gray-100 flex justify-between items-center gap-4"
                            >
                                <a href="#" class="flex gap-x-2">
                                    <img :src="item.image" alt="" class="w-10 h-10 object-cover rounded-md" />
                                    <div>
                                        <div class="flex items-center gap-x-2">
                                            <p v-html="highlightMatch(item.name)" class="font-normal text-[20px]"></p>
                                            <img class="w-[20px] h-[20px] " v-if="item.gender" :src="gender" alt="unisex">
                                        </div>
                                        <div class="flex">
                                            <p
                                                v-for="(color, index) in item.colors"
                                                :key="color"
                                                class="text-[16px] opacity-40 font-normal pr-2"
                                            >
                                                {{ color }}<span v-if="index < item.colors.length - 1">,</span>
                                            </p>


                                        </div>

                                    </div>
                                </a>
                                <p class="text-sm text-olive font-bold">{{ item.price.toFixed(2) }} lei</p>


                            </li>
                        </ul>
                    </div>
                    <div v-else-if="hasSearchNoResults" @enter="onEnter" @after-enter="onAfterEnter" @leave="onLeave" class="w-full absolute left-0 h-fit top-22  mx-auto -mt-3 mb-4 bg-white   rounded-md shadow p-4">
                        <div>
                            <p class="text-[14px]">No relevant results found</p>
                            <p class="text-[14px] opacity-60 font-normal">You can change your query or choose from suggested search options</p>
                            <div class="flex  flex-wrap gap-x-6 gap-y-2 mt-4">
                                <a href="#" v-for="item in recommended" class="flex items-center gap-x-2">
                                    <img class="opacity-60" :src="loop" alt="recommended">
                                    <p class="text-[14px]">{{item}}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>
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
            open: false,

            searchQuery: '',
            searchIcon,loop,gender,back,
            isMobile: window.innerWidth < 1021,
            items: [
                {
                    id: 1,
                    name: 'Summer Cotton Jumpsuit',
                    colors: ['Beige', 'Pink', 'White', 'Gray', 'Ivory'],
                    image: img1,
                    price: 240,
                    size:['0–12M', '0–8M'],
                    gender:true
                },
                {
                    id: 2,
                    name: 'Fleece Jumpsuit',
                    colors: ['Beige', 'Pink', 'White', 'Gray',],
                    image: img2,
                    price: 236,
                    size:['0–12M'],
                    gender:false
                },
                {
                    id: 3,
                    name: 'Elegant Jumpsuit',
                    colors: ['White', 'Gray',],
                    image: img1,
                    price: 435,
                    size:['0–12M'],
                    gender:true
                },
                {
                    id: 4,
                    name: 'Cotton Jumpsuit',
                    colors: ['White', 'Gray',],
                    image: img1,
                    price: 315,
                    size:['0–12M'],
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
        }
    },

    methods: {
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
            this.isMobile = window.innerWidth < 1021;
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
