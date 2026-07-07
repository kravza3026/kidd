<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Categories'), 'route' => 'admin.categories.index'],
        ['label' => $editing ? __('Edit') : __('New')],
    ]" />

    <x-admin.page-header :title="$editing ? __('Edit category') : __('New category')" />

    <form wire:submit="save" class="space-y-5">
        <x-admin.card :title="__('Category details')">
            <div class="grid gap-4">
                {{-- Name (translatable) --}}
                <div x-data="{ locale: @js(array_key_first(config('app.locales'))) }" class="flex flex-col gap-1.5">
                    <div class="flex items-center justify-between">
                        <label class="admin-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                        <div class="flex gap-1">
                            @foreach (array_keys(config('app.locales')) as $loc)
                                <button type="button" @click="locale = @js($loc)"
                                    :class="locale === @js($loc) ? 'bg-olive text-white' : 'bg-surface-2 text-ink-muted'"
                                    class="rounded-md px-2 py-0.5 text-xs font-semibold uppercase">{{ $loc }}</button>
                            @endforeach
                        </div>
                    </div>
                    @foreach (array_keys(config('app.locales')) as $loc)
                        <div x-show="locale === @js($loc)" x-cloak>
                            <input type="text" wire:model="name.{{ $loc }}" class="admin-input" />
                            @error("name.{$loc}")
                                <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                {{-- Description (translatable) --}}
                <div x-data="{ locale: @js(array_key_first(config('app.locales'))) }" class="flex flex-col gap-1.5">
                    <div class="flex items-center justify-between">
                        <label class="admin-label">{{ __('Description') }}</label>
                        <div class="flex gap-1">
                            @foreach (array_keys(config('app.locales')) as $loc)
                                <button type="button" @click="locale = @js($loc)"
                                    :class="locale === @js($loc) ? 'bg-olive text-white' : 'bg-surface-2 text-ink-muted'"
                                    class="rounded-md px-2 py-0.5 text-xs font-semibold uppercase">{{ $loc }}</button>
                            @endforeach
                        </div>
                    </div>
                    @foreach (array_keys(config('app.locales')) as $loc)
                        <div x-show="locale === @js($loc)" x-cloak>
                            <textarea wire:model="description.{{ $loc }}" rows="3" class="admin-input"></textarea>
                            @error("description.{$loc}")
                                <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                {{-- Parent --}}
                <x-admin.field :label="__('Parent category')" name="parent_id">
                    <select wire:model="parent_id" class="admin-input cursor-pointer">
                        <option value="">{{ __('— None (top level) —') }}</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->getTranslation('name', app()->getLocale()) }}</option>
                        @endforeach
                    </select>
                </x-admin.field>

                {{-- Image --}}
                <div class="flex flex-col gap-2">
                    <label class="admin-label">{{ __('Image') }}</label>
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" alt="" class="h-16 w-16 rounded-lg border border-line object-cover" />
                    @elseif ($category?->image)
                        <img
                            src="{{ \Illuminate\Support\Str::startsWith($category->image, 'http') ? $category->image : asset('storage/'.$category->image) }}"
                            alt=""
                            class="h-16 w-16 rounded-lg border border-line object-cover"
                        />
                    @endif
                    <input type="file" wire:model="image" accept="image/*"
                        class="block w-full text-sm text-ink-muted file:mr-4 file:rounded-lg file:border-0 file:bg-surface-2 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-ink hover:file:bg-line" />
                    <span wire:loading wire:target="image" class="text-xs text-ink-muted">{{ __('Uploading…') }}</span>
                    @error('image')
                        <p class="text-xs text-danger">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Visible --}}
                <label class="flex cursor-pointer items-center gap-3">
                    <span class="relative inline-flex">
                        <input type="checkbox" wire:model="is_visible" class="peer sr-only" />
                        <span class="h-5 w-9 rounded-full bg-line transition peer-checked:bg-olive"></span>
                        <span class="pointer-events-none absolute top-0.5 left-0.5 h-4 w-4 rounded-full bg-white shadow transition peer-checked:translate-x-4"></span>
                    </span>
                    <span class="text-sm text-ink">{{ __('Visible on storefront') }}</span>
                </label>
            </div>
        </x-admin.card>

        <div class="flex items-center gap-3">
            <button type="submit" class="admin-btn admin-btn--primary" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire:target="save">{{ $editing ? __('Save changes') : __('Create category') }}</span>
                <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
            </button>
            <a href="{{ route('admin.categories.index') }}" wire:navigate class="admin-btn admin-btn--secondary">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
