@php
    $cv = $application->cv_url ?: ($application->cv_file_path ? asset('storage/'.$application->cv_file_path) : null);
@endphp

<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Applications'), 'route' => 'admin.vacancy-applications.index'],
        ['label' => $application->first_name.' '.$application->last_name],
    ]" />

    <x-admin.page-header :title="$application->first_name.' '.$application->last_name" :subtitle="$application->email">
        <x-slot:actions>
            @if ($cv)
                <a href="{{ $cv }}" target="_blank" rel="noopener" class="admin-btn admin-btn--secondary">{{ __('Download CV') }}</a>
            @endif
            <a href="mailto:{{ $application->email }}" class="admin-btn admin-btn--secondary">{{ __('Reply') }}</a>
            @can('delete', $application)
                <button type="button" wire:click="delete" wire:confirm="{{ __('Delete this application?') }}" class="admin-btn admin-btn--danger">{{ __('Delete') }}</button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid gap-4 lg:grid-cols-2">
        <x-admin.card :title="__('Applicant')">
            <dl class="grid grid-cols-2 gap-y-2.5 text-sm">
                <dt class="text-ink-muted">{{ __('Email') }}</dt>
                <dd class="text-ink">{{ $application->email }}</dd>
                <dt class="text-ink-muted">{{ __('Phone') }}</dt>
                <dd class="text-ink">{{ $application->phone }}</dd>
                <dt class="text-ink-muted">{{ __('Applied') }}</dt>
                <dd class="text-ink">{{ $application->created_at?->format('Y-m-d H:i') }}</dd>
                <dt class="text-ink-muted">{{ __('CV') }}</dt>
                <dd class="text-ink">{{ $cv ? __('Attached') : __('None') }}</dd>
            </dl>
        </x-admin.card>

        <x-admin.card :title="__('Vacancy')">
            @if ($application->vacancy)
                <p class="text-sm font-medium text-ink">{{ $application->vacancy->getTranslation('title', app()->getLocale()) }}</p>
                <p class="mt-1 text-sm text-ink-muted">{{ $application->vacancy->getTranslation('summary', app()->getLocale()) }}</p>
            @else
                <p class="text-sm text-ink-muted">—</p>
            @endif
        </x-admin.card>
    </div>
</div>
