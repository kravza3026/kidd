<template>
    <div>
        <div @click="open = true" class="cursor-pointer flex items-center gap-1">
            <img :src="sizeIcon" alt="" class="w-3" />
            <span class="text-[#a8ba66] text-sm font-bold underline leading-[14px]">
      {{ t('product.desc.size_guide') }}
    </span>
        </div>

        <TransitionRoot as="template" :show="open">
            <Dialog class="relative z-10" @close="open = false">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-start justify-center p-4 text-center md:items-center sm:p-0">
                        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <div class="relative w-full max-w-xl bg-white rounded-lg shadow-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <h2 class="text-lg font-semibold p-3 mb-4 text-[32px]">Size chart</h2>
                                        <img @click="open = false" class="cursor-pointer" :src="closeIcon" alt="close guide">
                                    </div>
                                    <div class="grid grid-cols-12 p-3 gap-4 text-[10px] uppercase font-bold opacity-40">
                                        <p class="col-span-3">Size</p>
                                        <p class="col-span-4">Height</p>
                                        <p class="col-span-4 px-2">Weight</p>
                                    </div>
                                    <hr class="border-light-border">
                                    <div class="text-[14px]">
                                        <div class="grid grid-cols-12 mt-2 p-3 rounded-2xl gap-2 cursor-pointer hover:bg-gray-100">
                                            <p class="font-bold col-span-3">Preemie</p>
                                            <p class="col-span-4">&lt; 55 cm</p>
                                            <p class="col-span-4">up to 2.7 kg</p>

                                        </div>
                                        <div class="grid grid-cols-12 mt-2 p-3 rounded-2xl gap-4 cursor-pointer hover:bg-gray-100">
                                            <p class="font-bold col-span-3">3–6M</p>
                                            <p class="col-span-4">62 – 68 cm</p>
                                            <p class="col-span-4">4 kg — 5.7 kg</p>
                                            <p class="col-span-1"></p>
                                        </div>
                                        <div class="grid grid-cols-12 mt-2 p-3 rounded-2xl gap-4 cursor-pointer hover:bg-gray-100">
                                            <p class="font-bold col-span-3">6–9M</p>
                                            <p class="col-span-4">68 – 74 cm</p>
                                            <p class="col-span-4">5.7 kg — 7.5 kg</p>
                                            <p class="col-span-1 text-center">

                                                <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="28" height="28" rx="14" fill="#EAC2C3"/>
                                                    <g filter="url(#filter0_d_925_17169)">
                                                        <path d="M17.8137 9.088V10.894H12.7597V13.204H17.1697V15.01H12.7597V17.208H17.8137V19H10.7297V9.088H17.8137Z" fill="white"/>
                                                    </g>
                                                    <defs>
                                                        <filter id="filter0_d_925_17169" x="4.72969" y="3.08789" width="23.084" height="25.9121" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                            <feOffset dx="2" dy="2"/>
                                                            <feGaussianBlur stdDeviation="4"/>
                                                            <feComposite in2="hardAlpha" operator="out"/>
                                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
                                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_925_17169"/>
                                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_925_17169" result="shape"/>
                                                        </filter>
                                                    </defs>
                                                </svg>

                                            </p>
                                        </div>
                                        <div class="grid grid-cols-12 mt-2 p-3 rounded-2xl gap-4 cursor-pointer hover:bg-gray-100">
                                            <p class="font-bold col-span-3">9–12M</p>
                                            <p class="col-span-4">74 – 80 cm</p>
                                            <p class="col-span-4">7.5 kg — 9.3 kg</p>
                                            <p class="col-span-1"></p>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex justify-start">

                                            <Button
                                                class=""
                                            >
                                                <a class="border-none outline-none" href="/">View full size chart</a>
                                            </Button>

                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import closeIcon from '@img/icons/close_dark.svg'
import sizeIcon from '@img/icons/size.svg';
import { useI18n } from 'vue-i18n';
import Button from "@/components/Button.vue";

const { t, locale } = useI18n();
const open = ref(false)
</script>
