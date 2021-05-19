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
        '/dp/update', 
        '/wishlist/toggle',
        '/cart/toggle',
        '/compare/toggle',
        '/cart/change-qty',
        '/account/update-name',
        '/account/update-email',
        '/account/update-mobile',
        '/address/remove',
        '/address/remove',
        '/address/edit/fetch',
        '/ajax/calcPrice',
        '/ajax/calcMRP',
        '/ajax/sync-price',
        '/ajax/get-small-banner-data',
        '/checkout/payment/response/*',   
        '/checkout/payment/response/*'  
    ];
}
