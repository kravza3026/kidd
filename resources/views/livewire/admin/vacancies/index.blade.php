<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => __('Vacancies')]]" />

    <x-admin.page-header :title="__('Vacancies')" :subtitle="__('Manage job listings')">
        <x-slot:actions>
            @can('create', App\Models\Vacancy::class)
                <x-admin.button :href="route('admin.vacancies.create')" wire:navigate>{{ __('New vacancy') }}</x-admin.button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="admin-card overflow-hidden">
        <div class="flex items-center gap-2 border-b border-line p-2.5">
            <div class="relative max-w-xs flex-1">
                <svg viewBox="0 0 20 20" fill="currentColor" class="pointer-events-none absolute top-1/2 left-2.5 size-4 -translate-y-1/2 text-ink-muted">
                    <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <input type="search" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search…') }}" class="admin-input pl-8" />
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                    <tr>
                        <x-admin.th field="title" :label="__('Title')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-left font-medium">{{ __('Company') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Remote') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Applications') }}</th>
                        <th class="admin-table-cell text-right font-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($vacancies as $vacancy)
                        <tr wire:key="vac-{{ $vacancy->id }}" class="hover:bg-surface-2">
                            <td class="admin-table-cell font-medium text-ink">
                                <a href="{{ route('admin.vacancies.show', $vacancy) }}" wire:navigate class="hover:text-olive">
                                    {{ $vacancy->getTranslation('title', app()->getLocale()) }}
                                </a>
                            </td>
                            <td class="admin-table-cell text-ink-muted">{{ $vacancy->company?->name ?? '—' }}</td>
                            <td class="admin-table-cell">
                                <x-admin.status-badge :color="$vacancy->remote ? 'blue' : 'gray'" :label="$vacancy->remote ? __('Remote') : __('On-site')" />
                            </td>
                            <td class="admin-table-cell text-ink-muted">{{ $vacancy->applications_count }}</td>
                            <td class="admin-table-cell">
                                <x-admin.row-actions :model="$vacancy" :edit-url="route('admin.vacancies.edit', $vacancy)" :delete-id="$vacancy->id" :delete-confirm="__('Delete this vacancy?')" />
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="admin-table-cell py-10 text-center text-ink-muted">{{ __('No vacancies yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line p-2.5">{{ $vacancies->links() }}</div>
    </div>
</div>
