<style>
    html {
        -webkit-print-color-adjust: exact;
    }
    .inv_footer > * {
        font-family: 'Onest', sans-serif;
        font-weight: 400;
        font-size: 12px;
        color: #000;
        text-decoration: none;
    }
    .inv_footer {
        position: absolute;
        bottom: 0;
        left: 24px;
        right: 24px;
        top: auto;
        color: #000;
        font-weight: bold;
        text-align: center;
        height: 120px;
    }
    .mt-2 {
        margin-top: 8px;
    }
    .h-4 {
        height: 16px;
    }
    .w-full {
        width: 100%;
    }
    .text-sm {
        font-size: 12px;
        line-height: 1.3333;
    }
    .text-xs {
        font-size: 10px;
        line-height: 1.3333;
    }
    .text-end {
        text-align: end;
    }
    .text-start {
        text-align: start;
    }
    .font-bold {
        font-weight: bold;
    }
    .opacity-50 {
        opacity: 0.5;
    }
    .grid {
        display: grid;
    }
    .grid-cols-12 {
        grid-template-columns: repeat(12, minmax(0, 1fr));
    }
    .gap-4 {
        gap: 14px;
    }
    .col-span-2 {
        grid-column: span 2 / span 2;
    }
    .col-span-4 {
        grid-column: span 4 / span 4;
    }
    .col-span-6 {
        grid-column: span 6 / span 6;
    }
    .my-4 {
        margin-block: 6px;
    }
    .border-light-border {
        border-color: #e5e7eb;
        border-width: 0.5px;
        border-style: solid;
        border-top: none;
    }
    .gradient_full {
        background-image: linear-gradient(to right, oklch(88.5% 0.062 18.334), oklch(80.9% 0.105 251.813));
        display: block;
        width: 100%;
        height: 16px;
        margin-top: 16px;
    }
    /* cyrillic-ext */
    @font-face {
        font-family: 'Onest';
        font-style: normal;
        font-weight: 300 700;
        font-display: swap;
        src: url(file://{{ asset('fonts/Onest.ttf') }}) format('truetype');
        unicode-range: U+0460-052F, U+1C80-1C8A, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Onest';
        font-style: normal;
        font-weight: 300 700;
        font-display: swap;
        src: url(file://{{ asset('fonts/Onest.ttf') }}) format('truetype');
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Onest';
        font-style: normal;
        font-weight: 300 700;
        font-display: swap;
        src: url(file://{{ asset('fonts/Onest.ttf') }}) format('truetype');
        unicode-range:
            U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF,
            U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }
    /* latin */
    @font-face {
        font-family: 'Onest';
        font-style: normal;
        font-weight: 300 700;
        font-display: swap;
        src: url(file://{{ asset('fonts/Onest.ttf') }}) format('truetype');
        unicode-range:
            U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F,
            U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
</style>
<footer class="inv_footer">
    <p style="text-align: left; font-weight: 400; font-size: 11px; margin-top: 24px" class="text-sm opacity-50">
        {{ __('invoice.footer.description') }}
    </p>
    <hr class="border-light-border my-4" />
    <div class="grid grid-cols-12 gap-4">
        <p class="col-span-2 text-start text-xs font-bold">Kidd Digital SRL</p>
        <p class="col-span-4 text-start text-xs">
            <span class="font-bold">{{ __('invoice.footer.idno') }}:</span>
            101560000363
        </p>
        <p class="col-span-6 text-end text-xs">
            <span class="font-bold">{{ __('invoice.footer.address') }}:</span>
            bd. Decebal 6/1, apt 333, Chișinău, MD-2022
        </p>
    </div>
</footer>
<div
    style="
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 16px;
        margin-top: 16px;
        background-image: linear-gradient(to right, oklch(80.9% 0.105 251.813), oklch(88.5% 0.062 18.334));
    "
    class="gradient_full mt-2 h-4 w-full"
></div>
