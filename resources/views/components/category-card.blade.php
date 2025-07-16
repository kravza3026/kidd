<a href="{{ $link ?? '#' }}"
   class="category-card group rounded-2xl w-1/2 min-w-2/3 md:min-w-1/5 md:w-1/4 overflow-hidden h-[240px] xl:h-[480px] grid items-end"
   style="background-image: url('{{ $backgroundImage ?? '/default-image.jpg' }}'); background-size: cover; background-position: center;">
    <div class="card-title grid text-center bg-gradient-to-t from-gray-900/80 to-slate-50/0  p-4 bg-opacity-60 ">
        <p class="font-semibold relative bottom-0 group-hover:bottom-7 text-white text-[20px] duration-500 transition-all ease-in-out">{{ $title ?? 'Default Title' }}</p>
        <svg class="relative mx-auto group-hover:bottom-5 bottom-[-50px] duration-500 transition-all ease-in-out" width="24" height="24" viewBox="0 0 24 24" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path d="M20 16L12 8L4 16" stroke="#020202" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"/>
        </svg>
    </div>
</a>
