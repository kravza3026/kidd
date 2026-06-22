<?php

use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Money\Currency;
use Money\Money;

beforeEach(function () {
    // The admin layout shares $errors via web middleware; provide an empty bag for isolated renders.
    View::share('errors', new ViewErrorBag);
});

it('renders the status badge', function () {
    $this->blade('<x-admin.status-badge color="green" label="Active" />')
        ->assertSee('Active')
        ->assertSee('bg-green-100', false);
});

it('renders the page header with an actions slot', function () {
    $this->blade('<x-admin.page-header title="Products"><x-slot:actions>New</x-slot:actions></x-admin.page-header>')
        ->assertSee('Products')
        ->assertSee('New');
});

it('renders the card with title and body', function () {
    $this->blade('<x-admin.card title="Details">Body here</x-admin.card>')
        ->assertSee('Details')
        ->assertSee('Body here');
});

it('renders money input in major units', function () {
    $money = new Money(12345, new Currency('MDL'));

    $this->blade('<x-admin.money-input name="price" :value="$money" />', ['money' => $money])
        ->assertSee('123.45', false)
        ->assertSee('MDL');
});

it('renders a translatable input with a field per locale', function () {
    $this->blade('<x-admin.translatable-input name="title" label="Title" :values="$values" />', [
        'values' => ['ro' => 'Salut', 'ru' => 'Привет', 'en' => 'Hi'],
    ])
        ->assertSee('name="title[ro]"', false)
        ->assertSee('name="title[ru]"', false)
        ->assertSee('name="title[en]"', false)
        ->assertSee('Salut', false);
});

it('renders a select with options and selection', function () {
    $this->blade('<x-admin.select name="brand_id" :options="$options" :selected="2" />', [
        'options' => [1 => 'Nike', 2 => 'Adidas'],
    ])
        ->assertSee('Adidas')
        ->assertSee('value="2" selected', false);
});

it('renders a toggle with a hidden fallback and checked state', function () {
    $this->blade('<x-admin.toggle name="is_visible" :checked="true" label="Visible" />')
        ->assertSee('name="is_visible" value="0"', false)
        ->assertSee('checked', false)
        ->assertSee('Visible');
});
