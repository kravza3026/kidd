<?php

use App\Livewire\Admin\Brands;
use App\Livewire\Admin\CareInstructions;
use App\Livewire\Admin\Colors;
use App\Livewire\Admin\Fabrics;
use App\Livewire\Admin\Genders;
use App\Livewire\Admin\Seasons;
use App\Livewire\Admin\Sizes;
use App\Livewire\Admin\Tags;
use App\Models\Brand;
use App\Models\CareInstruction;
use App\Models\Color;
use App\Models\Fabric;
use App\Models\Gender;
use App\Models\Season;
use App\Models\Size;
use App\Models\Tag;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
});

it('lists brands', function () {
    actingAsAdmin();
    $brand = Brand::factory()->create();

    $this->get(route('admin.brands.index'))->assertOk()->assertSeeLivewire(Brands\Index::class);
    Livewire::test(Brands\Index::class)->assertSee($brand->getTranslation('name', 'en'));
});

it('creates a brand with description and auto slug', function () {
    actingAsAdmin();

    Livewire::test(Brands\Form::class)
        ->set('name.ro', 'M')
        ->set('name.ru', 'M')
        ->set('name.en', 'MyBrand')
        ->set('description.en', 'Premium')
        ->set('sort_order', 5)
        ->call('save')
        ->assertRedirect(route('admin.brands.index'));

    $brand = Brand::query()->latest('id')->first();

    expect($brand->getTranslation('name', 'en'))->toBe('MyBrand')
        ->and($brand->getTranslation('description', 'en'))->toBe('Premium')
        ->and($brand->sort_order)->toBe(5)
        ->and($brand->getTranslation('slug', 'en'))->not->toBeEmpty();
});

it('requires a brand name', function () {
    actingAsAdmin();

    Livewire::test(Brands\Form::class)
        ->set('name.ro', '')->set('name.ru', '')->set('name.en', '')
        ->call('save')
        ->assertHasErrors(['name.en']);
});

it('creates then deletes a season', function () {
    actingAsAdmin();

    Livewire::test(Seasons\Form::class)
        ->set('name.ro', 'V')->set('name.ru', 'Л')->set('name.en', 'Summer')
        ->call('save')
        ->assertRedirect(route('admin.seasons.index'));

    $season = Season::query()->latest('id')->first();
    expect($season->getTranslation('name', 'en'))->toBe('Summer');

    Livewire::test(Seasons\Index::class)->call('delete', $season->id);
    expect(Season::find($season->id))->toBeNull();
});

it('edits a fabric', function () {
    actingAsAdmin();
    $fabric = Fabric::factory()->create();

    Livewire::test(Fabrics\Form::class, ['fabric' => $fabric])
        ->assertSet('recordId', $fabric->id)
        ->set('name.ro', 'x')->set('name.ru', 'y')->set('name.en', 'Linen X')
        ->call('save')
        ->assertRedirect(route('admin.fabrics.index'));

    expect($fabric->fresh()->getTranslation('name', 'en'))->toBe('Linen X');
});

it('creates a gender with code and colour', function () {
    actingAsAdmin();

    Livewire::test(Genders\Form::class)
        ->set('name.ro', 'U')->set('name.ru', 'U')->set('name.en', 'Unisex')
        ->set('code', 'U')
        ->set('bg_color', '#eeeeee')
        ->call('save')
        ->assertRedirect(route('admin.genders.index'));

    $gender = Gender::query()->latest('id')->first();
    expect($gender->getTranslation('name', 'en'))->toBe('Unisex')
        ->and($gender->code)->toBe('U')
        ->and($gender->getRawOriginal('bg_color'))->toBe('#eeeeee');
});

it('creates a color with hex and type', function () {
    actingAsAdmin();

    Livewire::test(Colors\Form::class)
        ->set('name.ro', 'R')->set('name.ru', 'R')->set('name.en', 'Red')
        ->set('hex', '#ff0000')
        ->set('type', 1)
        ->call('save')
        ->assertRedirect(route('admin.colors.index'));

    $color = Color::query()->latest('id')->first();
    expect($color->getTranslation('name', 'en'))->toBe('Red')
        ->and($color->hex)->toBe('#ff0000')
        ->and($color->getTranslation('slug', 'en'))->not->toBeEmpty();
});

it('creates a size with type and ranges', function () {
    actingAsAdmin();

    Livewire::test(Sizes\Form::class)
        ->set('name.ro', 'M')->set('name.ru', 'M')->set('name.en', 'M')
        ->set('type', Size::TYPE_CLOTH)
        ->set('min_age', 12)
        ->set('max_age', 24)
        ->set('min_weight', 8000)
        ->set('max_weight', 12000)
        ->call('save')
        ->assertRedirect(route('admin.sizes.index'));

    $size = Size::query()->latest('id')->first();
    expect($size->getTranslation('name', 'en'))->toBe('M')
        ->and($size->min_age)->toBe(12)
        ->and($size->max_weight)->toBe(12000);
});

it('lists care instructions by their title (label attribute)', function () {
    actingAsAdmin();
    CareInstruction::factory()->create([
        'name' => 'legacy-internal-key',
        'title' => ['ro' => 'Spălare', 'ru' => 'Стирка', 'en' => 'Machine wash'],
    ]);

    $this->get(route('admin.care-instructions.index'))->assertOk()->assertSeeLivewire(CareInstructions\Index::class);
    Livewire::test(CareInstructions\Index::class)->assertSee('Machine wash')->assertDontSee('legacy-internal-key');
});

it('creates a care instruction with title, description and icon', function () {
    actingAsAdmin();

    Livewire::test(CareInstructions\Form::class)
        ->set('name.ro', 'Nu înălbiți')
        ->set('name.ru', 'Не отбеливать')
        ->set('name.en', 'Do not bleach')
        ->set('description.en', 'Avoid chlorine bleach')
        ->set('icon', 'no-bleach')
        ->set('sort_order', 3)
        ->call('save')
        ->assertRedirect(route('admin.care-instructions.index'));

    $care = CareInstruction::query()->latest('id')->first();

    expect($care->getTranslation('title', 'en'))->toBe('Do not bleach')
        ->and($care->getTranslation('description', 'en'))->toBe('Avoid chlorine bleach')
        ->and($care->icon)->toBe('no-bleach')
        ->and($care->sort_order)->toBe(3);
});

it('requires a care instruction title', function () {
    actingAsAdmin();

    Livewire::test(CareInstructions\Form::class)
        ->set('name.ro', '')->set('name.ru', '')->set('name.en', '')
        ->call('save')
        ->assertHasErrors(['name.en']);
});

it('edits a care instruction title and persists to the title column', function () {
    actingAsAdmin();
    $care = CareInstruction::factory()->create();

    Livewire::test(CareInstructions\Form::class, ['careInstruction' => $care])
        ->assertSet('recordId', $care->id)
        ->set('name.en', 'Tumble dry low')
        ->call('save')
        ->assertRedirect(route('admin.care-instructions.index'));

    expect($care->fresh()->getTranslation('title', 'en'))->toBe('Tumble dry low');
});

it('lists tags', function () {
    actingAsAdmin();
    $tag = Tag::create(['name' => ['ro' => 'Remote', 'ru' => 'Удалённо', 'en' => 'Remote']]);

    $this->get(route('admin.tags.index'))->assertOk()->assertSeeLivewire(Tags\Index::class);
    Livewire::test(Tags\Index::class)->assertSee('Remote');
});

it('creates a tag with a type and auto slug', function () {
    actingAsAdmin();

    Livewire::test(Tags\Form::class)
        ->set('name.ro', 'Cu normă întreagă')
        ->set('name.ru', 'Полная занятость')
        ->set('name.en', 'Full-time')
        ->set('type', 'employment')
        ->call('save')
        ->assertRedirect(route('admin.tags.index'));

    $tag = Tag::query()->latest('id')->first();

    expect($tag->getTranslation('name', 'en'))->toBe('Full-time')
        ->and($tag->type)->toBe('employment')
        ->and($tag->getTranslation('slug', 'en'))->toBe('full-time');
});

it('requires a tag name', function () {
    actingAsAdmin();

    Livewire::test(Tags\Form::class)
        ->set('name.ro', '')->set('name.ru', '')->set('name.en', '')
        ->call('save')
        ->assertHasErrors(['name.en']);
});

it('edits then deletes a tag', function () {
    actingAsAdmin();
    $tag = Tag::create(['name' => ['ro' => 'x', 'ru' => 'y', 'en' => 'Draft']]);

    Livewire::test(Tags\Form::class, ['tag' => $tag])
        ->assertSet('recordId', $tag->id)
        ->set('name.en', 'On-Site')
        ->call('save')
        ->assertRedirect(route('admin.tags.index'));

    expect($tag->fresh()->getTranslation('name', 'en'))->toBe('On-Site');

    Livewire::test(Tags\Index::class)->call('delete', $tag->id);
    expect(Tag::find($tag->id))->toBeNull();
});

it('forbids HR from taxonomy and 404s when a module is disabled', function () {
    $hr = User::factory()->create();
    $hr->assignRole('hr');
    $this->actingAs($hr);
    $this->get(route('admin.brands.index'))->assertForbidden();

    $this->actingAs(actingAsAdmin());
    config(['admin.modules.brand' => false]);
    $this->get(route('admin.brands.index'))->assertNotFound();
});
