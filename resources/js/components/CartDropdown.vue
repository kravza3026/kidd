<template>
    <div class="cart relative cursor-pointer " ref="dropdown" @click="toggle">
       <div class="group relative">
           <img :src="cartIcon" width="24" height="24" alt="cart" class="">
            <div v-if="cartItems.length > 0" class="absolute flex items-center justify-center -top-2 -right-2 bg-olive rounded-full p-1 w-[16px] h-[16px]">
                <span class="text-[10px] text-white">{{cartItems.length}}</span>
            </div>

           <div class="absolute left-2/3 -translate-x-2/5 top-full mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
               Cart
               <div class="absolute -top-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
           </div>
       </div>

        <!-- full dropdown cart menu -->
        <transition name="slide-fade" @click.stop>
            <div
                v-if="open"
                class="absolute cursor-auto light_border -right-10 top-full mt-4 w-100 bg-white shadow-xl rounded-md z-50 "
            >
                <i class="w-[15px] h-[15px] block absolute right-1/7 -top-2 rotate-45 border-l border-t border-light-border bg-white translate-x-2/5 "></i>

                <div v-if="cartItems.length > 0">
                    <div class="flex justify-between p-4 border-b border-b-light-border">
                        <h3 class="text-lg font-bold mb-2">My cart</h3>
                        <p class="font-bold text-[14px] opacity-40">3 products</p>
                    </div>
                    <ul  class="p-4 space-y-3 border-b border-b-light-border max-h-[40vh] overflow-y-auto">
                        <li v-for="item in cartItems" :key="item.id" class="flex justify-between gap-4 mb-6">
                            <div class="flex gap-x-2">
                                <div class="bg-card-bg p-1 rounded-2xl">
                                    <img class="w-[54px] h-[54px]" :src="item.img" :alt="item.name">
                                </div>
                                <div>
                                    <p class="font-semibold">{{ item.name }}</p>
                                    <div class="flex">
                                        <div class="flex items-center gap-x-2 border-r pr-2 border-r-light-border">
                                            <span class="h-4 w-4 light_border rounded-full" :style="{ backgroundColor: item.color }"></span>
                                            <p class="opacity-40 font-normal text-[14px]">{{item.colorName}}</p>
                                        </div>
                                        <p class="opacity-40 font-normal text-[14px] pl-2">{{item.size}}</p>
                                    </div>
                                    <p class="text-sm text-black">x{{ item.quantity }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-olive">{{item.price}} lei</p>
                            </div>
                        </li>
                    </ul>
                    <div class="flex justify-between p-4">
                        <h3 class="text-lg font-bold mb-2">Grand total</h3>
                        <p class=" text-[18px]">570 lei</p>
                    </div>
                    <div class="px-4">
                        <Button customClass="mx-auto mt-0 w-full">View full cart</Button>
                    </div>
                </div>

                <div v-else class="text-center p-4 grid justify-center ">
                    <img class="mx-auto py-4" :src="basket_empty" alt="">
                    <div class="py-4">
                        <p class="py-1 text-[18px]">Cart is empty</p>
                        <p class="py-1 opacity-60 text-[14px] font-normal">Let’s find something cute</p>
                    </div>
                    <Button customClass="mx-auto mt-0 w-full">Explore outfits</Button>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import cartIcon from '@img/cart.svg';
import basket_empty from '@img/basket_empty.svg';
import Button from '@/components/Button.vue';
import img1 from '@img/products/product_3.png'
import img2 from '@img/products/product_2.png'
export default {
    name: 'CartDropdown',
    components: {
        Button,
    },
    data() {
        return {
            open: false,
            cartIcon,
            basket_empty,
            cartItems: [
                { id: 1, name: 'Summer Cotton Jumpsuit', quantity: 2, price: 240, color:'#020202',img:img1, colorName:'Black', size:'0–3M' },
                { id: 2, name: 'Thin Pants', quantity: 1, price: 330, color:'#ECE1DE',img:img2, colorName:'Beige', size:'6–9M' },
            ],
        };
    },
    methods: {
        toggle() {
            this.open = !this.open;
        },
        handleClickOutside(event) {
            const dropdown = this.$refs.dropdown;
            if (dropdown && !dropdown.contains(event.target)) {
                this.open = false;
            }
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

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease;
}
.slide-fade-enter-from {
    opacity: 0;
    transform: translateY(-10px);
}
.slide-fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
