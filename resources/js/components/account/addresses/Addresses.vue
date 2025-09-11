<script>
import { ref } from 'vue';
import Button from '@/components/ui/Button.vue';
import BaseCheckbox from '@/components/ui/BaseCheckbox.vue';
import clickOutside from '@/clickOutside.js';
import iconMarker from '@img/icons/marker_outline.png';
import iconFavorite from '@img/icons/favorite_white.svg';
import iconFavoriteOl from '@img/icons/olive/favorite_olive.svg';
import iconTrash from '@img/common/trash.svg';
import iconNoAddress from '@img/common/empty_addresses.jpg';
import iconSettings from '@img/icons/Settings_base.svg';
import iconClose from '@img/icons/close.svg';
import iconCheck from '@img/icons/checked_white.svg';
import selectIcon from '@img/icons/select-arrows_o.svg';
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
    components: { BaseInput, Button, BaseCheckbox },

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
                                class="text-charcoal/60 max-w-4/5 rounded-2xl font-bold shadow-sm duration-500 focus:outline-hidden lg:max-w-full lg:text-[20px]"
                                customClass="!p-0 min-h-7.5 placeholder-text-sm "
                                name="label"
                                @change="address.form.validate('label')"
                            />
                            <div class="max-w-full text-xs opacity-65 lg:hidden">
                                <p v-if="!address.editor.isEditing">
                                    {{ address.form.region?.name[locale] || address.form.region?.name['ro'] }},
                                    {{ address.form.city?.name[locale] || address.form.city?.name['ro'] }},<br />
                                    {{
                                        address.form?.street_name +
                                        ' ' +
                                        $t('address.building_short') +
                                        address.form?.building
                                    }},
                                    {{ $t('address.apartment_short') + address.form?.apartment }}
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
                                        class="gradient_r-b_dark relative flex size-8 cursor-pointer items-center justify-center rounded-full border border-transparent !p-0 shadow-sm duration-500 lg:h-fit lg:w-fit"
                                    >
                                        <span class="absolute inset-0 rounded-full bg-black/15"></span>
                                        <div
                                            class="relative z-10 flex !w-full items-center justify-center p-0 lg:gap-x-2 lg:px-3 lg:py-2"
                                        >
                                            <img :src="iconFavorite" alt="" class="size-4" />
                                            <p class="hidden text-xs font-bold text-white lg:block">
                                                {{ $t('address.actions.default') }}
                                            </p>
                                        </div>
                                    </button>
                                    <button
                                        v-else
                                        class="border-light-border relative flex size-8 cursor-pointer items-center justify-center rounded-full border !p-0 shadow-sm duration-500 lg:h-fit lg:w-fit"
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
                                class="settings border-light-border hover:bg-olive group relative flex size-8 cursor-pointer items-center justify-center rounded-full border shadow-sm duration-500 hover:text-white lg:size-9"
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
                                <svg
                                    class="!size-4"
                                    fill="none"
                                    height="24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                    width="24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path
                                        d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"
                                    />
                                </svg>
                            </button>

                            <div
                                v-if="!address.editor.isEditing"
                                v-click-outside="() => (address.editor.confirmingDelete = false)"
                                class="group border-light-border text-olive hover:bg-olive relative flex size-8 cursor-pointer items-center justify-center rounded-full border !p-0 shadow-sm hover:text-white lg:size-9"
                                @click="address.editor.confirmingDelete = !address.editor.confirmingDelete"
                            >
                                <svg
                                    class="size-4"
                                    fill="none"
                                    height="24"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2.1"
                                    viewBox="0 0 24 24"
                                    width="24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path d="M10 11v6" />
                                    <path d="M14 11v6" />
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                    <path d="M3 6h18" />
                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                </svg>
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

                    <div class="relative col-span-12 lg:col-span-4">
                        <BaseInput
                            :id="'street_' + address.id"
                            v-model="address.form.street_name"
                            :class="{
                              'cursor-not-allowed': !address.editor.isEditing,
                              '!shadow-red-500': address.editor.isEditing && address.form.invalid('street'),
                            }"
                            :disabled="!address.editor.isEditing"
                            aria-label="street"
                            class="text-charcoal/60 rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                            customClass="p-0 h-7.5 peer w-full bg-transparent text-sm border border-slate-200 rounded-md px-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            name="street"
                            @change="address.form.validate('street')"
                        />
                        <label
                            :class="{
                              'text-scale-200 !-top-2 left-2.5 scale-90 text-xs text-gray-500/50':
                                address.form.street_name,
                            }"
                            :for="'street_' + address.id"
                            class="absolute top-1 left-2.5 origin-left transform cursor-text bg-white px-1 text-sm text-gray-500/50 transition-all peer-focus:-top-2 peer-focus:left-2.5 peer-focus:scale-90 peer-focus:text-xs"
                        >
                            {{ $t('address.street_short') }}
                        </label>
                    </div>

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
                                'text-scale-200 !-top-2 left-2.5 scale-90 text-xs text-gray-500/50':
                                    address.form.building,
                            }"
                            :for="'building_' + address.id"
                            class="absolute top-1 left-2.5 origin-left transform cursor-text bg-white px-1 text-sm text-gray-500/50 transition-all peer-focus:-top-2 peer-focus:left-2.5 peer-focus:scale-90 peer-focus:text-xs"
                        >
                            {{ $t('address.building_short') }}
                        </label>
                    </div>



                    <div class="relative col-span-4 lg:col-span-2">
                        <BaseInput
                            :id="'apartment_' + address.id"
                            v-model="address.form.apartment"
                            :class="{
                              'cursor-not-allowed': !address.editor.isEditing,
                              '!shadow-red-500': address.editor.isEditing && address.form.invalid('apartment'),
                            }"
                            :disabled="!address.editor.isEditing"
                            aria-label="apartment"
                            class="text-charcoal/60 max-w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                            customClass="p-0 min-h-7.5 peer w-full bg-transparent text-sm border border-slate-200 rounded-md px-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            maxlength="3"
                            name="apartment"
                            placeholder="--"
                            @change="address.form.validate('apartment')"
                        />
                        <label
                            :class="{
                              'text-scale-200 !-top-2 left-2.5 scale-90 text-xs text-gray-500/50': address.form.apartment,
                            }"
                            :for="'apartment_' + address.id"
                            class="absolute top-1 left-2.5 origin-left transform cursor-text bg-white px-1 text-sm text-gray-500/50 transition-all peer-focus:-top-2 peer-focus:left-2.5 peer-focus:scale-90 peer-focus:text-xs"
                        >
                            {{ $t('address.apartment_short') }}
                        </label>
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
                        <div class="relative col-span-4 lg:col-span-2">
                            <BaseInput
                                :id="'floor_' + address.id"
                                v-model="address.form.floor"
                                :class="{
                                  'cursor-not-allowed': !address.editor.isEditing,
                                  '!shadow-red-500': address.editor.isEditing && address.form.invalid('floor'),
                                }"
                                :disabled="!address.editor.isEditing"
                                aria-label="floor"
                                class="text-charcoal/60 max-w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                                customClass="p-0 min-h-7.5 peer w-full bg-transparent text-sm border border-slate-200 rounded-md px-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                maxlength="3"
                                name="floor"
                                @change="address.form.validate('floor')"
                            />
                            <label
                                :class="{
                                  'text-scale-200 !-top-2 left-2.5 scale-90 text-xs text-gray-500/50':
                                    address.form.floor,
                                }"
                                :for="'floor_' + address.id"
                                class="absolute top-1 left-2.5 origin-left transform cursor-text bg-white px-1 text-sm text-gray-500/50 transition-all peer-focus:-top-2 peer-focus:left-2.5 peer-focus:scale-90 peer-focus:text-xs"
                            >
                                {{ $t('address.floor_short') }}
                            </label>
                        </div>

                    </div>

                    <div class="relative col-span-4 lg:col-span-2">

                        <div class="relative col-span-4 lg:col-span-2">
                            <BaseInput
                                :id="'entrance_' + address.id"
                                v-model="address.form.entrance"
                                :class="{
                                  'cursor-not-allowed': !address.editor.isEditing,
                                  '!shadow-red-500': address.editor.isEditing && address.form.invalid('entrance'),
                                }"
                                :disabled="!address.editor.isEditing"
                                aria-label="entrance"
                                class="text-charcoal/60 max-w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                                customClass="p-0 min-h-7.5 peer w-full bg-transparent text-sm border border-slate-200 rounded-md px-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                maxlength="3"
                                name="entrance"
                                @change="address.form.validate('entrance')"
                            />
                            <label
                                :class="{
                                  'text-scale-200 !-top-2 left-2.5 scale-90 text-xs text-gray-500/50':
                                    address.form.entrance,
                                }"
                                :for="'entrance_' + address.id"
                                class="absolute top-1 left-2.5 origin-left transform cursor-text bg-white px-1 text-sm text-gray-500/50 transition-all peer-focus:-top-2 peer-focus:left-2.5 peer-focus:scale-90 peer-focus:text-xs"
                            >
                                {{ $t('address.entrance_short') }}
                            </label>
                        </div>

                    </div>

                    <div class="relative col-span-4 lg:col-span-2">
                        <div class="relative col-span-4 lg:col-span-2">
                            <BaseInput
                                :id="'intercom_' + address.id"
                                v-model="address.form.intercom"
                                :class="{
                                  'cursor-not-allowed': !address.editor.isEditing,
                                  '!shadow-red-500': address.editor.isEditing && address.form.invalid('intercom'),
                                }"
                                :disabled="!address.editor.isEditing"
                                aria-label="intercom"
                                class="text-charcoal/60 max-w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                                customClass="p-0 min-h-7.5 peer w-full bg-transparent text-sm border border-slate-200 rounded-md px-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                maxlength="3"
                                name="intercom"
                                @change="address.form.validate('intercom')"
                            />
                            <label
                                :class="{
                                  'text-scale-200 !-top-2 left-2.5 scale-90 text-xs text-gray-500/50':
                                    address.form.intercom,
                                }"
                                :for="'intercom_' + address.id"
                                class="absolute top-1 left-2.5 origin-left transform cursor-text bg-white px-1 text-sm text-gray-500/50 transition-all peer-focus:-top-2 peer-focus:left-2.5 peer-focus:scale-90 peer-focus:text-xs"
                            >
                                {{ $t('address.intercom_short') }}
                            </label>
                        </div>

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
