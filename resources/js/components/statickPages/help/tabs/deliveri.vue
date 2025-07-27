<template>
<div>
    <div class="container">
        <h2 class="text-charcoal text-[20px]">Can I change my delivery address after I have placed my order?</h2>
        <p class="leading-[175%] text-[12px] text-charcoal/40">Last updated 2 days ago</p>
        <p class="leading-[175%] text-charcoal/60 ">Unfortunately, once an order is placed we are unable to amend your delivery address. We can confirm, however, that delivery will be attempted 3 times at the address registered with your order. If no one is available to sign for the parcel, it will be returned to sender for a full refund.</p>
    </div>

    <div class="mt-10 p-2 px-[20px] md:container lg:p-10 bg-light-orange">
        <p class="text-[30px] font-bold leading-8 lg:text-[32px]">Didn't found what you were looking for?</p>
        <p class="text-[14px] opacity-60">Message us and we will get back as soon as possible</p>
        <form>
            <BaseInput
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
</template>
<script>

import {defineComponent} from "vue";
import Button from "@/components/Button.vue";
import BaseInput from "@/components/ui/BaseInput.vue";
import BaseTextarea from "@/components/ui/BaseTextarea.vue";
import BaseCheckbox from "@/components/ui/BaseCheckbox.vue";

export default defineComponent({
    components: {BaseCheckbox, BaseTextarea, BaseInput, Button}
})
</script>
