<x-app-layout>
    <div class="pageContent">
        <section class="py-section container grid lg:grid-cols-12 justify-between">
            <div class="pr-5 col-span-6">
                <h2 class="font-bold text-[30px] lg:text-[24px] leading-[-2%]">
                    {{ $vacancy->title }}
                </h2>
                <p>
                    Tags:
                    @foreach ($vacancy->tags as $tag)
                        <span class="bg-gray-200 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                            {{ $tag->name }}
                        </span>
                    @endforeach

                    <br>
                    <br>
                    <span class="font-bold">Summary:</span>
                    {{ $vacancy->summary }}
                    <br>
                    <br>
                    <span class="font-bold">Requirements:</span>
                    {{ $vacancy->requirements }}
                    <br>
                    <br>
                    <span class="font-bold">Responsibilities:</span>
                    {{ $vacancy->responsibilities }}
                    <br>
                    <br>
                    <span class="font-bold">Extra:</span>
                    {{ $vacancy->extra }}
                    <br>
                    <br>
                    <span class="font-bold">Notes:</span>
                    {{ $vacancy->notes }}
                    <br>
                    <br>

                    <a class="button px-5 py-4" href="{{ route('vacancy.application.create', $vacancy) }}">Apply for vacancy</a>
                </p>
            </div>
        </section>
    </div>
</x-app-layout>
