<script setup>
import bigBanner from '@img/home-page/bigBanner.jpg';
import Button from "@/components/Button.vue";
const count = 4
</script>
<template>
    <div class="pageContent">
        <section class="big-slider relative w-full">
            <img :src="bigBanner" alt="banner" class="w-full">
            <div class="absolute z-1 inset-0 grid place-items-end ">
                <div class="w-full text-white p-10">
                    <h1 class=" text-[64px] font-bold ">Discover adorable <br> outfits for your little joy!</h1>
                    <p class="">From cozy onesies to trendy outfits, we have everything you <br>
                        need to keep your baby stylish, comfortable and oh-so-cute</p>
                    <Button>Explore outfits</Button>
                </div>
            </div>
        </section>
        <section>
            <div
                v-for="n in count"
                :key="n"
                class="p-6 bg-gray-100 mb-4 rounded"
            >
                <h3 class="text-xl font-bold">Блок №{{ n }}</h3>
                <p>Контент всередині блоку</p>
            </div>
        </section>


    </div>
</template>

<script>
export default {
    name: 'HomePage'
}
</script>
