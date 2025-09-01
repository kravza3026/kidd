<script>
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import Button from '@/components/ui/Button.vue';
import BaseCheckbox from '@/components/ui/BaseCheckbox.vue';
import BaseInput from '@/components/ui/BaseInput.vue';
import clickOutside from '@/clickOutside.js';
import { useAlert } from '@/useAlert.js'; // icons
import iconMarker from '@img/icons/marker_outline.png';
import iconUnknow from '@img/common/baby_unknown.svg';
import iconTrash from '@img/common/trash.svg';
import iconSettings from '@img/icons/Settings_base.svg';
import iconClose from '@img/icons/close.svg';
import iconCheck from '@img/icons/checked_white.svg';
import iconDate from '@img/icons/date.png';
import selectIcon from '@img/icons/select-arrows_o.svg';

export default {
    name: 'Family',
    components: { BaseInput, Button, BaseCheckbox },

    directives: {
        clickOutside,
    },
    data() {
        return {
            family: [],
            genders: [],
            locale: document.documentElement.lang || 'ro',
            iconMarker,
            iconTrash,
            selectIcon,
            iconSettings,
            iconClose,
            iconUnknow,
            iconCheck,
            iconDate,
        };
    },
    setup() {
        const { locale, t, n } = useI18n();
        const { showAlert } = useAlert();
        const isAddingChild = ref(false);
        return {
            isAddingChild,
            showAlert,
            locale,
            t,
            n,
        };
    },
    methods: {
        async getFamily() {
            await window.axios
                .get(this.route('api.family.index'))
                .then((response) => {
                    this.genders = response.data.genders;

                    this.family = response.data.family.map((item) => ({
                        ...item,
                        editor: {
                            isEditing: false,
                            dropdownCityOpen: false,
                            dropdownDistrictOpen: false,
                            confirmingDelete: false,
                        },
                    }));
                })
                .catch((error) => {
                    console.error('Server error:', error);
                });
        },

        addChild() {
            if (this.isAddingChild) return;

            // Перевіряємо, чи вже є форма для нової дитини
            const hasUnsaved = this.family.some((child) => child.isNew);
            if (hasUnsaved) {
                return;
            }
            this.isAddingChild = true;
            const newChild = {
                isNew: true,
                id: Date.now(),
                name: '',
                birth_date: '',
                gender: {
                    gender_id: 1,
                    name: {},
                    bg_color: '',
                    svg: '',
                },
                height: '',
                weight: '',
                editor: {
                    isEditing: true,
                    dropdownCityOpen: false,
                    dropdownDistrictOpen: false,
                    confirmingDelete: false,
                },
            };

            this.family.push(newChild);
            this.isAddingChild = false;
        },

        async saveNewChild(id) {
            const index = this.family.findIndex((child) => child.id === id);
            if (index === -1) return;

            const child = this.family[index];

            await window.axios
                .post(this.route('api.family.store'), child)
                .then((response) => {
                    if (response.data) {
                        this.getFamily(); // Refresh the family list after creating a new child

                        this.showAlert({
                            type: 'success',
                            title: this.$t('family_member.alert.created_title'),
                            message: this.$t('family_member.alert.created_message'),
                        });
                    }
                })
                .catch((error) => {
                    console.error('Save error:', error.response?.data || error);
                });
        },

        async updateChild(id) {
            const index = this.family.findIndex((child) => child.id === id);
            if (index === -1) {
                return;
            }
            const member = this.family[index];

            await window.axios
                .put(this.route('api.family.update', member.id), member)
                .then((response) => {
                    this.getFamily(); // Refresh the family list after update

                    this.showAlert({
                        type: 'info',
                        title: this.$t('family_member.alert.update_title'),
                        message: this.$t('family_member.alert.update_message'),
                    });
                })
                .catch((error) => {
                    console.error('Update error:', error.response?.data || error);
                });
        },

        formatBirthDateToInput(birth_date) {
            if (!birth_date) return '';
            return birth_date.split('T')[0];
        },

        async confirmRemove(member_id) {
            await window.axios
                .delete(this.route('api.family.destroy', member_id))
                .then(() => {
                    this.getFamily(); // Refresh the family list after deletion

                    this.showAlert({
                        type: 'info',
                        title: this.$t('family_member.alert.delete_title'),
                        message: this.$t('family_member.alert.delete_message'),
                    });
                })
                .catch((error) => {
                    console.error('Delete error:', error.response?.data || error);
                });
        },

        toggleEdit(id) {
            const index = this.family.findIndex((child) => child.id === id);
            if (index !== -1) {
                this.family[index].editor.isEditing = !this.family[index].editor.isEditing;
            }
        },
        removeNewChild(id) {
            const index = this.family.findIndex((child) => child.id === id && child.isNew);
            if (index !== -1) {
                this.family.splice(index, 1);
            }
        },
        openDatePicker(id) {
            const el = document.getElementById('birthday-' + id);
            if (!el) return;

            if ('showPicker' in el) {
                el.showPicker();
            } else {
                el.focus(); // для iOS Safari та старих браузерів
            }
        },
    },
    mounted() {
        this.getFamily();
    },
};
</script>
<template>
    <div class="rounded-xl bg-white">
        <div
            v-for="(child, index) in family"
            :key="child.id"
            :class="{ 'border-b-0 lg:border-b-1': index !== family.length - 1, 'border-t-1': child.isNew }"
            class="border-light-border border-t border-b p-2 py-4 duration-500 lg:my-4 lg:rounded-xl lg:border lg:p-5"
        >
            <div class="flex items-center justify-between lg:space-y-2">
                <div class="w-fit items-start gap-x-2 lg:flex lg:items-center">
                    <div class="flex items-center gap-x-2">
                        <div
                            :class="child.gender.bg_color || 'bg-light-orange'"
                            class="border-light-border w-fit rounded-full border p-2"
                        >
                            <p
                                v-if="child.gender.svg"
                                class="flex size-5 max-h-5 max-w-5 items-center justify-center"
                                v-html="child.gender.svg || genders[0].svg"
                            ></p>
                            <img v-else :src="iconUnknow" alt="" />
                        </div>
                        <div class="items-center lg:flex">
                            <BaseInput
                                :id="'label-' + child.id"
                                v-model="child.name"
                                :class="{
                                    'cursor-not-allowed border-none !px-0 !shadow-none lg:!px-4':
                                        !child.editor.isEditing,
                                    'lg:!px-4': child.editor.isEditing,
                                }"
                                :disabled="!child.editor.isEditing"
                                :placeholder="$t('family_member.name_placeholder')"
                                aria-label="label"
                                autocomplate="given-name"
                                class="text-charcoal/60 rounded-2xl text-base font-bold shadow-sm duration-500 focus:outline-hidden"
                                customClass="min-w-40 max-w-fit lg:my-1 lg:min-h-7.5 !placeholder-text-sm !max-w-fit"
                                name="label"
                            />

                            <div v-if="!child.isNew" class="flex-no-wrap flex gap-x-1">
                                <p
                                    v-if="!child.editor.isEditing"
                                    class="lg: border-l-charcoal/40 hidden gap-x-1 border-l px-2 text-sm uppercase opacity-40 lg:block"
                                    v-text="child.age_diff"
                                ></p>
                                <p
                                    v-if="!child.editor.isEditing"
                                    class="border-r-charcoal/50 w-fit border-r px-1 py-0 text-sm text-nowrap opacity-40 lg:hidden lg:p-2"
                                    v-text="child.age_diff"
                                ></p>
                                <p
                                    class="border-r-charcoal/50 w-fit border-r px-1 text-start text-sm opacity-40 lg:hidden"
                                >
                                    {{ child.height }} {{ $t('family_member.height_label') }}
                                </p>
                                <p class="w-fit px-1 text-start text-sm opacity-40 lg:hidden">
                                    {{ child.weight.toFixed(1) }} kg
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="!child.editor.isEditing" class="flex items-center gap-x-2">
                    <button
                        :class="{
                            'text-olive': !child.editor.isEditing,
                            'bg-olive text-white': child.editor.isEditing,
                        }"
                        class="settings border-light-border group relative cursor-pointer rounded-full border p-2 shadow-sm duration-500"
                        @click="toggleEdit(child.id)"
                        @keydown.enter="toggleEdit(child.id)"
                    >
                        <div
                            class="absolute -top-10 left-2/3 z-10 mt-2 w-max -translate-x-2/5 rounded-full bg-black px-3 py-1 text-sm text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                        >
                            {{ $t('family_member.edit') }}
                            <div
                                class="absolute -bottom-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                            ></div>
                        </div>
                        <svg class="size-4" fill="none" viewBox="0 0 25 24" xmlns="http://www.w3.org/2000/svg">
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
                        v-click-outside="() => (child.editor.confirmingDelete = false)"
                        class="group border-light-border relative flex h-9 w-9 cursor-pointer items-center justify-center rounded-full border p-2 shadow-sm"
                        tabindex="0"
                        @click="child.editor.confirmingDelete = !child.editor.confirmingDelete"
                        @keydown.enter="child.editor.confirmingDelete = !child.editor.confirmingDelete"
                    >
                        <img :src="iconTrash" alt="" class="size-4" />
                        <div
                            class="absolute -top-10 left-2/3 z-10 mt-2 w-max -translate-x-2/5 rounded-full bg-black px-3 py-1 text-sm text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                        >
                            {{ $t('family_member.delete') }}
                            <div
                                class="absolute -bottom-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                            ></div>
                        </div>
                        <transition appear name="fade-slide">
                            <div
                                v-if="child.editor.confirmingDelete"
                                class="absolute -right-9 -bottom-8 flex w-[100px] items-center justify-between gap-x-2"
                            >
                                <!-- Cancel -->
                                <div
                                    class="bg-olive flex h-5 w-full justify-center rounded-2xl py-1 text-center opacity-85 shadow-sm transition-all duration-300 ease-in-out hover:opacity-100"
                                    tabindex="0"
                                    @keydown.enter="child.editor.confirmingDelete = false"
                                    @click.stop="child.editor.confirmingDelete = false"
                                >
                                    <img :src="iconClose" alt="" />
                                </div>

                                <!-- Confirm -->
                                <div
                                    class="bg-danger flex h-5 w-full justify-center rounded-2xl py-1 text-center opacity-85 shadow-sm transition-all duration-300 ease-in-out hover:opacity-100"
                                    tabindex="0"
                                    @keydown.enter="confirmRemove(child.id)"
                                    @click.stop="confirmRemove(child.id)"
                                >
                                    <img :src="iconCheck" alt="" />
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <div
                    v-else-if="child.editor.isEditing && !child.isNew"
                    class="my-2 hidden flex-nowrap items-center gap-x-2 text-nowrap lg:my-0 lg:flex"
                >
                    <Button
                        :customClass="'!my-0 !px-4 !py-1.5 h-fit flex flex-nowrap !rounded-full !shadow-none text-sm font-medium'"
                        tabindex="0"
                        @click="updateChild(child.id)"
                        @keydown.enter="updateChild(child.id)"
                    >
                        <img :src="iconCheck" alt="" class="size-2" /> Save child
                    </Button>
                    <Button
                        :customClass="'w-fit px-3 !py-1.5 h-fit !shadow-none bg-white text-olive !rounded-full font-medium text-sm !m-0'"
                        buttonPrimary
                        tabindex="0"
                        @click="child.editor.isEditing = false"
                        @keydown.enter="child.editor.isEditing = false"
                        >Cancel</Button
                    >
                </div>
                <div v-else class="hidden items-center gap-x-2 lg:flex">
                    <Button
                        :customClass="'w-fit !px-4 !py-1.5 h-fit text-nowrap flex flex-nowrap !rounded-full !shadow-none text-sm font-medium'"
                        tabindex="0"
                        @click="saveNewChild(child.id)"
                        @keydown.enter="saveNewChild(child.id)"
                    >
                        <img :src="iconCheck" alt="" class="-mr-3 size-3" /> Save child
                    </Button>
                    <Button
                        :customClass="'w-fit px-3 !py-1.5 h-fit !shadow-none bg-white text-olive !rounded-full font-medium text-sm !m-0'"
                        buttonPrimary
                        @click="removeNewChild(child.id)"
                        @keydown.enter="removeNewChild(child.id)"
                        >Cancel</Button
                    >
                </div>
            </div>

            <div
                :class="{ 'hidden cursor-not-allowed lg:grid': !child.editor.isEditing, '': child.editor.isEditing }"
                class="my-2 grid justify-between gap-x-4 lg:grid-cols-17"
            >
                <div class="relative col-span-8 mt-4 flex items-center lg:col-span-3 lg:mt-0">
                    <label
                        class="absolute flex cursor-pointer items-center pl-2 opacity-40 duration-500"
                        for="birthday"
                        @click.prevent="openDatePicker"
                    >
                        <img :src="iconDate" alt="date" />
                    </label>

                    <BaseInput
                        :id="'birthday-' + child.id"
                        v-model="child.birth_date"
                        :class="{
                            'pointer-events-none hidden cursor-not-allowed lg:flex': !child.editor.isEditing,
                            '': child.editor.isEditing,
                        }"
                        :disabled="false"
                        :placeholder="$t('family_member.birthday_placeholder')"
                        :value="formatBirthDateToInput(child.birth_date)"
                        aria-label="birthday"
                        class="text-charcoal/60 no-date-icon w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                        customClass="p-0 !pl-8 h-7.5 placeholder-text-sm"
                        name="birthday"
                        type="date"
                        @click="openDatePicker(child.id)"
                    />
                </div>

                <div class="relative col-span-8 mt-4 rounded-lg shadow-sm lg:col-span-2 lg:mt-0">
                    <div
                        v-click-outside="() => (child.editor.dropdownDistrictOpen = false)"
                        :class="{
                            'hidden cursor-not-allowed lg:flex': !child.editor.isEditing,
                            '': child.editor.isEditing,
                        }"
                        class="border-light-border flex w-full items-center justify-between rounded-lg border px-3 py-1"
                        role="listbox"
                        tabindex="0"
                        @click="
                            child.editor.isEditing &&
                            (child.editor.dropdownDistrictOpen = !child.editor.dropdownDistrictOpen)
                        "
                        @focus="
                            child.editor.isEditing &&
                            (child.editor.dropdownDistrictOpen = !child.editor.dropdownDistrictOpen)
                        "
                    >
                        <input v-model="child.gender.id" name="gender_id" type="hidden" />
                        <p class="flex items-center text-sm opacity-60">
                            {{ child.gender.name[locale] || $t('family_member.gender_placeholder') }}
                        </p>
                        <img
                            :class="{ 'opacity-0': !child.editor.isEditing, 'opacity-40': child.editor.isEditing }"
                            :src="selectIcon"
                            alt="selectIcon"
                            class="duration-500"
                        />
                    </div>

                    <ul
                        v-if="child.editor.dropdownDistrictOpen"
                        class="border-light-border absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded border bg-white shadow-sm"
                    >
                        <li
                            v-for="gender in genders"
                            :key="gender.id"
                            class="flex cursor-pointer gap-x-2 px-3 py-2 text-sm hover:bg-gray-100"
                            tabindex="0"
                            @click="
                                child.editor.dropdownDistrictOpen = false;
                                child.gender = gender;
                            "
                            @keydown.enter="
                                child.editor.dropdownDistrictOpen = false;
                                child.gender = gender;
                            "
                        >
                            {{ gender.name[locale] }}
                        </li>
                    </ul>
                </div>

                <div
                    :class="{
                        'hidden cursor-not-allowed lg:flex': !child.editor.isEditing,
                        '': child.editor.isEditing,
                    }"
                    class="relative col-span-4 mt-4 flex items-center lg:col-span-2 lg:mt-0"
                >
                    <BaseInput
                        :id="'height-' + child.id"
                        v-model="child.height"
                        :disabled="!child.editor.isEditing && !child.isNew"
                        :placeholder="$t('family_member.height_placeholder')"
                        aria-label="height"
                        class="text-charcoal/60 w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                        customClass="p-0 flex items-center min-h-7.5 placeholder-text-sm  leading-none"
                        name="height"
                        type=""
                    />
                    <span
                        v-if="child.height > 0"
                        class="pointer-events-none absolute top-1/2 right-2 left-0 -translate-y-1/2 p-1 text-sm text-gray-500"
                        ><span class="opacity-0">{{ child.height }}</span>
                        <span class="pl-3">{{ $t('family_member.height_label') }}</span>
                    </span>
                </div>
                <div
                    :class="{
                        'hidden cursor-not-allowed lg:flex': !child.editor.isEditing,
                        '': child.editor.isEditing,
                    }"
                    class="relative col-span-4 mt-4 flex items-center lg:col-span-2 lg:mt-0"
                >
                    <BaseInput
                        :id="'weight-' + child.id"
                        v-model="child.weight"
                        :disabled="!child.editor.isEditing && !child.isNew"
                        :placeholder="$t('family_member.weight_placeholder')"
                        aria-label="weight"
                        class="text-charcoal/60 w-full rounded-2xl text-sm shadow-sm duration-500 focus:outline-hidden"
                        customClass="p-0 flex items-center min-h-7.5 placeholder-text-sm  leading-none"
                        name="weight"
                    />
                    <span
                        v-if="child.weight > 0"
                        class="pointer-events-none absolute top-1/2 right-2 left-0 -translate-y-1/2 p-1 text-sm text-gray-500"
                        ><span class="opacity-0">{{ child.weight }}</span>
                        <span class="pl-3">{{ $t('family_member.weight_label') }}</span>
                    </span>
                </div>
            </div>
            <div
                v-if="child.editor.isEditing && !child.isNew"
                class="my-2 grid flex-nowrap items-center gap-y-2 text-nowrap lg:my-0 lg:hidden"
            >
                <Button
                    :customClass="'w-full !my-0 !px-4 !py-1.5 h-fit flex flex-nowrap !rounded-full !shadow-none text-sm font-medium'"
                    @click="updateChild(child.id)"
                >
                    <img :src="iconCheck" alt="" class="size-2" /> Save child
                </Button>
                <Button
                    :customClass="'w-full px-3 !py-1.5 h-fit !shadow-none bg-white text-olive !rounded-full font-medium text-sm !m-0'"
                    buttonPrimary
                    @click="child.editor.isEditing = false"
                    >Cancel</Button
                >
            </div>
            <div v-else-if="child.editor.isEditing && child.isNew" class="grid items-center gap-y-2 lg:hidden">
                <Button
                    :customClass="'w-full !my-0 !px-4 !py-1.5 h-fit text-nowrap flex flex-nowrap !rounded-full !shadow-none text-sm font-medium'"
                    @click="saveNewChild(child.id)"
                >
                    <img :src="iconCheck" alt="" class="-mr-3 size-3" /> Save child
                </Button>
                <Button
                    :customClass="'!w-full px-3 !py-1.5 h-fit !shadow-none bg-white text-olive !rounded-full font-medium text-sm !m-0'"
                    buttonPrimary
                    @click="removeNewChild(child.id)"
                    >Cancel</Button
                >
            </div>
        </div>
    </div>
    <Button
        v-if="!isAddingChild"
        class="flex items-center font-bold"
        customClass="!py-1 md:!py-2 w-11/12 mx-auto lg:mx-0 lg:w-fit"
        @click="addChild()"
        @keydown.enter="addChild()"
        ><span class="text-[24px]">+</span> Add child
    </Button>
</template>

<style scoped>
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
