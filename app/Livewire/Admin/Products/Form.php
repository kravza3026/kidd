<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Fabric;
use App\Models\Gender;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.admin.admin')]
class Form extends Component
{
    use WithFileUploads;

    public ?Product $product = null;

    /** @var array<string, string> */
    public array $name = [];

    /** @var array<string, string> */
    public array $description = [];

    public ?int $category_id = null;

    public ?int $brand_id = null;

    public ?int $gender_id = null;

    public ?int $season_id = null;

    public ?int $fabric_id = null;

    public ?string $barcode = null;

    public bool $is_visible = true;

    public bool $is_new = false;

    public bool $has_discount = false;

    public bool $is_featured = false;

    public bool $is_bestseller = false;

    /** @var array<int, TemporaryUploadedFile> */
    public array $gallery = [];

    public function mount(?Product $product = null): void
    {
        $locales = array_keys(config('app.locales'));
        $this->name = array_fill_keys($locales, '');
        $this->description = array_fill_keys($locales, '');

        if ($product?->exists) {
            $this->authorize('update', $product);
            $this->product = $product;
            $this->name = array_merge($this->name, $product->getTranslations('name'));
            $this->description = array_merge($this->description, $product->getTranslations('description'));
            $this->fill($product->only([
                'category_id', 'brand_id', 'gender_id', 'season_id', 'fabric_id', 'barcode',
                'is_visible', 'is_new', 'has_discount', 'is_featured', 'is_bestseller',
            ]));
        } else {
            $this->authorize('create', Product::class);
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $rules = [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'gender_id' => ['required', 'integer', 'exists:genders,id'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'season_id' => ['nullable', 'integer', 'exists:seasons,id'],
            'fabric_id' => ['nullable', 'integer', 'exists:fabrics,id'],
            'barcode' => ['nullable', 'string', 'max:255', Rule::unique('products', 'barcode')->ignore($this->product?->id)],
            'is_visible' => ['boolean'],
            'is_new' => ['boolean'],
            'has_discount' => ['boolean'],
            'is_featured' => ['boolean'],
            'is_bestseller' => ['boolean'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'max:4096'],
        ];

        foreach (array_keys(config('app.locales')) as $locale) {
            $rules["name.{$locale}"] = ['required', 'string', 'max:255'];
            $rules["description.{$locale}"] = ['nullable', 'string', 'max:5000'];
        }

        return $rules;
    }

    public function save(): void
    {
        $this->validate();
        $editing = (bool) $this->product;

        $product = $this->product ?? new Product;
        $product->fill([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'gender_id' => $this->gender_id,
            'season_id' => $this->season_id,
            'fabric_id' => $this->fabric_id,
            'barcode' => $this->barcode,
            'is_visible' => $this->is_visible,
            'is_new' => $this->is_new,
            'has_discount' => $this->has_discount,
            'is_featured' => $this->is_featured,
            'is_bestseller' => $this->is_bestseller,
        ]);
        $product->save();

        foreach ($this->gallery as $file) {
            $product->addMedia($file->getRealPath())
                ->usingFileName($file->getClientOriginalName())
                ->toMediaCollection('gallery');
        }

        session()->flash('success', $editing ? __('Product updated.') : __('Product created.'));

        $this->redirectRoute('admin.products.index', navigate: true);
    }

    public function render(): View
    {
        $locale = app()->getLocale();

        return view('livewire.admin.products.form', [
            'editing' => (bool) $this->product,
            'categories' => Category::orderBy('sort_order')->get()->mapWithKeys(fn ($c) => [$c->id => $c->getTranslation('name', $locale)]),
            'brands' => Brand::orderBy('sort_order')->get()->mapWithKeys(fn ($b) => [$b->id => $b->getTranslation('name', $locale)]),
            'genders' => Gender::orderBy('sort_order')->get()->mapWithKeys(fn ($g) => [$g->id => $g->getTranslation('name', $locale)]),
            'seasons' => Season::orderBy('sort_order')->get()->mapWithKeys(fn ($s) => [$s->id => $s->getTranslation('name', $locale)]),
            'fabrics' => Fabric::orderBy('sort_order')->get()->mapWithKeys(fn ($f) => [$f->id => $f->getTranslation('name', $locale)]),
        ]);
    }
}
