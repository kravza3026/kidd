<script>
import { ref } from 'vue'
import Button from "@/components/ui/Button.vue";
import SubscribeForm from "@/components/ui/subscribeForm.vue";
import BaseCheckbox from "@/components/ui/BaseCheckbox.vue";
import clickOutside from "@/clickOutside.js";
import iconMarker from "@img/icons/marker_outline.png"
import iconFavorite from "@img/icons/favorite_white.png"
import iconTrash from "@img/common/trash.svg"
import selectIcon from "@img/icons/select-arrows.svg"
import BaseInput from "@/components/ui/BaseInput.vue";
 export default {
     name: 'Addresses',
     components: {BaseInput, Button, SubscribeForm, BaseCheckbox},

     directives: {
         clickOutside,
     },
     data(){
         return {
             addresses: [
                 {
                     id: 1,
                     name: '<NAME>',
                     address: '1234567890',
                     city: 'New York',
                     state: 'NY',
                     zip: '10001',
                     country: 'USA',
                 }
             ],
             dropdownOpen: false,
             dropdownCityOpen: false,
             iconMarker,iconFavorite,iconTrash,selectIcon

         }
     },
     setup(){
         const dropdownOpen = ref(false)
         const dropdownCityOpen = ref(false)
     }
 }
</script>
<template>
    <div>
        <h1 class="text-[24px] font-bold">Shipping addresses</h1>
        <div class="location my-4 border border-light-border rounded-xl p-5">
            <div class="flex items-center justify-between ">
                <div class="flex items-center gap-x-2">
                    <div class="p-2 bg-light-orange rounded-full">
                        <img class="opacity-65" :src="iconMarker" alt="">
                    </div>
                    <p class="font-bold text-[20px]">Home</p>
                </div>
                <div class="flex items-center gap-x-2">
                    <button class="gradient_r-b_dark relative shadow-sm cursor-pointer">
                        <span class="absolute inset-0 bg-black/15 rounded-2xl"></span>
                        <div class="flex items-center gap-x-2 relative z-10 py-2 px-3">
                            <img :src="iconFavorite" alt="">
                            <p class="text-white font-bold text-[14px]">Default</p>
                        </div>
                    </button>
                    <button class="cursor-pointer p-2 border border-light-border rounded-full shadow-sm">
                        <img :src="iconTrash" alt="">
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-17 justify-between gap-x-4 my-4 w-full">
                <div class="relative col-span-3 rounded-lg shadow-sm">
                    <div
                        class="border border-light-border px-3 py-1 rounded-lg w-full flex justify-between items-center"
                        @click="dropdownCityOpen = !dropdownCityOpen"
                        v-click-outside="() => dropdownCityOpen = false"
                    >
                        <p class="flex items-center opacity-60 text-[14px]">
                            option
                        </p>
                        <img :src="selectIcon" class="opacity-40" alt="selectIcon" />
                    </div>

                    <ul
                        v-if="dropdownCityOpen"
                        class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
                    >
                        <li
                            class="px-3 flex gap-x-2 py-2 cursor-pointer hover:bg-gray-100"
                        >
                            option 2
                        </li>
                        <!-- Можна продублювати цей li вручну кілька разів -->
                    </ul>
                </div>
                <div class="relative col-span-3 rounded-lg shadow-sm">
                    <div
                        class="border border-light-border px-3 py-1 rounded-lg w-full flex justify-between items-center"
                        @click="dropdownOpen = !dropdownOpen"
                        v-click-outside="() => dropdownOpen = false"
                    >
                        <p class="flex items-center opacity-60 text-[14px]">
                            option
                        </p>
                        <img :src="selectIcon" class="opacity-40" alt="selectIcon" />
                    </div>

                    <ul
                        v-if="dropdownOpen"
                        class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
                    >
                        <li
                            class="px-3 flex gap-x-2 py-2 cursor-pointer hover:bg-gray-100"
                        >
                            option 2
                        </li>
                        <!-- Можна продублювати цей li вручну кілька разів -->
                    </ul>
                </div>
                <BaseInput
                    customClass="p-0 h-7.5 placeholder-text-sm"
                    name="username"
                    id="username"
                    placeholder=""
                    aria-label="Ім’я користувача"
                    class="shadow-sm text-charcoal/60 text-[14px] rounded-2xl focus:outline-hidden col-span-3"
                />
                <BaseInput
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="username"
                    id="username"
                    placeholder=""
                    aria-label="Ім’я користувача"
                    class="shadow-sm text-charcoal/60 text-[14px] rounded-2xl focus:outline-hidden col-span-2"
                />
                <BaseInput
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="username"
                    id="username"
                    placeholder=""
                    aria-label="Ім’я користувача"
                    class="shadow-sm text-charcoal/60 text-[14px] rounded-2xl focus:outline-hidden col-span-2"
                />
                <BaseInput
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="username"
                    id="username"
                    placeholder=""
                    aria-label="Ім’я користувача"
                    class="shadow-sm text-charcoal/60 text-[14px] rounded-2xl focus:outline-hidden col-span-2"
                />
                <BaseInput
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="username"
                    id="username"
                    placeholder=""
                    aria-label="Ім’я користувача"
                    class="shadow-sm text-charcoal/60 text-[14px] rounded-2xl focus:outline-hidden col-span-2"
                />

            </div>
        </div>

    </div>
</template>
