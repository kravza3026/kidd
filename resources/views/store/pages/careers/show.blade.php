<x-app-layout>
    <div class="pageContent ">
{{--        {{dd($vacancy)}}--}}
        <section class="py-section  container grid lg:grid-cols-12 justify-between">
            <div class="pr-5 col-span-12">
                <h2 class="font-bold text-[24px] lg:text-[48px] relative leading-[-2%] flex gap-x-4 items-center">
                    <a href="{{ route('vacancy.index') }}" class="relative lg:absolute size-10 min-w-10 min-h-10 border border-light-border rounded-full top-1/4 lg:-left-14 flex justify-center items-center font-normal cursor-pointer">
                        <img src="{{ Vite::image('icons/back.svg') }}" alt="date" class="opacity-50">
                    </a>
                    {{ $vacancy->title }}
                </h2>

                <div class="flex items-center justify-between  mt-3 mb-5 ml-12 lg:ml-0">
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
                        <p>{{ $vacancy->summary }}</p>
                        {{-- add class "markers" if ul                   --}}
                    </div>
               @endif
               @if ($vacancy->responsibilities)
                    <div>
                        <h2 class="leading-[-2%] text-[24px] font-bold py-2 mt-5">Responsibilities</h2>
                        <p>{{ $vacancy->responsibilities }}</p>
                        {{-- add class "markers" if ul                   --}}
                    </div>
                @endif
                @if ($vacancy->requirements)
                    <div>
                        <h2 class="leading-[-2%] text-[24px] font-bold py-2 mt-5">Requirements</h2>
                        <p>{{ $vacancy->requirements }}</p>
                        {{-- add class "markers" if ul                   --}}
                    </div>
                @endif


            @if ($vacancy->extra)
                    <div>
                        <h2 class="leading-[-2%] text-[24px] font-bold py-2 mt-5">Extra</h2>
                        <p>{{ $vacancy->extra }}</p>
                        {{-- add class "markers" if ul                   --}}
                    </div>
                @endif

            @if ($vacancy->notes)
                <div class="mt-5">
                    <p>{{ $vacancy->notes }}</p>
                    {{-- add class "markers" if ul                   --}}
                </div>
            @endif
            </div>
            <a class="my-5" href="{{ route('vacancy.application.create', $vacancy) }}">
                <x-primary-button class="text-nowrap cursor-pointer">Apply now</x-primary-button>
            </a>

        </section>
    </div>
{{--        @include('store.pages.careers.application.alert')--}}
</x-app-layout>
<script>
    @if(session('success'))
window.addEventListener('DOMContentLoaded', () => {
    Swal.fire({
        imageUrl: '{{Vite::image('icons/file.png')}}',
        imageWidth: 200,
        imageHeight: 200,
        imageAlt: 'Custom icon',
        showCloseButton: true,
        showConfirmButton: false,
        didOpen: () => {
            document.getElementById('close-alert').addEventListener('click', () => {
                Swal.close();
            });
        },
        customClass: {
            popup: 'bg-white shadow-xl !rounded-lg !p-4',  // головний контейнер
            title: 'text-xl font-bold text-green-700',
            htmlContainer: 'text-gray-600 ',
        },
        html: `{!! str_replace("\n", '', trim(view('store.pages.careers.application.alert')->render())) !!}`,

    });
});
    @endif
</script>
<style>
    .swal2-close:hover{
        color: var(--color-olive)!important;
    }
    .swal2-close:focus-visible{
        box-shadow: none!important;
    }
</style>
