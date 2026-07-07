<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Inquiries'), 'route' => 'admin.contact-inquiries.index'],
        ['label' => $inquiry->first_name.' '.$inquiry->last_name],
    ]" />

    <x-admin.page-header :title="$inquiry->first_name.' '.$inquiry->last_name" :subtitle="$inquiry->email">
        <x-slot:actions>
            <a href="mailto:{{ $inquiry->email }}" class="admin-btn admin-btn--secondary">{{ __('Reply') }}</a>
            @can('delete', $inquiry)
                <button type="button" wire:click="delete" wire:confirm="{{ __('Delete this inquiry?') }}" class="admin-btn admin-btn--danger">{{ __('Delete') }}</button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid gap-4 lg:grid-cols-3">
        <x-admin.card :title="__('Contact')" class="lg:col-span-1">
            <dl class="grid grid-cols-2 gap-y-2.5 text-sm">
                <dt class="text-ink-muted">{{ __('Email') }}</dt>
                <dd class="text-ink">{{ $inquiry->email }}</dd>
                <dt class="text-ink-muted">{{ __('Phone') }}</dt>
                <dd class="text-ink">{{ $inquiry->phone }}</dd>
                <dt class="text-ink-muted">{{ __('Linked account') }}</dt>
                <dd class="text-ink">{{ $inquiry->user?->name ?? __('Guest') }}</dd>
                <dt class="text-ink-muted">{{ __('Received') }}</dt>
                <dd class="text-ink">{{ $inquiry->created_at?->format('Y-m-d H:i') }}</dd>
            </dl>
        </x-admin.card>

        <x-admin.card :title="__('Message')" class="lg:col-span-2">
            <p class="text-sm whitespace-pre-line text-ink">{{ $inquiry->message }}</p>
        </x-admin.card>
    </div>
</div>
