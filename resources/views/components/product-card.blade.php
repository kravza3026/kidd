@props([
    'title',
    'price',
    'image',
    'discount' => null,
    'oldPrice' => null,
    'isNew' => false,
    'genderIcon' => null,
    'ageLabel' => null,
    'colors' => [],
])

<div class="cursor-pointer group p-1 min-w-1/2 md:min-w-1/4">
    <div class="bg-card-bg group-hover:bg-white border border-transparent group-hover:border-black/10 duration-700 transition-all ease-in-out rounded-xl py-4 px-2 relative overflow-hidden">
        <div class="relative flex">
            @if($discount || $isNew)
                <div class="absolute top-1 md:top-2 left-1 md:left-2 flex items-center gap-2  ">
                    @if ($discount)
                        <div class=" bg-danger text-white text-[10px] md:text-[12px] font-semibold rounded-full px-3 py-1">
                            {{ $discount }}
                        </div>
                    @endif
                    @if ($isNew)
                        <div class=" bg-olive text-white text-[10px] md:text-[12px] font-semibold rounded-full px-3 py-1">
                            NEW
                        </div>
                    @endif
                </div>
            @endif
            @if ($genderIcon || $ageLabel)
                <div class="absolute top-2 right-2 hidden xl:flex items-center gap-1  bg-opacity-90 rounded-full px-2 py-1 text-xs">
                    @if ($genderIcon)
                        <img src="{{ $genderIcon }}" alt="gender" class="w-[24px] h-[24px]" />
                    @endif
                    @if ($ageLabel)
                        <div class="text-[12px] bg-white font-bold h-[24px] rounded-full flex items-center justify-center py-1 px-2 gap-x-1 border border-black/10">
                            <img src="{{ asset('assets/images/icons/size.png') }}" alt="size">
                            {{ $ageLabel }}
                        </div>
                    @endif
                </div>
            @endif

            <img src="{{ $image }}" alt="{{ $title }}" class="w-full object-contain aspect-[1/1]" />
        </div>

        <div class="flex justify-center items-center gap-2 mt-3">
            @foreach ($colors as $color)
                @if ($loop->first)
                    <div class="border cursor-pointer p-0 w-4 h-4 rounded-full flex justify-center items-center border-gray-300 bg-white">
            <span
                class="w-2 h-2 rounded-full p-0"
                style="background-color: {{ $color }}"
            ></span>
                    </div>
                @else
                    <div class="cursor-pointer w-2 h-2 rounded-full" style="background-color: {{ $color }}"></div>
                @endif
            @endforeach

        </div>
        <div class="absolute bg-white w-7 h-7 xl:w-10 xl:h-10 p-1 xl:p-2 border border-black/10 rounded-full right-7 xl:right-4 bottom-4 xl:bottom-[-20%] group-hover:bottom-4  duration-500 transition-all ease-in-out">
            <img class="xl:opacity-0  group-hover:opacity-100 duration-1000"  src="{{ asset('assets/images/icons/add_fav.svg') }}" alt="add to favorite">
        </div>
    </div>

    <div class="text-start px-4 mt-4">
        @if ($genderIcon || $ageLabel)
            <div class="flex xl:hidden items-center gap-1  bg-opacity-90 rounded-full py-1 text-[10px]">
                @if ($genderIcon)
                    <img src="{{ $genderIcon }}" alt="gender" class="w-[24px] h-[24px]" />
                @endif
                @if ($ageLabel)
                    <div class="text-[12px] bg-white font-bold h-[24px] rounded-full flex items-center justify-center py-1 px-2 gap-x-1 border border-black/10">
                        <img src="{{ asset('assets/images/icons/size.png') }}" alt="size">
                        {{ $ageLabel }}
                    </div>
                @endif
            </div>
        @endif
        <p class="text-base text-charcoal text-[14px] md:text-[16px]">{{ $title }}</p>
        <p class="font-bold text-charcoal text-[16px]">{{ $price }} lei
            @if ($oldPrice)
                <span class="text-[14px] line-through opacity-30">{{$oldPrice}}lei</span>
            @endif
        </p>
    </div>
</div>
