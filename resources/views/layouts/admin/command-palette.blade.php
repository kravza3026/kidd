@php
    // Destinations are discovered from registered admin "*.index" routes, so the palette
    // stays in sync as modules ship. The panel itself is staff-gated; per-route
    // authorization still applies on navigation.
    $destinations = collect(app('router')->getRoutes()->getRoutes())
        ->map(fn ($route) => $route->getName())
        ->filter(fn ($name) => $name && \Illuminate\Support\Str::startsWith($name, 'admin.') && \Illuminate\Support\Str::endsWith($name, '.index'))
        ->unique()
        ->map(fn ($name) => [
            'label' => \Illuminate\Support\Str::headline(\Illuminate\Support\Str::between($name, 'admin.', '.index')),
            'url' => route($name),
        ])
        ->sortBy('label')
        ->prepend(['label' => __('Dashboard'), 'url' => route('admin.home')])
        ->values();
@endphp

<div
    x-data="{
        open: false,
        query: '',
        active: 0,
        items: @js($destinations),
        get filtered() {
            const q = this.query.toLowerCase().trim();
            return q === '' ? this.items : this.items.filter((i) => i.label.toLowerCase().includes(q));
        },
        toggle() { this.open = !this.open; this.query = ''; this.active = 0; if (this.open) this.$nextTick(() => this.$refs.input?.focus()); },
        move(d) { const n = this.filtered.length; if (n) this.active = (this.active + d + n) % n; },
        go(url) { if (url) window.location.href = url; },
        enter() { const item = this.filtered[this.active]; if (item) this.go(item.url); },
    }"
    @keydown.window.meta.k.prevent="toggle()"
    @keydown.window.ctrl.k.prevent="toggle()"
    @keydown.window.escape="open = false"
    @admin-palette.window="toggle()"
    x-cloak
>
    <div x-show="open" class="fixed inset-0 z-[100] bg-black/40 backdrop-blur-sm" @click="open = false" x-transition.opacity></div>

    <div
        x-show="open"
        x-transition
        class="fixed inset-x-0 top-20 z-[101] mx-auto w-full max-w-xl px-4"
    >
        <div class="admin-card overflow-hidden shadow-2xl" @click.outside="open = false">
            <div class="flex items-center gap-2 border-b border-line px-3">
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-4 text-ink-muted">
                    <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <input
                    x-ref="input"
                    x-model="query"
                    @keydown.down.prevent="move(1)"
                    @keydown.up.prevent="move(-1)"
                    @keydown.enter.prevent="enter()"
                    type="text"
                    placeholder="{{ __('Jump to…') }}"
                    class="w-full bg-transparent py-3 text-sm text-ink outline-none placeholder:text-ink-muted"
                />
                <kbd class="rounded border border-line px-1.5 py-0.5 text-[10px] text-ink-muted">ESC</kbd>
            </div>
            <ul class="max-h-80 overflow-y-auto py-1">
                <template x-for="(item, index) in filtered" :key="item.url">
                    <li>
                        <button
                            type="button"
                            @click="go(item.url)"
                            @mouseenter="active = index"
                            :class="active === index ? 'bg-olive-soft text-ink' : 'text-ink-muted'"
                            class="flex w-full items-center gap-2 px-3 py-2 text-left text-sm"
                        >
                            <svg viewBox="0 0 20 20" fill="currentColor" class="size-4 opacity-60"><path d="M3 5.75A2.75 2.75 0 0 1 5.75 3h8.5A2.75 2.75 0 0 1 17 5.75v8.5A2.75 2.75 0 0 1 14.25 17h-8.5A2.75 2.75 0 0 1 3 14.25v-8.5Z" /></svg>
                            <span x-text="item.label"></span>
                        </button>
                    </li>
                </template>
                <li x-show="filtered.length === 0" class="px-3 py-6 text-center text-sm text-ink-muted">{{ __('No matches.') }}</li>
            </ul>
        </div>
    </div>
</div>
