<section class="pt-section">
    <div class="grid grid-cols-1 md:flex items-center relative justify-start bg-olive  h-fit min-h-[380px] xl:min-h-[560px]">

        <div class="container order-2 md:order-1 pb-7 md:pb-0 relative h-full grid items-center content-center"
             data-vue-component="SubscribeForm"
             data-vue-props='{
                "title": "Subscribe to newsletter and get 25% off your first order",
                "secondaryTitle": "Receive the latest updates and take advantage of great offers",
                "contentWidth": "w-full md:w-5/12",
                "formClass": "mt-10"
            }'
        ></div>
        <div class="w-full md:absolute right-0 md:w-6/12 min-h-[380px] xl:min-h-[560px] order-1 md:order-2"
             style="background-image: url({{ Vite::image('subscribe_bg.jpg') }}); background-size: cover; background-position: center; background-repeat: no-repeat;"
        >

        </div>
    </div>
</section>
