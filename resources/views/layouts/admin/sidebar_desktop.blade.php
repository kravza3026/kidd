<div class="relative flex grow flex-col overflow-y-auto border-r border-line bg-surface px-3 py-4">
    {{-- Brand + collapse toggle --}}
    <div class="mb-4 flex h-9 shrink-0 items-center justify-between px-1.5">
        <a href="{{ route('admin.home') }}" wire:navigate class="flex items-center gap-2 overflow-hidden">
            <span class="flex size-7 shrink-0 items-center justify-center rounded-lg bg-olive text-sm font-bold text-white" style="font-family: var(--font-display)">k</span>
            <span x-show="!collapsed" class="truncate text-sm font-bold tracking-tight text-ink" style="font-family: var(--font-display)">kidd<span class="text-olive">.</span>admin</span>
        </a>
        <button
            type="button"
            @click="collapsed = !collapsed"
            class="flex size-7 shrink-0 items-center justify-center rounded-md text-ink-muted hover:bg-surface-2 hover:text-ink"
            :aria-label="collapsed ? '{{ __('Expand sidebar') }}' : '{{ __('Collapse sidebar') }}'"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-4" :class="collapsed && 'rotate-180'">
                <path d="M15.75 19.5 8.25 12l7.5-7.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>

    @include('layouts.admin._nav', ['collapsible' => true])
</div>
