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
Route::namespace ('customer')->group(function () {
    Route::any('/', 'HomeController@index');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace ('Auth')->group(function () {
    Route::get('/login/admin', 'LoginController@showAdminLoginForm');
    Route::get('/login/customer', 'LoginController@showCustomerLoginForm');
    Route::post('/login/admin/submit', 'LoginController@adminLogin')->name('admin.login.submit');
    Route::post('/login/customer/submit', 'LoginController@customerLogin')->name('customer.login.submit');
    Route::post('/register/customer/submit', 'LoginController@customerRegister')->name('customer.register.submit');
    Route::post('/create/customer', 'LoginController@customerCreate');
    Route::get('/forget-password/customer', 'LoginController@forgetPassword');
    Route::post('/forget-password/customer/verify', 'LoginController@forgetPasswordVerify');
    Route::post('/forget-password/customer/submit', 'LoginController@forgetPasswordSubmit');
});

// Route::view('/home', 'home')->middleware('auth');

Route::get('/admin', 'Admincontroller@index');

// admin notification
Route::get('/admin/push-notification', 'Admincontroller@pushNotification');

// admin shipping charge
Route::post('/admin/shipping-charge/update', 'Admincontroller@shippingCharge');

// admin search
Route::post('/admin/search', 'Admincontroller@searchResult');

// admin auto
Route::post('/admin/auto', 'Admincontroller@auto');
Route::get('/admin/auto/order-notification', 'Admincontroller@autoOrderRequest');

// admin notification
Route::post('/admin/allread', 'Admincontroller@allRead');
Route::post('/admin/read', 'Admincontroller@read');

// admin delivery time
// Route::namespace ('admin')->group(function () {
//     Route::get('/admin/delivery-time', 'DeliveryTimesController@timeList');
//     Route::post('/admin/delivery-time/add', 'DeliveryTimesController@timeAdd');
//     Route::post('/admin/delivery-time/delete/{id}', 'DeliveryTimesController@timeDelete');
//     Route::get('/admin/delivery-time/edit/{id}', 'DeliveryTimesController@timeEdit');
//     Route::post('/admin/delivery-time/update/{id}', 'DeliveryTimesController@timeUpdate');
// });

// admin invoice
Route::any('admin/invoice', 'Admincontroller@invoice');
Route::get('admin/invoice/all/{id}', 'Admincontroller@invoiceAll');
Route::any('admin/print/order', 'Admincontroller@printOrder');

// admin purchase
Route::get('admin/purchase/bill/{id}', 'Admincontroller@purchaseBill');

// admin delivery time
Route::namespace ('admin')->group(function () {
    Route::post('/admin/delivery-day/status', 'DeliveryDaysController@statusChange');
    Route::get('/admin/delivery-day/setting', 'DeliveryDaysController@setting');
    Route::post('/admin/delivery-day/update/{id}', 'DeliveryDaysController@update');
});

// admin products
Route::namespace ('admin')->group(function () {
    Route::get('/admin/products', 'ProductsController@productList');
    Route::get('/admin/products/update-price', 'ProductsController@UpdatePrice');
    Route::post('/admin/products/submit-all', 'ProductsController@SubmitAll');
    Route::get('/admin/products/add', 'ProductsController@productAddForm');
    Route::post('/admin/products/add/submit', 'ProductsController@productAdd');
    Route::get('/admin/product/{id}', 'ProductsController@productEditForm');
    Route::post('/admin/product/edit/{id}', 'ProductsController@productEdit');
    Route::post('/admin/product/delete/{id}', 'ProductsController@productDelete');
});

// admin functions
Route::namespace ('admin')->group(function () {
    Route::get('/admin/functions', 'FunctionsController@functionList');
    Route::post('/admin/function/add', 'FunctionsController@functionAdd');
    Route::get('/admin/function/edit/{id}', 'FunctionsController@functionEdit');
    Route::post('/admin/function/update/{id}', 'FunctionsController@functionUpdate');
    Route::post('/admin/function/delete/{id}', 'FunctionsController@functionDelete');
});

// admin hotels
Route::namespace ('admin')->group(function () {
    Route::get('/admin/hotels', 'HotelsController@hotelList');
    Route::post('/admin/hotel/add', 'HotelsController@hotelAdd');
    Route::get('/admin/hotel/edit/{id}', 'HotelsController@hotelEdit');
    Route::post('/admin/hotel/update/{id}', 'HotelsController@hotelUpdate');
    Route::post('/admin/hotel/delete/{id}', 'HotelsController@hotelDelete');
});

// admin Store
Route::get('/admin/storeInfo', 'Admincontroller@StoreInfo');
Route::post('/admin/storeInfo/update', 'Admincontroller@StoreUpdate');
Route::get('/admin/profile', 'Admincontroller@profileForm');
Route::post('/admin/profile/update', 'Admincontroller@profileUpdate');
Route::get('/admin/order/purchase-list', 'Admincontroller@purchaseList');

// admin orders
Route::namespace ('admin')->group(function () {
    Route::get('/admin/orders', 'OrdersController@orderList');
    Route::get('/admin/order/{id}', 'OrdersController@orderDetail');
    Route::post('/admin/order/update/{id}', 'OrdersController@orderUpdate');
    Route::post('/admin/order/search', 'OrdersController@searchResult');
    Route::post('/admin/order/filter', 'OrdersController@orderFilter');
});

// admin order rejects
Route::namespace ('admin')->group(function () {
    Route::get('/admin/rejects', 'OrderRejectsController@rejectList');
    Route::get('/admin/reject/{id}', 'OrderRejectsController@rejectDetail');
    Route::post('/admin/reject/delete/{id}', 'OrderRejectsController@rejectDelete');
});

// admin banners
Route::namespace ('admin')->group(function () {
    Route::get('/admin/banners', 'BannersController@bannerList');
    Route::get('/admin/banner/add', 'BannersController@bannerAddForm');
    Route::post('/admin/banner/add/submit', 'BannersController@bannerAdd');
    Route::get('/admin/banner/{id}', 'BannersController@bannerEditForm');
    Route::post('/admin/banner/edit/{id}', 'BannersController@bannerEdit');
    Route::post('/admin/banner/detele/{id}', 'BannersController@bannerDelete');
});

// admin offer-banners
Route::namespace ('admin')->group(function () {
    Route::get('/admin/offer-banners', 'OfferBannersController@bannerList');
    Route::get('/admin/offer-banner/add', 'OfferBannersController@bannerAddForm');
    Route::post('/admin/offer-banner/add/submit', 'OfferBannersController@bannerAdd');
    Route::get('/admin/offer-banner/{id}', 'OfferBannersController@bannerEditForm');
    Route::post('/admin/offer-banner/edit/{id}', 'OfferBannersController@bannerEdit');
    Route::post('/admin/offer-banner/detele/{id}', 'OfferBannersController@bannerDelete');
});

// admin combo-offers
Route::namespace ('admin')->group(function () {
    Route::get('/admin/combo-offers', 'CombosController@comboList');
    Route::get('/admin/combo-offer/add', 'CombosController@comboAdd');
    Route::post('/admin/combo-offer/add/submit', 'CombosController@comboAddSubmit');
    Route::get('/admin/combo-offer/{id}', 'CombosController@comboEdit');
    Route::post('/admin/combo-offer/update/{id}', 'CombosController@comboUpdate');
    Route::post('/admin/combo-offer/delete/{id}', 'CombosController@comboDelete');
});

// admin coupons
Route::namespace ('admin')->group(function () {
    Route::get('/admin/coupons', 'CouponsController@couponList');
    Route::get('/admin/coupon/add', 'CouponsController@couponAddForm');
    Route::post('/admin/coupon/add/submit', 'CouponsController@couponAdd');
    Route::get('/admin/coupon/{id}', 'CouponsController@couponEditForm');
    Route::post('/admin/coupon/update/{id}', 'CouponsController@couponUpdate');
    Route::post('/admin/coupon/delete/{id}', 'CouponsController@couponDelete');
});

// admin districts
// Route::namespace ('admin')->group(function () {
//     Route::get('/admin/districts', 'DistrictsController@districtList');
//     Route::post('/admin/district/add/submit', 'DistrictsController@districtAdd');
//     Route::get('/admin/district/edit/{id}', 'DistrictsController@districtEditForm');
//     Route::post('/admin/district/update/{id}', 'DistrictsController@districtUpdate');
//     Route::post('/admin/district/delete/{id}', 'DistrictsController@districtDelete');
// });

// admin customers
Route::namespace ('admin')->group(function () {
    Route::get('/admin/customers', 'CustomersController@customerList');
    Route::get('/admin/customer/detail/{id}', 'CustomersController@customerDetail');
    Route::post('/admin/customer/delete/{id}', 'CustomersController@customerDelete');
    Route::post('/admin/customer/search', 'CustomersController@searchResult');
});

// admin delivery boy
Route::namespace ('admin')->group(function () {
    Route::get('/admin/delivery-boys', 'DeliveriesController@deliveryList');
    Route::get('/admin/delivery-boy/orders/{id}', 'DeliveriesController@deliveryOrder');
    Route::get('/admin/delivery-boy/add', 'DeliveriesController@deliveryAddForm');
    Route::post('/admin/delivery-boy/add/submit', 'DeliveriesController@deliveryAdd');
    Route::get('/admin/delivery-boy/detail/{id}', 'DeliveriesController@deliveryDetail');
    Route::post('/admin/delivery-boy/update/{id}', 'DeliveriesController@deliveryUpdate');
    Route::post('/admin/delivery-boy/delete/{id}', 'DeliveriesController@deliveryDelete');
    Route::post('/admin/delivery-boy/search', 'DeliveriesController@searchResult');
    Route::get('/admin/delivery-boys/get-cash/list', 'DeliveriesController@getCashList');
    Route::get('/admin/delivery-boy/get-cash/{id}', 'DeliveriesController@getCash');
});

// admin delivery salaries
Route::namespace ('admin')->group(function () {
    Route::get('/admin/delivery-salaries', 'DeliverySalariesController@salaryList');
    Route::get('/admin/delivery-salary/{id}', 'DeliverySalariesController@salaryEdit');
    Route::post('/admin/delivery-salary/update/{id}', 'DeliverySalariesController@salaryUpdate');
    Route::post('/admin/delivery-charge/update', 'DeliverySalariesController@chargeUpdate');
    Route::post('/admin/weekly-incentive/update', 'DeliverySalariesController@weeklyIncentiveUpdate');
    Route::post('/admin/delivery-salary/delete/{id}', 'DeliverySalariesController@salaryDelete');
    Route::get('/admin/paid-salary', 'DeliverySalariesController@paidSalary');
    Route::post('/admin/delivery-boy/bonus', 'DeliverySalariesController@bonus');
    Route::post('/admin/delivery-boy/amount-incentive', 'DeliverySalariesController@amountIncentive');
    Route::post('/admin/delivery-boy/order-incentive', 'DeliverySalariesController@orderIncentiveUpdate');
    Route::get('/admin/delivery-salary/detail-list/{id}', 'DeliverySalariesController@detailList');
    Route::get('/admin/delivery-salary/pay/{id}', 'DeliverySalariesController@salaryPay');
    Route::post('/admin/paid-salary/search', 'DeliverySalariesController@paidSearch');
});

// admin feedback
Route::namespace ('admin')->group(function () {
    Route::get('/admin/feedback', 'FeedbacksController@feedbackList');
    Route::get('/admin/feedback/detail/{id}', 'FeedbacksController@feedbackDetail');
    Route::post('/admin/feedback/delete/{id}', 'FeedbacksController@feedbackDelete');
});

// admin category
Route::namespace ('admin')->group(function () {
    Route::get('/admin/categories', 'CategoriesController@categoryList');
    Route::post('/admin/category/add', 'CategoriesController@categoryAdd');
    Route::get('/admin/category/edit/{id}', 'CategoriesController@categoryEditForm');
    Route::post('/admin/category/update/{id}', 'CategoriesController@categoryUpdate');
    Route::post('/admin/category/delete/{id}', 'CategoriesController@categoryDelete');
});

// admin customer care
Route::namespace ('admin')->group(function () {
    Route::get('/admin/customer-cares', 'CustomerCaresController@customerCareList');
    Route::post('/admin/customer-care/add', 'CustomerCaresController@customerCareAdd');
    Route::get('/admin/customer-care/edit/{id}', 'CustomerCaresController@customerCareEdit');
    Route::post('/admin/customer-care/update/{id}', 'CustomerCaresController@customerCareUpdate');
    Route::post('/admin/customer-care/delete/{id}', 'CustomerCaresController@customerCareDelete');
});

// admin send notification
Route::namespace ('admin')->group(function () {
    Route::get('/admin/send-notification', 'SendNotificationsController@showForm');
    Route::post('/admin/send-notification/submit', 'SendNotificationsController@send_all_notification');
});

// delivery
Route::namespace ('delivery')->group(function () {
    Route::get('/delivery', 'DeliveriesController@home');
});

// customer products and categories
Route::namespace ('customer')->group(function () {
    Route::any('products', 'HomeController@products');
    Route::any('product/{id}', 'HomeController@productSingle');
    Route::any('combo/{id}', 'HomeController@comboSingle');
    Route::any('categories', 'HomeController@categoryList');
    Route::any('categories/functions', 'HomeController@functionList');
    Route::any('categories/hotels', 'HomeController@hotelList');
    Route::any('category/{id}', 'HomeController@categoryProducts');
    Route::any('search/result', 'HomeController@searchresult');
    Route::post('favorite/add', 'FavoritesController@addFavorite');
});

// customer favorites
// Route::namespace ('customer')->group(function () {
//     Route::get('/customer/favorites', 'FavoritesController@favoriteList');
//     Route::post('/customer/favorite/add/ajax', 'FavoritesController@addFavoriteAjax');
//     Route::post('/customer/favorite/add/{id}', 'FavoritesController@addFavorite');
//     Route::get('favorite/delete/{id}', 'FavoritesController@favoriteDelete');
//     Route::post('/customer/favorite/clear', 'FavoritesController@favoriteClearall');
// });

// customer profile
Route::get('/customer', 'CustomersController@index');
Route::post('/customer/profile/update', 'CustomersController@profileUpdate');
Route::post('/customer/change-password', 'CustomersController@changePassword');

// customer address
Route::namespace ('customer')->group(function () {
    Route::post('/customer/address/add', 'AddressesController@addressAdd');
    Route::get('/customer/address/delete/{id}', 'AddressesController@addressDelete');
    Route::get('/customer/address/{id}', 'AddressesController@addressSingle');
    Route::post('/customer/address/update/{id}', 'AddressesController@addressUpdate');
});

// customer carts
Route::namespace ('customer')->group(function () {
    Route::get('/customer/carts', 'CartsController@cartList');
    Route::post('/customer/cart/add/ajax', 'CartsController@addCartAjax');
    Route::post('/customer/cart/add/combo-ajax', 'CartsController@addComboAjax');
    Route::post('/customer/cart/update/ajax/{id}', 'CartsController@updateCartAjax');
    Route::post('/customer/cart/add/{id}', 'CartsController@addCart');
    Route::post('/customer/cart/add/combo/{id}', 'CartsController@addCombo');
    Route::get('/customer/cart/delete/{id}', 'CartsController@cartDelete');
    Route::post('/customer/cart/clear', 'CartsController@cartClearall');
    Route::post('/customer/cart/coupon/check', 'CartsController@couponCheck');
});

// customer feedback
Route::namespace ('customer')->group(function () {
    Route::get('/customer/feedback', 'FeedbackController@feedbackForm');
    Route::post('/customer/feedback/add', 'FeedbackController@feedbackAdd');
});

// customer orders
Route::namespace ('customer')->group(function () {
    Route::post('/customer/checkout', 'OrdersController@checkout');
    Route::post('/customer/order/add', 'OrdersController@orderAdd');
    Route::get('/customer/orders', 'OrdersController@orderList');
    Route::get('/customer/order/{id}', 'OrdersController@orderDetail');
    Route::post('/customer/order/cancel/{id}', 'OrdersController@orderCancel');
});

Route::get('payment-razorpay', 'PaymentController@create')->name('paywithrazorpay');
Route::post('payment', 'PaymentController@payment')->name('payment');
use App\Models\Delivery;
use App\Models\Order;
Route::get('test', function(){
    $delivery_boys = Delivery::where('status',1)->get();
            $closest = null;
            $search = '62700';
            foreach ($delivery_boys as $bkey => $boy) {
                $delivery_orders = Order::where('delivery',$boy->id)->get();
                foreach($delivery_orders as $key => $do){
                    if($do->order_status == 3){
                        $delivery_orders->forget($key);
                    }else if($do->order_status == 4){
                        $delivery_orders->forget($key);
                    }
                }
                if(count($delivery_orders) >= 7){
                    continue;
                }
                if ($closest === null || abs($search - $closest) > abs($boy->pincode - $search)) {
                    $closest = $boy->id;
                }
            }
            
            app('App\Http\Controllers\PushNotification')->send_notification_delivery($closest, 'New Order', 'Your new Order',15,null);
            return $closest;
});