<script>
import {reactive,onMounted, ref} from 'vue'
import Button from "@/components/ui/Button.vue";
import SubscribeForm from "@/components/ui/subscribeForm.vue";
import BaseCheckbox from "@/components/ui/BaseCheckbox.vue";
import clickOutside from "@/clickOutside.js";
import iconMarker from "@img/icons/marker_outline.png"
import iconFavorite from "@img/icons/favorite_white.svg"
import iconFavoriteOl from "@img/icons/favorite_olive.svg"
import iconTrash from "@img/common/trash.svg"
import iconNoAddress from "@img/common/empty_addresses.jpg"
import iconSettings from "@img/icons/Settings_base.svg"
import iconClose from '@img/icons/close.svg'
import iconCheck from '@img/icons/checked_white.svg'
import selectIcon from "@img/icons/select-arrows.svg"
import BaseInput from "@/components/ui/BaseInput.vue";
import {debounce} from "lodash";
import {useForm} from "laravel-precognition-vue";
import {useAlert} from "@/useAlert.js";
import logger from "pusher-js/src/core/logger.js";



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
         clickOutside
     },
        setup(){
            const { showAlert } = useAlert();
            return {showAlert}
        },
     data(){
         return {

             form: useForm('post', '/user/addresses', { ...addressTemplate }),

             locale: document.documentElement.lang || 'ro',
             addresses: reactive([]),
             regions: ref([]),
             cities: [],
             isAdding: {},
             types:[
                 {id:3, label: 'Shipping addresses'},
                 {id:4, label: 'Billing addresses'},
             ],
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
                     confirmingDelete: false,
                     wasValidated: false
                 },
             },

             iconMarker,iconFavorite,iconTrash,selectIcon,iconSettings,iconClose,iconCheck,iconFavoriteOl,iconNoAddress
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

                     console.log(this.addresses) // TODO - remove in production
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
                    console.log(response.data) // TODO - remove in production
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
                    console.log(response.data) // TODO - remove in production
                 }).catch((error) => {
                    console.error('Server error:', error)
                 });

         },
         getCityNameById(cityId) {

             if (!cityId) return '';
             console.log('cityId', this.cities)
             const city = this.cities.find(c => c.id === cityId);
             if (!city) return '';
             console.log('city', city)
             // якщо у відповіді API `name` має переклади по мовах
             if (city.name && typeof city.name === 'object') {
                 return city.name[this.locale] || city.name['ro'] || Object.values(city.name)[0];
             }

             // fallback якщо це просто рядок
             return city.name || '';
         },

         addNewAddress(address_type) {
             const exists = this.addresses.some(
                 addr => addr.isNew && addr.address_type === address_type
             );
             if (exists) {
                 // TODO - remove in production
                 console.warn(`Address with type ${address_type} already exists as new`);
                 return;
             }
             if (this.isAdding[address_type]) return
             this.isAdding[address_type] = true
             const newAddress = {
                 ...addressTemplate,
                 id: Date.now(),
                 address_type:address_type,
                 is_default:false,
                 postal_code:'',
                 form: useForm('post', '/user/addresses', {
                     address_type:address_type,
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


         },

         createAddress(address_type) {
             const newAddress = this.addresses.find(addr => addr.isNew);

             if (!newAddress) {
                 return;
             }
             newAddress.form.address_type = address_type;
             newAddress.form.submit()
                 .then(response => {
                     newAddress.id = response.data.address.id;
                     // newAddress.form.id = response.data.address.id;
                     this.form.reset();
                     console.log('newAddress== ', newAddress)
                     // this.addresses.push(newAddress);
                     newAddress.isNew = false;
                     this.isAdding[address_type] = false   // показуємо кнопку назад
                     this.getAddresses();
                 })
                 .catch(error => {
                     console.error(error.response.data.message);

                 });
         },
         async updateAddress(id) {
             console.log(id)
             const index = this.addresses.findIndex(address => address.id === id);
             if (index === -1) {
                 return;
             }

             const address = this.addresses[index];

             await window.axios.put(this.route('api.addresses.update', address.id), address.form)
                 .then((response) => {
                     this.getAddresses(); // Refresh the family list after update

                     this.showAlert({
                         type: 'info',
                         title: this.$t('family_member.alert.update_title'),
                         message: this.$t('family_member.alert.update_message'),
                     });
                 }).catch((error) => {
                     console.error("Update error:", error.response?.data || error);
                 });
         },

         async setDefaultAddress(id) {
             try {
                 const current = this.addresses.find(addr => addr.id === id);
                 if (!current) return;

                 const type = current.address_type;

                 await window.axios.put(this.route('api.addresses.default', id));

                 this.addresses = this.addresses.map(addr => {
                     // Якщо це той самий тип — обнуляємо всі дефолтні крім поточного
                     if (addr.address_type === type) {
                         return {
                             ...addr,
                             is_default: addr.id === id
                         };
                     }
                     // Інакше не чіпаємо
                     return addr;
                 });

                 this.showAlert({
                     type: 'info',
                     title: this.$t('address.alert.default_title'),
                     message: this.$t('address.alert.default_message'),
                 });
             } catch (error) {
                 console.error("Set default error:", error.response?.data || error);
             }
         }
         ,
         async confirmRemoveAddress(address_id, address_type) {
             const index = this.addresses.findIndex(address => address.id === address_id);
             if (index === -1) {
                 return;
             }

             const address = this.addresses[index];
             if (address.isNew){
                 this.addresses.splice(index, 1);

                 this.isAdding[address_type] = false
                 return
             }
             await window.axios.delete(this.route('api.addresses.destroy', address_id))
                 .then(() => {
                     this.getAddresses(); // Refresh the family list after deletion
                     this.showAlert({
                         type: 'info',
                         title: this.$t('family_member.alert.delete_title'),
                         message: this.$t('family_member.alert.delete_message'),
                     });



                 }).catch((error) => {
                     console.error("Delete error:", error.response?.data || error);

                 });

         },


         toggleEdit(id) {
             const index = this.addresses.findIndex(address => address.id === id);
             if (index !== -1) {
                 this.addresses[index].editor.isEditing = !this.addresses[index].editor.isEditing;

             }


         },
         isAddressFormValid(address) {
             // Список обов’язкових полів
             const requiredFields = [
                 'label',
                 'region_id',
                 'city_id',
                 'street_name',
                 'building',

             ];
             console.log('address', address)
             // Перевірка: всі поля заповнені і не пусті
             return requiredFields.every(field => {
                 const value = address.form[field];
                 return value !== null && value !== undefined && String(value).trim() !== '';
             });
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

     },

 }
</script>
<template>
    <section
    v-for="(type) in types "
    >
        <div class="mt-5 bg-white lg:shadow rounded-xl lg:p-5 duration-500">
            <h1 class="text-[24px] font-bold border border-b-0 rounded-t-lg p-2 border-light-border lg:border-none">{{type.label}}</h1>

            <form v-if="addresses.filter(a => a.address_type === type.id).length > 0"
                  @submit.prevent="createAddress(type.id)" v-for="(address, index) in addresses.filter(a => a.address_type === type.id)"
                  :key="address.id"
                  :class="{
                  'pb-8 lg:pb-5': address.editor.isEditing,
                  'border-b-0 border border-light-border': index < addresses.filter(a => a.address_type === type.id).length - 1,
                  'border border-light-border': index === addresses.filter(a => a.address_type === type.id).length - 1
                }"
                  class="location relative duration-500 lg:my-4  lg:border border-light-border lg:rounded-xl p-2 lg:p-5">

                <div  class="flex items-start lg:items-center justify-between">
                    <div class="flex lg:items-center gap-x-4 lf:gap-x-2 max-w-2/3 lg:max-w-1/2">
                        <div class="min-w-10 min-h-10 flex items-center justify-center size-10 p-1 lg:p-2 h-fit  bg-light-orange rounded-full">
                            <img class="opacity-65 " :src="iconMarker" alt="">
                        </div>
                        <div class="relative">

                            <BaseInput
                                :disabled="!address.editor.isEditing"
                                customClass="!p-0 min-h-7.5 placeholder-text-sm "
                                name="label"
                                id="label"
                                v-model="address.form.label"
                                aria-label="label"
                                @change="address.form.validate('label')"
                                class="shadow-sm text-charcoal/60 rounded-2xl focus:outline-hidden duration-500 font-bold lg:text-[20px] max-w-1/2 lg:max-w-full"
                                :class="{
                          '!p-1': address.editor.isEditing,
                          'cursor-not-allowed border-none !shadow-none ': !address.editor.isEditing,
                          '!shadow-red-500': address.editor.isEditing && address.form.invalid('label')
                        }"

                            />
                            <div class="lg:hidden text-xs max-w-full opacity-65">
                                <p>
                                    {{address.form.region?.name[locale] || address.form.region?.name['ro']}}
                                    {{ address.form.city?.name[locale] || address.form.city?.name['ro']}}

                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center gap-x-2 max-w-1/3 lg:max-w-1/2">


                        <div class="flex items-center gap-x-2" v-if="!address.isNew">
                            <transition name="fade" mode="out-in">
                                <div :key="address.is_default">
                                    <button v-if="address.is_default"
                                            class="gradient_r-b_dark border border-transparent duration-500 relative shadow-sm cursor-pointer rounded-full size-[34px] lg:size-8  !p-0 lg:!p-0 lg:w-fit lg:h-fit flex justify-center items-center">
                                        <span class="absolute inset-0 bg-black/15 rounded-full"></span>
                                        <div class="flex justify-center items-center lg:gap-x-2 relative z-10 !w-full  p-0 lg:py-2 lg:px-3">
                                            <img class="size-4 " :src="iconFavorite" alt="">
                                            <p class="text-white font-bold text-sm hidden lg:block">Default</p>
                                        </div>
                                    </button>
                                    <button v-else
                                            @click="setDefaultAddress(address.id)"
                                            class="relative border border-light-border shadow-sm cursor-pointer duration-500 rounded-full size-[34px] lg:size-8 !p-0 lg:!p-0 lg:w-fit lg:h-fit flex justify-center items-center">
                                        <div class="flex items-center justify-center gap-x-2 relative z-10 !w-full  p-0 lg:py-2 lg:px-3">
                                            <img class="size-4 lg:hidden" :src="iconFavoriteOl" alt="">
                                            <p class="text-olive font-bold text-sm hidden lg:block">Make default</p>
                                        </div>
                                    </button>
                                </div>
                            </transition>
                            <button class="settings cursor-pointer size-[34px] lg:size-8 lg:p-2 border border-light-border  rounded-full shadow-sm duration-500 relative group flex items-center justify-center"
                                    :class="{'text-olive': !address.editor.isEditing,'text-white bg-olive': address.editor.isEditing}"
                                    type="button"
                                    @click="toggleEdit(address.id); this.getCities(address.form.region_id)"
                            >
                                <div class="absolute hidden lg:block lg:left-2/3 lg:-translate-x-2/5 lg:-top-10 mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                    {{ $t('address.edit') }}
                                    <div class="absolute -bottom-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
                                </div>
                                <svg class="!size-4" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.7238 1.0313C12.7664 -0.343766 14.8336 -0.343766 15.8762 1.0313L16.2293 1.49696C16.7982 2.24724 17.7277 2.63222 18.6605 2.50397L19.2394 2.42437C20.949 2.18931 22.4107 3.65102 22.1756 5.3606L22.096 5.93954C21.9678 6.87235 22.3528 7.80178 23.103 8.37068L23.5687 8.72377C24.9438 9.76642 24.9438 11.8336 23.5687 12.8762L23.103 13.2293C22.3528 13.7982 21.9678 14.7277 22.096 15.6605L22.1756 16.2394C22.4107 17.949 20.949 19.4107 19.2394 19.1756L18.6605 19.096C17.7277 18.9678 16.7982 19.3528 16.2293 20.103L15.8762 20.5687C14.8336 21.9438 12.7664 21.9438 11.7238 20.5687L11.3707 20.103C10.8018 19.3528 9.87235 18.9678 8.93954 19.096L8.3606 19.1756C6.65102 19.4107 5.18931 17.949 5.42437 16.2394L5.50397 15.6605C5.63222 14.7277 5.24724 13.7982 4.49696 13.2293L4.0313 12.8762C2.65623 11.8336 2.65623 9.76642 4.0313 8.72377L4.49696 8.37068C5.24724 7.80178 5.63222 6.87235 5.50397 5.93954L5.42437 5.3606C5.18931 3.65102 6.65102 2.18931 8.3606 2.42437L8.93954 2.50397C9.87235 2.63222 10.8018 2.24724 11.3707 1.49696L11.7238 1.0313Z" fill="currentColor" fill-opacity="0.15"/>
                                    <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M9.92377 2.23125C10.9664 0.856185 13.0336 0.856185 14.0762 2.23125L14.4293 2.69691C14.9982 3.44719 15.9277 3.83218 16.8605 3.70392L17.4394 3.62432C19.149 3.38926 20.6107 4.85097 20.3756 6.56055L20.296 7.13949C20.1678 8.0723 20.5528 9.00173 21.303 9.57064L21.7687 9.92372C23.1438 10.9664 23.1438 13.0335 21.7687 14.0762L21.303 14.4293C20.5528 14.9982 20.1678 15.9276 20.296 16.8604L20.3756 17.4394C20.6107 19.1489 19.149 20.6106 17.4394 20.3756L16.8605 20.296C15.9277 20.1677 14.9982 20.5527 14.4293 21.303L14.0762 21.7687C13.0336 23.1437 10.9664 23.1437 9.92377 21.7687L9.57068 21.303C9.00178 20.5527 8.07234 20.1677 7.13954 20.296L6.5606 20.3756C4.85102 20.6106 3.38931 19.1489 3.62437 17.4394L3.70397 16.8604C3.83222 15.9276 3.44724 14.9982 2.69695 14.4293L2.23129 14.0762C0.856231 13.0335 0.856231 10.9664 2.23129 9.92372L2.69695 9.57064C3.44724 9.00173 3.83222 8.0723 3.70397 7.13949L3.62437 6.56055C3.38931 4.85097 4.85102 3.38926 6.5606 3.62432L7.13954 3.70392C8.07234 3.83218 9.00178 3.44719 9.57068 2.69691L9.92377 2.23125Z" stroke="currentColor" stroke-width="2"/>
                                </svg>

                            </button>

                            <div

                                class="cursor-pointer group size-[34px] lg:size-8 !p-0 lg:p-2 border border-light-border rounded-full shadow-sm relative flex items-center justify-center"
                                @click="address.editor.confirmingDelete = !address.editor.confirmingDelete"
                                v-click-outside="() => address.editor.confirmingDelete = false"
                            >
                                <img class="!size-4" :src="iconTrash" alt="" />
                                <div class="absolute hidden lg:block lg:left-2/3 -translate-x-2/5 lg:-top-10 mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                    {{ $t('address.delete') }}
                                    <div class="absolute -bottom-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
                                </div>
                                <transition name="fade-slide" appear>
                                    <div

                                        v-if="address.editor.confirmingDelete"
                                        class="absolute w-[50px] lg:w-[100px] lg:-right-9 grid gap-y-1 lg:flex gap-x-2 justify-between items-center -bottom-12 lg:-bottom-8"
                                    >
                                        <!-- Cancel -->
                                        <div
                                            class="col-span-6 hover:opacity-100 opacity-85 duration-300 transition-all ease-in-out shadow-sm rounded-2xl  text-center py-1 flex justify-center bg-olive w-full h-5"
                                            @click.stop="address.editor.confirmingDelete = false"
                                        >
                                            <img :src="iconClose" alt="" />
                                        </div>

                                        <!-- Confirm -->
                                        <div
                                            class="col-span-6 hover:opacity-100 opacity-85 duration-300 transition-all ease-in-out shadow-sm rounded-2xl w-full text-center py-1 flex justify-center bg-danger h-5"
                                            @click.stop="confirmRemoveAddress(address.id , type.id)"
                                        >
                                            <img :src="iconCheck" alt="" />
                                        </div>
                                    </div>
                                </transition>
                            </div>

                        </div>
                        <div v-if="address.editor.isEditing && address.isNew" class="flex order-first gap-x-2 items-center">
                            <Button
                                @click="createAddress(type.id)" :customClass="'w-fit !px-4 !my-0 !py-2 h-fit flex flex-nowrap !rounded-full !shadow-none text-sm font-medium absolute lg:static right-1 bottom-1'">
                                <img class="size-3 -mr-3" :src="iconCheck" alt="" /> Save
                            </Button>
                            <Button v-if="address.isNew" @click="confirmRemoveAddress(address.id,type.id)" buttonPrimary :customClass="'w-fit px-3 !py-2 h-fit !shadow-none bg-white text-olive !rounded-full font-medium text-sm !m-0'" >Cancel</Button>

                        </div>
                        <div v-else-if="address.editor.isEditing && !address.isNew" class="flex order-first gap-x-2 items-center">
                            <Button @click="updateAddress(address.id)" :customClass="'w-fit !px-4 !my-0 !py-2 h-fit flex flex-nowrap !rounded-full !shadow-none text-sm font-medium absolute lg:static right-1 bottom-1'">
                                <img class="size-3 -mr-3" :src="iconCheck" alt="" /> Save changes
                            </Button>
                            <Button v-if="address.isNew" @click="confirmRemoveAddress(address.id,type.id)" buttonPrimary :customClass="'w-fit px-3 !py-2 h-fit !shadow-none bg-white text-olive !rounded-full font-medium text-sm !m-0'" >Cancel</Button>

                        </div>
                    </div>
                </div>

                <div
                    :class="{'hidden lg:grid': !address.editor.isEditing && !address.isNew,'gap-y-4': address.editor.isEditing}"
                    class=" grid grid-cols-12 lg:grid-cols-18 justify-between gap-x-4 my-4 w-full">

                    <!-- District dropdown -->
                    <div class="relative col-span-12 lg:col-span-4 rounded-lg shadow-sm">
                        <div
                            class="border  border-light-border px-3 py-1 rounded-lg  w-full flex justify-between items-center"
                            :class="{'cursor-not-allowed': !address.editor.isEditing,'': address.editor.isEditing}"
                            @click="address.editor.isEditing && (address.editor.dropdownDistrictOpen = !address.editor.dropdownDistrictOpen)"
                            v-click-outside="() => address.editor.dropdownDistrictOpen = false"
                        >
                            <input type="hidden"  name="region_id" v-model="address.form.region_id" >
                            <p class="flex truncate line-clamp-1 w-11/12 items-center opacity-60 text-sm">
                                {{address.form.region?.name[locale] || address.form.region?.name['ro'] || 'Select region'}}
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
                                @click="this.getCities(region.id); address.region.id = region.id; address.form.region = region;address.form.region_id =region.id;  address.editor.dropdownDistrictOpen = false"
                            >
                                {{ region.name[locale] ?? region.name['ro'] }}
                            </li>
                        </ul>

                    </div>

                    <!-- City dropdown -->
                    <div class="relative col-span-12 lg:col-span-4 rounded-lg shadow-sm">
                        <div
                            class="border border-light-border px-3 py-1 rounded-lg w-full flex justify-between items-center "
                            :class="{'cursor-not-allowed': !address.editor.isEditing,'': address.editor.isEditing}"
                            @click="address.editor.isEditing && (address.editor.dropdownCityOpen = !address.editor.dropdownCityOpen)"
                            v-click-outside="() => address.editor.dropdownCityOpen = false"
                        >
                            <input type="hidden"  name="city_id" v-model="address.form.city_id" >
                            <p class="flex items-center opacity-60 text-sm">

                                {{address.city_id || 'Select city'}}

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
                                @click="address.city_id = city.id; address.form.city = city; address.form.city_id = city.id; address.editor.dropdownCityOpen = false"

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
                        @change="address.form.validate('street')"
                        class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-12 lg:col-span-4 duration-500"
                        :class="{
                          'cursor-not-allowed': !address.editor.isEditing,
                          '!shadow-red-500': address.editor.isEditing && address.form.invalid('street')
                        }"
                    />


                    <div class="col-span-4 lg:col-span-2 relative">
                        <label class="absolute inset-0 flex items-center pl-1.5 opacity-60 w-fit" for="building">bl.</label>
                        <BaseInput
                            :disabled="!address.editor.isEditing"
                            customClass="p-0 min-h-7.5 placeholder-text-sm pl-8"
                            name="building"
                            id="building"
                            placeholder="--"
                            v-model="address.form.building"
                            aria-label="building"
                            @change="address.form.validate('building')"
                            class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden max-w-full duration-500"
                            :class="{
                          'cursor-not-allowed': !address.editor.isEditing,
                          '!shadow-red-500': address.editor.isEditing && address.form.invalid('building')
                        }"
                        />
                    </div>

                    <div class="col-span-4 lg:col-span-2  relative">
                        <label class="absolute inset-0 flex items-center pl-1.5 opacity-60 w-fit" for="apartment">ap.</label>
                        <BaseInput
                            :disabled="!address.editor.isEditing"
                            customClass="p-0 min-h-7.5 placeholder-text-sm pl-8"
                            name="apartment"
                            id="apartment"
                            maxlength="3"
                            placeholder="--"
                            v-model="address.form.apartment"
                            aria-label="apartment"
                            @change="address.form.validate('apartment')"
                            class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden max-w-full duration-500"
                            :class="{
                          'cursor-not-allowed': !address.editor.isEditing,
                          '!shadow-red-500': address.editor.isEditing && address.form.invalid('apartment')
                        }"
                        />
                    </div>
                    <BaseInput
                        :ref="'postalCodeInput-'+address.id"
                        :key="'postal-'+address.id"
                        :mask-options="{
                            mask: 'MD-0000',
                            lazy: false
                          }"
                        placeholder="MD-____"
                        :disabled="!address.editor.isEditing"
                        customClass="min-h-7.5 placeholder-text-sm placeholder-text-charcoal/40"
                        name="postal_code"
                        :id="'postal_code_'+address.id"
                        v-model="address.form.postal_code"
                        aria-label="postal_code"
                        @change="address.form.validate('postal_code')"
                        class="postal_code shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-4 lg:col-span-2 duration-500"
                        :class="{
                          'cursor-not-allowed': !address.editor.isEditing,
                          '!shadow-red-500': address.editor.isEditing && address.form.invalid('postal_code')
                        }"
                    />



                </div>
                <div v-if="address.form.apartment && address.form.apartment.length > 0 && address.editor.isEditing" class="grid grid-cols-12 lg:grid-cols-18 lg:justify-end  gap-x-4 my-4 w-full">

                    <div class="col-span-4 lg:col-span-2 lg:col-start-13 relative">
                        <label class="absolute inset-0 flex items-center pl-1.5 opacity-60 w-fit" for="floor">fl.</label>
                        <BaseInput
                            :disabled="!address.editor.isEditing"
                            customClass="p-0 min-h-7.5 placeholder-text-sm pl-8"
                            name="floor"
                            id="floor"
                            placeholder="--"
                            v-model="address.form.floor"
                            aria-label="floor"
                            maxlength="3"
                            @change="address.form.validate('floor')"
                            class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden max-w-full duration-500"
                            :class="{
                          'cursor-not-allowed': !address.editor.isEditing,
                          '!shadow-red-500': address.editor.isEditing && address.form.invalid('floor')
                        }"
                        />
                    </div>

                    <div class="col-span-4 lg:col-span-2 relative">
                        <label class="absolute inset-0 flex items-center pl-1.5 opacity-60 w-fit" for="entrance">int.</label>
                        <BaseInput
                            :disabled="!address.editor.isEditing"
                            customClass="p-0 min-h-7.5 placeholder-text-sm pl-8"
                            name="intercom"
                            id="intercom"
                            maxlength="3"
                            placeholder="--"
                            v-model="address.form.intercom"
                            aria-label="intercom"
                            @change="address.form.validate('intercom')"
                            class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden max-w-full duration-500"
                            :class="{
                          'cursor-not-allowed': !address.editor.isEditing,
                          '!shadow-red-500': address.editor.isEditing && address.form.invalid('intercom')
                        }"
                        />
                    </div>

                    <div class="col-span-4 lg:col-span-2 relative">
                        <label class="absolute inset-0 flex items-center pl-1.5 opacity-60 w-fit" for="entrance">et.</label>
                        <BaseInput
                            :disabled="!address.editor.isEditing"
                            customClass="p-0 min-h-7.5 placeholder-text-sm pl-8"
                            name="entrance"
                            id="entrance"
                            maxlength="3"
                            placeholder="--"
                            v-model="address.form.entrance"
                            aria-label="entrance"
                            @change="address.form.validate('entrance')"
                            class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden max-w-full duration-500"
                            :class="{
                          'cursor-not-allowed': !address.editor.isEditing,
                          '!shadow-red-500': address.editor.isEditing && address.form.invalid('entrance')
                        }"
                        />
                    </div>



                </div>
                <p v-if="address.form.invalid('label')" class="text-[12px] text-red-500 w-full text-nowrap ">{{ address.form.errors.label }}</p>
                <p v-if="address.form.invalid('floor')" class="text-[12px] text-red-500 w-full text-nowrap ">{{ address.form.errors.floor }}</p>
                <p v-if="address.form.invalid('street')" class="text-[12px] text-red-500 w-full text-nowrap ">{{ address.form.errors.street_name }}</p>
                <p v-if="address.form.invalid('entrance')" class="text-[12px] text-red-500 w-full text-nowrap ">{{ address.form.errors.entrance }}</p>
                <p v-if="address.form.invalid('apartment')" class="text-[12px] text-red-500 w-full text-nowrap ">{{ address.form.errors.apartment }}</p>
                <p v-if="address.form.invalid('building')" class="text-[12px] text-red-500 w-full text-nowrap ">{{ address.form.errors.building }}</p>
                <p v-if="address.form.invalid('intercom')" class="text-[12px] text-red-500 w-full text-nowrap ">{{ address.form.errors.intercom }}</p>
                <p v-if="address.form.invalid('postal_code')" class="text-[12px] text-red-500 w-full text-nowrap ">{{ address.form.errors.postal_code }}</p>



            </form>
            <div v-else class="w-full flex flex-col justify-center items-center">
                <img :src="iconNoAddress" alt="">
                <h2 class="text-lg font-bold">No saved addresses</h2>
            </div>
            <Button
                v-show="!isAdding[type.id]"
                @click="addNewAddress(type.id)"
                customClass="!py-2 !px-5 lg:!py-2 md:py-2 w-fit"
                class="font-bold flex items-center"><span class="text-base lg:text-[24px]">+</span> Add new address

            </Button>
        </div>
    </section>








</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
    transform: scale(0.95);
}

.fade-slide-enter-active, .fade-slide-leave-active {
    transition: all 0.3s ease;
}
.fade-slide-enter-from, .fade-slide-leave-to {
    opacity: 0;
    transform: translateY(5px);
}
</style>
