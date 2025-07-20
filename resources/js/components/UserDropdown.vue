<template>
    <div class="cart relative cursor-pointer " ref="dropdownUser" @click="toggle">
       <div class="group relative">
           <img :src="cartIcon" alt="cart" class="w-[24px] h-[24px] xl:w-[32px] xl:h-[32px]">
            <div class="absolute left-2/3 -translate-x-2/5 top-full mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
               Account
               <div class="absolute -top-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
           </div>
       </div>

        <!-- full dropdown cart menu -->
        <transition name="slide-fade" @click.stop>
            <div
                v-if="open"
                class="fixed inset-0 h-[calc(100%-162px)] md:h-fit md:inset-auto left-0 md:-right-10 w-full p-5 md:p-0  md:absolute cursor-auto border-t md:border-light-border  top-[72px] md:top-full md:mt-4 md:w-100 bg-white md:shadow-xl md:rounded-md z-50 "
            >
                <i class="w-[15px] h-[15px] hidden md:block absolute right-1/7 -top-2 rotate-45 border-l border-t border-light-border bg-white translate-x-2/5 "></i>

                <div v-if="!isAuthenticated" class="p-7">
                    <h3 class="text-xl">Sign in</h3>
                    <div class="mt-4">
                        <form>
                            <div>
                                <label class="text-[14px]" for="email">E-mail</label>
                                <input type="text" name="email" id="email" class="focus:border-light-border focus:outline-hidden w-full mt-1 p-3 border-1 rounded-xl border-light-border">
                            </div>

                            <div class="mt-4">
                                <label class="text-[14px]" for="email">Password</label>
                                <input type="text" name="email" id="password" placeholder="*******" class="focus:border-light-border focus:outline-hidden w-full mt-1 p-3 border-1 rounded-xl border-light-border">
                            </div>

                            <p class="text-olive mt-4 underline">Forgot password?</p>
                        </form>
                    </div>

                    <SimpleButton customClass="mx-auto mt-4 w-full  text-white">Log in</SimpleButton>
                    <p class="font-normal  text-center opacity-60 text-[14px]">New customer? <span class="underline cursor-pointer font-bold">Register now</span></p>

                </div>
                <template v-else>
                    <div class="p-[15px]">
                        <p class="text-lg text-start">{{userName}}</p>
                        <div class="rounded-xl light_border mt-4">
                            <div class="flex justify-between items-center rounded-t-xl  animated border-b border-b-light-border hover:bg-card-bg py-3 px-4  cursor-pointer">
                                <div class="flex items-center gap-x-4">
                                    <img class="w-[24px] h-[24px]" :src="Account" alt="arrow">
                                    <p class="text-[18px] font-normal">Profile</p>
                                </div>
                                <img class="opacity-20" :src="arrow" alt="arrow">
                            </div>
                            <div class="flex justify-between items-center animated border-b border-b-light-border hover:bg-card-bg py-3 px-4  cursor-pointer">
                                <div class="flex items-center gap-x-4">
                                    <img class="w-[24px] h-[24px]" :src="Favorite" alt="arrow">
                                    <p class="text-[18px] font-normal">Favorites</p>
                                    <p class="text-[12px] bg-charcoal/20 flex justify-center items-center px-1 font-[800] leading-0 rounded-full min-w-[16px] min-h-[16px] text-white">{{favorites}}</p>
                                </div>
                                <img class="opacity-20" :src="arrow" alt="arrow">
                            </div>
                            <div class="flex justify-between items-center animated border-b border-b-light-border hover:bg-card-bg py-3 px-4  cursor-pointer">
                                <div class="flex items-center gap-x-4">
                                    <img class="w-[24px] h-[24px]" :src="Order" alt="arrow">
                                    <p class="text-[18px] font-normal">Orders</p>
                                    <p class="text-[12px] bg-charcoal/20 flex justify-center items-center px-1 font-[800] leading-0 rounded-full min-w-[16px] min-h-[16px] text-white">{{orders}}</p>
                                </div>
                                <img class="opacity-20" :src="arrow" alt="arrow">
                            </div>
                            <div class="flex justify-between items-center rounded-b-xl animated  hover:bg-card-bg py-3 px-4  cursor-pointer">
                                <div class="flex items-center gap-x-4">
                                    <img class="w-[24px] h-[24px]" :src="Address" alt="arrow">
                                    <p class="text-[18px] font-normal">Addresses</p>
                                    <p class="text-[12px] bg-charcoal/20 flex justify-center items-center px-1 font-[800] leading-0 rounded-full min-w-[16px] min-h-[16px] text-white">{{addresses}}</p>
                                </div>
                                <img class="opacity-20" :src="arrow" alt="arrow">
                            </div>
                        </div>
                        <a href="#" class="flex gap-2 opacity-60 mt-4 justify-center items-center">
                            <img :src="logout" alt="logout">
                            <p>Log out</p>
                        </a>
                    </div>


                </template>

            </div>
        </transition>
    </div>
</template>

<script>
import cartIcon from '@img/user.svg';
import arrow from '@img/icons/profile/arrow.svg';
import logout from '@img/icons/profile/logout.svg';
import Account from '@img/icons/profile/Account.svg';
import Favorite from '@img/icons/profile/Favorite.svg';
import Address from '@img/icons/profile/Location.svg';
import Order from '@img/icons/profile/Order.svg';
import SimpleButton from '@/components/SimpleButton.vue';

export default {
    name: 'UserDropdown',
    components: {
        SimpleButton,

    },
    props: {
        isAuthenticated: {
            type: Boolean,
            default: false,
        },
        user: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            open: false,
            cartIcon,arrow,Account,Favorite,Address,Order,logout,
            // isAuthenticated: false,
            favorites: 24,
            orders:2,
            addresses:2,
            userName: 'Adam'
        };
    },
    methods: {
        toggle() {
            this.open = !this.open;
        },
        handleClickOutside(event) {
            const dropdown = this.$refs.dropdownUser;
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
