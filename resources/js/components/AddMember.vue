<script>
import {reactive, ref} from 'vue'
import { useI18n } from 'vue-i18n'
import Button from "@/components/ui/Button.vue";
import SubscribeForm from "@/components/ui/subscribeForm.vue";
import BaseCheckbox from "@/components/ui/BaseCheckbox.vue";
import clickOutside from "@/clickOutside.js";
import iconMarker from "@img/icons/marker_outline.png"
import iconUnknow from "@img/common/baby_unknown.svg"
import iconTrash from "@img/common/trash.svg"
import iconSettings from "@img/icons/Settings_base.svg"
import iconClose from '@img/icons/close.svg'
import iconCheck from '@img/icons/checked_white.svg'
import selectIcon from "@img/icons/select-arrows.svg"
import BaseInput from "@/components/ui/BaseInput.vue";
import {debounce} from "lodash";

export default {
    name: 'AddMember',
    components: {BaseInput, Button, SubscribeForm, BaseCheckbox},

    directives: {
        clickOutside,
    },
    data(){
        return {
            family:[],
            genders:reactive([]),
            locale: document.documentElement.lang || 'ro',
            addresses: reactive([]),
            regions: reactive([]),
            cities: [],
            currentRegion: ref(null),
            _isAddingAddress: false,
            iconMarker,iconTrash,selectIcon,iconSettings,iconClose,iconUnknow,iconCheck

        }
    },
    setup(){
        const { locale, t, n } = useI18n();

        return {
            locale,
            t,
            n,
        }
    },
    methods: {
        async getGenders() {

            await window.axios.get(`/genders`, {

            })
                .then((response) => {
                  this.genders = response.data
                    console.log('Genders ', this.genders)
                }).catch((error) => {
                    console.error('Server error:', error)
                });

        },
        async getFamily() {

            await window.axios.get(`/user/family`, {

            })
                .then((response) => {
                    this.family = response.data.map(item => ({
                        ...item,
                        editor: {
                            isEditing: false,
                            dropdownCityOpen: false,
                            dropdownDistrictOpen: false,
                            confirmingDelete: false,
                        }
                    }));
                    console.log('Family ', this.family)
                }).catch((error) => {
                    console.error('Server error:', error)
                });

        },

        addChild() {
            if (this._isAddingChild) return;

            // Перевіряємо, чи вже є форма для нової дитини
            const hasUnsaved = this.family.some(child => child.isNew);
            if (hasUnsaved) {
                console.warn("Вже є незбережена форма дитини");
                return;
            }

            this._isAddingChild = true;

            const newChild = {
                isNew: true,
                id: Date.now(),
                name: '',
                birth_date: '',
                gender: {
                    gender_id: 1,
                    name: {},
                    bg_color: '',
                    svg: ''
                },
                height: '',
                weight: '',
                editor: {
                    isEditing: true,
                    dropdownCityOpen: false,
                    dropdownDistrictOpen: false,
                    confirmingDelete: false
                }
            };

            this.family.push(newChild);
            this._isAddingChild = false;
        },

        async saveNewChild(id) {
            const index = this.family.findIndex(child => child.id === id);
            if (index === -1) return;

            const child = this.family[index];
            const payload = {
                id: child.isNew ? null : child.id,
                name: child.name,
                birth_date: child.birth_date,
                gender: child.gender,
                height: child.height,
                weight: child.weight,
            };

            try {
                const { data } = await window.axios.post(
                    `/addChild`,
                    payload,
                    { withCredentials: true }
                );

                if (data.child) {
                    this.family[index] = {
                        ...this.family[index],
                        ...data.child,
                        isNew: false
                    };
                }
            } catch (error) {
                console.error("Save error:", error.response?.data || error);
            }
        },


        async updateChild(id) {
            const index = this.family.findIndex(child => child.id === id);
            if (index === -1) {
                console.error("id", id, "not found");
                return;
            }
            const updatingChild = this.family[index];
            const options = {
                id: updatingChild.id,
                name: updatingChild.name,
                birth_date: updatingChild.birth_date,
                gender: updatingChild.gender,
                height: updatingChild.height,
                weight: updatingChild.weight,
            };
            console.log('update ', options)
            try {

                const { data } = await window.axios.post(
                    `/addChild`,
                    options,
                    { withCredentials: true }
                );

                if (data.child) {
                    this.family[index] = { ...this.family[index], ...data.child };
                }

            } catch (error) {

                console.error("Save error:", error.response?.data || error);
            }
        },

        formatBirthDateToInput(birth_date) {
            if (!birth_date) return '';
            return birth_date.split('T')[0];
        },
        calculateAge(birth_date) {
            if (!birth_date) return null;

            const birthDate = new Date(birth_date.split('T')[0]);
            const today = new Date();

            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age;
        },
        confirmRemove(id) {
            const index = this.addresses.findIndex(addr => addr.id === id);
            if (index !== -1) {
                this.addresses.splice(index, 1);
            }
        },

        toggleEdit(id) {
            const index = this.family.findIndex(child => child.id === id);
            if (index !== -1) {
                this.family[index].editor.isEditing = !this.family[index].editor.isEditing;
            }
        },
        removeNewChild(id) {
            const index = this.family.findIndex(child => child.id === id && child.isNew);
            if (index !== -1) {
                this.family.splice(index, 1);
            }
        }
    },
    mounted() {
        this.getFamily()
        this.getGenders()
    }
}
</script>
<template>
    <div class=" bg-white">

        <div v-for="(child, index) in family"
             :key="child.id" class="duration-500  my-4 border border-light-border rounded-xl p-5">
            <div  class="flex items-center justify-between ">
                <div class="flex items-center gap-x-2">
                    <div class="p-2 rounded-full border border-light-border" :class="child.gender.bg_color || 'bg-light-orange '">
                       <p v-if="child.gender.svg" class="size-5 flex items-center justify-center"
                           v-html="child.gender.svg || genders[0].svg"></p>
                        <img v-else :src="iconUnknow" alt="">
                    </div>
                    <BaseInput
                        :disabled="!child.editor.isEditing"
                        customClass="p-0 min-h-7.5 placeholder-text-sm"
                        name="label"
                        :id="'label-' + child.id"
                        placeholder="Enter name"
                        autocomplate="given-name"
                        :value="child.name"
                        v-model="child.name"
                        aria-label="label"
                        class="shadow-sm text-charcoal/60 rounded-2xl focus:outline-hidden duration-500 font-bold text-[20px]"
                        :class="{'cursor-not-allowed border-none !shadow-none': !child.editor.isEditing,'': child.editor.isEditing}"
                    />
                    <p>{{ calculateAge(child.birth_date) }}</p>
<!--                     TO DO: calculate age-->

                </div>
                <div v-if="!child.editor.isEditing" class="flex items-center gap-x-2">

                    <div
                        class="cursor-pointer group p-2 border border-light-border rounded-full shadow-sm relative"
                        @click="child.editor.confirmingDelete = !child.editor.confirmingDelete"
                        v-click-outside="() => child.editor.confirmingDelete = false"
                    >
                        <img class="size-4" :src="iconTrash" alt="" />
                        <div class="absolute left-2/3 -translate-x-2/5 -top-10 mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                            {{ $t('address.delete') }}
                            <div class="absolute -bottom-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
                        </div>
                        <transition name="fade-slide" appear>
                            <div

                                v-if="child.editor.confirmingDelete"
                                class="absolute w-[100px] -right-9 flex gap-x-2 justify-between items-center -bottom-8"
                            >
                                <!-- Cancel -->
                                <div
                                    class="hover:opacity-100 opacity-85 duration-300 transition-all ease-in-out shadow-sm rounded-2xl  text-center py-1 flex justify-center bg-olive w-full h-5"
                                    @click.stop="child.editor.confirmingDelete = false"
                                >
                                    <img :src="iconClose" alt="" />
                                </div>

                                <!-- Confirm -->
                                <div
                                    class="hover:opacity-100 opacity-85 duration-300 transition-all ease-in-out shadow-sm rounded-2xl w-full text-center py-1 flex justify-center bg-danger h-5"
                                    @click.stop="removeChild(child.id)"
                                >
                                    <img :src="iconCheck" alt="" />
                                </div>
                            </div>
                        </transition>
                    </div>
                    <button class="settings cursor-pointer p-2 border border-light-border  rounded-full shadow-sm duration-500 relative group"
                            :class="{'text-olive': !child.editor.isEditing,'text-white bg-olive': child.editor.isEditing}"
                            @click="toggleEdit(child.id)"
                    >
                        <div class="absolute left-2/3 -translate-x-2/5 -top-10 mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                            {{ $t('child.edit') }}
                            <div class="absolute -bottom-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
                        </div>
                        <svg class="size-4" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7238 1.0313C12.7664 -0.343766 14.8336 -0.343766 15.8762 1.0313L16.2293 1.49696C16.7982 2.24724 17.7277 2.63222 18.6605 2.50397L19.2394 2.42437C20.949 2.18931 22.4107 3.65102 22.1756 5.3606L22.096 5.93954C21.9678 6.87235 22.3528 7.80178 23.103 8.37068L23.5687 8.72377C24.9438 9.76642 24.9438 11.8336 23.5687 12.8762L23.103 13.2293C22.3528 13.7982 21.9678 14.7277 22.096 15.6605L22.1756 16.2394C22.4107 17.949 20.949 19.4107 19.2394 19.1756L18.6605 19.096C17.7277 18.9678 16.7982 19.3528 16.2293 20.103L15.8762 20.5687C14.8336 21.9438 12.7664 21.9438 11.7238 20.5687L11.3707 20.103C10.8018 19.3528 9.87235 18.9678 8.93954 19.096L8.3606 19.1756C6.65102 19.4107 5.18931 17.949 5.42437 16.2394L5.50397 15.6605C5.63222 14.7277 5.24724 13.7982 4.49696 13.2293L4.0313 12.8762C2.65623 11.8336 2.65623 9.76642 4.0313 8.72377L4.49696 8.37068C5.24724 7.80178 5.63222 6.87235 5.50397 5.93954L5.42437 5.3606C5.18931 3.65102 6.65102 2.18931 8.3606 2.42437L8.93954 2.50397C9.87235 2.63222 10.8018 2.24724 11.3707 1.49696L11.7238 1.0313Z" fill="currentColor" fill-opacity="0.15"/>
                            <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M9.92377 2.23125C10.9664 0.856185 13.0336 0.856185 14.0762 2.23125L14.4293 2.69691C14.9982 3.44719 15.9277 3.83218 16.8605 3.70392L17.4394 3.62432C19.149 3.38926 20.6107 4.85097 20.3756 6.56055L20.296 7.13949C20.1678 8.0723 20.5528 9.00173 21.303 9.57064L21.7687 9.92372C23.1438 10.9664 23.1438 13.0335 21.7687 14.0762L21.303 14.4293C20.5528 14.9982 20.1678 15.9276 20.296 16.8604L20.3756 17.4394C20.6107 19.1489 19.149 20.6106 17.4394 20.3756L16.8605 20.296C15.9277 20.1677 14.9982 20.5527 14.4293 21.303L14.0762 21.7687C13.0336 23.1437 10.9664 23.1437 9.92377 21.7687L9.57068 21.303C9.00178 20.5527 8.07234 20.1677 7.13954 20.296L6.5606 20.3756C4.85102 20.6106 3.38931 19.1489 3.62437 17.4394L3.70397 16.8604C3.83222 15.9276 3.44724 14.9982 2.69695 14.4293L2.23129 14.0762C0.856231 13.0335 0.856231 10.9664 2.23129 9.92372L2.69695 9.57064C3.44724 9.00173 3.83222 8.0723 3.70397 7.13949L3.62437 6.56055C3.38931 4.85097 4.85102 3.38926 6.5606 3.62432L7.13954 3.70392C8.07234 3.83218 9.00178 3.44719 9.57068 2.69691L9.92377 2.23125Z" stroke="currentColor" stroke-width="2"/>
                        </svg>

                    </button>
                </div>
                <div v-else-if="child.editor.isEditing && !child.isNew" class="flex gap-x-2 items-center">
                    <Button @click="updateChild(child.id)" :customClass="'w-fit !px-3 !py-1 h-fit !rounded-full font-bold !m-0'">Save child</Button>
                    <Button @click="child.editor.isEditing = false" buttonPrimary :customClass="'w-fit px-3 !py-1 h-fit text-olive !rounded-full font-bold !m-0'" >Cancel</Button>

                </div>
                <div v-else class="flex gap-x-2 items-center">
                    <Button @click="saveNewChild(child.id)" :customClass="'w-fit !px-3 !py-1 h-fit !rounded-full font-bold'">Save child</Button>
                    <Button @click="removeNewChild(child.id)" buttonPrimary :customClass="'w-fit px-3 !py-1 h-fit text-olive !rounded-full font-bold'" >Cancel</Button>

                </div>
            </div>

            <div class="grid grid-cols-12 justify-between gap-x-4 my-4 w-full">

                <div class="relative col-span-3 rounded-lg shadow-sm">
                    <div
                        class="border border-light-border px-3 py-1 rounded-lg  w-full flex justify-between items-center"
                        :class="{'cursor-not-allowed': !child.editor.isEditing,'': child.editor.isEditing}"
                        @click="child.editor.isEditing && (child.editor.dropdownDistrictOpen = !child.editor.dropdownDistrictOpen)"
                        v-click-outside="() => child.editor.dropdownDistrictOpen = false"
                    >
                        <input type="hidden"  name="region_id" v-model="child.gender.id" >
                        <p class="flex items-center opacity-60 text-sm">
                            {{ child.gender.name[locale] || 'Gender' }}
                        </p>
                        <img :src="selectIcon" alt="selectIcon" class="duration-500"
                             :class="{'opacity-0': !child.editor.isEditing,'opacity-40': child.editor.isEditing}"   />
                    </div>

                    <ul
                        v-if="child.editor.dropdownDistrictOpen"
                        class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded shadow-sm max-h-60 overflow-auto"
                    >
                        <li
                            v-for="gender in genders"
                            :key="gender.id"
                            class="px-3 text-sm flex gap-x-2 py-2 cursor-pointer hover:bg-gray-100"
                            @click="updateChild(child.id);
                            child.editor.dropdownDistrictOpen = false;
                            child.gender = gender
"
                        >
                            {{ gender.name[locale] }}
                        </li>
                    </ul>

                </div>

                <BaseInput
                    type="date"
                    :disabled="!child.editor.isEditing"
                    customClass="p-0 h-7.5 placeholder-text-sm"
                    name="birthday"
                    id="birthday"
                    placeholder="Birthday"
                    :value="formatBirthDateToInput(child.birth_date)"
                    v-model="child.birth_date"
                    aria-label="street"
                    class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden col-span-3 duration-500"
                />

                <div class="relative flex items-center col-span-2">
                    <label class="absolute inset-0 pl-2 text-sm flex items-center w-fit" :for="'height-' + child.id" >cm:</label>
                    <BaseInput
                        :disabled="!child.editor.isEditing && !child.isNew"
                        customClass="p-0 flex items-center min-h-7.5 placeholder-text-sm pl-9 leading-none"
                        name="height"
                        :id="'height-' + child.id"
                        placeholder="height"
                        v-model="child.height"
                        aria-label="apartment"
                        class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden w-full duration-500"
                    />
                </div>
                <div class="relative flex items-center col-span-2">
                    <label class="absolute inset-0 pl-2 text-sm flex items-center w-fit" :for="'weight-' + child.id">gram:</label>
                    <BaseInput
                        :disabled="!child.editor.isEditing && !child.isNew"
                        customClass="p-0 flex items-center min-h-7.5 placeholder-text-sm pl-12 leading-none"
                        name="weight"
                        :id="'weight-' + child.id"
                        placeholder="weight"
                        v-model="child.weight"
                        aria-label="entrance"
                        class="shadow-sm text-charcoal/60 text-sm rounded-2xl focus:outline-hidden w-full duration-500"
                    />
                </div>

            </div>

        </div>
        <Button
            @click="addChild()"
            customClass="py-2 md:py-2 w-fit"
            class="font-bold flex items-center"><span class="text-[24px]">+</span> Add child

        </Button>
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
