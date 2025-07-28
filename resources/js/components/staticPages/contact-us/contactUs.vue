<template>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10 pb-section">
        <div class="form">
            <h1 class="text-[24px] lg:text-[32px] font-bold">We’d love to hear from you</h1>
            <p class="opacity-60 leading-[175%] text-[14px] lg:text-base">Message us and we will get back as soon as possible</p>
            <form action="" class="w-full">
                <BaseInput
                    customClass="w-full"
                    label="First name"
                    type="name"
                    name="nameContact"
                    id="nameContact"
                    placeholder="Enter your first name"
                    v-model="text"

                />
                <BaseInput
                    label="Last name"
                    type="lname"
                    name="lnameContact"
                    id="lnameContact"
                    placeholder="Enter your last name"
                    v-model="text"
                />
                <BaseInput
                    label="E-mail"
                    type="email"
                    name="emailContact"
                    id="emailContact"
                    placeholder="Enter e-mail address"
                    v-model="email"
                />
                <BaseTextarea
                    v-model="message"
                    label="How can we help?"
                    id="messageHelp"
                    name="messageHelp"
                    placeholder="Enter your message"
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
                    <Button customClass="w-full py-3 !mb-0">Send message</Button>
                </button>
            </form>
        </div>
        <div :style="{ backgroundImage: `url(${imgBg})` }" class="relative mt-10 lg:mt-0 bg-no-repeat bg-center bg-cover rounded-2xl flex items-end min-h-[400px] md:min-h-[500px]">
            <div class="absolute inset-0 bg-gradient-to-t from-charcoal/25 to-charcoal/5 z-0 rounded-2xl"></div>
           <div class="p-5 relative grid gap-[24px] z-10 text-white">
               <p class="text-[20px] lg:text-[32px] text-white leading-[150%] lg:mb-10">“I'm so grateful to have discovered KIDD. The fabrics are soft and gentle, and the attention to details is outstanding.”</p>
               <div>
                   <p class="font-bold lg:text-[20px]">Ana-Maria Parahonco</p>
                   <p class="text-[12px] lg:text-[14px]">Mother of little princess</p>
               </div>
           </div>
        </div>
    </div>
</template>
<script>


import BaseInput from "@/components/ui/BaseInput.vue";
import BaseTextarea from "@/components/ui/BaseTextarea.vue";
import BaseCheckbox from "@/components/ui/BaseCheckbox.vue";
import imgBg from "@img/contactUs_bg.jpg"
import Button from "@/components/Button.vue";

export default {
    name: 'contactUs',
    components: {Button, BaseCheckbox, BaseTextarea, BaseInput},

    data() {
        return {
            searchQuery: '',
            locale: document.documentElement.lang || 'ro',
            tabs: ['DeliveryTab', 'PaymentsTab', 'AccountTab', 'TechnicalTab'],
            imgBg
        };
    },

};

</script>
