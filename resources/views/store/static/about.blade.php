<x-app-layout>
    <div class="pageContent ">
        <section class="py-section  container grid lg:grid-cols-12 justify-between">
            <div class="pr-5 col-span-6">
                <h1 class="text-[24px] lg:text-[40px] pb-[40px]">For parents who want the <span class="gradient_r-b">best</span> for their children, but also value <span class="gradient_r-b">affordability</span> and <span class="gradient_r-b">practicality</span></h1>
                <p class="opacity-60 pb-[40px] leading-[150%] lg:leading-[175%]">
                    At KIDD. our mission is to provide stylish, high-quality baby clothing that combines comfort and functionality. We value sustainability, using eco-friendly materials, and prioritise ethical manufacturing practices. Our custom filtering feature helps you find  the perfect fit based on your child's weight, height, and age. We are committed to exceptional customer service, ensuring your satisfaction and your child's well-being. Join us as we celebrate the joy of parenthood, one outfit at a time.
                </p>

                <h2 class="font-bold text-[30px] lg:text-[24px] leading-[-2%]">Our values</h2>
                <div class="grid gap-y-2 lg:flex justify-between items-center gap-[20px] py-[20px] leading-[175%]">
                    <div class="flex items-center ">
                        <img width="40" height="40" class="pr-2" src={{ Vite::image('staticPages/about/aboutIcon_1.png') }} alt="icon" alt="">
                        <p class="leading-[130%] font-bold">High quality clothing
                            that is built to last</p>
                    </div>
                    <div class="flex items-center ">
                        <img width="40" height="40" class="pr-2" src={{ Vite::image('staticPages/about/aboutIcon_2.png') }} alt="icon" alt="">
                        <p class="leading-[130%] font-bold">Garments that feel
                            good on children skin</p>
                    </div>
                    <div class="flex items-center ">
                        <img width="40" height="40" class="pr-2" src={{ Vite::image('staticPages/about/aboutIcon_3.png') }} alt="icon" alt="">
                        <p class="leading-[130%] font-bold">Clothing that does
                            not break the bank</p>
                    </div>
                </div>

            </div>
            <div class="col-span-6 flex justify-center lg:justify-end">
                <div class="max-h-[650px] lg:mt-[-7%] h-full">
                    <img class="max-w-full mx-auto" height="650" alt="about" src={{ Vite::image('staticPages/about/b_1.png') }}>
                </div>
            </div>
        </section>
        <section class="py-section  bg-light-orange">
            <div class="container">
                <div class="grid lg:grid-cols-2 gap-x-2">
                    <h2 class="text-[30px] order-first font-bold lg:mb-[32px] lg:hidden">
                        Who we are
                    </h2>
                    <div class="order-last lg:order-none ">
                        <h2 class="text-[48px] hidden lg:block font-bold mb-[32px]">
                            Who we are
                        </h2>
                        <p class="leading-[150%] lg:leading-[175%] opacity-80">
                            Our baby clothing store came to life through our own experiences as parents, combined with a burning passion for providing the best for little ones. We were inspired to create a curated collection of baby clothes that met our high expectations in terms of quality, style, and functionality. From the very beginning, we envisioned a store that would offer a delightful range of garments that not only made babies look adorable but also prioritised their comfort and well-being
                            <br><br>
                            Driven by our personal journey as parents, we understood the challenges of finding clothing that ticked all the boxes: being both stylish and practical, gentle on delicate skin, and made from sustainable materials. This led us to set out on a mission to offer parents a one-stop destination for baby clothing that aligned with their values.
                            <br><br>
                            We meticulously researched and collaborated with talented designers to ensure that each item in our collection met the highest standards of quality and safety. From the selection of fabrics to the attention to detail in the craftsmanship, we leave no stone unturned in our pursuit of excellence.
                        </p>
                    </div>
                    <div class="flex justify-end order-1 lg:order-none py-5 lg:py-0">
                        <img class="max-w-full mx-auto"  height="600" alt="Who we are" src={{ Vite::image('staticPages/about/b_2.png') }}>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 gap-x-2 pt-section">
                    <h2 class="text-[30px] order-first font-bold lg:mb-[32px] lg:hidden">
                        What we do
                    </h2>
                    <div>
                        <h2 class="text-[48px] font-bold mb-[32px] hidden lg:block ">
                            What we do
                        </h2>
                        <p class="leading-[175%] opacity-80">
                            Our commitment to sustainability is deeply rooted in our core values. We believe in leaving a positive impact on the environment and future generations. By incorporating eco-friendly practices throughout our supply chain and sourcing responsibly, we strive to make a difference.
                            <br><br>
                            As parents ourselves, we understand the importance of convenience and peace of mind. That's why we've integrated a custom filtering feature into our website, allowing you to easily find the perfect fit based on your child's specific parameters such as weight, height, and age. We want to ensure that every little one feels comfortable and confident in our clothing.
                            <br><br>
                            We are incredibly grateful for the opportunity to be a part of your parenting journey. Join us as we dress your little ones in adorable, high-quality clothing that reflects our passion, values, and dedication. Thank you for choosing us to be a part of your precious moments.
                        </p>
                    </div>
                    <div class="order-first  flex justify-start py-5 lg:py-0 lg:mt-[-10%] xl:mt-[-25%]">
                        <img  class="max-w-full mx-auto" width="500" height="600" alt="Who we are" src={{ Vite::image('staticPages/about/b_2.png') }}>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
