<x-app-layout>
    <div class="pageContent">
        <section class="py-section container grid justify-between lg:grid-cols-12 lg:px-48">
            <div class="col-span-12 pr-5">
                <h2 class="relative flex items-center gap-x-4 text-[24px] leading-[-2%] font-bold lg:text-[48px]">
                    <a
                        href="{{ route('vacancy.index') }}"
                        class="border-light-border relative top-1/4 flex size-10 min-h-10 min-w-10 cursor-pointer items-center justify-center rounded-full border font-normal lg:absolute lg:-left-14"
                    >
                        <img src="{{ Vite::image('icons/back.svg') }}" alt="date" class="opacity-50" />
                    </a>
                    {{ $vacancy->title }}
                </h2>

                <div class="mt-3 mb-5 ml-12 flex items-center justify-between lg:ml-0">
                    <div class="flex flex-wrap gap-x-2">
                        @foreach ($vacancy->tags as $tag)
                            <span class="border-light-border rounded-full border px-2.5 py-0.5 font-medium">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>

                    <div>
                        <p class="text-sm opacity-40">
                            {{ __('careers.vacancies_latest_update', ['last_update' => $vacancy->updated_at->diffForHumans()]) }}
                        </p>
                    </div>
                </div>
                <hr class="border-light-border my-5" />

                @if ($vacancy->summary)
                    <div>
                        <h2 class="mt-5 py-2 text-[24px] leading-[-2%] font-bold">
                            {{ __('careers.vacancy_job_summary') }}
                        </h2>
                        <p>{!! $vacancy->summary !!}</p>
                        {{-- <ul class="ml-5 markers"> --}}
                        {{-- <li>test</li> --}}
                        {{-- </ul> --}}
                        {{-- add class "markers" if ul --}}
                    </div>
                @endif

                @if ($vacancy->responsibilities)
                    <div>
                        <h2 class="mt-5 py-2 text-[24px] leading-[-2%] font-bold">
                            {{ __('careers.vacancy_job_responsibilities') }}
                        </h2>
                        <p>{!! $vacancy->responsibilities !!}</p>
                        {{-- add class "markers" if ul --}}
                    </div>
                @endif

                @if ($vacancy->requirements)
                    <div>
                        <h2 class="mt-5 py-2 text-[24px] leading-[-2%] font-bold">
                            {{ __('careers.vacancy_job_requirements') }}
                        </h2>
                        <p>{!! $vacancy->requirements !!}</p>
                        {{-- add class "markers" if ul --}}
                    </div>
                @endif

                @if ($vacancy->extra)
                    <div>
                        <h2 class="mt-5 py-2 text-[24px] leading-[-2%] font-bold">
                            {{ __('careers.vacancy_job_extra') }}
                        </h2>
                        <p>{!! $vacancy->extra !!}</p>
                        {{-- add class "markers" if ul --}}
                    </div>
                @endif
            </div>
            <a class="my-5" href="{{ route('vacancy.application.create', $vacancy) }}">
                <x-primary-button class="cursor-pointer text-nowrap">
                    {{ __('careers.vacancy_apply_button') }}
                </x-primary-button>
                {{-- TODO - Translate --}}
            </a>
        </section>
    </div>
</x-app-layout>
