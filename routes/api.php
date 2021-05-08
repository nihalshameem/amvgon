<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
//admin notification
Route::namespace ('App\Http\Controllers\admin')->group(function () {
    Route::post('/add-device', 'AdminNotificationsController@addDevice');
    Route::post('/remove-device', 'AdminNotificationsController@removeDevice');
});

// admin purchase bill
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::get('/purchase/bill/{date}', 'ApiController@adminPurchase');
});

// admin invoice bill
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::post('/invoice/bill', 'ApiController@adminInvoice');
});

// customer Auth controls
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::post('/phone-validate', 'CustomerAuthController@phoneValidate');
    Route::post('/register', 'CustomerAuthController@register');
    Route::post('/forget-password', 'CustomerAuthController@forgetPassword');
    Route::post('/login', 'CustomerAuthController@login');
    Route::post('/logout/{token}', 'CustomerAuthController@logout');
});

// delivery time list
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::get('/delivery-time', 'ApiController@timeList');
});

// delivery time list
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::get('/delivery-day', 'ApiController@deliveryDay');
});
// customer care
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::get('/customer-care', 'ApiController@customerCare');
});

// customer
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::get('/profile/{token}', 'ApiController@customerdetails');
    Route::post('/profile/update/{token}', 'ApiController@customerUpdate');
    Route::post('/profile/change_password/{token}', 'ApiController@changePass');
    Route::get('/orders/{token}', 'ApiController@orderList');
    Route::get('/order/details/{token}', 'ApiController@orderDetail');
    Route::post('/order/add/{token}', 'ApiController@orderAdd');
    Route::post('/order/cancel/{token}', 'ApiController@orderCancel');
});

// Functions and hotels
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::get('/functions', 'ApiController@functionList');
    Route::get('/hotels', 'ApiController@hotelList');
});

// favorites
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::get('/favorites/{token}', 'FavoritesController@favoriteList');
    Route::post('/favorite/add/{token}', 'FavoritesController@favoriteAdd');
    Route::post('/favorite/delete/{token}', 'FavoritesController@favoriteDelete');
    Route::post('/favorite/clearall/{token}', 'FavoritesController@favoriteDeleteAll');
});

// carts
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::get('/carts/{token}', 'CartsController@cartList');
    Route::post('/cart/add/{token}', 'CartsController@cartAdd');
    Route::post('/cart/update/{token}', 'CartsController@cartUpdate');
    Route::post('/cart/delete/{token}', 'CartsController@cartDelete');
    Route::post('/cart/clearall/{token}', 'CartsController@cartDeleteAll');
});

// products
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::get('/products', 'ApiController@productList');
    Route::get('/products/hot', 'ApiController@productsHot');
    Route::get('/product/{id}', 'ApiController@productSingle');
    Route::get('/store', 'ApiController@store');
});

// banners
Route::get('/banners', 'App\Http\Controllers\api\ApiController@Banner');

// combos
Route::get('/combos', 'App\Http\Controllers\api\ApiController@combos');

// offer banners
Route::get('/offer-banners', 'App\Http\Controllers\api\ApiController@OfferBanner');

// districts
Route::get('/districts', 'App\Http\Controllers\api\ApiController@districtList');

// categories
Route::get('/categories', 'App\Http\Controllers\api\ApiController@categoryList');

// shpping charges
Route::get('/shipping-charge', 'App\Http\Controllers\api\ApiController@shippingCharge');

// addresses
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::get('/addresses/{api_token}', 'AddressesController@addressList');
    Route::get('/address/single/{token}', 'AddressesController@addressSingle');
    Route::post('/address/add/{token}', 'AddressesController@addressAdd');
    Route::post('/address/update/{token}', 'AddressesController@addressUpdate');
    Route::post('/address/delete/{token}', 'AddressesController@addressDelete');
});

// customer feedback and ratings
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::post('/feedback/{token}', 'FeedbacksController@customerFeedback');
    Route::post('/delivery/rating/{token}', 'FeedbacksController@deliveryRating');
    Route::get('/rating-list/{token}', 'FeedbacksController@customerRating');
});

// customer coupons
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::post('/coupon/{token}', 'CouponsController@couponSingle');
    Route::get('/coupon/all/{token}', 'CouponsController@couponAll');
});

// delivery boy Auth controls
Route::namespace ('App\Http\Controllers\api')->group(function () {
    Route::post('/delivery-boy/login', 'DeliveryAuthController@login');
    Route::post('/delivery-boy/logout/{token}', 'DeliveryAuthController@logout');
    Route::post('/delivery-boy/change_password/{token}', 'DeliveryAuthController@changePass');
});

// delivery boy orders
Route::namespace ('App\Http\Controllers\delivery')->group(function () {
    Route::get('/delivery-boy/orders/{token}', 'OrdersController@orderList');
    Route::post('/delivery-boy/order/select/{token}', 'OrdersController@orderSelect');
    Route::post('/delivery-boy/order/reject/{token}', 'OrdersController@orderReject');
    Route::post('/delivery-boy/order-finished/{token}', 'OrdersController@orderFinished');
    Route::get('/delivery-boy/order-completed/list/{token}', 'OrdersController@completedList');
    Route::get('/delivery-boy/request-list/{token}', 'OrdersController@requestList');
    Route::post('/delivery-boy/request-decline/{token}', 'OrdersController@requestDecline');
    Route::get('/delivery-boy/selected-list/{token}', 'OrdersController@selectedList');
    Route::post('/delivery-boy/order-start/{token}', 'OrdersController@orderStart');
});

// delivery boy profile
Route::namespace ('App\Http\Controllers\delivery')->group(function () {
    Route::get('/delivery-boy/profile/{token}', 'DeliveriesController@profile');
    Route::post('/delivery-boy/status-change/{token}', 'DeliveriesController@statusChange');
    Route::post('/delivery-boy/location/{token}', 'DeliveriesController@locationUpdate');
});

// delivery boy salary
Route::namespace ('App\Http\Controllers\delivery')->group(function () {
    Route::get('/delivery-boy/salary/paid/{token}', 'DeliveriesController@paidList');
    Route::get('/delivery-boy/cash-given/{token}', 'DeliveriesController@cashGiven');
});
