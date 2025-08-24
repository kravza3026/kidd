<script>
import { ref } from 'vue';
import Button from '@/components/ui/Button.vue';
import SubscribeForm from '@/components/ui/subscribeForm.vue';
import BaseCheckbox from '@/components/ui/BaseCheckbox.vue';
import clickOutside from '@/clickOutside.js';
import iconMarker from '@img/icons/marker_outline.png';
import iconFavorite from '@img/icons/favorite_white.svg';
import iconFavoriteOl from '@img/icons/favorite_olive.svg';
import iconTrash from '@img/common/trash.svg';
import iconNoAddress from '@img/common/empty_addresses.jpg';
import iconSettings from '@img/icons/Settings_base.svg';
import iconClose from '@img/icons/close.svg';
import iconCheck from '@img/icons/checked_white.svg';
import selectIcon from '@img/icons/select-arrows.svg';
import BaseInput from '@/components/ui/BaseInput.vue';
import { useForm } from 'laravel-precognition-vue';
import { useAlert } from '@/useAlert.js';

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
    components: { BaseInput, Button, SubscribeForm, BaseCheckbox },

    directives: {
        clickOutside,
    },
    setup() {
        const { showAlert } = useAlert();
        return { showAlert };
    },
    data() {
        return {
            form: useForm('post', '/user/addresses', { ...addressTemplate }),

            locale: document.documentElement.lang || 'ro',
            addresses: ref([]),
            regions: ref([]),
            cities: [],
            isAdding: {},
            types: [
                { id: 3, trans_key: 'address.type_shipping' },
                { id: 4, trans_key: 'address.type_billing' },
            ],
            defaults: {
                city: {
                    id: 0,
                    name: {
                        ro: '---',
                        ru: '---',
                        en: '---',
                    },
                },
                region: {
                    id: 0,
                    name: {
                        ro: '---',
                        ru: '---',
                        en: '---',
                    },
                },
                editor: {
                    isEditing: true,
                    dropdownCityOpen: false,
                    dropdownDistrictOpen: false,
                    confirmingDelete: false,
                    wasValidated: false,
                },
            },

            iconMarker,
            iconFavorite,
            iconTrash,
            selectIcon,
            iconSettings,
            iconClose,
            iconCheck,
            iconFavoriteOl,
            iconNoAddress,
        };
    },

    methods: {
        async getAddresses() {
            await window.axios
                .get(`/user/addresses`)
                .then((response) => {
                    this.addresses = response.data.addresses.map((address) => ({
                        ...address,
                        form: useForm('post', '/user/addresses', {
                            ...address,
                        }),
                    }));

                    console.log(this.addresses); // TODO - remove in production
                })
                .catch((error) => {
                    console.error('Server error:', error);
                });
        },

        async getRegions(region_id = null) {
            await window.axios
                .get(`/regions`, {
                    params: {
                        region_id: region_id ?? null,
                    },
                })
                .then((response) => {
                    this.regions = response.data.regions;
                    console.log(response.data); // TODO - remove in production
                })
                .catch((error) => {
                    console.error('Server error:', error);
                });
        },

        async getCities(region_id = null) {
            await window.axios
                .get(`/cities`, {
                    params: {
                        region_id: region_id ?? null,
                    },
                })
                .then((response) => {
                    this.cities = response.data.cities;
                    console.log(response.data); // TODO - remove in production
                })
                .catch((error) => {
                    console.error('Server error:', error);
                });
        },

        addNewAddress(address_type) {
            const exists = this.addresses.some((addr) => addr.isNew && addr.address_type === address_type);
            if (exists) {
                // TODO - remove in production
                console.warn(`Address with type ${address_type} already exists as new`);
                return;
            }
            if (this.isAdding[address_type]) return;
            this.isAdding[address_type] = true;
            const newAddress = {
                ...addressTemplate,
                id: Date.now(),
                address_type: address_type,
                is_default: false,
                postal_code: 'MD-',
                form: useForm('post', '/user/addresses', {
                    address_type: address_type,
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
                isNew: true,
            };
            console.log('newAddress== ', newAddress);
            this.addresses.push(newAddress);
        },

        createAddress(address_type) {
            const newAddress = this.addresses.find((addr) => addr.isNew);

            if (!newAddress) {
                return;
            }
            newAddress.form.address_type = address_type;
            newAddress.form
                .submit()
                .then((response) => {
                    newAddress.id = response.data.address.id;
                    // newAddress.form.id = response.data.address.id;
                    this.form.reset();
                    console.log('newAddress== ', newAddress);
                    // this.addresses.push(newAddress);
                    newAddress.isNew = false;
                    this.isAdding[address_type] = false; // показуємо кнопку назад
                    this.getAddresses();
                    this.showAlert({
                        type: 'info',
                        title: this.$t('address.alerts.add_title'),
                        message: this.$t('address.alerts.add_message'),
                    });
                })
                .catch((error) => {
                    console.error(error.response.data.message);
                });
        },
        async updateAddress(id) {
            console.log(id);
            const index = this.addresses.findIndex((address) => address.id === id);
            if (index === -1) {
                return;
            }

            const address = this.addresses[index];

            await window.axios
                .put(this.route('api.addresses.update', address.id), address.form)
                .then((response) => {
                    this.getAddresses(); // Refresh address list after update

                    this.showAlert({
                        type: 'info',
                        title: this.$t('address.alerts.update_title'),
                        message: this.$t('address.alerts.update_message'),
                    });
                })
                .catch((error) => {
                    console.error('Update error:', error.response?.data || error);
                });
        },

        async setDefaultAddress(id) {
            try {
                const current = this.addresses.find((addr) => addr.id === id);
                if (!current) return;

                const type = current.address_type;

                await window.axios.put(this.route('api.addresses.default', id));

                this.addresses = this.addresses.map((addr) => {
                    // Якщо це той самий тип — обнуляємо всі дефолтні крім поточного
                    if (addr.address_type === type) {
                        return {
                            ...addr,
                            is_default: addr.id === id,
                        };
                    }
                    // Інакше не чіпаємо
                    return addr;
                });

                this.showAlert({
                    type: 'info',
                    title: this.$t('address.alerts.default_title'),
                    message: this.$t('address.alerts.default_message'),
                });
            } catch (error) {
                console.error('Set default error:', error.response?.data || error);
            }
        },
        async confirmRemoveAddress(address_id, address_type) {
            const index = this.addresses.findIndex((address) => address.id === address_id);
            if (index === -1) {
                return;
            }

            const address = this.addresses[index];
            if (address.isNew) {
                this.addresses.splice(index, 1);

                this.isAdding[address_type] = false;
                return;
            }
            await window.axios
                .delete(this.route('api.addresses.destroy', address_id))
                .then(() => {
                    this.getAddresses(); // Refresh the family list after deletion
                    this.showAlert({
                        type: 'info',
                        title: this.$t('address.alerts.delete_title'),
                        message: this.$t('address.alerts.delete_message'),
                    });
                })
                .catch((error) => {
                    console.error('Delete error:', error.response?.data || error);
                });
        },

        toggleEdit(id) {
            const index = this.addresses.findIndex((address) => address.id === id);
            if (index !== -1) {
                this.addresses[index].editor.isEditing = !this.addresses[index].editor.isEditing;
            }
        },
        isAddressFormValid(address) {
            // Список обов’язкових полів
            const requiredFields = ['label', 'region_id', 'city_id', 'street_name', 'building'];
            console.log('address', address);
            // Перевірка: всі поля заповнені і не пусті
            return requiredFields.every((field) => {
                const value = address.form[field];
                return value !== null && value !== undefined && String(value).trim() !== '';
            });
        },
        async removeAddress(id) {
            const index = this.addresses.findIndex((address) => address.id === id);
            if (index !== -1) {
                this.addresses.splice(index, 1);
            }
        },
    },
    mounted() {
        this.getAddresses();
        this.getRegions();
    },
};
</script>
<template>
    <section v-for="addr_type in types">
        <div class="mt-5 rounded-xl bg-white duration-500 lg:p-5 lg:shadow">
            <h1 class="border-light-border rounded-t-lg border border-b-0 p-2 text-[24px] font-bold lg:border-none">
                {{ $t(addr_type.trans_key) }}
            </h1>

            <form
                v-for="(address, index) in addresses.filter((a) => a.address_type === addr_type.id)"
                v-if="addresses.filter((a) => a.address_type === addr_type.id).length > 0"
                :key="address.id"
                :class="{
                    'pb-8 lg:pb-5': address.editor.isEditing,
                    'border-light-border border border-b-0':
                        index < addresses.filter((a) => a.address_type === addr_type.id).length - 1,
                    'border-light-border border':
                        index === addresses.filter((a) => a.address_type === addr_type.id).length - 1,
                }"
                class="location border-light-border relative p-2 duration-500 lg:my-4 lg:rounded-xl lg:border lg:p-5"
                @submit.prevent="createAddress(addr_type.id)"
            >
                <div class="flex items-start justify-between lg:items-center">
                    <div class="lf:gap-x-2 flex max-w-2/3 gap-x-4 lg:max-w-1/2 lg:items-center">
                        <div
                            class="bg-light-orange flex size-10 h-fit min-h-10 min-w-10 items-center justify-center rounded-full p-1 lg:p-2"
                        >
                            <img :src="iconMarker" alt="" class="opacity-65" />
                        </div>
                        <div class="relative">
                            <BaseInput
                                id="label"
                                v-model="address.form.label"
                                :class="{
                                    '!p-1': address.editor.isEditing,
                                    'cursor-not-allowed border-none !shadow-none': !address.editor.isEditing,
                                    '!shadow-red-500': address.editor.isEditing && address.form.invalid('label'),
                                }"
                                :disabled="!address.editor.isEditing"
                                aria-label="label"
                                class="text-charcoal/60 max-w-1/2 rounded-2xl font-bold shadow-sm duration-500 focus:outline-hidden lg:max-w-full lg:text-[20px]"
                                customClass="!p-0 min-h-7.5 placeholder-text-sm "
                                name="label"
                                @change="address.form.validate('label')"
                            />
                            <div class="max-w-full text-xs opacity-65 lg:hidden">
                                <p>
                                    {{ address.form.region?.name[locale] || address.form.region?.name['ro'] }}
                                    {{ address.form.city?.name[locale] || address.form.city?.name['ro'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex max-w-1/3 items-center gap-x-2 lg:max-w-1/2">
                        <div v-if="!address.isNew" class="flex items-center gap-x-2">
                            <transition v-if="!address.editor.isEditing" mode="out-in" name="fade">
                                <div :key="address.is_default">
                                    <button
                                        v-if="address.is_default"
                                        class="gradient_r-b_dark relative flex size-[34px] cursor-pointer items-center justify-center rounded-full border border-transparent !p-0 shadow-sm duration-500 lg:size-8 lg:h-fit lg:w-fit lg:!p-0"
                                    >
                                        <span class="absolute inset-0 rounded-full bg-black/15"></span>
                                        <div
                                            class="relative z-10 flex !w-full items-center justify-center p-0 lg:gap-x-2 lg:px-3 lg:py-2"
                                        >
                                            <img :src="iconFavorite" alt="" class="size-4" />
                                            <p class="hidden text-sm font-bold text-white lg:block">
                                                {{ $t('address.actions.default') }}
                                            </p>
                                        </div>
                                    </button>
                                    <button
                                        v-else
                                        class="border-light-border relative flex size-[34px] cursor-pointer items-center justify-center rounded-full border !p-0 shadow-sm duration-500 lg:size-8 lg:h-fit lg:w-fit lg:!p-0"
                                        @click="setDefaultAddress(address.id)"
                                    >
                                        <div
                                            class="relative z-10 flex !w-full items-center justify-center gap-x-2 p-0 lg:px-3 lg:py-2"
                                        >
                                            <img :src="iconFavoriteOl" alt="" class="size-4 lg:hidden" />
                                            <p class="text-olive hidden text-sm font-bold lg:block">
                                                {{ $t('address.actions.make_default') }}
                                            </p>
                                        </div>
                                    </button>
                                </div>
                            </transition>
                            <button
                                v-if="!address.editor.isEditing"
                                :class="{
                                    'text-olive': !address.editor.isEditing,
                                    'bg-olive text-white': address.editor.isEditing,
                                }"
                                class="settings border-light-border group relative flex size-[34px] cursor-pointer items-center justify-center rounded-full border shadow-sm duration-500 lg:size-8 lg:p-2"
                                type="button"
                                @click="
                                    toggleEdit(address.id);
                                    this.getCities(address.form.region_id);
                                "
                            >
                                <div
                                    class="absolute z-10 mt-2 hidden w-max rounded-full bg-black px-3 py-1 text-sm text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100 lg:-top-10 lg:left-2/3 lg:block lg:-translate-x-2/5"
                                >
                                    {{ $t('address.actions.edit_tooltip') }}
                                    <div
                                        class="absolute -bottom-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                                    ></div>
                                </div>
                                <svg class="!size-4" fill="none" viewBox="0 0 25 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.7238 1.0313C12.7664 -0.343766 14.8336 -0.343766 15.8762 1.0313L16.2293 1.49696C16.7982 2.24724 17.7277 2.63222 18.6605 2.50397L19.2394 2.42437C20.949 2.18931 22.4107 3.65102 22.1756 5.3606L22.096 5.93954C21.9678 6.87235 22.3528 7.80178 23.103 8.37068L23.5687 8.72377C24.9438 9.76642 24.9438 11.8336 23.5687 12.8762L23.103 13.2293C22.3528 13.7982 21.9678 14.7277 22.096 15.6605L22.1756 16.2394C22.4107 17.949 20.949 19.4107 19.2394 19.1756L18.6605 19.096C17.7277 18.9678 16.7982 19.3528 16.2293 20.103L15.8762 20.5687C14.8336 21.9438 12.7664 21.9438 11.7238 20.5687L11.3707 20.103C10.8018 19.3528 9.87235 18.9678 8.93954 19.096L8.3606 19.1756C6.65102 19.4107 5.18931 17.949 5.42437 16.2394L5.50397 15.6605C5.63222 14.7277 5.24724 13.7982 4.49696 13.2293L4.0313 12.8762C2.65623 11.8336 2.65623 9.76642 4.0313 8.72377L4.49696 8.37068C5.24724 7.80178 5.63222 6.87235 5.50397 5.93954L5.42437 5.3606C5.18931 3.65102 6.65102 2.18931 8.3606 2.42437L8.93954 2.50397C9.87235 2.63222 10.8018 2.24724 11.3707 1.49696L11.7238 1.0313Z"
                                        fill="currentColor"
                                        fill-opacity="0.15"
                                    />
                                    <path
                                        d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    />
                                    <path
                                        d="M9.92377 2.23125C10.9664 0.856185 13.0336 0.856185 14.0762 2.23125L14.4293 2.69691C14.9982 3.44719 15.9277 3.83218 16.8605 3.70392L17.4394 3.62432C19.149 3.38926 20.6107 4.85097 20.3756 6.56055L20.296 7.13949C20.1678 8.0723 20.5528 9.00173 21.303 9.57064L21.7687 9.92372C23.1438 10.9664 23.1438 13.0335 21.7687 14.0762L21.303 14.4293C20.5528 14.9982 20.1678 15.9276 20.296 16.8604L20.3756 17.4394C20.6107 19.1489 19.149 20.6106 17.4394 20.3756L16.8605 20.296C15.9277 20.1677 14.9982 20.5527 14.4293 21.303L14.0762 21.7687C13.0336 23.1437 10.9664 23.1437 9.92377 21.7687L9.57068 21.303C9.00178 20.5527 8.07234 20.1677 7.13954 20.296L6.5606 20.3756C4.85102 20.6106 3.38931 19.1489 3.62437 17.4394L3.70397 16.8604C3.83222 15.9276 3.44724 14.9982 2.69695 14.4293L2.23129 14.0762C0.856231 13.0335 0.856231 10.9664 2.23129 9.92372L2.69695 9.57064C3.44724 9.00173 3.83222 8.0723 3.70397 7.13949L3.62437 6.56055C3.38931 4.85097 4.85102 3.38926 6.5606 3.62432L7.13954 3.70392C8.07234 3.83218 9.00178 3.44719 9.57068 2.69691L9.92377 2.23125Z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    />
                                </svg>
                            </button>

                            <div
                                v-if="!address.editor.isEditing"
                                v-click-outside="() => (address.editor.confirmingDelete = false)"
                                class="group border-light-border relative flex size-[34px] cursor-pointer items-center justify-center rounded-full border !p-0 shadow-sm lg:size-8 lg:p-2"
                                @click="address.editor.confirmingDelete = !address.editor.confirmingDelete"
                            >
                                <img :src="iconTrash" alt="" class="!size-4" />
                                <div
                                    class="absolute z-10 mt-2 hidden w-max -translate-x-2/5 rounded-full bg-black px-3 py-1 text-sm text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100 lg:-top-10 lg:left-2/3 lg:block"
                                >
                                    {{ $t('address.actions.delete_tooltip') }}
                                    <div
                                        class="absolute -bottom-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                                    ></div>
                                </div>
                                <transition appear name="fade-slide">
                                    <div
                                        v-if="address.editor.confirmingDelete"
                                        class="absolute -bottom-12 grid w-[50px] items-center justify-between gap-x-2 gap-y-1 lg:-right-9 lg:-bottom-8 lg:flex lg:w-[100px]"
                                    >
                                        <!-- Cancel -->
                                        <div
                                            class="bg-olive col-span-6 flex h-5 w-full justify-center rounded-2xl py-1 text-center opacity-85 shadow-sm transition-all duration-300 ease-in-out hover:opacity-100"
                                            @click.stop="address.editor.confirmingDelete = false"
                                        >
                                            <img :src="iconClose" alt="" />
                                        </div>

                                        <!-- Confirm -->
                                        <div
                                            class="bg-danger col-span-6 flex h-5 w-full justify-center rounded-2xl py-1 text-center opacity-85 shadow-sm transition-all duration-300 ease-in-out hover:opacity-100"
                                            @click.stop="confirmRemoveAddress(address.id, addr_type.id)"
                                        >
                                            <img :src="iconCheck" alt="" />
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </div>
                        <div
                            v-if="address.editor.isEditing && address.isNew"
                            class="order-first flex items-center gap-x-2"
                        >
                            <Button
                                :customClass="'w-fit !px-4 !my-0 !py-2 h-fit flex flex-nowrap !rounded-full !shadow-none text-sm font-medium absolute lg:static right-1 bottom-1'"
                                @click="createAddress(addr_type.id)"
                            >
                                <img :src="iconCheck" alt="" class="-mr-3 size-3" />
                                {{ $t('address.actions.save_btn') }}
                            </Button>
                            <Button
                                v-if="address.isNew"
                                :customClass="'w-fit px-3 !py-2 h-fit !shadow-none bg-white text-olive !rounded-full font-medium text-sm !m-0'"
                                buttonPrimary
                                @click="confirmRemoveAddress(address.id, addr_type.id)"
                            >
                                {{ $t('address.actions.cancel_btn') }}
                            </Button>
                        </div>
                        <div
                            v-else-if="address.editor.isEditing && !address.isNew"
                            class="order-first flex items-center gap-x-2"
                        >
                            <Button
                                :customClass="'w-fit !px-4 !my-0 !py-2 h-fit flex flex-nowrap !rounded-full !shadow-none text-sm font-medium absolute lg:static right-1 bottom-1'"
                                @click="updateAddress(address.id)"
                            >
                                <img :src="iconCheck" alt="" class="-mr-3 size-3" />
                                {{ $t('address.actions.save_btn') }}
                            </Button>
                            <Button
                                v-if="!address.isNew"
                                :customClass="'w-fit px-3 !py-2 h-fit !shadow-none bg-white text-olive !rounded-full font-medium text-sm !m-0'"
                                buttonPrimary
                                @click="address.editor.isEditing = false"
                            >
                                {{ $t('address.actions.cancel_btn') }}
                            </Button>
                        </div>
                    </div>
                </div>

                <div
                    :class="{
                        'hidden lg:grid': !address.editor.isEditing && !address.isNew,
                        'gap-y-4': address.editor.isEditing,
                    }"
                    class="my-4 grid w-full grid-cols-12 justify-between gap-x-4 lg:grid-cols-18"
                >
                    <!-- District dropdown -->
                    <div class="relative col-span-12 rounded-lg shadow-sm lg:col-span-4">
                        <div
                            v-click-outside="() => (address.editor.dropdownDistrictOpen = false)"
                            :class="{ 'cursor-not-allowed': !address.editor.isEditing, '': address.editor.isEditing }"
                            class="border-light-border flex w-full items-center justify-between rounded-lg border px-3 py-1"
                            role="listbox"
                            tabindex="0"
                            @click="
                                address.editor.isEditing &&
                                (address.editor.dropdownDistrictOpen = !address.editor.dropdownDistrictOpen)
                            "
                            @keydown.enter="
                                address.editor.isEditing &&
                                (address.editor.dropdownDistrictOpen = !address.editor.dropdownDistrictOpen)
                            "
                        >
                            <input v-model="address.form.region_id" name="region_id" type="hidden" />
                            <p class="line-clamp-1 flex w-11/12 items-center truncate text-sm opacity-60">
                                {{
                                    address.form.region?.name[locale] ||
                                    address.form.region?.name['ro'] ||
                                    $t('address.region_select')
                                }}
                            </p>
                            <img
                                :class="{
                                    'opacity-0': !address.editor.isEditing,
                                    'opacity-40': address.editor.isEditing,
                                }"
                                :src="selectIcon"
                                alt="selectIcon"
                                class="duration-500"
                            />
                        </div>

                        <ul
                            v-if="address.editor.dropdownDistrictOpen"
                            class="border-light-border absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded border bg-white shadow-sm"
                        >
                            <li
                                v-for="region in regions"
                                :key="region.id"
                                class="flex cursor-pointer gap-x-2 px-3 py-2 text-xs hover:bg-gray-100"
                                tabindex="0"
                                @click="
                                    this.getCities(region.id);
                                    address.region.id = region.id;
                                    address.form.region = region;
                                    address.form.region_id = region.id;
                                    address.editor.dropdownDistrictOpen = false;
                                "
                                @keydown.enter="
                                    this.getCities(region.id);
                                    address.region.id = region.id;
                                    address.form.region = region;
                                    address.form.region_id = region.id;
                                    address.editor.dropdownDistrictOpen = false;
                                "
                            >
                                {{ region.name[locale] ?? region.name['ro'] }}
                            </li>
                        </ul>
                    </div>

                    <!-- City dropdown -->
                    <div class="relative col-span-12 rounded-lg shadow-sm lg:col-span-4">
                        <div
                            v-click-outside="() => (address.editor.dropdownCityOpen = false)"
                            :class="{ 'cursor-not-allowed': !address.editor.isEditing, '': address.editor.isEditing }"
                            class="border-light-border flex w-full items-center justify-between rounded-lg border px-3 py-1"
                            role="listbox"
                            tabindex="0"
                            @click="
                                address.editor.isEditing &&
                                (address.editor.dropdownCityOpen = !address.editor.dropdownCityOpen)
                            "
                            @keydown.enter="
                                address.editor.isEditing &&
                                (address.editor.dropdownCityOpen = !address.editor.dropdownCityOpen)
                            "
                        >
                            <input v-model="address.form.city_id" name="city_id" type="hidden" />
                            <p class="flex items-center text-sm opacity-60">
                                {{
                                    address.city?.name[locale] || address.city?.name['ro'] || $t('address.city_select')
                                }}
                            </p>
                            <img
                                :class="{
                                    'opacity-0': !address.editor.isEditing,
                                    'opacity-40': address.editor.isEditing,
                                }"
                                :src="selectIcon"
                                alt="selectIcon"
                                class="duration-500"
                            />
                        </div>

                        <ul
                            v-if="address.editor.dropdownCityOpen"
                            class="border-light-border absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded border bg-white text-xs shadow-sm"
                        >
                            <li
                                v-for="city in cities"
                                :key="city.id"
                                class="flex cursor-pointer gap-x-2 px-3 py-2 hover:bg-gray-100"
                                tabindex="0"
                                @click="
                                    address.city_id = city.id;
                                    address.city = city;
                                    address.form.city = city;
                                    address.form.city_id = city.id;
                                    address.editor.dropdownCityOpen = false;
                                "
                                @keydown.enter="
                                    address.city_id = city.id;
                                    address.city = city;
                                    address.form.city = city;
                                    address.form.city_id = city.id;
                                    address.editor.dropdownCityOpen = false;
                                "
                            >
                                {{ city.name[locale] || $t('address.city_select') }}
                            </li>
                        </ul>
                    </div>

                    <BaseInput
                        id="street"
                        v-model="address.form.street_name"
                        :class="{
                            'cursor-not-allowed': !address.editor.isEditing,
                            '!shadow-red-500': address.editor.isEditing && address.form.invalid('street'),
                        }"
                        :disabled="!address.editor.isEditing"
                        :placeholder="$t('address.street_short')"
                        aria-label="street"
                        class="text-charcoal/60 col-span-12 rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden lg:col-span-4"
                        customClass="p-0 h-7.5 placeholder-text-sm"
                        name="street"
                        @change="address.form.validate('street')"
                    />
                    <div class="relative col-span-4 lg:col-span-2">
                        <BaseInput
                            :id="'building_' + address.id"
                            v-model="address.form.building"
                            :class="{
                                'cursor-not-allowed': !address.editor.isEditing,
                                '!shadow-red-500': address.editor.isEditing && address.form.invalid('building'),
                            }"
                            :disabled="!address.editor.isEditing"
                            aria-label="building"
                            class="text-charcoal/60 max-w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                            customClass="p-0 min-h-7.5 peer w-full bg-transparent  text-sm border border-slate-200 rounded-md px-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow "
                            name="building"
                            placeholder=""
                            @change="address.form.validate('building')"
                        />
                        <label
                            :class="{
                                'text-scale-200 !-top-2 left-2.5 scale-90 text-xs text-slate-400':
                                    address.form.building,
                            }"
                            :for="'building_' + address.id"
                            class="absolute top-1 left-2.5 origin-left transform cursor-text bg-white px-1 text-sm text-slate-400 transition-all peer-focus:-top-2 peer-focus:left-2.5 peer-focus:scale-90 peer-focus:text-xs"
                        >
                            {{ $t('address.building_short') }}
                        </label>
                    </div>

                    <!--                    <div class="col-span-4 lg:col-span-2 relative">-->
                    <!--                        <label class="absolute inset-0 flex items-center pl-1.5 opacity-60 w-fit" for="building">-->
                    <!--                            {{ $t('address.building_short') }}-->
                    <!--                        </label>-->
                    <!--                        <BaseInput-->
                    <!--                            :disabled="!address.editor.isEditing"-->
                    <!--                            customClass="p-0 min-h-7.5 placeholder-text-sm pl-8"-->
                    <!--                            name="building"-->
                    <!--                            id="building"-->
                    <!--                            placeholder="&#45;&#45;"-->
                    <!--                            v-model="address.form.building"-->
                    <!--                            aria-label="building"-->
                    <!--                            @change="address.form.validate('building')"-->
                    <!--                            class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden max-w-full duration-500"-->
                    <!--                            :class="{-->
                    <!--                          'cursor-not-allowed': !address.editor.isEditing,-->
                    <!--                          '!shadow-red-500': address.editor.isEditing && address.form.invalid('building')-->
                    <!--                        }"-->
                    <!--                        />-->
                    <!--                    </div>-->

                    <div class="relative col-span-4 lg:col-span-2">
                        <label class="absolute inset-0 flex w-fit items-center pl-1.5 opacity-60" for="apartment">
                            {{ $t('address.apartment_short') }}
                        </label>
                        <BaseInput
                            id="apartment"
                            v-model="address.form.apartment"
                            :class="{
                                'cursor-not-allowed': !address.editor.isEditing,
                                '!shadow-red-500': address.editor.isEditing && address.form.invalid('apartment'),
                            }"
                            :disabled="!address.editor.isEditing"
                            aria-label="apartment"
                            class="text-charcoal/60 max-w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                            customClass="p-0 min-h-7.5 placeholder-text-sm pl-8"
                            maxlength="3"
                            name="apartment"
                            placeholder="--"
                            @change="address.form.validate('apartment')"
                        />
                    </div>
                    <BaseInput
                        :id="'postal_code_' + address.id"
                        :key="'postal-' + address.id"
                        :ref="'postalCodeInput-' + address.id"
                        v-model="address.form.postal_code"
                        :class="{
                            'cursor-not-allowed': !address.editor.isEditing,
                            '!shadow-red-500': address.editor.isEditing && address.form.invalid('postal_code'),
                        }"
                        :disabled="!address.editor.isEditing"
                        :mask-options="{
                            mask: 'MD-0000',
                            lazy: false,
                        }"
                        aria-label="postal_code"
                        class="postal_code text-charcoal/60 col-span-4 rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden lg:col-span-2"
                        customClass="min-h-7.5 placeholder-text-sm placeholder-text-charcoal/40"
                        name="postal_code"
                        placeholder="MD-____"
                        @change="address.form.validate('postal_code')"
                    />
                </div>
                <div
                    v-if="address.form.apartment && address.form.apartment.length > 0 && address.editor.isEditing"
                    class="my-4 grid w-full grid-cols-12 gap-x-4 lg:grid-cols-18 lg:justify-end"
                >
                    <div class="relative col-span-4 lg:col-span-2 lg:col-start-13">
                        <label class="absolute inset-0 flex w-fit items-center pl-1.5 opacity-60" for="floor">
                            {{ $t('address.floor_short') }}
                        </label>
                        <BaseInput
                            id="floor"
                            v-model="address.form.floor"
                            :class="{
                                'cursor-not-allowed': !address.editor.isEditing,
                                '!shadow-red-500': address.editor.isEditing && address.form.invalid('floor'),
                            }"
                            :disabled="!address.editor.isEditing"
                            aria-label="floor"
                            class="text-charcoal/60 max-w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                            customClass="p-0 min-h-7.5 placeholder-text-sm pl-8"
                            maxlength="3"
                            name="floor"
                            placeholder="--"
                            @change="address.form.validate('floor')"
                        />
                    </div>

                    <div class="relative col-span-4 lg:col-span-2">
                        <label class="absolute inset-0 flex w-fit items-center pl-1.5 opacity-60" for="entrance">
                            {{ $t('address.entrance_short') }}
                        </label>
                        <BaseInput
                            id="entrance"
                            v-model="address.form.entrance"
                            :class="{
                                'cursor-not-allowed': !address.editor.isEditing,
                                '!shadow-red-500': address.editor.isEditing && address.form.invalid('entrance'),
                            }"
                            :disabled="!address.editor.isEditing"
                            aria-label="entrance"
                            class="text-charcoal/60 max-w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                            customClass="p-0 min-h-7.5 placeholder-text-sm pl-11"
                            maxlength="3"
                            name="entrance"
                            placeholder="--"
                            @change="address.form.validate('entrance')"
                        />
                    </div>

                    <div class="relative col-span-4 lg:col-span-2">
                        <label class="absolute inset-0 flex w-fit items-center pl-1.5 opacity-60" for="intercom">
                            {{ $t('address.intercom_short') }}
                        </label>
                        <BaseInput
                            id="intercom"
                            v-model="address.form.intercom"
                            :class="{
                                'cursor-not-allowed': !address.editor.isEditing,
                                '!shadow-red-500': address.editor.isEditing && address.form.invalid('intercom'),
                            }"
                            :disabled="!address.editor.isEditing"
                            aria-label="intercom"
                            class="text-charcoal/60 max-w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                            customClass="p-0 min-h-7.5 placeholder-text-sm pl-8"
                            maxlength="3"
                            name="intercom"
                            placeholder="--"
                            @change="address.form.validate('intercom')"
                        />
                    </div>
                </div>
                <p v-if="address.form.invalid('label')" class="w-full text-[12px] text-nowrap text-red-500">
                    {{ address.form.errors.label }}
                </p>
                <p v-if="address.form.invalid('floor')" class="w-full text-[12px] text-nowrap text-red-500">
                    {{ address.form.errors.floor }}
                </p>
                <p v-if="address.form.invalid('street')" class="w-full text-[12px] text-nowrap text-red-500">
                    {{ address.form.errors.street_name }}
                </p>
                <p v-if="address.form.invalid('entrance')" class="w-full text-[12px] text-nowrap text-red-500">
                    {{ address.form.errors.entrance }}
                </p>
                <p v-if="address.form.invalid('apartment')" class="w-full text-[12px] text-nowrap text-red-500">
                    {{ address.form.errors.apartment }}
                </p>
                <p v-if="address.form.invalid('building')" class="w-full text-[12px] text-nowrap text-red-500">
                    {{ address.form.errors.building }}
                </p>
                <p v-if="address.form.invalid('intercom')" class="w-full text-[12px] text-nowrap text-red-500">
                    {{ address.form.errors.intercom }}
                </p>
                <p v-if="address.form.invalid('postal_code')" class="w-full text-[12px] text-nowrap text-red-500">
                    {{ address.form.errors.postal_code }}
                </p>
            </form>
            <div v-else class="flex w-full flex-col items-center justify-center">
                <img :src="iconNoAddress" alt="" />
                <h2 class="text-lg font-bold">{{ $t('address.actions.address_empty') }}</h2>
            </div>
            <Button
                v-show="!isAdding[addr_type.id]"
                class="flex items-center font-bold"
                customClass="!py-2 !px-5 lg:!py-2 md:py-2 w-fit"
                @click="addNewAddress(addr_type.id)"
                ><span class="text-base lg:text-[24px]">+</span> {{ $t('address.actions.add_btn') }}
            </Button>
        </div>
    </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition:
        opacity 0.3s ease,
        transform 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: scale(0.95);
}

.fade-slide-enter-active,
.fade-slide-leave-active {
    transition: all 0.3s ease;
}
.fade-slide-enter-from,
.fade-slide-leave-to {
    opacity: 0;
    transform: translateY(5px);
}
</style>
