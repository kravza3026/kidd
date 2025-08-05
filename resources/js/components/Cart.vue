
<script>
import { ref, computed, watch, onMounted, onUnmounted,getCurrentInstance } from 'vue'
import clickOutside from '@/clickOutside';
import { emitter } from '@/eventBus'
import iconTrash from '@img/common/trash.svg'
import iconTrashMobile from '@img/icons/trash_b.png'
import iconCheck from '@img/icons/checked_white.svg'
import iconDelete from '@img/icons/close.svg'
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
            iconTrash,iconCheck,iconDelete,iconTrashMobile,
            cartItems: [],
        }
    },
    setup(){
        const { locale, t, n } = useI18n()
        const isMobile = ref(false)
        const { proxy } = getCurrentInstance()

        const checkIsMobile = () => {
            isMobile.value = window.innerWidth <= 768 // наприклад, 768px як межа
        }

        onMounted(() => {
            checkIsMobile()
            window.addEventListener('resize', checkIsMobile)
        })

        onUnmounted(() => {
            window.removeEventListener('resize', checkIsMobile)
        })


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
            updateItem(item)

        }

        // Коли обирають колір
        const selectColor = (item, colorId) => {
            item.selectedColorId = colorId
            item.colorDropdownOpen = false
            updateSelectedPrice(item)
            updateItem(item)
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
        const max = 30
        const increment = (item) => {
            if (item.quantity < max) {
                item.quantity++
                updateItem(item)
            }
        }

        const decrement = (item) => {
            if (item.quantity > min) {
                item.quantity--
                updateItem(item)
            }
        }

        const updateSelectedPrice = (item) => {
            const variant = item.product.variants.find(v =>
                v.size.id === item.selectedSizeId && v.color.id === item.selectedColorId
            )
            item.selectedPriceOnline = variant?.price_online ?? 0
            item.selectedPriceFinal = variant?.price_final ?? 0
            item.selectedDiscount = variant?.discount_amount ?? 0
        }

        const cartTotalOnline = computed(() => {
            return proxy.cartItems.reduce((total, item) => {
                return total + item.selectedPriceOnline * item.quantity
            }, 0)
        })

        const cartTotal = computed(() => {
            return proxy.cartItems.reduce((total, item) => {
                return total + item.selectedPriceFinal * item.quantity
            }, 0)
        })

        const totalDiscount = computed(() => {
            return proxy.cartItems.reduce((acc, item) => {
                const discount = item.selectedDiscount || 0
                return acc + (discount * item.quantity)
            }, 0)
        })

        const updateItem = async (item) => {
            const variant = item.product.variants.find(v =>
                v.size.id === item.selectedSizeId && v.color.id === item.selectedColorId
            )
            if (!variant) return;

            try {
                await axios.put(`/cart/${item.hash}`, {
                       arguments:{
                           variant_id: variant.id,
                           quantity: item.quantity
                       }
                });
                emitter.emit('cart-updated');
            } catch (err) {
                console.error('Server error:', err);
            }
        }

        const toggleConfirm = (item) => {
            item.showConfirm = !item.showConfirm
        }

        const removeItem = async (item) => {
            try {
                await axios.delete(`/cart/${item.hash}`)
                proxy.cartItems = proxy.cartItems.filter(i => i.hash !== item.hash)
                emitter.emit('cart-updated')
            } catch (err) {
                console.error('Server error:', err)
            }
        }




        return {
            t,n,
            locale,
            selectIcon,
            isMobile,
            // основні методи
            getUniqueSizes,
            getAvailableColors,
            updateSelectedPrice,
            updateAvailableColors,
            selectSize,
            selectColor,
            getSizeNameById,
            getColorById,
            getAllColorsWithAvailability,
            increment, decrement,
            cartTotal,totalDiscount,cartTotalOnline,
            toggleConfirm,removeItem

        }
    },

    methods: {

        async getCartItems() {
            try {
                const response = await window.axios.get(`${this.locale}/cart/items`)
                const grandTotal = response.data.grand_total;
                const total = response.data.total;
                console.log('total:', total / 100 );
                console.log('Grand total:', grandTotal / 100); // MDL
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
                        selectedPriceOnline: selectedVariant?.price_online ?? 0,
                        selectedPriceFinal: selectedVariant?.price_final ?? 0,
                        selectedDiscount: selectedVariant?.discount_amount ?? 0,
                        sizeDropdownOpen: false,
                        colorDropdownOpen: false,
                        showConfirm: false,
                    }
                })
                console.log(response)
            } catch (error) {
                console.error('Server error:', error) // TODO Remove in production
            }
        },



    },
    mounted() {
        this.getCartItems();

    },
}
</script>

<template>

   <div class="w-full  lg:flex justify-between gap-x-16">
       <div class="w-full basis-full">
           <div class="mb-4 inline-block relative text-5xl font-bold leading-[62px] tracking-[-2%] text-charcoal/80">
               <h1>{{ $t('cart.title') }}</h1>
               <p class="absolute w-7 h-6 py-2 px-3 flex justify-center items-center text-white text-sm font-extrabold rounded-full -right-10 top-0 bg-olive">
                   <span class="p-2">{{ cartItems.length }}</span>
                   <span class="absolute -z-1 -bottom-[2px] left-1/12 rotate-95 w-4 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-olive"></span>
               </p>
           </div>
            <div class=" border lg:border-none border-light-border rounded-lg mb-7 md:px-5 lg:px-0 shadow-sm lg:shadow-none py-1">

                <div

                    v-for="(cartItem, index) in cartItems"
                    :key="cartItem.hash"
                    class="w-full relative">
                    <div v-if="isMobile"

                    >
                        <div class="grid grid-cols-12 gap-x-3 items-center  justify-between  my-2 py-2 px-3">
                            <div class="col-span-3 max-w-[100px] h-fit px-1 py-2 flex justify-center bg-light-orange rounded-2xl">
                                <img class="max-w-[80px]" :src='cartItem.img' alt="{{cartItem.name}}">
                            </div>
                            <div class="col-span-9">
                                <div class="h-full flex flex-col justify-between">
                                    <div>
                                        <a :href="cartItem.product.url" class="text-[20px] font-medium">{{cartItem.name}}</a>
                                        <div class="flex items-center gap-x-2 mt-1">
                                            <div class="border-r-light-border border-r-2 pr-2 flex items-center gap-x-2">
                                                <div class="size-5 rounded-full border border-light-border" :style="{ backgroundColor: getColorById(cartItem, cartItem.selectedColorId)?.hex || cartItem.hex }"></div>
                                                <p class="text-[14px] opacity-40">{{cartItem.color.name}}</p>
                                            </div>
                                            <p class="text-[14px] opacity-40">{{cartItem.size.name}}</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center w-full">
                                        <div class="py-2 flex items-center gap-x-2 justify-between w-full">
                                            <p>
                                                {{cartItem.quantity}} x
                                                <span>{{ $n(cartItem.selectedPriceFinal / 100, 'currency') }}</span>
                                                <span class="text-[14px] opacity-40 line-through px-1">{{$n(cartItem.selectedPriceOnline / 100, 'currency')}}</span>

<!--                                                {{ $n(cartItem.selectedPriceFinal, 'currency') }}-->
                                            </p>
                                            <p class="text-olive text-[16px] font-bold">
                                                {{$n((cartItem.selectedPriceFinal / 100) * cartItem.quantity,'currency') }}
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div
                                    v-click-outside="() => cartItem.showConfirm = false"
                                    @click="toggleConfirm(cartItem)"
                                    class="absolute col-span-2 flex justify-center items-center h-fit  right-2 top-1 ">
                                    <div class="text-olive  p-2 rounded-full border border-light-border  cursor-pointer">
                                        <img :src="iconTrashMobile" alt="" />
                                    </div>


                                    <transition name="fade-slide" appear>
                                        <div
                                            v-if="cartItem.showConfirm"
                                            class="absolute w-full -left-1 grid gap-x-2 flex-col gap-y-2 justify-between items-center -bottom-14"
                                        >
                                            <div
                                                class=" duration-300 transition-all ease-in-out shadow-sm rounded-lg w-10  py-1 px-0 flex items-center justify-center bg-olive h-5"
                                                @click="toggleConfirm(cartItem)"
                                            >
                                                <img class="size-3" :src="iconDelete" alt="icon remove" />
                                            </div>
                                            <div
                                                @click="removeItem(cartItem)"
                                                class=" duration-300 transition-all ease-in-out shadow-sm rounded-lg w-10 text-center py-1 px-0 flex justify-center bg-danger h-5"
                                            >
                                                <img class="size-3" :src="iconCheck" alt="" />
                                            </div>
                                        </div>
                                    </transition>

                                </div>


                        </div>
                        <hr v-if="index < cartItems.length - 1" class="border-light-border" />
                    </div>


                    <div v-else >
                        <div class="grid grid-cols-12 justify-between items-center my-2 py-2">
                            <div class="col-span-10 flex items-center gap-x-6">
                                <div class="flex gap-x-6">
                                    <div class="p-2 bg-light-orange rounded-2xl">
                                        <img class="w-[84px]" :src='cartItem.img' alt="{{cartItem.name}}">
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <a :href="cartItem.product.url" class="text-[20px] font-medium">{{cartItem.name}}</a>
                                        <div class="flex gap-x-2">
                                            <p class="opacity-60 pb-5">{{ $n(cartItem.selectedPriceFinal / 100, 'currency') }}</p>
                                            <p class="opacity-40 pb-5 line-through">{{ $n(cartItem.selectedPriceOnline / 100, 'currency') }} lei</p>
                                        </div>

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
                                                class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
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
                                                class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
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

                            <div class="col-span-2 grid justify-end content-between min-h-full gap-6">
                                <div class="flex justify-end">
                                    <p class="text-olive font-bold">{{$n((cartItem.selectedPriceFinal / 100) * cartItem.quantity,'currency') }}</p>
                                </div>
                                <div
                                    v-click-outside="() => cartItem.showConfirm = false"
                                    @click="toggleConfirm(cartItem)"
                                    class="flex justify-end content-between h-fit w-fit gap-x-2 text-olive bg-light-orange border border-light-border py-2 px-4 rounded-lg shadow-sn shadow-olive cursor-pointer relative">
                                    <img :src="iconTrash" alt="" />
                                    <p class="text-[14px] font-bold">Delete</p>


                                    <transition name="fade-slide" appear>
                                        <div
                                            v-if="cartItem.showConfirm"
                                            class="absolute w-full right-0 flex gap-x-2 justify-between items-center -bottom-8"
                                        >
                                            <div
                                                class="hover:opacity-100 opacity-85 duration-300 transition-all ease-in-out shadow-sm rounded-2xl w-full text-center py-1 flex justify-center bg-olive h-5"
                                                @click="toggleConfirm(cartItem)"
                                            >
                                                <img :src="iconDelete" alt="" />
                                            </div>
                                            <div
                                                @click="removeItem(cartItem)"
                                                class="hover:opacity-100 opacity-85 duration-300 transition-all ease-in-out shadow-sm rounded-2xl w-full text-center py-1 flex justify-center bg-danger h-5"
                                            >
                                                <img :src="iconCheck" alt="" />
                                            </div>
                                        </div>
                                    </transition>

                                </div>
                            </div>
                        </div>
                        <hr class="my-4 border-light-border" />
                    </div>

                </div>
            </div>
       </div>
       <!--  Summary  -->
       <div class="w-full sticky top-10 grow-5 flex-shrink-0 basis-[340px] h-fit flex border border-[#eeeeee]/70 rounded-xl shadow-sm">
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
                            {{ $n(cartTotalOnline/100,'currency') }}
                        </span>
                       </div>


                       <div class="flex w-full justify-between">
                            <span class="font-normal text-base tracking-[-2%] text-charcoal/40">
                               Discount
                            </span>
                           <span class="font-medium text-base tracking-[-2%] text-charcoal">
                                {{ $n(totalDiscount,'currency')}}
                            </span>
                       </div>

                   </div>

                   <div class="flex w-full pt-6 justify-between">
                    <span class="font-medium text-base tracking-[-2%] text-charcoal">
                        Grand total
                    </span>
                       <span class="font-extrabold text-base tracking-[-2%] text-charcoal">
                      {{ $n(cartTotal/100, 'currency') }}
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

<!--<style scoped>-->
<!--.fade-slide-enter-active,-->
<!--.fade-slide-leave-active {-->
<!--    transition: opacity 0.2s ease, transform 0.2s ease;-->
<!--}-->

<!--.fade-slide-enter-from {-->
<!--    opacity: 0;-->
<!--    transform: translateY(8px);-->
<!--}-->

<!--.fade-slide-enter-to {-->
<!--    opacity: 1;-->
<!--    transform: translateY(0);-->
<!--}-->

<!--.fade-slide-leave-from {-->
<!--    opacity: 1;-->
<!--    transform: translateY(0);-->
<!--}-->

<!--.fade-slide-leave-to {-->
<!--    opacity: 0;-->
<!--    transform: translateY(8px);-->
<!--}-->

<!--</style>-->
