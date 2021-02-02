<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/wishlist/toggle',
        '/cart/toggle',
        '/cart/change-qty',
        '/account/update-name',
        '/account/update-email',
        '/account/update-mobile',
    ];
}
