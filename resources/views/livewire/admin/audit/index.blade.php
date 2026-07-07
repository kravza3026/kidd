@php
    $eventColor = ['created' => 'green', 'updated' => 'blue', 'deleted' => 'red'];
@endphp

<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => __('Audit log')]]" />
    <x-admin.page-header :title="__('Audit log')" :subtitle="__('Every change made in the admin')" />

    <div class="admin-card overflow-hidden">
        <div class="flex flex-wrap items-center gap-2 border-b border-line p-2.5">
            <div class="relative max-w-xs flex-1">
                <svg viewBox="0 0 20 20" fill="currentColor" class="pointer-events-none absolute top-1/2 left-2.5 size-4 -translate-y-1/2 text-ink-muted">
                    <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <input type="search" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search…') }}" class="admin-input pl-8" />
            </div>
            <select wire:model.live="event" class="admin-input max-w-[10rem] cursor-pointer">
                <option value="">{{ __('All events') }}</option>
                @foreach ($events as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                    <tr>
                        <th class="admin-table-cell text-left font-medium">{{ __('When') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('By') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Event') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Subject') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($activities as $activity)
                        <tr wire:key="act-{{ $activity->id }}" class="hover:bg-surface-2">
                            <td class="admin-table-cell text-ink-muted">{{ $activity->created_at?->format('Y-m-d H:i') }}</td>
                            <td class="admin-table-cell text-ink">{{ $activity->causer?->name ?? __('System') }}</td>
                            <td class="admin-table-cell">
                                <x-admin.status-badge :color="$eventColor[$activity->event] ?? 'gray'" :label="$activity->event ? ucfirst($activity->event) : '—'" />
                            </td>
                            <td class="admin-table-cell text-ink-muted">
                                {{ class_basename($activity->subject_type ?? '') }} #{{ $activity->subject_id }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="admin-table-cell py-10 text-center text-ink-muted">{{ __('No activity recorded yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line p-2.5">{{ $activities->links() }}</div>
    </div>
</div>
