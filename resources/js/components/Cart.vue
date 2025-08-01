
<script>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'
import clickOutside from '@/clickOutside';
import { emitter } from '@/eventBus'
import iconTrash from '@img/common/trash.svg'
import { useI18n } from 'vue-i18n'
import BaseCheckbox from "@/components/ui/BaseCheckbox.vue";
// import {emitter} from "@/eventBus.js";
export default {
    name: 'Cart',
    components: {BaseCheckbox},

    directives: {
        clickOutside,
    },
    data(){
        return {
            iconTrash,
            cartItems: [],
        }
    },
    setup(){
        const { t, locale } = useI18n()


        const getColorById = (item, id) => {
            return item.product.variants
                .map(v => v.color)
                .find(c => c.id === id);
        }
        // Отримати назву розміру за id
        const getSizeNameById = (item, id) => {
            const size = item.product.variants
                .map(v => v.size)
                .find(s => s.id === id)
            return size ? size.name[locale.value] : ''
        }

        // Коли обирають розмір
        const selectSize = (item, sizeId) => {
            item.selectedSizeId = sizeId
            item.sizeDropdownOpen = false
            updateAvailableColors(item)
        }

        // Коли обирають колір
        const selectColor = (item, colorId) => {
            item.selectedColorId = colorId
            item.colorDropdownOpen = false
        }

        // Отримати список унікальних розмірів (для dropdown)
        const getUniqueSizes = (item) => {
            const seen = new Set()
            return item.product.variants
                .map(v => v.size)
                .filter(s => {
                    if (seen.has(s.id)) return false
                    seen.add(s.id)
                    return true
                })
        }

        // Отримати кольори, доступні лише для обраного розміру
        const getAvailableColors = (item) => {
            if (!item.selectedSizeId) return []

            const seen = new Set()
            return item.product.variants
                .filter(v => v.size.id === item.selectedSizeId)
                .map(v => v.color)
                .filter(c => {
                    if (seen.has(c.id)) return false
                    seen.add(c.id)
                    return true
                })
        }

        // Після вибору розміру, оновлюємо список доступних кольорів
        const updateAvailableColors = (item) => {
            const colors = getAvailableColors(item)
            console.log(colors)
            item.selectedColorId = colors.length ? colors[0].id : null
        }

        const getAllColorsWithAvailability = (item) => {
                const allColors = []
                const seen = new Set()

                const currentSizeId = item.selectedSizeId

                item.product.variants.forEach(variant => {
                    const { color, size } = variant
                    if (!seen.has(color.id)) {
                        seen.add(color.id)

                        const isAvailableForCurrentSize = item.product.variants.some(v =>
                            v.color.id === color.id && v.size.id === currentSizeId
                        )

                        allColors.push({
                            ...color,
                            available: isAvailableForCurrentSize,
                        })
                    }
                })

                return allColors
            }

        return {
            t,
            locale,

            // основні методи
            getUniqueSizes,
            getAvailableColors,
            updateAvailableColors,
            selectSize,
            selectColor,
            getSizeNameById,
            getColorById,
            getAllColorsWithAvailability

        }
    },


    methods: {

        async getCartItems() {
            try {
                const response = await window.axios.get(`${this.locale}/cart/items`)
                this.cartItems = response.data.items.map(item => ({
                    ...item,
                    selected: false,
                    selectedSizeId: item.size_id,
                    selectedColorId: item.color_id,
                    sizeDropdownOpen: false,
                    colorDropdownOpen: false,
                }));
                console.log(this.cartItems[0])
                // console.log(response) // TODO Remove in production
            } catch (error) {
                console.error('Server error:', error) // TODO Remove in production
            }
        },

        removeItem($itemHash) {
            axios.delete(`/cart/${$itemHash}`)
                .then(() => {
                    this.cartItems = this.cartItems.filter(item => item.id !== $itemHash);
                    emitter.emit('cart-updated');
                })
                .catch(err => {
                    console.error('Помилка при видаленні:', err)
                });
        },





    },
    mounted() {
        this.getCartItems();
    },

}
</script>

<template>

    <div class="mb-4 inline-block relative text-5xl font-bold leading-[62px] tracking-[-2%] text-charcoal/80">
        <h1>{{$t('cart.title')}}</h1>
        <p class="absolute w-7 h-6 py-2 px-3 flex justify-center items-center text-white text-xl font-bold  rounded-full -right-10 top-0 bg-olive">
            <span class="p-2">{{ cartItems.length }}</span>
            <span class="absolute -z-1 -bottom-[2px] left-1/12 rotate-95 w-4 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-olive"></span>
        </p>

    </div>

    <div
        v-for="cartItem in cartItems"
        :key="cartItem.id"
        class="">

        <div class="flex justify-between items-center my-2">

            <div class="flex items-center gap-x-6">
                <div class="flex gap-x-6">

                    <div class="p-2 bg-light-orange rounded-2xl">
                        <img class="w-[84px]" :src='cartItem.img' alt="{{cartItem.name}}">
                    </div>
                </div>
                <div>
                    <div>
                        <p class="text-[20px] font-medium">{{cartItem.name}}</p>
                        <p class="opacity-60">{{cartItem.price / 100}} lei</p>
                    </div>
                    <div class="flex gap-x-2">

                        <div class="relative min-w-32">
                            <div
                                class="border border-light-border px-3 py-1 rounded w-full flex justify-between items-center"
                                @click="cartItem.sizeDropdownOpen = !cartItem.sizeDropdownOpen"
                                v-click-outside="() => cartItem.sizeDropdownOpen = false"

                            >
                                <p>{{ getSizeNameById(cartItem, cartItem.selectedSizeId) || cartItem.size }}</p>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <ul
                                v-if="cartItem.sizeDropdownOpen"
                                class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded shadow-md max-h-60 overflow-auto"
                            >
                                <li
                                    v-for="size in getUniqueSizes(cartItem)"
                                    :key="size.id"
                                    @click="selectSize(cartItem, size.id)"
                                    class="px-3 py-2 cursor-pointer hover:bg-gray-100"
                                >
                                    {{ size.name[locale] }}
                                </li>
                            </ul>
                        </div>

                        <!-- Випадаючий список кольору -->
                        <div class="relative min-w-32" >
                            <div
                                class="border border-light-border px-3 py-1 rounded w-full flex justify-between items-center"
                                @click="cartItem.colorDropdownOpen = !cartItem.colorDropdownOpen"
                                v-click-outside="() => cartItem.colorDropdownOpen = false"
                            >

                                <p class="flex items-center gap-x-2">
                                    <span
                                    v-if="cartItem.selectedColorId || cartItem.hex"
                                    class="block min-w-5 min-h-5 rounded-full border border-light-border"
                                    :style="{ backgroundColor: getColorById(cartItem, cartItem.selectedColorId)?.hex || cartItem.hex }"
                                    ></span>
                                    {{ getColorById(cartItem, cartItem.selectedColorId)?.name[locale] || getColorById(cartItem, cartItem.color_id)?.name[locale] }}

                                </p>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <ul
                                v-if="cartItem.colorDropdownOpen"
                                class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded shadow-md max-h-60 overflow-auto"
                            >
                                <li
                                    v-for="color in getAllColorsWithAvailability(cartItem)"
                                    :key="color.id"
                                    @click="color.available && selectColor(cartItem, color.id)"
                                    class="px-3 flex gap-x-2 py-2 cursor-pointer hover:bg-gray-100"
                                    :class="{
                                        'hover:bg-gray-100 cursor-pointer': color.available,
                                        'opacity-50 cursor-not-allowed': !color.available
                                      }"
                                >
                                        <span
                                            class="w-5 h-5 block rounded-full border border-light-border"
                                            :style="{ backgroundColor: color.hex }"
                                        ></span>
                                     {{ color.name[locale] }}
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
            <div class="flex justify-between flex-col min-h-full gap-6">
                <div class="flex justify-end">
                    <p class="text-olive">{{ (cartItem.price / 100) * cartItem.quantity }} lei</p>
                </div>
                <div
                    @click="removeItem(cartItem.id)"
                    class="flex justify-end items-center gap-2 text-olive bg-light-orange py-1 px-4 rounded-lg cursor-pointer">
                    <img :src="iconTrash" alt="">
                    <p class="text-[14px]">Delete</p>
                </div>
            </div>
        </div>
        <hr class="my-4 border-light-border"></hr>
    </div>

</template>
