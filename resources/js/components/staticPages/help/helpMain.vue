<script>
import { ref, computed } from 'vue';
import Button from "@/components/ui/Button.vue";
import BaseInput from "@/components/ui/BaseInput.vue";
import BaseTextarea from "@/components/ui/BaseTextarea.vue";
import BaseCheckbox from "@/components/ui/BaseCheckbox.vue";
import BaseInputLabel from "@/components/ui/BaseInputLabel.vue";

export default {
    name: 'HelpMain',
    components: {BaseInputLabel, BaseCheckbox, BaseTextarea, Button, BaseInput},

    data() {
        return {
            searchQuery: '',
            locale: document.documentElement.lang || 'ro',
            items: [],
        };
    },

    setup() {
        const activeTab = ref('DeliveryTab');

        const tabContentItem = computed(() => {
            const el = document.getElementById(`tab-${activeTab.value}`);
            return el ? el.innerHTML : '';
        });

        return {
            activeTab,
            tabContentItem
        };
    },
    computed:{
        handleType: function() {
            if (this.timeout)
                clearTimeout(this.timeout);

            this.timeout = setTimeout(() => {
                this.search();
            }, 500); // delay
        }
    },
    methods:{
        async search() {
            if (!this.searchQuery.trim()) return [];

            const query = this.searchQuery.trim().toLowerCase();

            try {
                await axios.get(`/${this.locale}/search?term=${query}`)
                    .then(response => {
                        this.items = response.data.results;

                    })
                    .catch(error => {
                        console.error('Search error:', error);
                    });
            } catch (error) {
                console.error('Search error:', error);
            }
        },
    }

};

</script>
<template>
    <div class="container">
        <div class="relative">
            <input
                ref="searchInput"
                v-model="searchQuery"
                @input="handleType"
                type="text"
                class="w-full  focus:outline-hidden h-[50px] pl-2 pr-12 rounded-md bg-light-orange"
                placeholder="Search for questions"
                @keydown.esc="closeSearch"
            />
            <svg
                class="absolute text-olive right-4 top-1/3 transform  pointer-events-none"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M16.007 16.007L22 22M18.4103 10.2051C18.4103 14.7367 14.7367 18.4103 10.2051 18.4103C5.67356 18.4103 2 14.7367 2 10.2051C2 5.67356 5.67356 2 10.2051 2C14.7367 2 18.4103 5.67356 18.4103 10.2051Z"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </div>
    </div>

    <div class="tabs container flex lg:grid grid-cols-4 gap-3 mt-10 overflow-x-auto">

        <div ref="Delivery" @click="activeTab = 'DeliveryTab'"
            :class="activeTab === 'DeliveryTab' ? 'bg-olive text-white' : 'bg-olive/5 hover:bg-olive text-charcoal hover:text-white'"
            class="tab cursor-pointer group relative min-w-7/12 md:min-w-1/3 lg:min-w-full flex lg:grid items-center flex-row gap-x-2 justify-start lg:justify-between text-start lg:h-[124px] rounded-2xl p-3 lg:p-5  animated">
            <div
                :class="activeTab === 'DeliveryTab' ? 'text-white ' : 'group-hover:text-white text-olive'"
                class="tap-img ">
                <svg width="32" height="26" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.4 18.1263C24.4 19.603 23.179 20.8 21.6727 20.8C20.1665 20.8 18.9455 19.603 18.9455 18.1263C18.9455 16.6496 20.1665 15.4525 21.6727 15.4525C23.179 15.4525 24.4 16.6496 24.4 18.1263Z" fill="#A8BA66" fill-opacity="0.15"/>
                    <path d="M14.8 0.800049H5.2C3.87452 0.800049 2.8 1.98839 2.8 3.45428V15.4668C2.8 16.9327 3.87452 18.1211 5.2 18.1211H6.07273C6.07273 16.6444 7.29377 15.4473 8.8 15.4473C10.3062 15.4473 11.5273 16.6444 11.5273 18.1211L17.2 18.1263V18.1211V5.61288V3.45428C17.2 1.98839 16.1255 0.800049 14.8 0.800049Z" fill="#A8BA66" fill-opacity="0.15"/>
                    <path d="M8.8 20.7949C10.3062 20.7949 11.5273 19.5978 11.5273 18.1211C11.5273 16.6444 10.3062 15.4473 8.8 15.4473C7.29377 15.4473 6.07273 16.6444 6.07273 18.1211C6.07273 19.5978 7.29377 20.7949 8.8 20.7949Z" fill="#A8BA66" fill-opacity="0.15"/>
                    <path d="M26.8 15.9625V11.5112C26.8 10.7775 26.5254 10.0766 26.0415 9.57481L22.6924 6.33075C22.2476 5.86955 21.6607 5.61288 21.0509 5.61288H17.2V18.1211V18.1263H18.9455C18.9455 16.6496 20.1665 15.4525 21.6727 15.4525C23.179 15.4525 24.4 16.6496 24.4 18.1263C25.7255 18.1263 26.8 17.4283 26.8 15.9625Z" fill="#A8BA66" fill-opacity="0.15"/>
                    <path d="M15.4 19.3262V19.321V6.81283M15.4 19.3262H17.1455M15.4 19.3262L9.72727 19.321M22.6 19.3262C23.9255 19.3262 25 18.6283 25 17.1624V12.7111C25 11.9775 24.7254 11.2765 24.2415 10.7748L20.8924 7.5307C20.4476 7.0695 19.8607 6.81283 19.2509 6.81283H15.4M22.6 19.3262C22.6 20.8029 21.379 22 19.8727 22C18.3665 22 17.1455 20.8029 17.1455 19.3262M22.6 19.3262C22.6 17.8495 21.379 16.6524 19.8727 16.6524C18.3665 16.6524 17.1455 17.8495 17.1455 19.3262M15.4 6.81283V4.65423C15.4 3.18834 14.3255 2 13 2H3.4C2.07452 2 1 3.18834 1 4.65423V16.6668C1 18.1327 2.07452 19.321 3.4 19.321H4.27273M9.72727 19.321C9.72727 20.7977 8.50623 21.9948 7 21.9948C5.49377 21.9948 4.27273 20.7977 4.27273 19.321M9.72727 19.321C9.72727 17.8443 8.50623 16.6472 7 16.6472C5.49377 16.6472 4.27273 17.8443 4.27273 19.321" stroke="currentColor" stroke-width="2"/>
                </svg>
            </div>
            <div class="tab-title flex items-end">Delivery & orders</div>
            <i
                :class="activeTab === 'DeliveryTab' ? 'p-2' : 'group-hover:p-2 p-3'"
                class="small-cart-arrow absolute right-0 lg:top-0   duration-500 ease-in-out transition-all hidden lg:block">
                <svg
                    :class="activeTab === 'DeliveryTab' ? 'text-white ' : 'text-gray-300/80 group-hover:text-white'"
                    class=" transition-all duration-500 ease-in-out"
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g >
                        <path
                            d="M3.73334 2.66666H12.6667C13.0349 2.66666 13.3333 2.96513 13.3333 3.33332V12.2667M2.66667 13.3333L12.8 3.19999"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </g>
                </svg>
            </i>
        </div>

        <div ref="Payments" @click="activeTab = 'PaymentsTab'"
             :class="activeTab === 'PaymentsTab' ? 'bg-olive text-white' : 'bg-olive/5 hover:bg-olive text-charcoal hover:text-white'"
             class="tab cursor-pointer group relative min-w-7/12 md:min-w-1/3 lg:min-w-full flex items-center flex-row gap-x-2 lg:grid justify-start lg:justify-between text-start lg:h-[124px] rounded-2xl p-3 lg:p-5  animated">
            <div
                :class="activeTab === 'PaymentsTab' ? 'text-white ' : 'group-hover:text-white text-olive'"
                class="tap-img ">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.6 8.5V17.6C24.6 19.8091 22.8091 21.6 20.6 21.6H7C4.79087 21.6 3 19.8091 3 17.6V4.5V4C3 1.79086 4.79086 0 7 0H15.2C17.4091 0 19.2 1.79086 19.2 4V4.5H20.6C22.8091 4.5 24.6 6.29086 24.6 8.5Z" fill="#A8BA66" fill-opacity="0.15"/>
                    <path d="M17.4 5.69995H16.4V6.69995H17.4V5.69995ZM21.8 9.69995V18.8H23.8V9.69995H21.8ZM18.8 6.69995C20.4569 6.69995 21.8 8.0431 21.8 9.69995H23.8C23.8 6.93853 21.5614 4.69995 18.8 4.69995V6.69995ZM17.4 6.69995H18.8V4.69995H17.4V6.69995ZM16.4 5.19995V5.69995H18.4V5.19995H16.4ZM13.4 2.19995C15.0569 2.19995 16.4 3.5431 16.4 5.19995H18.4C18.4 2.43853 16.1614 0.199951 13.4 0.199951V2.19995ZM5.20001 2.19995H13.4V0.199951H5.20001V2.19995ZM2.20001 5.19995C2.20001 3.5431 3.54316 2.19995 5.20001 2.19995V0.199951C2.43859 0.199951 0.200012 2.43853 0.200012 5.19995H2.20001ZM2.20001 5.69995V5.19995H0.200012V5.69995H2.20001ZM2.20001 18.8V5.69995H0.200012V18.8H2.20001ZM5.20002 21.8C3.54316 21.8 2.20001 20.4568 2.20001 18.8H0.200012C0.200012 21.5614 2.43859 23.8 5.20002 23.8V21.8ZM18.8 21.8H5.20002V23.8H18.8V21.8ZM21.8 18.8C21.8 20.4568 20.4569 21.8 18.8 21.8V23.8C21.5614 23.8 23.8 21.5614 23.8 18.8H21.8ZM17.3 14.7C17.3 15.1418 16.9418 15.5 16.5 15.5V17.5C18.0464 17.5 19.3 16.2464 19.3 14.7H17.3ZM16.5 13.9C16.9418 13.9 17.3 14.2582 17.3 14.7H19.3C19.3 13.1536 18.0464 11.9 16.5 11.9V13.9ZM15.7 14.7C15.7 14.2582 16.0582 13.9 16.5 13.9V11.9C14.9536 11.9 13.7 13.1536 13.7 14.7H15.7ZM16.5 15.5C16.0582 15.5 15.7 15.1418 15.7 14.7H13.7C13.7 16.2464 14.9536 17.5 16.5 17.5V15.5ZM17.4 4.69995H1.20001V6.69995H17.4V4.69995Z" fill="currentColor"/>
                </svg>
            </div>
            <div class="tab-title ">Payments & returns</div>
            <i
                :class="activeTab === 'PaymentsTab' ? 'p-2' : 'group-hover:p-2 p-3'"
                class="small-cart-arrow absolute right-0 lg:top-0   duration-500 ease-in-out transition-all hidden lg:block">
                <svg
                    :class="activeTab === 'PaymentsTab' ? 'text-white ' : 'text-gray-300/80 group-hover:text-white'"
                    class=" transition-all duration-500 ease-in-out"
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g >
                        <path
                            d="M3.73334 2.66666H12.6667C13.0349 2.66666 13.3333 2.96513 13.3333 3.33332V12.2667M2.66667 13.3333L12.8 3.19999"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </g>
                </svg>
            </i>
        </div>

        <div ref="Account" @click="activeTab = 'AccountTab'"
             :class="activeTab === 'AccountTab' ? 'bg-olive text-white' : 'bg-olive/5 hover:bg-olive text-charcoal hover:text-white'"
             class="tab cursor-pointer group relative min-w-7/12 md:min-w-1/3 lg:min-w-full flex items-center flex-row gap-x-2 lg:grid justify-start lg:justify-between text-start lg:h-[124px] rounded-2xl p-3 lg:p-5  animated">
            <div
                :class="activeTab === 'AccountTab' ? 'text-white ' : 'group-hover:text-white text-olive'"
                class="tap-img ">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.5 17.55C23.5 19.7868 19.7206 21.6 14.75 21.6C9.77944 21.6 6 19.7868 6 17.55C6 13.7455 9.77944 11.7818 14.75 11.7818C19.7206 11.7818 23.5 13.7455 23.5 17.55Z" fill="#A8BA66" fill-opacity="0.15"/>
                    <path d="M18.6875 3.92727C18.6875 6.38182 17.0346 7.85455 14.75 7.85455C12.4654 7.85455 10.8125 6.38182 10.8125 3.92727C10.8125 1.47273 12.5625 0 14.75 0C16.9375 0 18.6875 1.47273 18.6875 3.92727Z" fill="#A8BA66" fill-opacity="0.15"/>
                    <path d="M20.75 18.7499C20.75 20.9867 16.9706 22.8 12 22.8C7.02944 22.8 3.25 20.9867 3.25 18.7499C3.25 14.9454 7.02944 12.9818 12 12.9818C16.9706 12.9818 20.75 14.9454 20.75 18.7499Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M15.9375 5.12722C15.9375 7.58177 14.2846 9.0545 12 9.0545C9.71538 9.0545 8.0625 7.58177 8.0625 5.12722C8.0625 2.67268 9.8125 1.19995 12 1.19995C14.1875 1.19995 15.9375 2.67268 15.9375 5.12722Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="tab-title">Account</div>
            <i
                :class="activeTab === 'AccountTab' ? 'p-2' : 'group-hover:p-2 p-3'"
                class="small-cart-arrow absolute right-0 lg:top-0   duration-500 ease-in-out transition-all hidden lg:block">
                <svg
                    :class="activeTab === 'AccountTab' ? 'text-white ' : 'text-gray-300/80 group-hover:text-white'"
                    class=" transition-all duration-500 ease-in-out"
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g >
                        <path
                            d="M3.73334 2.66666H12.6667C13.0349 2.66666 13.3333 2.96513 13.3333 3.33332V12.2667M2.66667 13.3333L12.8 3.19999"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </g>
                </svg>
            </i>
        </div>

        <div ref="Technical" @click="activeTab = 'TechnicalTab'"
             :class="activeTab === 'TechnicalTab' ? 'bg-olive text-white' : 'bg-olive/5 hover:bg-olive text-charcoal hover:text-white'"
             class="tab cursor-pointer group relative min-w-7/12 md:min-w-1/3 lg:min-w-full flex items-center flex-row gap-x-2 lg:grid justify-start lg:justify-between text-start lg:h-[124px] rounded-2xl p-3 lg:p-5  animated">
            <div
                :class="activeTab === 'TechnicalTab' ? 'text-white ' : 'group-hover:text-white text-olive'"
                class="tap-img ">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.7238 1.0313C12.7664 -0.343766 14.8336 -0.343766 15.8762 1.0313L16.2293 1.49696C16.7982 2.24724 17.7277 2.63222 18.6605 2.50397L19.2394 2.42437C20.949 2.18931 22.4107 3.65102 22.1756 5.3606L22.096 5.93954C21.9678 6.87235 22.3528 7.80178 23.103 8.37068L23.5687 8.72377C24.9438 9.76642 24.9438 11.8336 23.5687 12.8762L23.103 13.2293C22.3528 13.7982 21.9678 14.7277 22.096 15.6605L22.1756 16.2394C22.4107 17.949 20.949 19.4107 19.2394 19.1756L18.6605 19.096C17.7277 18.9678 16.7982 19.3528 16.2293 20.103L15.8762 20.5687C14.8336 21.9438 12.7664 21.9438 11.7238 20.5687L11.3707 20.103C10.8018 19.3528 9.87235 18.9678 8.93954 19.096L8.3606 19.1756C6.65102 19.4107 5.18931 17.949 5.42437 16.2394L5.50397 15.6605C5.63222 14.7277 5.24724 13.7982 4.49696 13.2293L4.0313 12.8762C2.65623 11.8336 2.65623 9.76642 4.0313 8.72377L4.49696 8.37068C5.24724 7.80178 5.63222 6.87235 5.50397 5.93954L5.42437 5.3606C5.18931 3.65102 6.65102 2.18931 8.3606 2.42437L8.93954 2.50397C9.87235 2.63222 10.8018 2.24724 11.3707 1.49696L11.7238 1.0313Z" fill="#A8BA66" fill-opacity="0.15"/>
                    <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M9.92377 2.23125C10.9664 0.856185 13.0336 0.856185 14.0762 2.23125L14.4293 2.69691C14.9982 3.44719 15.9277 3.83218 16.8605 3.70392L17.4394 3.62432C19.149 3.38926 20.6107 4.85097 20.3756 6.56055L20.296 7.13949C20.1678 8.0723 20.5528 9.00173 21.303 9.57064L21.7687 9.92372C23.1438 10.9664 23.1438 13.0335 21.7687 14.0762L21.303 14.4293C20.5528 14.9982 20.1678 15.9276 20.296 16.8604L20.3756 17.4394C20.6107 19.1489 19.149 20.6106 17.4394 20.3756L16.8605 20.296C15.9277 20.1677 14.9982 20.5527 14.4293 21.303L14.0762 21.7687C13.0336 23.1437 10.9664 23.1437 9.92377 21.7687L9.57068 21.303C9.00178 20.5527 8.07234 20.1677 7.13954 20.296L6.5606 20.3756C4.85102 20.6106 3.38931 19.1489 3.62437 17.4394L3.70397 16.8604C3.83222 15.9276 3.44724 14.9982 2.69695 14.4293L2.23129 14.0762C0.856231 13.0335 0.856231 10.9664 2.23129 9.92372L2.69695 9.57064C3.44724 9.00173 3.83222 8.0723 3.70397 7.13949L3.62437 6.56055C3.38931 4.85097 4.85102 3.38926 6.5606 3.62432L7.13954 3.70392C8.07234 3.83218 9.00178 3.44719 9.57068 2.69691L9.92377 2.23125Z" stroke="currentColor" stroke-width="2"/>
                </svg>
            </div>
            <div class="tab-title ">Technical issues</div>
            <i
                :class="activeTab === 'TechnicalTab' ? 'p-2' : 'group-hover:p-2 p-3'"
                class="small-cart-arrow absolute right-0 lg:top-0   duration-500 ease-in-out transition-all hidden lg:block">
                <svg
                    :class="activeTab === 'TechnicalTab' ? 'text-white ' : 'text-gray-300/80 group-hover:text-white'"
                    class=" transition-all duration-500 ease-in-out"
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g >
                        <path
                            d="M3.73334 2.66666H12.6667C13.0349 2.66666 13.3333 2.96513 13.3333 3.33332V12.2667M2.66667 13.3333L12.8 3.19999"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </g>
                </svg>
            </i>
        </div>

    </div>

    <div class="tabContent py-section">
        <div v-html="tabContentItem" />

        <div class="container">
            <div class="mt-10 p-2 px-[20px] md:container lg:p-10 bg-light-orange">
                <p class="text-[30px] font-bold leading-8 lg:text-[32px]">Didn't found what you were looking for?</p>
                <p class="text-sm opacity-60">Message us and we will get back as soon as possible</p>
                <form>
                    <BaseInputLabel
                        label="E-mail"
                        type="email"
                        name="emailHelp"
                        id="emailHelp"
                        placeholder="Enter e-mail address"
                        v-model="email"
                    />
                    <BaseTextarea
                        v-model="message"
                        label="How can we help?"
                        id="messageHelp"
                        name="messageHelp"
                        placeholder="Enter your message"
                        resize="none"
                        required
                    />

                    <div class="flex items-center justify-start gap-3 mt-5">
                        <BaseCheckbox/>
                        <div class="leading-[150%]">
                            By sending the message, I agree to the
                            <a href="/" class="underline font-bold">Privacy Policy</a>
                        </div>
                    </div>

                    <button type="submit" class="mt-5 w-full">
                        <Button customClass="w-full md:w-fit py-3 ">Send message</Button>
                    </button>
                </form>
            </div>
        </div>
    </div>

</template>
