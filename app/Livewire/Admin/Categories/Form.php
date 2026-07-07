<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.admin.admin')]
class Form extends Component
{
    use WithFileUploads;

    public ?Category $category = null;

    /** @var array<string, string> */
    public array $name = [];

    /** @var array<string, string> */
    public array $description = [];

    public ?int $parent_id = null;

    public bool $is_visible = true;

    public $image = null;

    public function mount(?Category $category = null): void
    {
        $locales = array_keys(config('app.locales'));
        $this->name = array_fill_keys($locales, '');
        $this->description = array_fill_keys($locales, '');

        if ($category?->exists) {
            $this->authorize('update', $category);
            $this->category = $category;
            $this->name = array_merge($this->name, $category->getTranslations('name'));
            $this->description = array_merge($this->description, $category->getTranslations('description'));
            $this->parent_id = $category->parent_id;
            $this->is_visible = $category->is_visible;
        } else {
            $this->authorize('create', Category::class);
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $rules = [
            'parent_id' => ['nullable', 'integer', 'exists:categories,id', Rule::notIn([$this->category?->id])],
            'is_visible' => ['boolean'],
            'image' => ['nullable', 'image', 'max:4096'],
        ];

        foreach (array_keys(config('app.locales')) as $locale) {
            $rules["name.{$locale}"] = ['required', 'string', 'max:255'];
            $rules["description.{$locale}"] = ['nullable', 'string', 'max:2000'];
        }

        return $rules;
    }

    public function save(): void
    {
        $this->validate();

        $category = $this->category ?? new Category;
        $category->fill([
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
            'is_visible' => $this->is_visible,
        ]);

        if ($this->image) {
            $category->image = $this->image->store('categories', 'public');
        }

        $editing = (bool) $this->category;
        $category->save();

        session()->flash('success', $editing ? __('Category updated.') : __('Category created.'));

        $this->redirectRoute('admin.categories.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.categories.form', [
            'editing' => (bool) $this->category,
            'parents' => Category::query()
                ->when($this->category, fn ($query) => $query->whereKeyNot($this->category->id))
                ->orderBy('sort_order')
                ->get(),
        ]);
    }
}
