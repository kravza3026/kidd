@props([
    'paginator' => null,
    'search' => true,
    'searchPlaceholder' => null,
])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-2xl border border-[#eeeeee] bg-white shadow-sm']) }}>
    @if ($search)
        <div class="border-b border-[#f3f3f3] px-4 py-3">
            <form method="GET" class="flex items-center gap-2">
                {{-- Preserve other query params (filters) while searching/paginating. --}}
                @foreach (request()->except(['search', 'page']) as $key => $value)
                    @if (! is_array($value))
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
                    @endif
                @endforeach

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ $searchPlaceholder ?? __('Search…') }}"
                    class="w-full max-w-xs rounded-xl border-[1.5px] border-[#eeeeee] p-2.5 text-sm focus:border-gray-200 focus:ring-gray-200"
                />
                <button type="submit" class="rounded-xl bg-charcoal px-4 py-2.5 text-sm font-semibold text-white">
                    {{ __('Search') }}
                </button>
            </form>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-[#f3f3f3] text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>{{ $head }}</tr>
            </thead>
            <tbody class="divide-y divide-[#f7f7f7]">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if ($paginator && $paginator->hasPages())
        <div class="border-t border-[#f3f3f3] px-4 py-3">
            {{ $paginator->withQueryString()->links() }}
        </div>
    @endif
</div>
