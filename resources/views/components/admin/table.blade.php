@props([
    'paginator' => null,
    'search' => true,
    'searchPlaceholder' => null,
])

<div {{ $attributes->merge(['class' => 'admin-card overflow-hidden']) }}>
    @if ($search)
        <div class="border-b border-line px-3 py-2.5">
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
                    class="admin-input max-w-xs"
                />
                <button type="submit" class="admin-btn admin-btn--secondary">{{ __('Search') }}</button>
            </form>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-line text-left text-sm">
            <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                <tr>{{ $head }}</tr>
            </thead>
            <tbody class="divide-y divide-line">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if ($paginator && $paginator->hasPages())
        <div class="border-t border-line px-3 py-2.5">
            {{ $paginator->withQueryString()->links() }}
        </div>
    @endif
</div>
