
@php
    $sections = [
      [
          'title' => 'Online Store Usage',
          'items' => [
              'You must be 18 years of age or older to use our website and make a purchase.',
              'You are responsible for maintaining the confidentiality of your account and password, and for restricting access to your account.',
              'You agree to provide accurate, current, and complete information during the purchase process.',
          ],
      ],
      [
          'title' => 'Product Information',
          'items' => [
              'We strive to provide accurate and detailed information about our products, including descriptions, images, and sizing information. However, we cannot guarantee that all information is completely accurate, up-to-date, or free from errors.',
              'Colors of products may appear differently on different devices due to variations in screens and settings. We cannot guarantee exact color accuracy.',
          ],
      ],
      [
          'title' => 'Pricing and Payments',
          'items' => [
              'All prices displayed on our website are in the specified currency and exclude applicable taxes, shipping, and handling charges, unless stated otherwise.',
              'We reserve the right to change prices at any time without prior notice.',
              'Payment for orders must be made using the available payment methods on our website. By placing an order, you confirm that you are authorized to use the selected payment method.',
          ],
      ],
      [
          'title' => 'Order Acceptance and Cancellation',
          'items' => [
              'Once you place an order, you will receive an order confirmation email. This email does not guarantee acceptance of your order. We reserve the right to accept or cancel orders at our discretion.',
              'In the event of cancellation, we will notify you and provide a refund if payment has been processed.',
          ],
      ],
      [
          'title' => 'Shipping and Delivery',
          'items' => [
              'We will make every effort to ship orders promptly and deliver them within the estimated timeframe. However, we cannot guarantee specific delivery dates as they depend on various factors beyond our control.',
              'Shipping costs and delivery options will be displayed during the checkout process. Additional customs duties or fees may apply for international orders.',
          ],
      ],
      [
          'title' => 'Returns and Exchanges',
          'items' => [
              'We accept returns and exchanges in accordance with our Return Policy, which can be found on our website. Please review the policy carefully before initiating a return or exchange.',
              'Returned products must be in unused, unwashed, and original condition with all tags and packaging intact.',
          ],
      ],
      [
          'title' => 'Intellectual Property',
          'items' => [
              'All content on our website, including text, images, logos, and designs, is protected by copyright and other intellectual property laws. You may not use, reproduce, modify, or distribute any content without our prior written consent.',
          ],
      ],
      [
          'title' => 'Limitation of Liability',
          'items' => [
              'We strive to provide a secure and error-free website. However, we do not guarantee that our website will be free from viruses, malware, or other harmful elements. You agree to use our website at your own risk.',
              'In no event shall KIDD. or its affiliates be liable for any direct, indirect, incidental, special, or consequential damages arising out of or in connection with your use of our website or products.',
          ],
      ],
      [
          'title' => 'Governing Law',
          'items' => [
              'These Terms & Conditions shall be governed by and construed in accordance with the laws of [Jurisdiction]. Any disputes arising out of or relating to these Terms & Conditions shall be subject to the exclusive jurisdiction of the courts of [Jurisdiction].',
          ],
      ],
  ];

@endphp

<x-app-layout>
    <div class="pageContent">
        <section class="container py-section">
{{--            Terms {{ app()->getLocale() }}--}}

            <h1 class="text-[30px] lg:text-[48px] font-bold opacity-80 leading-[100%]">Terms and Conditions</h1>
            <p class="opacity-40 text-[12px] lg:text-[14px]">Last updated 5 days ago</p>
            <hr class="my-5 border-light-border">
            <div class="content opacity-80">
                Please read these Terms & Conditions carefully before using our website or making a purchase from KIDD. These Terms & Conditions outline the rules and regulations governing the use of our website and the purchase of products from our online store. By accessing or using our website and placing an order, you agree to be bound by these Terms & Conditions. If you do not agree with any part of these Terms & Conditions, please refrain from using our website or making a purchase.

                <ul class="my-5 grid gap-y-5">
                    @foreach($sections as $index => $section)
                        <li>
                            <p class="flex items-center gap-x-3 font-bold">
                <span class="w-[18px] h-[18px] bg-olive rounded-full text-white flex items-center justify-center p-3 text-[13px]">
                    {{ $index + 1 }}
                </span>
                                <span class="opacity-80 text-[18px] leading-[150%]">{{ $section['title'] }}</span>
                            </p>

                            <ul class="markers pl-13 grid gap-y-3 text-[18px] leading-[150%] pt-2">
                                @foreach($section['items'] as $item)
                                    <li>
                                       <p> {{ $item }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
                <p class="opacity-80 text-[18px] leading-[175%]">By using our website and making a purchase, you acknowledge that you have read, understood, and agreed to these Terms & Conditions. These Terms & Conditions may be updated or revised from time to time, and it is your responsibility to review them periodically. If you have any questions or concerns regarding these Terms & Conditions, please contact our customer support team.</p>
            </div>
            <div class="flex items-start justify-start gap-3 mt-5">
                <x-ui.checkbox></x-ui.checkbox>
                <div class="leading-[150%]">
                    I have read and I totally agree to the
                    <a href="/" class="underline font-bold">Terms and Conditions</a>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
