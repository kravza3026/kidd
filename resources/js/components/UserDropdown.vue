<template>
    <div class="cart relative cursor-pointer " ref="dropdownUser" @click="toggle">
       <div class="group relative">
           <img :src="profileIcon" alt="cart" class="w-[24px] h-[24px] xl:w-[32px] xl:h-[32px]">
            <div class="absolute left-2/3 -translate-x-2/5 top-full mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
               Account
               <div class="absolute -top-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
           </div>
       </div>

        <!-- full dropdown cart menu -->
        <transition name="slide-fade" @click.stop>
            <div v-if="open"
                class="fixed inset-0 h-[calc(100%-162px)] lg:h-fit lg:inset-auto left-0 lg:-right-10 w-full p-5 lg:p-0  lg:absolute cursor-auto border-t lg:border-light-border  top-[72px] lg:top-full lg:mt-4 lg:w-100 bg-white lg:shadow-xl lg:rounded-md z-50 "
            >
                <i class="w-[15px] h-[15px] hidden lg:block absolute right-1/7 -top-2 rotate-45 border-l border-t border-light-border bg-white translate-x-2/5 "></i>

                <div v-if="!isAuthenticated" class="p-7">
                    <h3 class="text-xl">{{ $t ? $t('user-dropdown.login') : 'Sign In' }}</h3>
                    <div class="mt-4">
                        <form id="loginForm" name="authLogin" @keydown.enter.prevent="handleLogin">
                            <div>
                                <label class="text-[14px]" for="email">E-mail</label>
                                <input type="email" name="email" id="email" class="focus:border-light-border focus:outline-hidden w-full mt-1 p-3 border-1 rounded-xl border-light-border">
                                <p v-if="errors.email" class="text-danger text-sm mt-1">{{ errors.email[0] }}</p>
                            </div>

                            <div class="mt-4">
                                <label class="text-[14px]" for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter your password"
                                       class="focus:border-light-border focus:outline-hidden w-full mt-1 p-3 border-1 rounded-xl border-light-border">
                                <p v-if="errors.password" class="text-danger text-sm mt-1">{{ errors.password[0] }}</p>
                            </div>

                            <p class="text-olive mt-4 underline">Forgot password?</p>

                        </form>
                    </div>

                    <Button @click.passive="handleLogin" display-as="a" type="submit" customClass="mx-auto py-3 mt-4 w-full text-white">
                        {{ $t ? $t('user-dropdown.login') : 'Sign In' }}
                    </Button>

                    <p class="font-normal  text-center opacity-60 text-[14px]">New customer? <a href="/register" class="underline cursor-pointer font-bold">Register now</a></p>

                </div>
                <template v-else>
                    <div class="p-[15px]">
                        <p class="text-base text-dark-olive text-start">{{ user.name }}</p>
<!--                        <p class="text-xs text-dark text-start">{{ user.email }}</p>-->
                        <div class="rounded-xl light_border mt-4">
                            <a :href="route('profile.edit')" class="flex justify-between items-center rounded-t-xl  animated border-b border-b-light-border hover:bg-card-bg py-2 px-3  cursor-pointer">
                                <div class="flex items-center gap-x-4">
                                    <img class="w-[24px] h-[24px]" :src="Account" alt="arrow">
                                    <p class="text-[18px] font-normal">Profile</p>
                                </div>
                                <img class="opacity-20" :src="arrow" alt="arrow">
                            </a>
                            <a :href="route('favorites.index')" class="flex justify-between items-center animated border-b border-b-light-border hover:bg-card-bg py-2 px-3  cursor-pointer">
                                <div class="flex items-center gap-x-4">
                                    <img class="w-[24px] h-[24px]" :src="Favorite" alt="arrow">
                                    <p class="text-[18px] font-normal">Favorites</p>
                                    <p class="text-[12px] bg-charcoal/20 flex justify-center items-center px-1 font-[800] leading-0 rounded-full min-w-[16px] min-h-[16px] text-white">
                                        {{ user.favorites_count }}</p>
                                </div>
                                <img class="opacity-20" :src="arrow" alt="arrow">
                            </a>
                            <a :href="route('orders.index')" class="flex justify-between items-center animated border-b border-b-light-border hover:bg-card-bg py-2 px-3  cursor-pointer">
                                <div class="flex items-center gap-x-4">
                                    <img class="w-[24px] h-[24px]" :src="Order" alt="arrow">
                                    <p class="text-[18px] font-normal">Orders</p>
                                    <p class="text-[12px] bg-charcoal/20 flex justify-center items-center px-1 font-[800] leading-0 rounded-full min-w-[16px] min-h-[16px] text-white">
                                        {{ user.orders_count }}
                                    </p>
                                </div>
                                <img class="opacity-20" :src="arrow" alt="arrow">
                            </a>
                            <a :href="route('addresses.index')" class="flex justify-between items-center rounded-b-xl animated  hover:bg-card-bg py-2 px-3  cursor-pointer">
                                <div class="flex items-center gap-x-4">
                                    <img class="w-[24px] h-[24px]" :src="Address" alt="arrow">
                                    <p class="text-[18px] font-normal">Addresses</p>
                                    <p class="text-[12px] bg-charcoal/20 flex justify-center items-center px-1 font-[800] leading-0 rounded-full min-w-[16px] min-h-[16px] text-white">
                                        {{ user.addresses_count }}
                                    </p>
                                </div>
                                <img class="opacity-20" :src="arrow" alt="arrow">
                            </a>
                        </div>
                        <a :href="route('logout')" @click.prevent="handleLogout" class=" cursor-pointer flex gap-2 opacity-60 mt-4 justify-center items-center">
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
import profileIcon from '@img/user.svg';
import arrow from '@img/icons/profile/arrow.svg';
import logout from '@img/icons/profile/logout.svg';
import Account from '@img/icons/profile/Account.svg';
import Favorite from '@img/icons/profile/Favorite.svg';
import Address from '@img/icons/profile/Location.svg';
import Order from '@img/icons/profile/Order.svg';
import Button from "@/components/Button.vue";

export default {
    name: 'UserDropdown',
    components: {
        Button,
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
            profileIcon,arrow,Account,Favorite,Address,Order,logout,
            errors: {},
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
        handleLogin() {
            this.errors = {}; // Reset errors before login attempt
            // Handle login logic here
            const form = document.forms['authLogin'];
            const email = form.email.value;
            const password = form.password.value;

            window.axios.post( this.route('login'), { email, password })
                .then(response => {
                    // this.$emit('login', response.data);
                    // this.open = false;
                    window.location.reload(); // Reload to update user state
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                        console.log('Validation errors:');
                        console.dir( this.errors);
                    } else {
                        console.error('Login failed:', error);
                    }
                });
        },
        handleLogout() {
            // Handle logout logic here
            window.axios.post(this.route('logout'))
                .then(() => {
                    // this.$emit('logout');
                    // this.open = false;
                    window.location.reload(); // Reload to update user state
                })
                .catch(error => {
                    console.error('Logout failed:', error);
                });
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
