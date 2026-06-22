<?php

namespace App\Livewire\Admin\Design;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Design system')]
class Index extends Component
{
    public bool $demoToggle = true;

    public bool $demoSwitch = false;

    /** @var array<string, string> */
    public array $demoName = ['ro' => 'Tricou', 'ru' => 'Майка', 'en' => 'T-shirt'];

    public ?int $demoSelect = 1;

    public function render(): View
    {
        return view('livewire.admin.design.index');
    }
}
