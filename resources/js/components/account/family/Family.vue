<script>
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import Button from '@/components/ui/Button.vue';
import BaseCheckbox from '@/components/ui/BaseCheckbox.vue';
import BaseInput from '@/components/ui/BaseInput.vue';
import clickOutside from '@/clickOutside.js';
import { useAlert } from '@/useAlert.js'; // icons
import iconUnknow from '@img/common/baby_unknown.svg';
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
            selectIcon,
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
                        <div class="items-center lg:flex lg:items-center">
                            <BaseInput
                                v-show="child.editor.isEditing"
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
                                customClass="lg:my-1 lg:min-h-7.5 !placeholder-text-sm"
                                name="label"
                            />

                            <p v-show="!child.editor.isEditing" class="mr-2" v-text="child.name"></p>

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
                        class="settings border-light-border hover:bg-olive group relative cursor-pointer rounded-full border p-2 shadow-sm duration-500 hover:text-white"
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
                        <svg
                            class="size-4.5"
                            fill="none"
                            height="24"
                            stroke="currentColor"
                            stroke-width="2.2"
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
                        v-click-outside="() => (child.editor.confirmingDelete = false)"
                        class="group border-light-border text-olive hover:bg-olive relative flex h-9 w-9 cursor-pointer items-center justify-center rounded-full border p-2 shadow-sm hover:text-white"
                        tabindex="0"
                        @click="child.editor.confirmingDelete = !child.editor.confirmingDelete"
                        @keydown.enter="child.editor.confirmingDelete = !child.editor.confirmingDelete"
                    >
                        <svg
                            class="size-4.5"
                            fill="none"
                            height="24"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2.2"
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
