<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('php-info', function (){
        phpinfo();
    });


// Authentication Routes Start...
    Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('login/{provider}', 'App\Http\Controllers\OAuthController@redirect')->name('social.login');
    Route::get('login/{provider}/callback','App\Http\Controllers\OAuthController@Callback');

    // Verification Routes 
    Route::post('email/resend', 'App\Http\Controllers\Auth\VerificationController@resend')->name('verification.resend');
    Route::get('email/verify', 'App\Http\Controllers\Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'App\Http\Controllers\Auth\VerificationController@verify')->name('verification.verify');

    // Password Reset Routes...
    Route::get('password/confirm', 'App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'App\Http\Controllers\Auth\ConfirmPasswordController@confirm');
    Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token?}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');
    Route::post('/ajax/get-product-reviews', [App\Http\Controllers\AjaxController::class, 'GetProductReviews'])->name('get-product-reviews');
    Route::post('/ajax/get-product-qnas', [App\Http\Controllers\AjaxController::class, 'GetProductQnas'])->name('get-product-qnas');
    Route::post('/ajax/sync-price', [App\Http\Controllers\AjaxController::class, 'SyncPrice'])->name('sync-price');
// Authentication Routes End...





// Public routes
    Route::get('/', [App\Http\Controllers\IndexController::class, 'Index'])->name('home')->middleware(['VerifiedNoAuth']);
    
    Route::get('/search', [App\Http\Controllers\IndexController::class, 'Search'])->name('search')->middleware(['VerifiedNoAuth']);
    
    Route::get('/categories', [App\Http\Controllers\IndexController::class, 'Categories'])->name('categories')->middleware(['VerifiedNoAuth']);
    
    Route::get('/redeem-voucher', [App\Http\Controllers\Admin\PromotionalsOffersController::class, 'Redeem'])->name('redeem-voucher')->middleware(['VerifiedNoAuth']);
    
    Route::get('/catalog/{slug}', [App\Http\Controllers\IndexController::class, 'Catalog'])->name('show-catalog')->middleware(['VerifiedNoAuth']);
    
    Route::get('/r/{short_url}', [App\Http\Controllers\IndexController::class, 'ShortUrlRedirect'])->name('ShortUrlRedirect')->middleware(['VerifiedNoAuth']);
    
    Route::get('/product/{product_id}/{product_name?}', 'App\Http\Controllers\ShowProductsController@ProductIndex')->name('product-index')->middleware(['VerifiedNoAuth']);
      
    Route::get('/compare', [App\Http\Controllers\CompareController::class, 'ShowCompare'])->name('compare')->middleware(['VerifiedNoAuth']);
    
    Route::post('/compare/toggle', [App\Http\Controllers\CompareController::class, 'ToggleCompare'])->name('toggle-compare-btn')->middleware(['VerifiedNoAuth']);

    Route::get('/cart', [App\Http\Controllers\CartController::class, 'ShowCart'])->name('cart')->middleware(['VerifiedNoAuth']);

    Route::post('/cart/toggle', [App\Http\Controllers\CartController::class, 'ToggleCart'])->name('toggle-cart-btn')->middleware(['VerifiedNoAuth']);

    Route::post('/cart/change-qty', [App\Http\Controllers\CartController::class, 'ChangeQty'])->name('change-qty')->middleware(['VerifiedNoAuth']);
    
    Route::post('/checkout/payment/response/payu', [App\Http\Controllers\CheckoutController::class, 'PayuResponse'])->name('checkout-payu-response')->middleware(['VerifiedNoAuth']);

    Route::post('/checkout/payment/response/paytm', [App\Http\Controllers\CheckoutController::class, 'PaytmResponse'])->name('checkout-paytm-response')->middleware(['VerifiedNoAuth']);
    
    Route::get('/support', [App\Http\Controllers\SupportController::class, 'Support'])->name('support')->middleware(['VerifiedNoAuth']);
    
    Route::get('/support/contact-us', [App\Http\Controllers\SupportController::class, 'ContactUs'])->name('support.contact-us')->middleware(['VerifiedNoAuth']);
    
    Route::get('/product/pid/{product_id}/reviews', [App\Http\Controllers\ReviewController::class, 'AllProductReviews'])->name('all-product-reviews');
    
    Route::get('/ajax/fetch/search-suggestions', [App\Http\Controllers\AjaxController::class, 'FetchSearchSuggestions'])->name('fetch-search-suggestions');
    
    Route::post('/ajax/get-small-banner-data', [App\Http\Controllers\AjaxController::class, 'GetSmallBannerData'])->name('get-small-banner-data');





// Verified Middleware Start

Route::group(['middleware' => ['verified', 'auth']], function() { 

    Route::get('/support/raise-support-ticket', [App\Http\Controllers\SupportController::class, 'RaiseSupportTicket'])->name('support.raise-support-ticket');
    
    // Route::post('/support/raise-support-ticket/submit', [App\Http\Controllers\SupportController::class, 'RaiseSupportTicketSubmit'])->name('support.raise-support-ticket-submit');
    
    Route::post('/qna/new-question/submit', [App\Http\Controllers\ProductQNAController::class, 'QuestionSubmit'])->name('qna.new-question-submit');
    
    Route::post('/support/add-reply/submit', [App\Http\Controllers\SupportController::class, 'AddReply'])->name('support.support-add-reply');
    
    Route::post('/support/ticket/mark-as-resolved/submit', [App\Http\Controllers\SupportController::class, 'MarkAsResolved'])->name('support.ticket-mark-resolved');

    Route::get('/support/support-tickets', [App\Http\Controllers\SupportController::class, 'SupportTickets'])->name('support.support-tickets');
    
    Route::get('/support/ticket/id/{ticket_id}', [App\Http\Controllers\SupportController::class, 'ShowTicket'])->name('support.show-ticket');

    Route::get('/checkout/order/{order_id}/confirmation', [App\Http\Controllers\CheckoutController::class, 'CheckoutOrderConfirmation'])->name('checkout-order-confirmation');
    
    Route::post('/dp/update', [App\Http\Controllers\DpUpdateController::class, 'DpUpdate'])->name('dp-update');

    Route::get('/account', [App\Http\Controllers\AccountController::class, 'ShowAccount'])->name('my-account');
    
    Route::get('/addresses', [App\Http\Controllers\ManageAddressesController::class, 'ShowAddresses'])->name('addresses');
    
    Route::get('/orders', [App\Http\Controllers\OrdersController::class, 'ViewOrders'])->name('orders');
    
    Route::get('/order/{order_id}', [App\Http\Controllers\OrdersController::class, 'OrderPage'])->name('order-page');

    Route::post('/address/add', [App\Http\Controllers\ManageAddressesController::class, 'AddAddress'])->name('add-address-submit');

    Route::post('/address/remove', [App\Http\Controllers\ManageAddressesController::class, 'RemoveAddress'])->name('remove-address-submit');
    
    Route::post('/address/edit/fetch', [App\Http\Controllers\ManageAddressesController::class, 'EditAddressFetch'])->name('edit-address-fetch');

    Route::post('/address/edit/submit', [App\Http\Controllers\ManageAddressesController::class, 'EditAddressSubmit'])->name('edit-address-submit');

    Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'ShowWishlist'])->name('wishlist');
    
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'CheckoutView'])->name('checkout-post');
    
    Route::post('/checkout/submit', [App\Http\Controllers\CheckoutController::class, 'CheckoutSubmit'])->name('checkout-submit');
   
    Route::post('/cancel-order/request', [App\Http\Controllers\OrdersController::class, 'CancelRequest'])->name('cancel-order.request');

    Route::post('/ajax/calcMRP', [App\Http\Controllers\AjaxController::class, 'CalcMRPPrice'])->name('calc-mrp-price');

    Route::post('/cart/checkout', [App\Http\Controllers\CheckoutController::class, 'CartCheckout'])->name('cart-checkout');
    
    Route::post('/wishlist/toggle', [App\Http\Controllers\WishlistController::class, 'ToggleWishlist'])->name('toggle-wishlist-btn');
    
    Route::post('/account/update-name', [App\Http\Controllers\AccountController::class, 'UpdateName'])->name('update-name');

    Route::post('/account/update-email', [App\Http\Controllers\AccountController::class, 'UpdateEmail'])->name('update-email');

    Route::post('/account/update-mobile', [App\Http\Controllers\AccountController::class, 'UpdateMobile'])->name('update-mobile');
    
    Route::post('/review/product/submit', [App\Http\Controllers\ReviewController::class, 'ReviewSubmit'])->name('review-submit');
    
    Route::post('/qna/answer/submit', [App\Http\Controllers\ProductQNAController::class, 'AnswerSubmit'])->name('answer-submit');
    
    Route::get('/ajax/get-auth-name', [App\Http\Controllers\AjaxController::class, 'GetAuthName'])->name('get-auth-name');

    Route::get('/ajax/get-auth-email', [App\Http\Controllers\AjaxController::class, 'GetAuthEmail'])->name('get-auth-email');

    Route::get('/ajax/get-auth-mobile', [App\Http\Controllers\AjaxController::class, 'GetAuthMobile'])->name('get-auth-mobile');
   
    Route::get('/ajax/get-add-answer-form-details', [App\Http\Controllers\AjaxController::class, 'GetAnswerFormDetails'])->name('get-add-answer-form-details');
    
    

// Admin Prefix Routes
Route::group(['prefix' => 'admin', 'middleware' => ['permission:Admin', 'verified']], function() {

    Route::get('/','App\Http\Controllers\Admin\AdminController@IndexDashboard')->name('admin-dashboard');

    Route::get('/manage-offers-promotionals','App\Http\Controllers\Admin\PromotionalsOffersController@ManageOffers')->name('admin-manage-offers-promotionals');
   
    Route::get('/manage-vouchers','App\Http\Controllers\Admin\PromotionalsOffersController@ManageVouchers')->name('admin-manage-vouchers');
    
    Route::post('/create-voucher/sbumit','App\Http\Controllers\Admin\PromotionalsOffersController@CreateVoucherSubmit')->name('admin-create-voucher-submit');
    
    Route::get('/create-voucher','App\Http\Controllers\Admin\PromotionalsOffersController@CreateVoucher')->name('admin-create-voucher');
    
    Route::get('/manage-voucher/{voucher_id}/edit','App\Http\Controllers\Admin\PromotionalsOffersController@EditVoucher')->name('admin-edit-voucher');
    
    Route::post('/manage-voucher/edit/submit','App\Http\Controllers\Admin\PromotionalsOffersController@EditVoucherSubmit')->name('admin-edit-voucher-submit');
    
    Route::get('/system-settings','App\Http\Controllers\Admin\AdminController@SystemSettings')->name('admin-system-settings');
    
    Route::get('/system-settings/update','App\Http\Controllers\Admin\AdminController@SystemSettingsUpdate')->name('admin-system-settings-update');

    Route::get('/profile','App\Http\Controllers\Admin\AdminController@IndexProfile')->name('admin-profile');

    Route::get('/user-management','App\Http\Controllers\Admin\AdminController@AdminUserManagement')->middleware('permission:User Management|Master Admin')->name('admin-user-management');

    Route::post('/user-management/user/search/submit','App\Http\Controllers\Admin\AdminController@UserSearchSubmit')->middleware('permission:User Management|Master Admin')->name('admin-user-search-submit');

    Route::post('/user-management/user/create/submit','App\Http\Controllers\Admin\AdminController@AdminUserCreateSubmit')->middleware('permission:User Management|Master Admin')->name('admin-user-create-submit');

    Route::get('/user-management/id/{id}/delete','App\Http\Controllers\Admin\AdminController@AdminUserRemove')->middleware('permission:User Management|Master Admin');

    Route::get('/user-management/id/{id}/edit','App\Http\Controllers\Admin\AdminController@AdminUserEdit')->middleware('permission:User Management|Master Admin');

    Route::post('/user-management/edit/submit','App\Http\Controllers\Admin\AdminController@AdminUserEditSubmit')->middleware('permission:User Management|Master Admin')->name('admin-user-edit-submit');

    Route::get('/manage-products','App\Http\Controllers\Admin\AdminController@ManageProducts')->middleware('permission:Manage Products|Master Admin')->name('admin-manage-products');

    Route::get('/manage-ui','App\Http\Controllers\Admin\AdminController@ManageUI')->middleware('permission:Manage UI|Master Admin')->name('admin-manage-ui');
    
    Route::get('/support/tickets','App\Http\Controllers\SupportController@AdminShowTicketsPage')->middleware('permission:Support Staff|Master Admin')->name('admin-support-tickets');
    
    Route::get('/support/ticket/{ticket_id}/manage','App\Http\Controllers\SupportController@AdminManageTicketPage')->middleware('permission:Support Staff|Master Admin')->name('admin-manage-support-ticket');
    
    Route::post('/support/add-reply/submit', [App\Http\Controllers\SupportController::class, 'AdminAddReply'])->middleware('permission:Support Staff|Master Admin')->name('admin.support-add-reply');

    Route::get('/manage-ui/featured-catalogs','App\Http\Controllers\Admin\AdminController@ManageFeaturedCatalogs')->middleware('permission:Manage UI|Master Admin')->name('admin-manage-featured-catalogs');
   
    Route::get('/manage-ui/create-new-catalog','App\Http\Controllers\Admin\AdminController@CreateNewCatalog')->middleware('permission:Manage UI|Master Admin')->name('admin-create-new-catalog');

    Route::post('/manage-ui/create-new-catalog/submit','App\Http\Controllers\Admin\AdminController@CreateNewCatalogSubmit')->middleware('permission:Manage UI|Master Admin')->name('admin-create-new-catalog-submit');
       
    Route::get('/manage-ui/edit-catalog/{catalog_id}','App\Http\Controllers\Admin\AdminController@EditCatalog')->middleware('permission:Manage UI|Master Admin')->name('admin-edit-catalog');

    Route::post('/manage-ui/edit-catalog/submit','App\Http\Controllers\Admin\AdminController@EditCatalogSubmit')->middleware('permission:Manage UI|Master Admin')->name('admin-edit-catalog-submit');



    // Home Carousel Routes (Admin)
    Route::get('/manage-ui/home-carousel-sliders','App\Http\Controllers\Admin\AdminController@ManageHomeCarouselSlider')->middleware('permission:Manage UI|Master Admin')->name('admin-manage-home-carousel-sliders');
    
    Route::get('/manage-ui/home-carousel-sliders/create','App\Http\Controllers\Admin\AdminController@HomeCarouselCreatePageView')->middleware('permission:Manage UI|Master Admin')->name('admin-create-home-carousel-slider');
    
    Route::get('/manage-ui/home-carousel-slider/{slider_id}/edit','App\Http\Controllers\Admin\AdminController@EditHomeCarouselSlider')->middleware('permission:Manage UI|Master Admin')->name('admin-edit-home-carousel-slider');
    // -----------------------------



    
    Route::post('/manage-ui/edit-small-banner/submit','App\Http\Controllers\Admin\AdminController@EditSmallBannerSubmit')->middleware('permission:Manage UI|Master Admin')->name('admin-edit-small-banner-submit');

    Route::get('/manage-banners','App\Http\Controllers\Admin\AdminController@ManageBanners')->middleware('permission:Manage UI|Master Admin')->name('admin-manage-banners');
    
    Route::get('/edit-banners','App\Http\Controllers\Admin\AdminController@EditBanners')->middleware('permission:Manage UI|Master Admin')->name('admin-edit-banners');
    
    Route::get('/banner/{banner_id}/edit','App\Http\Controllers\Admin\AdminController@EditBannerPage')->middleware('permission:Manage UI|Master Admin')->name('admin-edit-banner-page');

    Route::post('/banner/edit/submit','App\Http\Controllers\Admin\AdminController@EditBannerSubmit')->middleware('permission:Manage UI|Master Admin')->name('admin-edit-banner-submit');
    
    Route::get('/manage-orders','App\Http\Controllers\Admin\ManageOrdersController@ViewManageOrders')->middleware('permission:Manage Orders|Master Admin')->name('admin-manage-orders');

    Route::get('/ship-orders','App\Http\Controllers\Admin\ManageOrdersController@ShipOrdersPage')->middleware('permission:Manage Orders|Master Admin')->name('admin-ship-orders');
    
    Route::get('/delivery-confirmation','App\Http\Controllers\Admin\ManageOrdersController@DeliveryConfirmationPage')->middleware('permission:Manage Orders|Master Admin')->name('admin-delivery-confirmation');
    
    Route::get('/manage-order/{order_id}','App\Http\Controllers\Admin\ManageOrdersController@ShipOrder')->middleware('permission:Manage Orders|Master Admin')->name('admin-ship-order');
    
    Route::get('/manage-order/{order_item_id}/delivered','App\Http\Controllers\Admin\ManageOrdersController@ItemDeliveredConfirmation')->middleware('permission:Manage Orders|Master Admin')->name('admin-item-delivered-confirmation');

    Route::get('/manage-order/{order_item_id}/start-packing','App\Http\Controllers\Admin\ManageOrdersController@StartPacking')->middleware('permission:Manage Orders|Master Admin')->name('admin-start-packing-order');
    
    Route::get('/manage-order/{order_item_id}/packing-completed','App\Http\Controllers\Admin\ManageOrdersController@CompletePacking')->middleware('permission:Manage Orders|Master Admin')->name('admin-complete-packing-order');
    
    // Route::get('/manage-order/{order_item_id}/create-shipment','App\Http\Controllers\Admin\ManageOrdersController@CreateShipmentView')->middleware('permission:Manage Orders|Master Admin')->name('admin-create-shipment-view');
    
    Route::get('/manage-order/{order_id}/create-shipment','App\Http\Controllers\Admin\ManageOrdersController@CreateShipment')->middleware('permission:Manage Orders|Master Admin')->name('admin-create-shipment');
    
    Route::post('/manage-order/create-shipment/submit','App\Http\Controllers\Admin\ManageOrdersController@CreateShipmentSubmit')->middleware('permission:Manage Orders|Master Admin')->name('admin-create-shipment-submit');
    
    Route::post('/manage-order/send-license-Key/submit','App\Http\Controllers\Admin\ManageOrdersController@SendLicenseKey')->middleware('permission:Manage Orders|Master Admin')->name('admin-send-license-key');
    
    Route::post('/cancel-order/review/submit','App\Http\Controllers\Admin\ManageOrdersController@CancelReviewSubmit')->middleware('permission:Manage Orders|Master Admin')->name('admin-cancel-review-submit');
    
    // Route::get('/manage-order/{order_item_id}/pickup-done','App\Http\Controllers\Admin\ManageOrdersController@PickupDone')->middleware('permission:Manage Orders|Master Admin')->name('admin-order-pickup-done');

    Route::get('/new-banner','App\Http\Controllers\Admin\AdminController@NewBanner')->middleware('permission:Manage UI|Master Admin')->name('admin-new-banner');
    
    Route::post('/new-banner/submit','App\Http\Controllers\Admin\AdminController@NewBannerSubmit')->middleware('permission:Manage UI|Master Admin')->name('admin-new-banner-submit');

    Route::get('/publish-banner','App\Http\Controllers\Admin\AdminController@PublishBanners')->middleware('permission:Manage UI|Master Admin')->name('admin-publish-banners');

    Route::post('/publish-banner/submit','App\Http\Controllers\Admin\AdminController@PublishBannersSubmit')->middleware('permission:Manage UI|Master Admin')->name('admin-publish-banners-submit');

    Route::get('/manage-products/new-product-listing', 'App\Http\Controllers\Admin\ManageProductsController@NewProductListing')->middleware('permission:Manage Products|Master Admin')->name('admin-new-product-listing');

    Route::post('/manage-products/new-product-listing/submit', 'App\Http\Controllers\Admin\ManageProductsController@NewProductListingSubmit')->middleware('permission:Manage Products|Master Admin')->name('admin-new-product-listing-submit');

    Route::get('/manage-products/publish-products','App\Http\Controllers\Admin\ManageProductsController@ProductPublish')->middleware('permission:Manage Products|Master Admin')->name('admin-product-publish');

    Route::get('/manage-products/publish-product/id/{product_id}','App\Http\Controllers\Admin\ManageProductsController@ProductPublishFormHandler')->middleware('permission:Manage Products|Master Admin')->name('ProductPublishFormHandler');

    Route::post('/manage-products/publish-product/specification/submit', 'App\Http\Controllers\Admin\ManageProductsController@ProductPublishFormSpecification')->middleware('permission:Manage Products|Master Admin')->name('admin-publish-product-specification-submit');

    Route::get('/manage-products/publish-product/tag', 'App\Http\Controllers\Admin\ManageProductsController@TagForm')->middleware('permission:Manage Products|Master Admin');

    Route::post('/manage-products/publish-product/tag/submit', 'App\Http\Controllers\Admin\ManageProductsController@ProductPublishFormTag')->middleware('permission:Manage Products|Master Admin')->name('admin-publish-product-tag-submit');

    Route::get('/manage-product/pid/{product_id}/edit','App\Http\Controllers\Admin\ManageProductsController@EditProduct')->middleware('permission:Manage Products|Master Admin')->name('edit-product');
    
    Route::get('/manage-product/pid/{product_id}/licenses','App\Http\Controllers\Admin\ManageProductsController@EditProductLicenses')->middleware('permission:Manage Products|Master Admin')->name('edit-product-licenses');

    Route::post('/manage-products/pid/edit/submit', 'App\Http\Controllers\Admin\ManageProductsController@EditProductSubmit')->middleware('permission:Manage Products|Master Admin')->name('edit-product-submit');

    Route::get('/manage-product/pid/{product_id}/images/edit','App\Http\Controllers\Admin\ManageProductsController@EditProductImages')->middleware('permission:Manage Products|Master Admin')->name('edit-product-images');

    Route::post('/manage-products/pid/edit/images/submit', 'App\Http\Controllers\Admin\ManageProductsController@EditProductImagesSubmit')->middleware('permission:Manage Products|Master Admin')->name('edit-product-images-submit');

    Route::post('/manage-products/pid/edit/add-images/submit', 'App\Http\Controllers\Admin\ManageProductsController@AddMoreImages')->middleware('permission:Manage Products|Master Admin')->name('edit-add-images-submit');

    Route::get('/manage-products/remove-image/id/{image_id}', 'App\Http\Controllers\Admin\ManageProductsController@RemoveImage')->middleware('permission:Manage Products|Master Admin')->name('remove-image-submit');

    Route::get('/manage-products/pid/{product_id}/remove', 'App\Http\Controllers\Admin\ManageProductsController@RemoveProduct')->middleware('permission:Manage Products|Master Admin')->name('remove-product');

});


    
    // Affiliate Links Prefix Routes
    Route::group(['prefix' => 'affiliate',], function() {
        Route::get('/', [App\Http\Controllers\AffiliateController::class, 'Index'])->name('affiliate');

        Route::get('/join', [App\Http\Controllers\AffiliateController::class, 'ShowJoinPage'])->name('affiliate.join');

        Route::post('/join/submit', [App\Http\Controllers\AffiliateController::class, 'JoinSubmit'])->name('affiliate.join-submit');
        
        Route::get('/referred-purchases', [App\Http\Controllers\AffiliateController::class, 'ReferredPurchasesPage'])->middleware('permission:Affiliate')->name('affiliate.referred-purchases');
        
        Route::get('/reports', [App\Http\Controllers\AffiliateController::class, 'ReportsPage'])->middleware('permission:Affiliate')->name('affiliate.reports');
        
        Route::get('/wallet', [App\Http\Controllers\AffiliateController::class, 'WalletPage'])->middleware('permission:Affiliate')->name('affiliate.wallet');
        
        Route::get('/payment-modes', [App\Http\Controllers\AffiliateController::class, 'PaymentModesPage'])->middleware('permission:Affiliate')->name('affiliate.payment-modes');
        
        Route::get('/payout', [App\Http\Controllers\AffiliateController::class, 'PayoutPage'])->middleware('permission:Affiliate')->name('affiliate.payout');
        
        Route::get('/settings', [App\Http\Controllers\AffiliateController::class, 'SettingsPage'])->middleware('permission:Affiliate')->name('affiliate.settings');
    });


















Route::group(['prefix' => 'ajax/data-table'], function() {

    Route::resource('datatable/products-licenses-table','App\Http\Controllers\Datatables\ProductLicensesTableController')->names('datatable-product-licenses-table');

    Route::get('admin-featured-catalogs-table', 'App\Http\Controllers\AjaxDataTable@AdminFeaturedCatalogsTable')->name('ajax-datatable.AdminFeaturedCatalogsTable');
    Route::get('admin-products-table', 'App\Http\Controllers\AjaxDataTable@AdminProductsTable')->name('ajax-datatable.AdminProductsTable');
    Route::get('admin-products-publish-table', 'App\Http\Controllers\AjaxDataTable@AdminProductsPublishTable')->name('ajax-datatable.AdminProductsPublishTable');
    Route::get('admin-orders-table', 'App\Http\Controllers\AjaxDataTable@AdminOrdersTable')->name('ajax-datatable.AdminOrdersTable');
    Route::get('admin-ship-orders-table', 'App\Http\Controllers\AjaxDataTable@AdminShipOrdersTable')->name('ajax-datatable.AdminShipOrdersTable');
    Route::get('admin-slider-products-table', 'App\Http\Controllers\AjaxDataTable@SliderProductsTable')->name('ajax-datatable.AdminSliderProductsTable');
    Route::get('referred-purchases-table', 'App\Http\Controllers\AjaxDataTable@ReferredPurchasesTable')->name('ajax-datatable.ReferredPurchasesTable');
    Route::get('support-tickets-table', 'App\Http\Controllers\AjaxDataTable@SupportTicketsTable')->name('ajax-datatable.SupportTicketsTable');
    Route::get('admin-support-tickets-table', 'App\Http\Controllers\AjaxDataTable@AdminSupportTicketsTable')->name('ajax-datatable.AdminSupportTicketsTable');
    Route::get('admin-delivery-confirmation-table', 'App\Http\Controllers\AjaxDataTable@AdminDeliveryConfirmationTable')->name('ajax-datatable.AdminDeliveryConfirmationTable');
    Route::get('admin-Wallet-txn-table', 'App\Http\Controllers\AjaxDataTable@WalletTxnTable')->name('ajax-datatable.WalletTxnTable');
    Route::get('admin-vouchers-table', 'App\Http\Controllers\AjaxDataTable@AdminVouchersTable')->name('ajax-datatable.AdminVouchersTable');
});

Route::group(['prefix' => 'jquery/load/components'], function() {
    Route::get('/checkout-address-container-div', [App\Http\Controllers\JqueryLoadController::class, 'CheckoutAddressContainerDiv'])->name('CheckoutAddressContainerDiv');
});




}); // Verified+Auth Middleware End