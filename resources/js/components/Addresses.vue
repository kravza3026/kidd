<script>
import {reactive, ref} from 'vue'
import Button from "@/components/ui/Button.vue";
import SubscribeForm from "@/components/ui/subscribeForm.vue";
import BaseCheckbox from "@/components/ui/BaseCheckbox.vue";
import clickOutside from "@/clickOutside.js";
import iconMarker from "@img/icons/marker_outline.png"
import iconFavorite from "@img/icons/favorite_white.png"
import iconTrash from "@img/common/trash.svg"
import iconSettings from "@img/icons/Settings_base.svg"
import iconClose from '@img/icons/close.svg'
import iconCheck from '@img/icons/checked_white.svg'
import selectIcon from "@img/icons/select-arrows.svg"
import BaseInput from "@/components/ui/BaseInput.vue";
import {debounce} from "lodash";
import {useForm} from "laravel-precognition-vue";

const addressTemplate = {
    address_type: null,
    label: '',
    is_default: false,
    region_id: '',
    city_id: '',
    street_name: '',
    building: '',
    apartment: '',
    entrance: '',
    floor: '',
    postal_code: '',
    intercom: '',
};
export default {
     name: 'Addresses',
     components: {BaseInput, Button, SubscribeForm, BaseCheckbox},

     directives: {
         clickOutside,
     },
     data(){
         return {

             form: useForm('post', '/user/addresses', { ...addressTemplate }),

             locale: document.documentElement.lang || 'ro',
             addresses: reactive([]),
             regions: ref([]),
             cities: [],
             _isAddingAddress: ref(false),

             defaults: {
                 city: {
                     id: 0,
                     name: {
                         'ro': 'Select City',
                         'ru': 'Select City',
                         'en': 'Select City',
                     },
                 },
                 region: {
                     id: 0,
                     name: {
                         'ro': 'Select district',
                         'ru': 'Select district',
                         'en': 'Select district',
                     },
                 },
                 editor: {
                     isEditing: true,
                     dropdownCityOpen: false,
                     dropdownDistrictOpen: false,
                     confirmingDelete: false
                 },
             },

             iconMarker,iconFavorite,iconTrash,selectIcon,iconSettings,iconClose,iconCheck,
         }
     },

     methods: {

         async getAddresses() {

             await window.axios.get(`/user/addresses`)
                 .then((response) => {
                     this.addresses = response.data.addresses.map(address => ({
                         ...address,
                         form: useForm('post', '/user/addresses', {
                             ...address
                         })
                     }));

                     console.log(this.addresses)
                 }).catch((error) => {
                    console.error('Server error:', error)
                 });

         },

         async getRegions(region_id = null) {

             await window.axios.get(`/regions`, {
                     params: {
                         region_id: region_id ?? null
                     }
                 })
                 .then((response) => {
                     this.regions = response.data.regions;
                    console.log(response.data)
                 }).catch((error) => {
                    console.error('Server error:', error)
                 });

         },

         async getCities(region_id = null) {

             await window.axios.get(`/cities`, {
                     params: {
                         region_id: region_id ?? null
                     }
                 })
                 .then((response) => {
                     this.cities = response.data.cities;
                    console.log(response.data)
                 }).catch((error) => {
                    console.error('Server error:', error)
                 });

         },

         addNewAddress(address_type) {
             if (this._isAddingAddress) return;
             this._isAddingAddress = true;
             const newAddress = {
                 ...addressTemplate,
                 address_type,
                 form: useForm('post', '/user/addresses', {
                     label: '',
                     is_default: false,
                     region_id: '',
                     city_id: '',
                     street_name: '',
                     building: '',
                     apartment: '',
                     entrance: '',
                     floor: '',
                     postal_code: '',
                     intercom: '',
                 }),
                 city: { ...this.defaults.city },
                 region: { ...this.defaults.region },
                 editor: { ...this.defaults.editor },
                 isNew: true
             };
             console.log('newAddress== ', newAddress)
             this.addresses.push(newAddress);

             setTimeout(() => {
                 this._isAddingAddress = false;
                 newAddress.editor.dropdownDistrictOpen = true;
             }, 300);
         },



         createAddress(address_type) {
             const newAddress = this.addresses.find(addr => addr.isNew);

             if (!newAddress) {
                 console.error('No new address found');
                 return;
             }
             newAddress.form.address_type = address_type;
             newAddress.form.submit()
                 .then(response => {
                     console.log('response',response.data)
                     this.form.reset();
                     alert('Address created.');
                     console.info(response.data);
                 })
                 .catch(error => {

                     console.error(error.response.data.message);
                 });
         },

         async saveAddress(id) {
             const index = this.addresses.findIndex(addr => addr.id === id);
             if (index === -1) {
                 console.error("Address with id", id, "not found");
                 return;
             }
             const address = this.addresses[0];


             try {
                 console.log('address= ', address)
                 const { data } = await window.axios.post(
                     '/user/addresses',
                     address
                 );

                 console.log("Address saved:", data);

                 // Оновлюємо ID, якщо він приходить з сервера
                 if (data.address?.id) {
                     address.id = data.address.id;
                 }

             } catch (error) {

                 console.error("Save error:", error.response?.data || error);
             }
         },

         confirmRemoveAddress(id) {
             const index = this.addresses.findIndex(addr => addr.id === id);
             if (index !== -1) {
                 this.addresses.splice(index, 1);
             }
         },

         toggleEdit(id) {
             const index = this.addresses.findIndex(address => address.id === id);
             if (index !== -1) {
                 this.addresses[index].editor.isEditing = !this.addresses[index].editor.isEditing;
             }

         },
         validateField(index, fieldName) {
             this.addresses[index].form.validate(fieldName);
         },
         async removeAddress(id) {

             const index = this.addresses.findIndex(address => address.id === id);
             if (index !== -1) {
                 this.addresses.splice(index, 1);
             }
         }
     },
     mounted() {
         this.getAddresses()
         this.getRegions()
     }
 }
</script>
<template>
    <div class=" bg-white shadow sm:rounded-xl p-5">
        <h1 class="text-[24px] font-bold">Shipping addresses</h1>
        <!--    Type 4 = Shipping-->
        <form @submit.prevent="createAddress(4)" v-for="(address, index) in addresses.filter(a => a.address_type === 4)"
             :key="address.id" class="location duration-500 my-4 border border-light-border rounded-xl p-5">
            <div  class="flex items-center justify-between ">
                <div class="flex items-center gap-x-2">
                    <div class="p-2 bg-light-orange rounded-full">
                        <img class="opacity-65" :src="iconMarker" alt="">
                    </div>
                    <div class="relative">
                        <p v-if="address.form.invalid('label')" class="text-[12px] text-red-500 absolute w-full text-nowrap -top-5">{{ address.form.errors.label }}</p>
                        <BaseInput
                            :disabled="!address.editor.isEditing"
                            customClass="p-0 min-h-7.5 placeholder-text-sm"
                            name="label"
                            id="label"
                            v-model="address.form.label"
                            aria-label="label"
                            @change="address.form.validate('label')"
                            class="shadow-sm text-charcoal/60 rounded-2xl focus:outline-hidden duration-500 font-bold text-[20px]"
                            :class="{
                          'cursor-not-allowed border-none !shadow-none': !address.editor.isEditing,
                          '!shadow-red-500': address.editor.isEditing && address.form.invalid('label'),
                          '!shadow-olive': address.editor.isEditing && address.form.valid('label')
                        }"

                        />
                    </div>

                </div>
                <div class="flex items-center gap-x-2">


                    <button v-if="address.is_default" class="gradient_r-b_dark relative shadow-sm cursor-pointer">
                        <span class="absolute inset-0 bg-black/15 rounded-full"></span>
                        <div class="flex items-center gap-x-2 relative z-10 py-2 px-3">
                            <img :src="iconFavorite" alt="">
                            <p class="text-white font-bold text-sm">Default</p>
                        </div>
                    </button>
                    <button v-else class=" relative border border-light-border shadow-sm cursor-pointer rounded-full">
                        <div class="flex items-center justify-center gap-x-2 relative z-10 py-2 px-3">
                            <p class="text-olive font-bold text-sm">Make default</p>
                        </div>
                    </button>
                    <div
                        class="cursor-pointer group p-2 border border-light-border rounded-full shadow-sm relative"
                        @click="address.editor.confirmingDelete = !address.editor.confirmingDelete"
                        v-click-outside="() => address.editor.confirmingDelete = false"
                    >
                        <img class="size-4" :src="iconTrash" alt="" />
                        <div class="absolute left-2/3 -translate-x-2/5 -top-10 mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                            {{ $t('address.delete') }}
                            <div class="absolute -bottom-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
                        </div>
                        <transition name="fade-slide" appear>
                            <div

                                v-if="address.editor.confirmingDelete"
                                class="absolute w-[100px] -right-9 flex gap-x-2 justify-between items-center -bottom-8"
                            >
                                <!-- Cancel -->
                                <div
                                    class="hover:opacity-100 opacity-85 duration-300 transition-all ease-in-out shadow-sm rounded-2xl  text-center py-1 flex justify-center bg-olive w-full h-5"
                                    @click.stop="address.editor.confirmingDelete = false"
                                >
                                    <img :src="iconClose" alt="" />
                                </div>

                                <!-- Confirm -->
                                <div
                                    class="hover:opacity-100 opacity-85 duration-300 transition-all ease-in-out shadow-sm rounded-2xl w-full text-center py-1 flex justify-center bg-danger h-5"
                                    @click.stop="confirmRemoveAddress(address.id)"
                                >
                                    <img :src="iconCheck" alt="" />
                                </div>
                            </div>
                        </transition>
                    </div>
                    <button class="settings cursor-pointer p-2 border border-light-border  rounded-full shadow-sm duration-500 relative group"
                            :class="{'text-olive': !address.editor.isEditing,'text-white bg-olive': address.editor.isEditing}"
                            type="button"
                            @click="toggleEdit(address.id)"
                    >
                        <div class="absolute left-2/3 -translate-x-2/5 -top-10 mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                            {{ $t('address.edit') }}
                            <div class="absolute -bottom-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
                        </div>
                        <svg class="size-4" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7238 1.0313C12.7664 -0.343766 14.8336 -0.343766 15.8762 1.0313L16.2293 1.49696C16.7982 2.24724 17.7277 2.63222 18.6605 2.50397L19.2394 2.42437C20.949 2.18931 22.4107 3.65102 22.1756 5.3606L22.096 5.93954C21.9678 6.87235 22.3528 7.80178 23.103 8.37068L23.5687 8.72377C24.9438 9.76642 24.9438 11.8336 23.5687 12.8762L23.103 13.2293C22.3528 13.7982 21.9678 14.7277 22.096 15.6605L22.1756 16.2394C22.4107 17.949 20.949 19.4107 19.2394 19.1756L18.6605 19.096C17.7277 18.9678 16.7982 19.3528 16.2293 20.103L15.8762 20.5687C14.8336 21.9438 12.7664 21.9438 11.7238 20.5687L11.3707 20.103C10.8018 19.3528 9.87235 18.9678 8.93954 19.096L8.3606 19.1756C6.65102 19.4107 5.18931 17.949 5.42437 16.2394L5.50397 15.6605C5.63222 14.7277 5.24724 13.7982 4.49696 13.2293L4.0313 12.8762C2.65623 11.8336 2.65623 9.76642 4.0313 8.72377L4.49696 8.37068C5.24724 7.80178 5.63222 6.87235 5.50397 5.93954L5.42437 5.3606C5.18931 3.65102 6.65102 2.18931 8.3606 2.42437L8.93954 2.50397C9.87235 2.63222 10.8018 2.24724 11.3707 1.49696L11.7238 1.0313Z" fill="currentColor" fill-opacity="0.15"/>
                            <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M9.92377 2.23125C10.9664 0.856185 13.0336 0.856185 14.0762 2.23125L14.4293 2.69691C14.9982 3.44719 15.9277 3.83218 16.8605 3.70392L17.4394 3.62432C19.149 3.38926 20.6107 4.85097 20.3756 6.56055L20.296 7.13949C20.1678 8.0723 20.5528 9.00173 21.303 9.57064L21.7687 9.92372C23.1438 10.9664 23.1438 13.0335 21.7687 14.0762L21.303 14.4293C20.5528 14.9982 20.1678 15.9276 20.296 16.8604L20.3756 17.4394C20.6107 19.1489 19.149 20.6106 17.4394 20.3756L16.8605 20.296C15.9277 20.1677 14.9982 20.5527 14.4293 21.303L14.0762 21.7687C13.0336 23.1437 10.9664 23.1437 9.92377 21.7687L9.57068 21.303C9.00178 20.5527 8.07234 20.1677 7.13954 20.296L6.5606 20.3756C4.85102 20.6106 3.38931 19.1489 3.62437 17.4394L3.70397 16.8604C3.83222 15.9276 3.44724 14.9982 2.69695 14.4293L2.23129 14.0762C0.856231 13.0335 0.856231 10.9664 2.23129 9.92372L2.69695 9.57064C3.44724 9.00173 3.83222 8.0723 3.70397 7.13949L3.62437 6.56055C3.38931 4.85097 4.85102 3.38926 6.5606 3.62432L7.13954 3.70392C8.07234 3.83218 9.00178 3.44719 9.57068 2.69691L9.92377 2.23125Z" stroke="currentColor" stroke-width="2"/>
                        </svg>

                    </button>
                </div>
            </div>

            <div class="grid grid-cols-17 justify-between gap-x-4 my-4 w-full">

                <!-- District dropdown -->
                <div class="relative col-span-3 rounded-lg shadow-sm">
                    <div
                        class="border border-light-border px-3 py-1 rounded-lg  w-full flex justify-between items-center"
                        :class="{'cursor-not-allowed': !address.editor.isEditing,'': address.editor.isEditing}"
                        @click="address.editor.isEditing && (address.editor.dropdownDistrictOpen = !address.editor.dropdownDistrictOpen)"
                        v-click-outside="() => address.editor.dropdownDistrictOpen = false"
                    >
                        <input type="hidden"  name="region_id" v-model="address.form.region_id" >
                        <p class="flex items-center opacity-60 text-sm">
                            {{ address.region.name[locale] ?? address.region.name['ro'] }}
                        </p>
                        <img :src="selectIcon" alt="selectIcon" class="duration-500"
                             :class="{'opacity-0': !address.editor.isEditing,'opacity-40': address.editor.isEditing}"   />
                    </div>

                    <ul
                        v-if="address.editor.dropdownDistrictOpen"
                        class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
                    >
                        <li
                            v-for="region in regions"
                            :key="region.id"
                            class="px-3 text-xs flex gap-x-2 py-2 cursor-pointer hover:bg-gray-100"
                            @click="this.getCities(region.id); address.form.region_id = region.id; address.form.region = region; address.editor.dropdownDistrictOpen = false"
                        >
                            {{ region.name[locale] ?? region.name['ro'] }}
                        </li>
                    </ul>

                </div>

                <!-- City dropdown -->
                <div class="relative col-span-3 rounded-lg shadow-sm">
                    <div
                        class="border border-light-border px-3 py-1 rounded-lg w-full flex justify-between items-center "
                        :class="{'cursor-not-allowed': !address.editor.isEditing,'': address.editor.isEditing}"
                        @click="address.editor.isEditing && (address.editor.dropdownCityOpen = !address.editor.dropdownCityOpen)"
                        v-click-outside="() => address.editor.dropdownCityOpen = false"
                    >
                        <input type="hidden"  name="city_id" v-model="address.form.city_id" >
                        <p class="flex items-center opacity-60 text-sm">

                            {{ address.city?.name[locale] || address.city?.name['ro'] || 'Select city' }}

                        </p>
                        <img class="duration-500" :src="selectIcon"  alt="selectIcon"
                        :class="{'opacity-0': !address.editor.isEditing,'opacity-40': address.editor.isEditing}"  />
                    </div>

                    <ul
                        v-if="address.editor.dropdownCityOpen"
                        class="absolute z-10 w-full text-xs mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
                    >
                        <li
                            v-for="city in cities"
                            :key="city.id"
                            class="px-3 flex gap-x-2 py-2 cursor-pointer hover:bg-gray-100"
                            @click="address.form.city_id = city.id; address.form.city = city; address.editor.dropdownCityOpen = false"

                        >
                            {{ city.name[locale] ?? city.name['ro'] }}
                        </li>
                    </ul>
                </div>


               <BaseInput
                   :disabled="!address.editor.isEditing"
                   customClass="p-0 h-7.5 placeholder-text-sm"
                   name="street"
                   id="street"
                   placeholder="str."
                   v-model="address.form.street_name"
                   aria-label="street"
                   class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-3 duration-500"
               />


                <BaseInput
                    :disabled="!address.editor.isEditing"
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="building"
                    id="building"
                    placeholder="bl."
                    v-model="address.form.building"
                    aria-label="building"
                    class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-2 duration-500"
                />
                <BaseInput
                    :disabled="!address.editor.isEditing"
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="apartment"
                    id="apartment"
                    placeholder="ap."
                    v-model="address.form.apartment"
                    aria-label="apartment"
                    class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-2 duration-500"
                />
                <BaseInput
                    :disabled="!address.editor.isEditing"
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="entrance"
                    id="entrance"
                    placeholder="sc."
                    v-model="address.form.entrance"
                    aria-label="entrance"
                    class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-2 duration-500"
                />
                <BaseInput
                    :disabled="!address.editor.isEditing"
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="floor"
                    id="floor"
                    placeholder="et."
                    v-model="address.form.floor"
                    aria-label="floor"
                    class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-2 duration-500"
                />
                </div>
            <div class="flex justify-end">
                <Button  v-if="address.isNew" @click="createAddress(4)" customClass="mx-auto !m-0 p-0 h-1" :class="{'hidden':!address.editor.isEditing}">Create {{index}}</Button>

                <Button  v-else @click="updateAddress(address.id)" customClass="mx-auto !m-0 p-0 h-1" :class="{'hidden':!address.editor.isEditing}">Save</Button>
            </div>
        </form>
<!--            Type 4 = Shipping -->
        <Button

            @click="addNewAddress(4)"
            customClass="py-2 md:py-2 w-fit"
            class="font-bold flex items-center"><span class="text-[24px]">+</span> Add new address

        </Button>

<!--        <hr>-->
<!--        ===================================================================================================-->
<!--        <br>=== Validation Examples and methods / Playground-->
<!--        <br> input more than 3 characters for Error-->
<!--        <br> input less than 3 characters for Valid-->
<!--        ===================================================================================================-->
<!--        <hr>-->

<!--        <form @submit.prevent="createAddress(4)" class="location duration-500 my-4 border border-light-border rounded-xl p-5">-->
<!--            <div class="flex items-center justify-between">-->

<!--                <div class="flex items-center gap-x-2">-->
<!--                    <div class="p-2 bg-light-orange rounded-full">-->
<!--                        <img class="opacity-65" :src="iconMarker" alt="">-->
<!--                    </div>-->
<!--                    <BaseInput-->
<!--                        customClass="p-0 min-h-7.5 placeholder-text-sm"-->
<!--                        name="label"-->
<!--                        id="label"-->
<!--                        :value="form.label"-->
<!--                        v-model="form.label"-->
<!--                        aria-label="label"-->
<!--                        class="shadow-sm text-charcoal/60 rounded-2xl focus:outline-hidden duration-500 font-bold text-[20px]"-->
<!--                        @change="form.validate('label')"-->
<!--                    />-->

<!--                    &lt;!&ndash;                // input specific&ndash;&gt;-->
<!--                    <span v-if="form.valid('label')">-->
<!--                        ✅-->
<!--                    </span>-->
<!--                    <span v-else-if="form.invalid('label')">-->
<!--                        ❌-->
<!--                    </span>-->

<!--                </div>-->

<!--                &lt;!&ndash;                // input specific&ndash;&gt;-->
<!--                <div>-->
<!--                    <br/>-->
<!--                    <span class="flex w-full text-xs text-red-500" v-if="form.invalid('label')">-->
<!--                        {{ form.errors.label }}-->
<!--                    </span>-->
<!--                </div>-->

<!--                &lt;!&ndash;                //form general&ndash;&gt;-->
<!--                <div>-->
<!--                    <div v-if="form.invalid('label')">-->
<!--                        {{ form.errors.email }}-->
<!--                    </div>-->
<!--                    <div v-if="form.processing">-->
<!--                        Processing...-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <input class="size-3 disabled:bg-red-500" :disabled="form.processing">-->
<!--                    </div>-->
<!--                    <div v-if="form.validating">-->
<!--                        Validating...-->
<!--                    </div>-->
<!--                    <div v-if="form.hasErrors">-->
<!--                        Form has errors-->
<!--                    </div>-->
<!--                </div>-->

<!--            </div>-->

<!--            <div class="flex justify-end">-->
<!--                <Button @click="createAddress(4)" display-as="a" type="submit" customClass="mx-auto !m-0 p-0 h-1">-->
<!--                    Save-->
<!--                </Button>-->
<!--            </div>-->
<!--        </form>-->

    </div>

    <div class=" mt-5 bg-white shadow sm:rounded-xl p-5">
        <h1 class="text-[24px] font-bold">Billing addresses</h1>
<!--        Type 4 = Billing-->
        <form v-for="(address, index) in addresses.filter(a => a.address_type === 3)"
             :key="address.id" class="location duration-500 my-4 border border-light-border rounded-xl p-5">
            <div  class="flex items-center justify-between ">
                <div class="flex items-center gap-x-2">
                    <div class="p-2 bg-light-orange rounded-full">
                        <img class="opacity-65" :src="iconMarker" alt="">
                    </div>
                    <BaseInput
                        :disabled="!address.editor.isEditing"
                        customClass="p-0 min-h-7.5 placeholder-text-sm"
                        name="username"
                        id="username"
                        :required="true"
                        :value="address.label"
                        v-model="address.label"
                        aria-label=""
                        class="shadow-sm text-charcoal/60 rounded-2xl focus:outline-hidden duration-500 font-bold text-[20px]"
                        :class="{'cursor-not-allowed border-none !shadow-none': !address.editor.isEditing,'': address.editor.isEditing}"
                    />

                </div>
                <div class="flex items-center gap-x-2">


                    <button type="button" v-if="address.is_default" class="gradient_r-b_dark relative shadow-sm cursor-pointer">
                        <span class="absolute inset-0 bg-black/15 rounded-full"></span>
                        <div class="flex items-center gap-x-2 relative z-10 py-2 px-3">
                            <img :src="iconFavorite" alt="">
                            <p class="text-white font-bold text-sm">Default</p>
                        </div>
                    </button>
                    <button type="button" v-else class=" relative border border-light-border shadow-sm cursor-pointer rounded-full">
                        <div class="flex items-center justify-center gap-x-2 relative z-10 py-2 px-3">
                            <p class="text-olive font-bold text-sm">Make default</p>
                        </div>
                    </button>
                    <button type="button"
                        class="cursor-pointer p-2 border border-light-border rounded-full shadow-sm"
                        @click="removeAddress(address.id)"
                    >
                        <img class="size-4" :src="iconTrash" alt="">
                    </button>
                    <button type="button" class="settings cursor-pointer p-2 border border-light-border  rounded-full shadow-sm duration-500"
                            :class="{'text-olive': !address.editor.isEditing,'text-white bg-olive': address.editor.isEditing}"
                            @click="toggleEdit(address.id)"
                    >
                        <svg class="size-4" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7238 1.0313C12.7664 -0.343766 14.8336 -0.343766 15.8762 1.0313L16.2293 1.49696C16.7982 2.24724 17.7277 2.63222 18.6605 2.50397L19.2394 2.42437C20.949 2.18931 22.4107 3.65102 22.1756 5.3606L22.096 5.93954C21.9678 6.87235 22.3528 7.80178 23.103 8.37068L23.5687 8.72377C24.9438 9.76642 24.9438 11.8336 23.5687 12.8762L23.103 13.2293C22.3528 13.7982 21.9678 14.7277 22.096 15.6605L22.1756 16.2394C22.4107 17.949 20.949 19.4107 19.2394 19.1756L18.6605 19.096C17.7277 18.9678 16.7982 19.3528 16.2293 20.103L15.8762 20.5687C14.8336 21.9438 12.7664 21.9438 11.7238 20.5687L11.3707 20.103C10.8018 19.3528 9.87235 18.9678 8.93954 19.096L8.3606 19.1756C6.65102 19.4107 5.18931 17.949 5.42437 16.2394L5.50397 15.6605C5.63222 14.7277 5.24724 13.7982 4.49696 13.2293L4.0313 12.8762C2.65623 11.8336 2.65623 9.76642 4.0313 8.72377L4.49696 8.37068C5.24724 7.80178 5.63222 6.87235 5.50397 5.93954L5.42437 5.3606C5.18931 3.65102 6.65102 2.18931 8.3606 2.42437L8.93954 2.50397C9.87235 2.63222 10.8018 2.24724 11.3707 1.49696L11.7238 1.0313Z" fill="currentColor" fill-opacity="0.15"/>
                            <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M9.92377 2.23125C10.9664 0.856185 13.0336 0.856185 14.0762 2.23125L14.4293 2.69691C14.9982 3.44719 15.9277 3.83218 16.8605 3.70392L17.4394 3.62432C19.149 3.38926 20.6107 4.85097 20.3756 6.56055L20.296 7.13949C20.1678 8.0723 20.5528 9.00173 21.303 9.57064L21.7687 9.92372C23.1438 10.9664 23.1438 13.0335 21.7687 14.0762L21.303 14.4293C20.5528 14.9982 20.1678 15.9276 20.296 16.8604L20.3756 17.4394C20.6107 19.1489 19.149 20.6106 17.4394 20.3756L16.8605 20.296C15.9277 20.1677 14.9982 20.5527 14.4293 21.303L14.0762 21.7687C13.0336 23.1437 10.9664 23.1437 9.92377 21.7687L9.57068 21.303C9.00178 20.5527 8.07234 20.1677 7.13954 20.296L6.5606 20.3756C4.85102 20.6106 3.38931 19.1489 3.62437 17.4394L3.70397 16.8604C3.83222 15.9276 3.44724 14.9982 2.69695 14.4293L2.23129 14.0762C0.856231 13.0335 0.856231 10.9664 2.23129 9.92372L2.69695 9.57064C3.44724 9.00173 3.83222 8.0723 3.70397 7.13949L3.62437 6.56055C3.38931 4.85097 4.85102 3.38926 6.5606 3.62432L7.13954 3.70392C8.07234 3.83218 9.00178 3.44719 9.57068 2.69691L9.92377 2.23125Z" stroke="currentColor" stroke-width="2"/>
                        </svg>

                    </button>
                </div>
            </div>

            <div class="grid grid-cols-17 justify-between gap-x-4 my-4 w-full">

                <!-- District dropdown -->
                <div class="relative col-span-3 rounded-lg shadow-sm">
                    <div
                        class="border border-light-border px-3 py-1 rounded-lg  w-full flex justify-between items-center"
                        :class="{'cursor-not-allowed': !address.editor.isEditing,'': address.editor.isEditing}"
                        @click="address.editor.isEditing && (address.editor.dropdownDistrictOpen = !address.editor.dropdownDistrictOpen)"
                        v-click-outside="() => address.editor.dropdownDistrictOpen = false"
                    >
                        <p class="flex items-center opacity-60 text-sm">
                            {{ address.region.name[locale] ?? 'Select district' }}
                        </p>
                        <img :src="selectIcon" alt="selectIcon" class="duration-500"
                             :class="{'opacity-0': !address.editor.isEditing,'opacity-40': address.editor.isEditing}"   />
                    </div>

                    <ul
                        v-if="address.editor.dropdownDistrictOpen"
                        class="absolute z-10 w-full text-xs mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
                    >
                        <li
                            v-for="region in regions"
                            :key="region.id"
                            class="px-3 flex gap-x-2 py-2 cursor-pointer hover:bg-gray-100"
                            @click="this.getCities(region.id); address.region_id = region.id; address.region = region; address.editor.dropdownDistrictOpen = false"
                        >
                            {{ region.name[locale ?? 'ro'] }}
                        </li>
                    </ul>

                </div>

                <!-- City dropdown -->
                <div class="relative col-span-3 rounded-lg shadow-sm">
                    <div
                        class="border border-light-border px-3 py-1 rounded-lg w-full flex justify-between items-center "
                        :class="{'cursor-not-allowed': !address.editor.isEditing,'': address.editor.isEditing}"
                        @click="address.editor.isEditing && (address.editor.dropdownCityOpen = !address.editor.dropdownCityOpen)"
                        v-click-outside="() => address.editor.dropdownCityOpen = false"
                    >
                        <p class="flex items-center opacity-60 text-sm">
                            {{ address.city?.name[locale ?? 'ro'] ?? 'Select city' }}
                        </p>
                        <img class="duration-500" :src="selectIcon"  alt="selectIcon"
                             :class="{'opacity-0': !address.editor.isEditing,'opacity-40': address.editor.isEditing}"  />
                    </div>

                    <ul
                        v-if="address.editor.dropdownCityOpen"
                        class="absolute z-10 w-full text-xs mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
                    >
                        <li
                            v-for="city in cities"
                            :key="city.id"
                            class="px-3 flex gap-x-2 py-2 cursor-pointer hover:bg-gray-100"
                            @click="address.city_id = city.id; address.city = city; address.editor.dropdownCityOpen = false"

                        >
                            {{ city.name[locale ?? 'ro'] }}
                        </li>
                    </ul>
                </div>

                <BaseInput
                    :disabled="!address.editor.isEditing"
                    customClass="p-0 h-7.5 placeholder-text-sm"
                    name="street"
                    id="street"
                    :value="address.street_name"
                    v-model="address.street_name"
                    aria-label="street"
                    class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-3 duration-500"
                />
                <BaseInput
                    :disabled="!address.editor.isEditing"
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="building"
                    id="building"
                    :value="address.building"
                    v-model="address.building"
                    aria-label="building"
                    class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-2 duration-500"
                />
                <BaseInput
                    :disabled="!address.editor.isEditing"
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="apartment"
                    id="apartment"
                    :value="address.apartment"
                    v-model="address.apartment"
                    aria-label="apartment"
                    class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-2 duration-500"
                />
                <BaseInput
                    :disabled="!address.editor.isEditing"
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="entrance"
                    id="entrance"
                    :value="address.entrance"
                    v-model="address.entrance"
                    aria-label="entrance"
                    class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-2 duration-500"
                />
                <BaseInput
                    :disabled="!address.editor.isEditing"
                    customClass="p-0 min-h-7.5 placeholder-text-sm"
                    name="floor"
                    id="floor"
                    :value="address.floor"
                    v-model="address.floor"
                    aria-label="floor"
                    class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-2 duration-500"
                />
            </div>
            <div class="flex justify-end">
                <Button type="submit" customClass="mx-auto !m-0 p-0 h-1" :class="{'hidden':!address.editor.isEditing}">Save</Button>
            </div>
        </form>
        <button>
<!--            Type 4 = Billing-->
            <Button
                customClass="py-2 md:py-2 w-fit"
                @click="addNewAddress(3)"
                class="font-bold flex items-center"><span class="text-[24px]">+</span> Add new address
            </Button>
        </button>
    </div>
</template>

<style scoped>
.fade-slide-enter-active, .fade-slide-leave-active {
    transition: all 0.3s ease;
}
.fade-slide-enter-from, .fade-slide-leave-to {
    opacity: 0;
    transform: translateY(5px);
}
</style>
