<section class="pt-section">
    <div
        class="bg-olive relative grid h-fit min-h-[380px] grid-cols-1 items-center justify-start md:flex xl:min-h-[560px]"
    >
        <div
            class="relative order-2 container grid h-full content-center items-center pb-7 md:order-1 md:pb-0"
            data-vue-component="SubscribeForm"
            data-vue-props='{
                "title": "Это не должен быть Vue Component",
                "secondaryTitle": "{{ __('main.subscribe.subtitle') }}",
                "contentWidth": "w-full md:w-5/12",
                "formClass": "mt-10"
            }'
        ></div>
        {{-- {{ __('main.subscribe.title') }} --}}
        {{-- {{ __('main.subscribe.subtitle') }} --}}
        {{-- {{ __('main.subscribe.email_placeholder') }} --}}
        {{-- {{ __('main.subscribe.subscribe_btn') }} --}}
        <div
            class="right-0 order-1 min-h-[380px] w-full md:absolute md:order-2 md:w-6/12 xl:min-h-[560px]"
            style="
                background-image: url({{ Vite::image('subscribe_bg.jpg') }});
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            "
        ></div>
    </div>
</section>
