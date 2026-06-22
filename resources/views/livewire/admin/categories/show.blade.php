<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Categories'), 'route' => 'admin.categories.index'],
        ['label' => $category->getTranslation('name', app()->getLocale())],
    ]" />

    <x-admin.page-header :title="$category->getTranslation('name', app()->getLocale())" :subtitle="__('Category')">
        <x-slot:actions>
            @can('update', $category)
                <x-admin.button :href="route('admin.categories.edit', $category)" wire:navigate>{{ __('Edit') }}</x-admin.button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid gap-4 lg:grid-cols-2">
        <x-admin.card :title="__('Details')">
            <dl class="grid grid-cols-3 gap-y-3 text-sm">
                <dt class="text-ink-muted">{{ __('Parent') }}</dt>
                <dd class="col-span-2 text-ink">
                    {{ $category->parent?->getTranslation('name', app()->getLocale()) ?? __('Top level') }}
                </dd>

                <dt class="text-ink-muted">{{ __('Visible') }}</dt>
                <dd class="col-span-2">
                    <x-admin.status-badge
                        :color="$category->is_visible ? 'green' : 'gray'"
                        :label="$category->is_visible ? __('Visible') : __('Hidden')"
                    />
                </dd>

                <dt class="text-ink-muted">{{ __('Products') }}</dt>
                <dd class="col-span-2 text-ink">{{ $category->products_count }}</dd>

                <dt class="text-ink-muted">{{ __('Subcategories') }}</dt>
                <dd class="col-span-2 text-ink">{{ $category->subcategories->count() }}</dd>
            </dl>
        </x-admin.card>

        <x-admin.card :title="__('Translations')">
            <dl class="grid gap-y-3 text-sm">
                @foreach (array_keys(config('app.locales')) as $locale)
                    <div>
                        <dt class="text-xs font-semibold text-ink-subtle uppercase">{{ $locale }}</dt>
                        <dd class="text-ink">{{ $category->getTranslation('name', $locale) }}</dd>
                    </div>
                @endforeach
            </dl>
        </x-admin.card>
    </div>
</div>
