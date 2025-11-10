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
            searchIcon,
            loop,
            gender,
            back,
            isMobile: window.innerWidth < 1024,
            products: [],
            recommended: [],
        };
    },

    computed: {
        hasSearchNoResults() {
            return this.searchQuery.trim() !== '' && this.processed;
        },
    },

    created() {
        this.fetchTags();
    },

    methods: {
        async search() {
            if (!this.searchQuery.trim()) return [];

            const query = this.searchQuery.trim().toLowerCase();

            // TODO - set url from global storage and easy accessible.
            await axios
                .get('search', {
                    params: {
                        term: query,
                    },
                })
                .then((response) => {
                    this.products = response.data.results;
                    this.processed = true;
                })
                .catch((error) => {
                    console.error('Search error:', error);
                });
        },

        async fetchTags() {
            // TODO - Implement API tags for recommended searches.
            // TODO - Make them clickable, @click set as searchQuery
            this.recommended = [
                'summer cotton jumpsuit',
                'floral print summer dress',
                'summer shorts for boys',
                'floral sun hat',
                'blue sundress',
            ];
        },

        handleType: _.debounce(function () {
            this.search();
        }, 300),

        openSearchFromOutside() {
            this.$refs.searchInput?.focus();
        },

        handleClickOutside(event) {
            const wrapper = this.$refs.searchWrapper;
            const toggle = this.$refs.searchToggle;
            if (!this.open) return;
            if (wrapper && !wrapper.contains(event.target) && toggle && !toggle.contains(event.target)) {
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
        window.removeEventListener('toggle-mobile-search', this.openSearchFromOutside);
    },
};
</script>

<template>
    <div>
        <div
            ref="searchToggle"
            class="search hidden h-full w-full cursor-pointer items-center gap-x-5 lg:flex"
            @click="open = true"
        >
            <img :src="searchIcon" alt="search" height="24" width="24" />
            <span>{{ $t('menu.search') }}</span>
        </div>

        <transition name="slide-fade" @enter="onEnter" @leave="onLeave" @after-enter="onAfterEnter">
            <div
                v-show="open || isMobile"
                ref="searchWrapper"
                class="search-input absolute right-0 z-50 flex h-auto w-full flex-col bg-white px-3 lg:bottom-0"
            >
                <div class="relative mx-auto flex w-full items-center pt-0 lg:top-[-10px] lg:w-10/11">
                    <img
                        :src="back"
                        alt=""
                        class="border-r-light2-border absolute left-6 border-r py-2 pr-4 lg:hidden"
                    />
                    <input
                        ref="searchInput"
                        v-model="searchQuery"
                        class="bg-light-orange m-2 h-[50px] w-full rounded-md pr-12 pl-12 focus:outline-hidden lg:mx-0 lg:pl-5"
                        name="term"
                        placeholder=""
                        type="text"
                        @input="handleType"
                        @keydown.esc="closeSearch"
                    />
                    <svg
                        class="text-olive pointer-events-none absolute top-1/3 right-4 transform"
                        fill="none"
                        height="24"
                        viewBox="0 0 24 24"
                        width="24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M16.007 16.007L22 22M18.4103 10.2051C18.4103 14.7367 14.7367 18.4103 10.2051 18.4103C5.67356 18.4103 2 14.7367 2 10.2051C2 5.67356 5.67356 2 10.2051 2C14.7367 2 18.4103 5.67356 18.4103 10.2051Z"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        />
                    </svg>

                    <div
                        v-if="products.length"
                        class="absolute top-22 left-0 mx-auto mb-4 h-fit w-full overflow-auto rounded-md bg-white p-0 lg:top-[78px] lg:max-h-[50vh] lg:min-h-[267px] lg:shadow"
                        @enter="onEnter"
                        @leave="onLeave"
                        @after-enter="onAfterEnter"
                    >
                        <ul class="relative z-50 mt-2 w-full lg:mt-0">
                            <li
                                v-for="item in products"
                                :key="item.id"
                                class="border-b-light-border flex items-center justify-between gap-4 border-b px-2 py-4 hover:bg-gray-100 lg:p-4"
                            >
                                <a :href="item.url" class="flex w-full gap-x-4">
                                    <div
                                        class="bg-card-bg flex size-14 items-center justify-center rounded-md p-2 text-center"
                                    >
                                        <img
                                            :src="item.media[0].original_url"
                                            alt="product"
                                            class="max-h-[50px] max-w-[50px] rounded-md object-cover"
                                        />
                                    </div>
                                    <div class="flex w-full flex-col justify-evenly">
                                        <div class="flex w-full items-center justify-start gap-x-2">
                                            <p
                                                class="w-fit max-w-[calc(100%-20px)] text-base leading-5 font-normal lg:text-lg"
                                                v-html="highlightMatch(item.name[locale])"
                                            ></p>
                                            <div
                                                v-if="item.gender"
                                                :class="item.gender?.bg_color"
                                                class="group relative flex items-center justify-center rounded-full p-1"
                                            >
                                                <span
                                                    class="flex size-3 items-center"
                                                    v-html="item.gender?.svg ?? ''"
                                                ></span>
                                                <div
                                                    class="tooltip absolute top-full left-2/3 z-10 mt-2 w-max -translate-x-2/5 rounded-full bg-black px-3 py-1 text-sm text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                                                >
                                                    {{ item.gender?.name[locale] }}
                                                    <div
                                                        class="absolute -top-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-1 flex w-full flex-wrap items-center gap-x-[1px]">
                                            <p
                                                v-for="(variant, index) in item.variants"
                                                :key="variant.color.id"
                                                class="text-charcoal/40 pr-1 text-xs font-light tracking-tighter lg:pr-2 lg:text-base"
                                            >
                                                {{ variant.color.name[locale]
                                                }}<span v-if="index < item.variants.length - 1">,</span>
                                            </p>
                                            <span class="border-r-light2-border mr-2 block h-full border-r py-2"></span>
                                            <p
                                                v-for="(variant, index) in item.variants"
                                                :key="variant.size.id"
                                                class="text-charcoal/40 text-xs font-light lg:pr-2 lg:text-base"
                                            >
                                                {{ variant.size.name[locale]
                                                }}<span v-if="index < item.variants.length - 1">,</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid justify-items-end align-top">
                                        <p class="text-olive w-fit text-sm font-bold text-nowrap lg:text-base">
                                            {{ $n(item.variants[0]?.price_final / 100, 'currency', 'ro') }}
                                        </p>
                                        <p
                                            v-if="item.variants[0].price_online"
                                            class="text-charcoal/25 w-fit text-xs font-medium text-nowrap line-through lg:text-sm"
                                        >
                                            {{ $n(item.variants[0]?.price_online / 100, 'currency', 'ro') }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div
                        v-else-if="hasSearchNoResults"
                        class="absolute top-22 left-0 mx-auto -mt-3 mb-4 h-fit w-full rounded-md bg-white p-4 shadow"
                        @enter="onEnter"
                        @leave="onLeave"
                        @after-enter="onAfterEnter"
                    >
                        <div>
                            <p class="text-sm">No relevant results found</p>
                            <p class="text-sm font-normal opacity-60">
                                You can change your query or choose from suggested search options
                            </p>
                            <div class="mt-4 flex flex-wrap gap-x-6 gap-y-2">
                                <a v-for="item in recommended" class="flex items-center gap-x-2" href="#">
                                    <img :src="loop" alt="recommended" class="opacity-60" />
                                    <p class="text-sm">{{ item }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>
