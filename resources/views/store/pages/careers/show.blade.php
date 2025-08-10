<x-app-layout>
    <div class="pageContent">
        <section class="py-section container">
            <div class="mx-auto max-w-5xl">
                <h2 class="font-bold text-xl lg:text-2xl leading-[-2%]">
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


                </p>

                <div class="flex">
                    <a class="button px-5 py-4" href="{{ route('vacancy.application.create', $vacancy) }}">
                        {{ __('Apply now') }}
                    </a>
                </div>

            </div>
        </section>
    </div>
</x-app-layout>
