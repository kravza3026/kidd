<x-app-layout>
    <div class="pageContent ">
        <section class="py-section  container grid lg:grid-cols-12 justify-between">
            <div class="pr-5 col-span-12">
                <h2 class="font-bold text-[24px] lg:text-[48px] relative leading-[-2%] flex gap-x-4 items-center">
                    <a href="{{ route('vacancy.index') }}" class="lg:absolute size-10 border border-light-border rounded-full top-1/4 -left-14 flex justify-center items-center font-normal cursor-pointer">
                        <img src="{{ Vite::image('icons/back.svg') }}" alt="date" class="opacity-50">
                    </a>
                    {{ $vacancy->title }}
                </h2>

                <div class="flex items-center justify-between  mt-3 mb-5">
                   <div class="flex flex-wrap gap-x-2">
                       @foreach ($vacancy->tags as $tag)
                           <span class="border border-light-border font-medium px-2.5 py-0.5 rounded-full">
                            {{ $tag->name }}
                        </span>
                       @endforeach
                   </div>

                    <div>
                        <p class="text-sm opacity-40">Last updated {{ $vacancy->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
                <hr class="my-5 border-light-border">

                @if($vacancy->summary)
                    <div>
                        <h2 class="leading-[-2%] text-[24px] font-bold py-2 mt-5">Job summary</h2>
                        <p>{!! $vacancy->summary !!}</p>
                        {{-- add class "markers" if ul                   --}}
                    </div>
                @endif
                @if ($vacancy->responsibilities)
                    <div>
                        <h2 class="leading-[-2%] text-[24px] font-bold py-2 mt-5">Responsibilities</h2>
                        <p>{!! $vacancy->responsibilities !!}</p>
                        {{-- add class "markers" if ul                   --}}
                    </div>
               @endif
                @if ($vacancy->requirements)
                    <div>
                        <h2 class="leading-[-2%] text-[24px] font-bold py-2 mt-5">Requirements</h2>
                        <p>{!! $vacancy->requirements !!}</p>
                        {{-- add class "markers" if ul                   --}}
                    </div>
                @endif

                @if ($vacancy->extra)
                    <div>
                        <h2 class="leading-[-2%] text-[24px] font-bold py-2 mt-5">Extra</h2>
                        <p>{!! $vacancy->extra !!}</p>
                        {{-- add class "markers" if ul                   --}}
                    </div>
                @endif

            </div>
            <a class="my-5" href="{{ route('vacancy.application.create', $vacancy) }}">
                <x-primary-button class="text-nowrap cursor-pointer">
                    Apply now
                </x-primary-button>
{{--                TODO - Translate--}}
            </a>
        </section>
    </div>
</x-app-layout>
