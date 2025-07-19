<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center w-full py-2 px-6 sm:w-auto sm:px-8 sm:py-5 bg-olive border-b-2 border-dark-olive rounded-xl
font-bold text-base leading-4 text-snow hover:bg-dark-olive focus:bg-dark-olive active:bg-dark-olive focus:outline-none focus:ring-2 focus:ring-dark-olive focus:ring-offset-2 transition ease-in-out
duration-150']) }}>
    {{ $slot }}
</button>
