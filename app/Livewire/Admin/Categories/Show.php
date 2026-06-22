<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Show extends Component
{
    public Category $category;

    public function mount(Category $category): void
    {
        $this->authorize('view', $category);
        $this->category = $category->load('parent', 'subcategories');
    }

    public function render(): View
    {
        return view('livewire.admin.categories.show');
    }
}
