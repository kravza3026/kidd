<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Products'), 'route' => 'admin.products.index'],
        ['label' => $editing ? __('Edit') : __('New')],
    ]" />

    <x-admin.page-header :title="$editing ? __('Edit product') : __('New product')" />

    <form wire:submit="save" class="grid gap-5 lg:grid-cols-3">
        {{-- Main column --}}
        <div class="space-y-5 lg:col-span-2">
            <x-admin.card :title="__('Details')">
                <div class="grid gap-4">
                    <x-admin.translatable wire-model="name" :label="__('Name')" required />
                    <x-admin.translatable wire-model="description" :label="__('Description')" textarea :rows="5" />
                </div>
            </x-admin.card>

            <x-admin.card :title="__('Classification')">
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-admin.field :label="__('Category')" name="category_id" required>
                        <select wire:model="category_id" class="admin-input cursor-pointer">
                            <option value="">{{ __('— Select —') }}</option>
                            @foreach ($categories as $id => $label)
                                <option value="{{ $id }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>

                    <x-admin.field :label="__('Gender')" name="gender_id" required>
                        <select wire:model="gender_id" class="admin-input cursor-pointer">
                            <option value="">{{ __('— Select —') }}</option>
                            @foreach ($genders as $id => $label)
                                <option value="{{ $id }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>

                    <x-admin.field :label="__('Brand')" name="brand_id">
                        <select wire:model="brand_id" class="admin-input cursor-pointer">
                            <option value="">{{ __('— None —') }}</option>
                            @foreach ($brands as $id => $label)
                                <option value="{{ $id }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>

                    <x-admin.field :label="__('Season')" name="season_id">
                        <select wire:model="season_id" class="admin-input cursor-pointer">
                            <option value="">{{ __('— None —') }}</option>
                            @foreach ($seasons as $id => $label)
                                <option value="{{ $id }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>

                    <x-admin.field :label="__('Fabric')" name="fabric_id">
                        <select wire:model="fabric_id" class="admin-input cursor-pointer">
                            <option value="">{{ __('— None —') }}</option>
                            @foreach ($fabrics as $id => $label)
                                <option value="{{ $id }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>

                    <x-admin.field :label="__('Barcode')" name="barcode">
                        <input type="text" wire:model="barcode" class="admin-input" />
                    </x-admin.field>
                </div>
            </x-admin.card>

            <x-admin.card :title="__('Gallery')" :description="__('Product images. Manage colour/size variants from the product page.')">
                @if ($editing && $product->getMedia('gallery')->isNotEmpty())
                    <div class="mb-3 flex flex-wrap gap-2">
                        @foreach ($product->getMedia('gallery') as $media)
                            <img src="{{ $media->getUrl() }}" alt="" class="h-16 w-16 rounded-lg border border-line object-cover" wire:key="media-{{ $media->id }}" />
                        @endforeach
                    </div>
                @endif
                <input type="file" wire:model="gallery" multiple accept="image/*"
                    class="block w-full text-sm text-ink-muted file:mr-4 file:rounded-lg file:border-0 file:bg-surface-2 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-ink hover:file:bg-line" />
                <span wire:loading wire:target="gallery" class="mt-1 block text-xs text-ink-muted">{{ __('Uploading…') }}</span>
                @error('gallery.*')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </x-admin.card>
        </div>

        {{-- Side column --}}
        <div class="space-y-5">
            <x-admin.card :title="__('Visibility & flags')">
                <div class="divide-y divide-line">
                    <x-admin.switch wire-model="is_visible" :label="__('Visible on storefront')" />
                    <x-admin.switch wire-model="is_new" :label="__('New')" />
                    <x-admin.switch wire-model="has_discount" :label="__('Has discount')" />
                    <x-admin.switch wire-model="is_featured" :label="__('Featured')" />
                    <x-admin.switch wire-model="is_bestseller" :label="__('Bestseller')" />
                </div>
            </x-admin.card>

            <x-admin.card :title="__('Care instructions')">
                @if (count($careInstructions))
                    <div class="flex max-h-56 flex-col gap-1.5 overflow-y-auto">
                        @foreach ($careInstructions as $id => $label)
                            <label class="flex cursor-pointer items-center gap-2 text-sm" wire:key="care-{{ $id }}">
                                <input type="checkbox" wire:model="selectedCareInstructions" value="{{ $id }}" class="size-4 accent-olive" />
                                <span class="text-ink">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-ink-muted">{{ __('No care instructions yet.') }}</p>
                @endif
            </x-admin.card>

            <div class="flex flex-col gap-2">
                <button type="submit" class="admin-btn admin-btn--primary w-full" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save">{{ $editing ? __('Save changes') : __('Create product') }}</span>
                    <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
                </button>
                <a href="{{ route('admin.products.index') }}" wire:navigate class="admin-btn admin-btn--secondary w-full">{{ __('Cancel') }}</a>
            </div>
        </div>
    </form>
</div>
