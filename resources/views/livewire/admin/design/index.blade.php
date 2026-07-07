<div class="space-y-6">
    <x-admin.breadcrumbs :items="[['label' => __('Design system')]]" />
    <x-admin.page-header :title="__('Design system')" :subtitle="__('Living gallery of admin components — light, dark & both densities')" />

    {{-- Colors. Literal classes so Tailwind's JIT compiles every swatch. --}}
    <x-admin.card :title="__('Brand & surface tokens')">
        <div class="flex flex-wrap gap-3 text-xs">
            <div class="flex flex-col items-center gap-1"><span class="size-12 rounded-lg border border-line bg-olive"></span><span class="text-ink-muted">Olive</span></div>
            <div class="flex flex-col items-center gap-1"><span class="size-12 rounded-lg border border-line bg-dark-olive"></span><span class="text-ink-muted">Dark olive</span></div>
            <div class="flex flex-col items-center gap-1"><span class="size-12 rounded-lg border border-line bg-danger"></span><span class="text-ink-muted">Danger</span></div>
            <div class="flex flex-col items-center gap-1"><span class="size-12 rounded-lg border border-line bg-canvas"></span><span class="text-ink-muted">Canvas</span></div>
            <div class="flex flex-col items-center gap-1"><span class="size-12 rounded-lg border border-line bg-surface"></span><span class="text-ink-muted">Surface</span></div>
            <div class="flex flex-col items-center gap-1"><span class="size-12 rounded-lg border border-line bg-surface-2"></span><span class="text-ink-muted">Surface 2</span></div>
            <div class="flex flex-col items-center gap-1"><span class="size-12 rounded-lg border border-line bg-line"></span><span class="text-ink-muted">Line</span></div>
            <div class="flex flex-col items-center gap-1"><span class="size-12 rounded-lg border border-line bg-ink"></span><span class="text-ink-muted">Ink</span></div>
            <div class="flex flex-col items-center gap-1"><span class="size-12 rounded-lg border border-line bg-ink-muted"></span><span class="text-ink-muted">Ink muted</span></div>
        </div>
    </x-admin.card>

    {{-- Buttons --}}
    <x-admin.card :title="__('Buttons')">
        <div class="flex flex-wrap items-center gap-3">
            <x-admin.button>{{ __('Primary') }}</x-admin.button>
            <x-admin.button variant="secondary">{{ __('Secondary') }}</x-admin.button>
            <x-admin.button variant="danger">{{ __('Danger') }}</x-admin.button>
            <x-admin.button variant="ghost">{{ __('Ghost') }}</x-admin.button>
        </div>
    </x-admin.card>

    {{-- Badges --}}
    <x-admin.card :title="__('Status badges')">
        <div class="flex flex-wrap items-center gap-2">
            @foreach (['gray', 'green', 'red', 'yellow', 'blue', 'purple'] as $color)
                <x-admin.status-badge :color="$color" :label="ucfirst($color)" />
            @endforeach
        </div>
    </x-admin.card>

    {{-- Form controls --}}
    <div class="grid gap-6 lg:grid-cols-2">
        <x-admin.card :title="__('Inputs')">
            <div class="grid gap-4">
                <x-admin.field :label="__('Text input')" name="demo">
                    <input type="text" class="admin-input" placeholder="{{ __('Type something…') }}" />
                </x-admin.field>
                <x-admin.field :label="__('Select')">
                    <select wire:model="demoSelect" class="admin-input cursor-pointer">
                        <option value="1">{{ __('Option one') }}</option>
                        <option value="2">{{ __('Option two') }}</option>
                    </select>
                </x-admin.field>
                <x-admin.translatable wire-model="demoName" :label="__('Translatable field')" />
            </div>
        </x-admin.card>

        <x-admin.card :title="__('Toggles & switches')">
            <div class="flex flex-col gap-4">
                <x-admin.toggle name="demoToggle" :checked="true" :label="__('Checkbox toggle')" />
                <x-admin.switch wire-model="demoSwitch" :label="__('Livewire switch')" :hint="__('Bound to component state')" />
                <p class="text-xs text-ink-muted">{{ __('Switch is currently:') }} <span class="font-semibold text-ink">{{ $demoSwitch ? __('On') : __('Off') }}</span></p>
            </div>
        </x-admin.card>
    </div>

    {{-- Table --}}
    <x-admin.card :title="__('Data table')">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs text-ink-muted uppercase">
                    <tr>
                        <th class="admin-table-cell text-left font-medium">{{ __('Name') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Status') }}</th>
                        <th class="admin-table-cell text-right font-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @foreach (['Alpha' => 'green', 'Beta' => 'yellow', 'Gamma' => 'gray'] as $name => $color)
                        <tr class="hover:bg-surface-2">
                            <td class="admin-table-cell font-medium text-ink">{{ $name }}</td>
                            <td class="admin-table-cell"><x-admin.status-badge :color="$color" :label="ucfirst($color)" /></td>
                            <td class="admin-table-cell text-right"><span class="admin-btn admin-btn--ghost">{{ __('Edit') }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-admin.card>

    {{-- Feedback --}}
    <x-admin.card :title="__('Feedback')">
        <div class="space-y-2">
            <div class="rounded-lg border border-olive/30 bg-olive/10 px-4 py-2.5 text-sm text-dark-olive dark:text-olive">{{ __('Success message') }}</div>
            <div class="rounded-lg border border-danger/30 bg-danger/10 px-4 py-2.5 text-sm text-danger">{{ __('Error message') }}</div>
        </div>
    </x-admin.card>
</div>
