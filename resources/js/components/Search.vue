<template>
    <div>
        <div
            class="search cursor-pointer w-full h-full flex items-center gap-x-5"
            @click="open = true"
        >
            <img :src="searchIcon" alt="search" width="24" height="24" />
            <span>Search</span>
        </div>

        <transition name="slide-fade" @enter="onEnter" @after-enter="onAfterEnter" @leave="onLeave">
            <div
                v-if="open"
                ref="searchWrapper"
                class="search-input absolute bottom-[20px] right-0 bg-white flex flex-col h-auto w-full z-50"
                @click.self="closeSearch"
            >
                <!-- Поле вводу -->
                <div class="relative flex items-center w-10/11 mx-auto pt-4">
                    <input
                        ref="searchInput"
                        v-model="searchQuery"
                        type="text"
                        class="w-full focus:outline-hidden h-[50px] pl-5 pr-12 rounded-md bg-light-orange"
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
                    <div v-if="filteredResults.length > 0" class="w-full absolute left-0 top-22  mx-auto -mt-3 mb-4 bg-white border border-light-border rounded-md shadow p-4">
                        <ul>
                            <li
                                v-for="(result, index) in filteredResults"
                                :key="index"
                                class="py-2 border-b last:border-b-0 hover:bg-gray-100 cursor-pointer"
                            >
                                {{ result }}
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Результати пошуку -->



            </div>
        </transition>
    </div>
</template>
<script>
import searchIcon from '@img/search.svg';

export default {
    name: 'Search',
    data() {
        return {
            open: false,
            searchQuery: '',
            searchIcon,
            items: ['apple', 'banana', 'carrot', 'cherry', 'grape', 'orange'], // приклад
        };
    },
    computed: {
        filteredResults() {
            if (!this.searchQuery.trim()) return [];
            const query = this.searchQuery.trim().toLowerCase();
            return this.items.filter(item =>
                item.toLowerCase().includes(query)
            );
        },
    },
    methods: {
        handleClickOutside(event) {
            if (
                this.open &&
                this.$refs.searchWrapper &&
                !this.$refs.searchWrapper.contains(event.target) &&
                !event.target.closest('.search')
            ) {
                this.closeSearch();
            }
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
    },
    mounted() {
        document.addEventListener('click', this.handleClickOutside);
    },
    beforeUnmount() {
        document.removeEventListener('click', this.handleClickOutside);
    },
};
</script>
