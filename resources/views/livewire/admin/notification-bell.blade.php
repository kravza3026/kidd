<div wire:poll.45s class="relative" x-data="{ open: false }" @keydown.escape="open = false">
    <button
        type="button"
        @click="open = !open"
        class="relative flex size-9 items-center justify-center rounded-lg text-ink-muted hover:bg-surface-2 hover:text-ink"
        aria-label="{{ __('Notifications') }}"
    >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-5">
            <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        @if ($unread > 0)
            <span class="absolute -top-0.5 -right-0.5 flex min-w-4 items-center justify-center rounded-full bg-danger px-1 text-[10px] font-bold text-white">{{ $unread > 99 ? '99+' : $unread }}</span>
        @endif
    </button>

    <div
        x-show="open"
        x-cloak
        @click.outside="open = false"
        x-transition.origin.top.right
        class="absolute right-0 z-30 mt-2 w-80 overflow-hidden rounded-xl border border-line bg-surface shadow-lg"
    >
        <div class="flex items-center justify-between border-b border-line px-3 py-2">
            <span class="text-sm font-semibold text-ink">{{ __('Notifications') }}</span>
            @if ($unread > 0)
                <button type="button" wire:click="markAllRead" class="text-xs text-ink-muted hover:text-ink">{{ __('Mark all read') }}</button>
            @endif
        </div>

        <div class="max-h-96 divide-y divide-line overflow-y-auto">
            @forelse ($items as $note)
                @php($data = $note->data)
                @php($url = ! empty($data['route']) && \Illuminate\Support\Facades\Route::has($data['route']) ? route($data['route'], $data['param'] ?? []) : null)
                <a
                    href="{{ $url ?? '#' }}"
                    @if ($url) wire:navigate @endif
                    wire:click="markRead('{{ $note->id }}')"
                    wire:key="note-{{ $note->id }}"
                    @class([
                        'flex items-start gap-2.5 px-3 py-2.5 hover:bg-surface-2',
                        'bg-olive-soft/40' => is_null($note->read_at),
                    ])
                >
                    <span @class([
                        'mt-1.5 size-2 shrink-0 rounded-full',
                        'bg-olive' => is_null($note->read_at),
                        'bg-transparent' => ! is_null($note->read_at),
                    ])></span>
                    <span class="min-w-0 flex-1">
                        <span class="block text-sm font-medium text-ink">{{ $data['title'] ?? __('Notification') }}</span>
                        <span class="block truncate text-xs text-ink-muted">{{ $data['message'] ?? '' }}</span>
                        <span class="block text-[10px] text-ink-subtle">{{ $note->created_at?->diffForHumans() }}</span>
                    </span>
                </a>
            @empty
                <p class="px-3 py-8 text-center text-sm text-ink-muted">{{ __('No notifications yet.') }}</p>
            @endforelse
        </div>
    </div>
</div>
