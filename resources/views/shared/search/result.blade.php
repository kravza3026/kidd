@foreach($results as $category)
{{--<tr>--}}
{{--    <td>{{ $category->id }}</td>--}}
{{--    <td>{{ $category->name }}</td>--}}
{{--    <td>{{ $category->description }}</td>--}}
{{--    <td>{{ $category->active }}</td>--}}
{{--</tr>--}}
    <div class="self-stretch pl-6 pr-8 py-6 border-b border-zinc-100 justify-start items-center gap-4 inline-flex">
        <div class="grow shrink basis-0 h-16 justify-start items-center gap-6 flex">
            <div class="w-16 h-16 bg-neutral-100 rounded-xl flex-col justify-center items-center gap-1 inline-flex">
                <img class="w-14 h-14 mix-blend-multiply" src="{{ Vite::image('product-'.rand(1,4).'.png') }}" />
            </div>
            <div class="grow shrink basis-0 flex-col justify-start items-start gap-2 inline-flex">
                <div class="justify-start items-start gap-1 inline-flex">
                    <div><span class="text-black text-xl font-normal leading-tight">Summer Cotton </span><span class="text-black text-xl font-bold leading-tight">Jump</span><span class="text-black text-xl font-normal leading-tight">suit</span></div>
                </div>
                <div class="justify-start items-center gap-3 inline-flex">
                    <div class="opacity-40 text-black text-base font-normal leading-none">Beige, Pink, White, Gray, Ivory</div>
                    <div class="w-4 self-stretch origin-top-left rotate-90 opacity-40 border border-zinc-400"></div>
                    <div class="opacity-40 text-black text-base font-normal leading-none">0–12M</div>
                </div>
            </div>
        </div>
        <div class="w-28 h-12 flex-col justify-start items-end gap-1 inline-flex">
            <div class="self-stretch text-right text-lime-300 text-lg font-bold leading-none">240 lei</div>
        </div>
    </div>
@endforeach
