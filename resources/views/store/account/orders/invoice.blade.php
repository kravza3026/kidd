<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name') }} - Moldova</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@300..700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

<main   class="max-w-3xl min-h-screen mx-auto flex flex-col justify-between py-4"

>
   <header>
       <div class="flex justify-between">
           <img src="{{Vite::image('/icons/logo_outline.png')}}" alt="logo">
           <div class="flex gap-x-18 text-[12px] font-medium">
               <div class="grid">
                   <a href="www.kidd.md">www.kidd.md</a>
                   <a href="mailto:hello@kidd.md">hello@kidd.md</a>
               </div>
               <div class="grid">
                   <a href="tel:+373 (22) 000 321">+373 (79) 000 321</a>
                   <a href="tel:+373 (79) 000 321">+373 (79) 000 321</a>
               </div>
           </div>
       </div>
       <hr class="my-4 border-light-border">
   </header>
   <div class="content py-6">
       <section class="my-6">
           <div class="grid justify-between grid-cols-17 gap-x-13">
               <div class="space-y-10 col-span-4">
                   <div class="space-y-4">
                       <p class="opacity-35 uppercase font-bold text-[10px] tracking-widest">Billing date</p>
                       <p class="font-medium">03/10/2023</p>
                   </div>
                   <div class="space-y-4">
                       <p class="opacity-35 uppercase font-bold text-[10px] tracking-widest">Billing date</p>
                       <p class="font-medium">03/10/2023</p>
                   </div>
               </div>
               <div class="space-y-4 col-span-6">
                   <p class="opacity-35 uppercase font-bold text-[10px] tracking-widest">Seller</p>
                   <p class="font-medium">KIDD. Digital SRL</p>
                   <p class="text-sm"><span>Address</span>: bd. Decebal 6/1, cab. 333, mun. Chișinău, MD-2022</p>
                   <p class="text-sm"><span>IDNO:</span> 101560000363</p>
                   <p class="text-sm"><span>Bank:</span> Moldova Agroindbank</p>
                   <p class="text-sm"><span>SWIFT:</span> KEDSLT2VXXX</p>

               </div>
               <div class="space-y-4 col-span-6">
                   <p class="opacity-35 uppercase font-bold text-[10px] tracking-widest">Buyer</p>
                   <p class="font-medium">Dionisie Ghețu</p>
                   <p class="text-sm"><span>Address</span>: Address: Alba Iulia 75, ap. 623, mun. Chișinău, MD-2071</p>
                   <p class="text-sm"><span>Phone:</span> +373 (60) 394 474</p>
                   <p class="text-sm"><span>E-mail:</span> ghetsudionysiy@gmail.com</p>


               </div>
           </div>
       </section>
       <hr class="my-4 border-light-border">
       <section class="py-8">
           <p class="text-4xl py-4">Invoice <span class="opacity-35">№ 173–963</span></p>
           <div class="mt-4">
               <div class="grid grid-cols-17 gap-x-6">
                   <p class="col-span-1 opacity-35 uppercase font-bold text-[10px] tracking-widest">#</p>
                   <p class="col-span-8 opacity-35 uppercase font-bold text-[10px] tracking-widest">Product title</p>
                   <p class="col-span-1 opacity-35 uppercase font-bold text-[10px] tracking-widest">QTY</p>
                   <p class="col-span-1 opacity-35 uppercase font-bold text-[10px] tracking-widest"></p>
                   <p class="col-span-3 opacity-35 uppercase font-bold text-[10px] tracking-widest">Price</p>
                   <p class="col-span-3 opacity-35 uppercase font-bold text-[10px] tracking-widest">Amount</p>
               </div>
               <hr class="my-4 border-light-border">
               <div class="grid grid-cols-17 gap-x-6 my-4">
                   <p class="col-span-1 opacity-35  text-base tracking-widest">01.</p>
                   <p class="col-span-8 text-base tracking-widest">Summer Cotton Jumpsuit Beige 0–3M</p>
                   <p class="col-span-1 text-base tracking-widest">1</p>
                   <p class="col-span-1 text-base tracking-widest"><span class="opacity-35 font-normal">×</span></p>
                   <p class="col-span-3 text-base tracking-widest">240 lei</p>
                   <p class="col-span-3 text-base tracking-widest font-medium">240 lei</p>
               </div>
               <div class="grid grid-cols-17 gap-x-6 my-4">
                   <p class="col-span-1 opacity-35  text-base tracking-widest">02.</p>
                   <p class="col-span-8 text-base tracking-widest">Thin Pants Black 6–9M</p>
                   <p class="col-span-1 text-base tracking-widest">2</p>
                   <p class="col-span-1 text-base tracking-widest"><span class="opacity-35 font-normal">×</span></p>
                   <p class="col-span-3 text-base tracking-widest">165 lei </p>
                   <p class="col-span-3 text-base tracking-widest font-medium">330 lei</p>
               </div>
               <div class="grid grid-cols-17 gap-x-6 my-4">
                   <p class="col-span-1 opacity-35  text-base tracking-widest">03.</p>
                   <p class="col-span-8 text-base tracking-widest">Flutter Sleeve Dress Turquoise 0–3M</p>
                   <p class="col-span-1 text-base tracking-widest">2</p>
                   <p class="col-span-1 text-base tracking-widest"><span class="opacity-35 font-normal">×</span></p>
                   <p class="col-span-3 text-base tracking-widest">240 lei</p>
                   <p class="col-span-3 text-base tracking-widest font-medium">480 lei</p>
               </div>
               <hr class="my-4 border-light-border">

               <div class="grid grid-cols-17 items-center gap-4 my-4">
                   <p class="col-span-3 col-start-12 opacity-35 uppercase text-[10px] font-bold tracking-widest">Subtotal</p>
                   <p class="col-span-3 text-base font-medium tracking-widest">1400 lei</p>

                   <p class="col-span-3 col-start-12 opacity-35 uppercase text-[10px] font-bold tracking-widest">Shipment</p>
                   <p class="col-span-3 text-base font-medium tracking-widest">50 lei</p>
                   <hr class="my-4 col-start-12 col-span-6 border-light-border">
                   <p class="col-span-3 col-start-12 opacity-35 uppercase text-[10px] font-bold tracking-widest">Shipment</p>
                   <p class="col-span-3 text-xl font-bold tracking-widest">1450 lei</p>

               </div>

           </div>
       </section>
   </div>
    <footer>
        <p class="opacity-50 text-sm">We accept payment via bank card, PayPal and bank transfer. Thank you for choosing KIDD. for your baby clothing needs! Your satisfaction is our priority. If you have any payment-related questions or need to make a return, please contact us at hello@kidd.md</p>
        <hr class="my-4 border-light-border">
        <div class="grid grid-cols-12 gap-4">
            <p class="col-span-2 font-bold text-[12px]">Kidd Digital SRL</p>
            <p class="text-[12px] col-span-4"><span class="font-bold">IDNO:</span> 101560000363</p>
            <p class="col-span-6 text-[12px] text-end"><span class="font-bold">Address: </span>bd. Decebal 6/1, apt 333, Chișinău, MD-2022</p>
        </div>
        <span class="block w-full h-4 gradient_r-b !rounded-none mt-2"></span>
    </footer>
</main>

</body>
</html>
