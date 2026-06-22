<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Vacancies'), 'route' => 'admin.vacancies.index'],
        ['label' => $vacancy->getTranslation('title', app()->getLocale())],
    ]" />

    <x-admin.page-header :title="$vacancy->getTranslation('title', app()->getLocale())" :subtitle="$vacancy->company?->name">
        <x-slot:actions>
            @can('update', $vacancy)
                <x-admin.button :href="route('admin.vacancies.edit', $vacancy)" wire:navigate>{{ __('Edit') }}</x-admin.button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid gap-4 lg:grid-cols-3">
        <x-admin.card :title="__('Details')" class="lg:col-span-1">
            <dl class="grid grid-cols-2 gap-y-2.5 text-sm">
                <dt class="text-ink-muted">{{ __('Company') }}</dt>
                <dd class="text-ink">{{ $vacancy->company?->name ?? '—' }}</dd>
                <dt class="text-ink-muted">{{ __('Location') }}</dt>
                <dd class="text-ink">{{ $vacancy->location?->getTranslation('name', app()->getLocale()) ?? '—' }}</dd>
                <dt class="text-ink-muted">{{ __('Remote') }}</dt>
                <dd><x-admin.status-badge :color="$vacancy->remote ? 'blue' : 'gray'" :label="$vacancy->remote ? __('Remote') : __('On-site')" /></dd>
                <dt class="text-ink-muted">{{ __('Applications') }}</dt>
                <dd class="text-ink">{{ $vacancy->applications_count }}</dd>
            </dl>
        </x-admin.card>

        <x-admin.card :title="__('Description')" class="lg:col-span-2">
            <div class="space-y-3 text-sm">
                @foreach (['summary' => __('Summary'), 'responsibilities' => __('Responsibilities'), 'requirements' => __('Requirements'), 'extra' => __('Extra')] as $field => $heading)
                    @php($value = $vacancy->getTranslation($field, app()->getLocale()))
                    @if ($value)
                        <div>
                            <p class="text-xs font-semibold text-ink-subtle uppercase">{{ $heading }}</p>
                            <p class="mt-0.5 whitespace-pre-line text-ink-muted">{{ $value }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </x-admin.card>
    </div>
</div>
