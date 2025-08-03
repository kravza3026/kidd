
<script>
import { ref, computed, watch, onMounted, onUnmounted,getCurrentInstance } from 'vue'
import clickOutside from '@/clickOutside';
import { emitter } from '@/eventBus'
import iconTrash from '@img/common/trash.svg'
import { useI18n } from 'vue-i18n'
import BaseCheckbox from "@/components/ui/BaseCheckbox.vue";
import SubscribeForm from "@/components/ui/subscribeForm.vue";
import selectIcon from "@img/icons/select-arrows.svg"
import logger from "pusher-js/src/core/logger.js";
import Button from "@/components/ui/Button.vue";
export default {
    name: 'Cart',
    components: {Button, SubscribeForm, BaseCheckbox},

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
        const { proxy } = getCurrentInstance()
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
            updateSelectedPrice(item)
        }

        // Коли обирають колір
        const selectColor = (item, colorId) => {
            item.selectedColorId = colorId
            item.colorDropdownOpen = false
            updateSelectedPrice(item)
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

        const min = 1
        const max = 99
        const increment = (item) => {
            if (item.quantity < max) {
                item.quantity++
            }
        }

        const decrement = (item) => {
            if (item.quantity > min) {
                item.quantity--
            }
        }

        const updateSelectedPrice = (item) => {
            const variant = item.product.variants.find(v =>
                v.size.id === item.selectedSizeId && v.color.id === item.selectedColorId
            )
            item.selectedPrice = variant?.price_final ?? 0
            item.selectedDiscount = variant?.discount_amount ?? 0
        }

        const cartTotal = computed(() => {
            return proxy.cartItems.reduce((total, item) => {
                return total + item.selectedPrice * item.quantity
            }, 0)
        })

        const totalDiscount = computed(() => {
            return proxy.cartItems.reduce((acc, item) => {
                const discount = item.selectedDiscount || 0
                return acc + (discount * item.quantity)
            }, 0)
        })



        return {
            t,
            locale,
            selectIcon,
            // основні методи
            getUniqueSizes,
            getAvailableColors,
            updateAvailableColors,
            selectSize,
            selectColor,
            getSizeNameById,
            getColorById,
            updateSelectedPrice,
            getAllColorsWithAvailability,
            increment, decrement,
            cartTotal,totalDiscount


        }
    },

    methods: {

        async getCartItems() {
            try {
                const response = await window.axios.get(`${this.locale}/cart/items`)

                this.cartItems = response.data.items.map(item => {
                    const selectedVariant = item.product.variants.find(v =>
                        v.size.id === item.size.id && v.color.id === item.color.id
                    )

                    return {
                        ...item,
                        quantity: item.quantity || 1,
                        selected: false,
                        selectedSizeId: item.size.id,
                        selectedColorId: item.color.id,
                        selectedPrice: selectedVariant?.price_final ?? 0,
                        selectedDiscount: selectedVariant?.discount_amount ?? 0,

                        sizeDropdownOpen: false,
                        colorDropdownOpen: false,
                    }
                })
                console.log(response)
            } catch (error) {
                console.error('Server error:', error) // TODO Remove in production
            }
        },

        async removeItem($itemHash) {
            await axios.delete(`/cart/${$itemHash}`)
                .then(() => {
                    this.cartItems = this.cartItems.filter(item => item.id !== $itemHash);
                    emitter.emit('cart-updated');
                })
                .catch(err => {
                    console.error('Server error:', err) // TODO Remove in production
                });
        },
    },
    mounted() {
        this.getCartItems();
    },
}
</script>

<template>
   <div class="w-full flex justify-between gap-x-16">
       <div class="w-full basis-full">
           <div class="mb-4 inline-block relative text-5xl font-bold leading-[62px] tracking-[-2%] text-charcoal/80">
               <h1>{{ $t('cart.title') }}</h1>
               <p class="absolute w-7 h-6 py-2 px-3 flex justify-center items-center text-white text-sm font-extrabold rounded-full -right-10 top-0 bg-olive">
                   <span class="p-2">{{ cartItems.length }}</span>
                   <span class="absolute -z-1 -bottom-[2px] left-1/12 rotate-95 w-4 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-olive"></span>
               </p>
           </div>

           <div
               v-for="cartItem in cartItems"
               :key="cartItem.id"
               class=" w-full">
               <div class="flex justify-between items-center my-2">
                   <div class="flex items-center gap-x-6">
                       <div class="flex gap-x-6">
                           <div class="p-2 bg-light-orange rounded-2xl">
                               <img class="w-[84px]" :src='cartItem.img' alt="{{cartItem.name}}">
                           </div>
                       </div>
                       <div>
                           <div>
                               <a :href="cartItem.product.url" class="text-[20px] font-medium">{{cartItem.name}}</a>
                               <p class="opacity-60 pb-5">{{ cartItem.selectedPrice / 100 }} lei</p>

                           </div>
                           <div class="flex gap-x-2">

                               <div class="relative min-w-42 shadow-sm rounded-lg">
                                   <div
                                       class="border border-light-border px-3 py-1 rounded-lg  w-full flex justify-between items-center"
                                       @click="cartItem.sizeDropdownOpen = !cartItem.sizeDropdownOpen"
                                       v-click-outside="() => cartItem.sizeDropdownOpen = false"

                                   >
                                       <p>{{ getSizeNameById(cartItem, cartItem.selectedSizeId) || cartItem.size }}</p>
                                       <img :src="selectIcon" alt="selectIcon">
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
                               <div class="relative min-w-42 rounded-lg shadow-sm" >
                                   <div
                                       class="border border-light-border px-3 py-1 rounded-lg w-full flex justify-between items-center"
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
                                       <img :src="selectIcon" alt="selectIcon">

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
                               <div
                                   class="flex justify-between min-w-24 items-center gap-x-2 border border-light-border rounded-lg shadow-sm px-2 py-1 select-none"
                               >
                                   <div class="font-bold cursor-pointer" @click="decrement(cartItem)">
                                       <p class="opacity-40">-</p>
                                   </div>
                                   <div>{{ cartItem.quantity }}</div>
                                   <div class="font-bold cursor-pointer" @click="increment(cartItem)">
                                       <p class="opacity-40">+</p>
                                   </div>
                               </div>

                           </div>
                       </div>
                   </div>
                   <div class="flex justify-between flex-col min-h-full gap-6">
                       <div class="flex justify-end">
                           <p class="text-olive">{{ ( (cartItem.selectedPrice / 100) * cartItem.quantity).toFixed(2) }} lei</p>
                       </div>
                       <div
                           @click="removeItem(cartItem.id)"
                           class="flex justify-end items-center gap-2 text-olive bg-light-orange py-1 px-4 rounded-lg cursor-pointer">
                           <img :src="iconTrash" alt="">
                           <p class="text-[14px]">Delete</p>
                       </div>
                   </div>
               </div>
               <hr class="my-4 border-light-border" />

           </div>
       </div>
       <!--  Summary  -->
       <div class="w-full sticky top-10 grow-5 flex-shrink-0 basis-[340px] h-fit flex border border-[#eeeeee]/70 rounded-xl shadow-lg">
           <div class="w-full grow-0  flex border border-[#eeeeee]/70 rounded-xl shadow-lg">
               <div class="text-nowrap static w-full h-auto p-6">
                   <h4 class="flex pb-6 w-full text-2xl text-gray-800 font-bold leading-6 tracking-[-2%]">
                       Order summary
                   </h4>

                   <div class="flex w-full flex-col py-6 border-y border-dark-snow space-y-4 ">
                       <div class="flex w-full justify-between ">
                        <span class="font-normal text-base tracking-[-2%] text-charcoal/40">
                            Products
                        </span>
                           <span class="font-medium text-base tracking-[-2%] text-charcoal">
                            {{ (cartTotal/100).toFixed(2) }} lei
                        </span>
                       </div>


                       <div class="flex w-full justify-between">
                            <span class="font-normal text-base tracking-[-2%] text-charcoal/40">
                               Discount
                            </span>
                           <span class="font-medium text-base tracking-[-2%] text-charcoal">
                                {{ (totalDiscount/100).toFixed(2)}} lei
                            </span>
                       </div>

                   </div>

                   <div class="flex w-full pt-6 justify-between">
                    <span class="font-medium text-base tracking-[-2%] text-charcoal">
                        Grand total
                    </span>
                       <span class="font-extrabold text-base tracking-[-2%] text-charcoal">
                      {{ (cartTotal/100).toFixed(2) }} lei
                    </span>
                   </div>

                   <div class="flex w-full pt-6">
                       <Button class="w-full" :href="`/checkout?total=${cartTotal}`" withArrow>Continue to checkout</Button>
                   </div>

               </div>
           </div>
       </div>
   </div>


    <SubscribeForm

                title = "Subscribe to newsletter and get 25% off your first order"
                secondaryTitle = "Receive the latest updates and take advantage of great offers"
                contentWidth = "w-full lg:flex justify-between gap-x-5 items-end bg-light-orange py-6 px-5 my-16 rounded-2xl"
                titleClass = "text-[24px] text-black"
                formClass = "w-full mt-5 lg:mt-0 lg:w-5/12"
                subtitleClass = "text-[14px]"

    ></SubscribeForm>
</template>
