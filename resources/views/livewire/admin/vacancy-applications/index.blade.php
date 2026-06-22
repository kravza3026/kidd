<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => __('Applications')]]" />
    <x-admin.page-header :title="__('Job applications')" :subtitle="__('Submissions from the careers pages')" />

    <div class="admin-card overflow-hidden">
        <div class="flex items-center gap-2 border-b border-line p-2.5">
            <div class="relative max-w-xs flex-1">
                <svg viewBox="0 0 20 20" fill="currentColor" class="pointer-events-none absolute top-1/2 left-2.5 size-4 -translate-y-1/2 text-ink-muted">
                    <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <input type="search" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search…') }}" class="admin-input pl-8" />
            </div>
            <span wire:loading.delay wire:target="search" class="text-xs text-ink-muted">{{ __('Searching…') }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                    <tr>
                        <x-admin.th field="first_name" :label="__('Applicant')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <x-admin.th field="email" :label="__('Email')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-left font-medium">{{ __('Vacancy') }}</th>
                        <x-admin.th field="created_at" :label="__('Applied')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-right font-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($applications as $application)
                        <tr wire:key="app-{{ $application->id }}" class="hover:bg-surface-2">
                            <td class="admin-table-cell font-medium text-ink">
                                <a href="{{ route('admin.vacancy-applications.show', $application) }}" wire:navigate class="hover:text-olive">
                                    {{ $application->first_name }} {{ $application->last_name }}
                                </a>
                            </td>
                            <td class="admin-table-cell text-ink-muted">{{ $application->email }}</td>
                            <td class="admin-table-cell text-ink-muted">{{ $application->vacancy?->getTranslation('title', app()->getLocale()) ?? '—' }}</td>
                            <td class="admin-table-cell text-ink-muted">{{ $application->created_at?->diffForHumans() }}</td>
                            <td class="admin-table-cell">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.vacancy-applications.show', $application) }}" wire:navigate class="admin-btn admin-btn--ghost">{{ __('View') }}</a>
                                    @can('delete', $application)
                                        <button type="button" wire:click="delete({{ $application->id }})" wire:confirm="{{ __('Delete this application?') }}" class="admin-btn admin-btn--ghost text-danger hover:bg-danger/10">{{ __('Delete') }}</button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="admin-table-cell py-10 text-center text-ink-muted">{{ __('No applications yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line p-2.5">{{ $applications->links() }}</div>
    </div>
</div>
