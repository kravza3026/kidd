<template>

        <div
            :class="contentWidth"
            class=""
            >
            <div>
                <h2 class="section-title text-balance text-white xl:leading-12 font-[700] " :class="titleClass">
                    {{title}}
                </h2>
                <p class="text-white" :class="subtitleClass">
                    {{secondaryTitle}}
                </p>
            </div>
            <form :class="formClass">
                <div class="relative">
                    <input class="w-full focus:outline-hidden bg-white rounded-xl p-5" type="text" value="" placeholder="Your e-mail address">
                    <button class="absolute cursor-pointer right-2 top-2 text-white font-bold border-b-2 border-b-olive hover:bg-olive bg-charcoal rounded-xl py-3 px-7 animated">
                        Subscribe
                    </button>
                </div>
            </form>
        </div>

</template>
<script>
// import axios from 'axios';
// await axios.get(`${import.meta.env.VITE_API_URL}/sanctum/csrf-cookie`, {
//     withCredentials: true,
// });
//
// axios.get(`${import.meta.env.VITE_API_URL}/search`, {
//     withCredentials: true
// })
//     .then(res => {
//         console.log('Search result:', res.data);
//     })
//     .catch(err => {
//         console.error('Search error:', err);
//     });


export default {
    name: 'SubscribeForm',
    props: {
        title: String,
        secondaryTitle: String,
        contentWidth:String,
        titleClass:{
            type:String,
            default:'md:text-[24px] xl:text-[40px] py-5'
        },
        subtitleClass:{
            type:String,
            default:''
        },
        formClass:{
            type:String,
            default:''
        }
    },
    computed: {
        mergedClasses() {
            console.log(this.contentWidth)
            return [
                '',
                this.customClass
            ].join(' ');
        },
    },
}

</script>
