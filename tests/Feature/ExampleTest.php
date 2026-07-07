<?php

it('redirects the root path to the localized home', function () {
    // The storefront is locale-prefixed (mcamara/laravel-localization), so the
    // bare root redirects to the default locale (e.g. /ro).
    $this->get('/')->assertRedirect();
});
