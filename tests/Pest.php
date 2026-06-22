<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Pest\Browser\Playwright\Playwright;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case bindings
|--------------------------------------------------------------------------
|
| Bind the application TestCase (and a fresh database) to the Feature and
| Browser suites. Unit tests stay free of the framework bootstrap.
|
*/

uses(TestCase::class, RefreshDatabase::class)->in('Feature', 'Browser');

/*
|--------------------------------------------------------------------------
| Browser visibility toggle
|--------------------------------------------------------------------------
|
| Browser tests run headless by default (CI-friendly). Set PEST_BROWSER_HEADED=true
| in the environment to launch a real, visible browser so the run can be watched
| locally — e.g. `PEST_BROWSER_HEADED=true php artisan test --browser`.
|
*/

if (filter_var(env('PEST_BROWSER_HEADED', false), FILTER_VALIDATE_BOOL)) {
    Playwright::headed();
}

/*
|--------------------------------------------------------------------------
| Expectations & helpers
|--------------------------------------------------------------------------
*/

/**
 * Authenticate as a freshly-created user holding the all-access `admin` role.
 */
function actingAsAdmin(): User
{
    $user = User::factory()->create();
    $user->assignRole(Role::findOrCreate('admin', 'web'));

    test()->actingAs($user);

    return $user;
}
