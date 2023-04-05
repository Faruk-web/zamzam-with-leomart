<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CRMController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SocialShareController;
use App\Http\Controllers\AttributesController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\RatingReviewController;
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

      //Begin:: role & permission
      Route::get('/admin/role', [AdminController::class, 'role'])->name('admin.role');
      Route::post('/admin/store-role', [AdminController::class, 'create_role'])->name('admin.create.roll');
      Route::get('/admin/edit-role/{id}', [AdminController::class, 'Edit_Admin_helper_role'])->name('admin.edit.roll');
      Route::post('/admin/update-admin-role/{id}', [AdminController::class, 'update_Admin_helper_role']);
      Route::get('/admin/role-permissions/{id}', [AdminController::class, 'admin_helper_permission']);
      Route::get('/admin/set-permission-to-admin-helper-role', [AdminController::class, 'set_permission_to_admin_helper_role']);
      Route::get('/admin/delete-permission-from-role', [AdminController::class, 'delete_permission_from_role']);


      //Begin::Admin  CRM
      Route::get('/admin/all-crm', [CRMController::class, 'index'])->name('admin.crm');
      Route::post('/admin/create-crm', [CRMController::class, 'store'])->name('admin.create.crm');
      Route::get('/admin/edit-crm/{id}', [CRMController::class, 'edit']);
      Route::post('/admin/update-crm/{id}', [CRMController::class, 'update']);
      Route::get('/admin/deactive-crm/{id}', [CRMController::class, 'DeactiveCRM']);
      Route::get('/admin/active-crm/{id}', [CRMController::class, 'ActiveCRM']);
      //End::Admin  CRM
// Route::get('/', function () {
//     return view('pages.index');
// });
// Route::get('/invoice', function () {
//     return view('admin.invoice.generate');
// });

Route::post('rating-review', [RatingReviewController::class, 'index'])->name('submit.rating')->middleware('review.auth');
Route::get('rating-review-show', [RatingReviewController::class, 'show'])->name('rating-review.show');

Route::post('rating-review-delete/{id}', [RatingReviewController::class, 'delete'])->name('rating-review.delete');

Route::get('social-share', [SocialShareController::class, 'index']);
Route::post('vendor/login/store',[UserController::class, 'vendorLogin'] )->name('vendor.login.store');
Route::get('vendor/login', function () {return view('auth/vendor_login');})->name('vendor.login');
Route::get('vendor/register', function () {return view('auth/vendor_registration');})->name('vendor.register');
Route::post('vendor/store',[UserController::class, 'register'] )->name('vendor.store');
Route::get('/', [App\Http\Controllers\PageController::class, 'index'])->name('index');

Route::get('/return-and-refund-policy', [\App\Http\Controllers\RefundController::class, 'show'])->name('refund-and-return.page');

Route::post('/cart/increment/{id}', 'CartController@increment')->name('cart.increment');
Route::post('/cart/decrement/{id}', 'CartController@decrement')->name('cart.decrement');

Route::get('/products', [App\Http\Controllers\PageController::class, 'products'])->name('products');
Route::get('/offer-products', [App\Http\Controllers\PageController::class, 'offer_products'])->name('offer.products');
Route::get('/product/{id}/{slug}', [App\Http\Controllers\PageController::class, 'single_product'])->name('single.product');
Route::get('/color/product/{id}', [App\Http\Controllers\PageController::class, 'color_product'])->name('color.product');
Route::get('/categories', [App\Http\Controllers\PageController::class, 'categories'])->name('categories');
Route::get('/category/{id}/{slug}', [App\Http\Controllers\PageController::class, 'category_products'])->name('category.products');

Route::get('/brand/{id}/{slug}', [App\Http\Controllers\PageController::class, 'brand_products'])->name('brand.products');

Route::get('/about-us', [App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/contact-us', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('/contact-us-message-send', [App\Http\Controllers\PageController::class, 'send_message'])->name('message.send');

Route::get('/search', [App\Http\Controllers\PageController::class, 'search'])->name('search');
Route::get('/search-result', [App\Http\Controllers\PageController::class, 'search_result'])->name('search.result');
Route::post('/subsribe', [App\Http\Controllers\PageController::class, 'subscribe'])->name('subscribe');

Route::get('/privacy-policy', [App\Http\Controllers\PageController::class, 'privacy_policy'])->name('privacy.policy');
Route::get('/terms-and-conditions', [App\Http\Controllers\PageController::class, 'term_condition'])->name('term.condition');

// Cart Route
Route::get('/shopping-carts', [App\Http\Controllers\CartController::class, 'index'])->name('carts');
Route::post('/add-to-cart', [App\Http\Controllers\CartController::class, 'add_cart'])->name('cart.add');
Route::post('/add-to-cart-form/{id}', [App\Http\Controllers\CartController::class, 'add_cart_form'])->name('cart.add-form');
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'update_cart'])->name('cart.update');
Route::post('/remove-from-cart', [App\Http\Controllers\CartController::class, 'remove_cart'])->name('cart.remove');
Route::get('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
Route::get('/get-division-by-country-id', [App\Http\Controllers\CartController::class, 'getDivision'])->name('get.division');
Route::get('/get-district-by-division-id', [App\Http\Controllers\CartController::class, 'getDistrict'])->name('get.district');
Route::get('/get-thana-by-district-id', [App\Http\Controllers\CartController::class, 'getThana'])->name('get.thana');


// Wishlist Route
Route::post('/add-to-wishlist', [App\Http\Controllers\WishlistController::class, 'add_wishlist'])->name('wishlist.add');
Route::post('/remove-from-wishlist/{id}', [App\Http\Controllers\WishlistController::class, 'remove_wishlist'])->name('wishlist.remove');


// Coupon Routes
Route::post('/apply-coupon', [App\Http\Controllers\CartController::class, 'apply_coupon'])->name('coupon.apply');
Route::get('/remove-coupon', [App\Http\Controllers\CartController::class, 'remove_coupon'])->name('coupon.remove');

// Order routes

Route::post('/order-create', [App\Http\Controllers\PageController::class, 'order_create'])->name('order.create');
Route::get('/order-complete/{id}', [App\Http\Controllers\PageController::class, 'order_complete'])->name('order.complete');
Route::get('/track-order', [App\Http\Controllers\PageController::class, 'order_track'])->name('order.track');
Route::get('/track-order-status', [App\Http\Controllers\PageController::class, 'order_track_result'])->name('order.track.result');

// Customer Profile
Route::get('/orders-data/{inputValue}', [App\Http\Controllers\PageController::class, 'order_data']);
Route::get('/my-orders', [App\Http\Controllers\PageController::class, 'my_orders'])->name('customer.orders');
Route::get('/my-wishlist', [App\Http\Controllers\PageController::class, 'my_wishlist'])->name('customer.wishlist');
Route::get('/my-account', [App\Http\Controllers\PageController::class, 'my_account'])->name('customer.account');
Route::post('/customer-account-update/{id}', [App\Http\Controllers\PageController::class, 'customer_account_update'])->name('customer.account.update');
Route::post('/customer-password-change', [App\Http\Controllers\PageController::class, 'change_password'])->name('customer.password.change');
Route::get('/my-wallet', [App\Http\Controllers\PageController::class, 'my_wallet'])->name('customer.wallet');

Route::get('/refund-and-return', [App\Http\Controllers\PageController::class, 'refund'])->name('refund.return');
Route::get('/get-refund-product-price-by-id', [App\Http\Controllers\PageController::class, 'get_refund_price'])->name('refund.return-request');
Route::get('/refund-and-return-request', [App\Http\Controllers\PageController::class, 'refund_request'])->name('refund.return-new');
Route::get('/refund-and-return-request-faruk/{id}', [App\Http\Controllers\PageController::class, 'refund_request_faruk'])->name('refund.return-faruk');
Route::post('/refund-and-return-submit', [App\Http\Controllers\PageController::class, 'refund_return'])->name('refund.return-form');
Route::post('/refund-and-return-search', [App\Http\Controllers\PageController::class, 'refund_return_search'])->name('refund.return-search');
Route::get('/search/raw/material', [App\Http\Controllers\PageController::class, 'rawmaterialsearch']);
Route::post('/my-wallet/point-convert', [App\Http\Controllers\PageController::class, 'my_wallet_point_convert'])->name('customer.point.convert');
Route::get('/my-profile', [App\Http\Controllers\PageController::class, 'my_profile'])->name('customer.profile');
Route::post('/customer/profile/update', [App\Http\Controllers\PageController::class, 'profile_update'])->name('customer.profile.update');
// vendor Controller vendor.conversation
Route::get('/vendor/visit/stor/{id}/{shop}', [App\Http\Controllers\VendorController::class, 'vendor_visit_stor'])->name('vendor.visit.stor');
Route::get('/vendor/wallet', [App\Http\Controllers\VendorController::class, 'vendor_wallet'])->name('vendor.wallet');
Route::get('/vendor/productss', [App\Http\Controllers\VendorController::class, 'ppp'])->name('vendor.pp');
Route::get('/vendor/wishlist', [App\Http\Controllers\VendorController::class, 'vendor_wishlist'])->name('vendor.wishlist');
Route::get('/vendor-account', [App\Http\Controllers\VendorController::class, 'vendor_account'])->name('vendor.account');
Route::get('/vendor-desboard', [App\Http\Controllers\VendorController::class, 'vendor_desboard'])->name('vendor.desboard');
Route::get('/vendor/product', [App\Http\Controllers\VendorController::class, 'vendor_product'])->name('vendor.product');
Route::get('/vendor/order', [App\Http\Controllers\VendorController::class, 'vendorOrders'])->name('vendor.orders');
Route::get('/vendor/profile', [App\Http\Controllers\VendorController::class, 'vendorProfile'])->name('vendor.profile');
Route::post('/vendor/profile/update', [App\Http\Controllers\VendorController::class, 'profile_update'])->name('vendor.profile.update');
//vendor product
Route::post('/vendor/conversation/stote', [App\Http\Controllers\VendorProductController::class, 'conversationStore'])->name('vendor.conversation.stor');
//Route::post('/vendor/product/stote', [App\Http\Controllers\VendorProductController::class, 'store'])->name('vendor.product.store');
Route::post('/vendor/variant/stote', [App\Http\Controllers\VendorProductController::class, 'variantStore'])->name('vendor.variant.store');
Route::post('/vendor/product/stote', [App\Http\Controllers\VendorProductController::class, 'vendorStore'])->name('vendor.product.store');
Route::get('/vendor/product/edit/{id}', [App\Http\Controllers\VendorProductController::class, 'edit'])->name('vendor.product.edit');
Route::post('/vendor/product/update/{id}', [App\Http\Controllers\VendorProductController::class, 'update'])->name('vendor.product.update');
Route::post('/vendor/product/update1/', [App\Http\Controllers\VendorProductController::class, 'update1'])->name('vendor.product.update1');
Route::post('/vendor/product/update2/', [App\Http\Controllers\VendorProductController::class, 'update2'])->name('vendor.product.update2');
Route::post('/vendor/product/service-update/', [App\Http\Controllers\VendorProductController::class, 'serviceUpdate'])->name('vendor.product.service-update');
Route::post('/vendor/product/update3/', [App\Http\Controllers\VendorProductController::class, 'update3'])->name('vendor.product.update3');
Route::post('/vendor/product/update4/', [App\Http\Controllers\VendorProductController::class, 'update4'])->name('vendor.product.update4');
Route::post('/vendor/product/delete/{id}', [App\Http\Controllers\VendorProductController::class, 'destroy'])->name('vendor.product.destroy');
Route::get('/vendor/product/show', [App\Http\Controllers\VendorProductController::class, 'vendorProductShow'])->name('vendor.product.show');

Route::post('/vendor/product/variation-form', [App\Http\Controllers\VendorProductController::class, 'vendor_product_variation'])->name('product.variation-form');
Route::post('/vendor/product/variation-form2', [App\Http\Controllers\VendorProductController::class, 'vendorProductVariation2'])->name('product.variation-form2');

Route::post('/vendor/package/store', [App\Http\Controllers\VendorProductController::class, 'packageStore'])->name('vendor.package.store');
Route::post('/vendor/package/delete', [App\Http\Controllers\VendorProductController::class, 'deletePackage'])->name('vendor.package.delete');

Route::post('/vendor/variant/destroy', [App\Http\Controllers\ProductVariationController::class, 'destroy'])->name('vendor.variant.delete');


Route::get('/vendor/product/tutorial', [App\Http\Controllers\VendorProductController::class, 'vendorProductTutorial'])->name('vendor.product.tutorial');
Route::get('/review/replay', [App\Http\Controllers\VendorProductController::class, 'reviewReplay'])->name('review.replay');

Route::post('/vendor/product/edit/update-1/', [App\Http\Controllers\VendorProductController::class, 'editUpdate1'])->name('edit.update-1');
Route::post('/vendor/product/edit/update-2/', [App\Http\Controllers\VendorProductController::class, 'editUpdate2'])->name('edit.update-2');
Route::post('/vendor/product/edit/update-3/', [App\Http\Controllers\VendorProductController::class, 'editUpdate3'])->name('edit.update-3');
Route::post('/vendor/product/edit/update-4/', [App\Http\Controllers\VendorProductController::class, 'editServiceUpdate'])->name('edit.update-4');
Route::post('/vendor/product/edit/update4/', [App\Http\Controllers\VendorProductController::class, 'edit_update4'])->name('vendor.product.edit.update4');

// Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
// Route::post('/update', [App\Http\Controllers\ProfileController::class, 'profile_update'])->name('profile.update');
// Route::post('/change-password', [App\Http\Controllers\ProfileController::class, 'change_password'])->name('password.change');


// Affiliate Route
Route::post('/submit-affiliate-request', [App\Http\Controllers\PageController::class, 'affiliate_apply'])->name('affiliate.apply');

Route::get('/affiliate-dashboard', [App\Http\Controllers\PageController::class, 'affiliate_dashboard'])->name('customer.affiliate.dashboard');

Route::post('/payment-request', [App\Http\Controllers\PageController::class, 'payment_request'])->name('customer.payment.request');

// Affiliate Coupon Route
Route::post('/affiliate-coupon-store', [App\Http\Controllers\PageController::class, 'coupone_store'])->name('customer.coupon.store');
Route::post('/affiliate-coupon-update/{id}', [App\Http\Controllers\PageController::class, 'coupone_update'])->name('customer.coupon.update');
Route::post('/affiliate-coupon-delete/{id}', [App\Http\Controllers\PageController::class, 'coupone_delete'])->name('customer.coupon.destroy');


// Route::get('/test', function () {
// 	$json = '[{"variation_id":"1","values":["s","m"]},{"variation_id":"2","values":["Red","Green"]}]';
// 	return json_decode($json, true);
// });

Auth::routes();


// API Routes
Route::get('get-sub-category/{id}', function ($id){
    return json_encode(App\Models\Category::where('parent_id',$id)->where('is_active', 1)->get());
});
Route::post('/product-filter', [App\Http\Controllers\PageController::class, 'product_filter'])->name('product.filter');

Route::get('get-area/{id}', function ($id){
    return json_encode(App\Models\Area::where('district_id',$id)->get());
});

// API Routes End

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::group(['prefix' => '/home', 'middleware' => ['auth', 'verified']], function(){

    // Admin Routes
	Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
	    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('index');
	    Route::get('/create', [App\Http\Controllers\AdminController::class, 'create'])->name('create');
		Route::post('/store', [App\Http\Controllers\AdminController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit'])->name('edit');
		Route::get('/permission/{id}', [App\Http\Controllers\AdminController::class, 'permission'])->name('permission');
		Route::post('/update/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('destroy');
		//Sidebar manage
		Route::get('/sidebar/create', [App\Http\Controllers\SidebarController::class, 'create'])->name('sidebar.create');
		// Route::get('/sidebar/add', [App\Http\Controllers\SidebarController::class, 'addSidebar'])->name('sidebar.add');
		Route::post('/sidebar/store', [App\Http\Controllers\SidebarController::class, 'sidebarStore'])->name('sidebar.store');
	});

	Route::group(['prefix' => 'refund', 'as' => 'refund.'], function (){
	    Route::get('/', [\App\Http\Controllers\RefundController::class, 'index'])->name('index');
	    Route::get('/edit/{id}', [\App\Http\Controllers\RefundController::class, 'edit'])->name('edit');
	    Route::post('/update/{id}', [\App\Http\Controllers\RefundController::class, 'refund'])->name('update');
    });

	// Admin Routes
	Route::group(['prefix' => 'customer', 'as' => 'customer.'], function(){
	    Route::get('/', [App\Http\Controllers\AdminController::class, 'customer_index'])->name('index');
		Route::post('/destroy/{id}', [App\Http\Controllers\AdminController::class, 'customer_destroy'])->name('destroy');
	});

    // Category Routes
	Route::group(['prefix' => 'category', 'as' => 'category.'], function(){
	    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('index');
	    Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('create');
		Route::post('/stote', [App\Http\Controllers\CategoryController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('destroy');
	});

	Route::get('/attributes', [AttributesController::class, 'index'])->name('attributes');

    // Category Routes
    Route::group(['prefix' => 'color', 'as' => 'color.'], function(){
        Route::post('/stote', [ColorController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ColorController::class, 'edit'])->name('edit');
        Route::post('/update/', [ColorController::class, 'update'])->name('update');
        Route::delete('/destroy/', [ColorController::class, 'destroy'])->name('delete');
    });

    // Category Routes
    Route::group(['prefix' => 'size', 'as' => 'size.'], function(){
        Route::post('/stote', [SizeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SizeController::class, 'edit'])->name('edit');
        Route::post('/update/', [SizeController::class, 'update'])->name('update');
        Route::delete('/destroy/', [SizeController::class, 'destroy'])->name('delete');
    });

	// Offer Routes
	Route::group(['prefix' => 'offer', 'as' => 'offer.'], function(){
	    Route::get('/', [App\Http\Controllers\OfferController::class, 'index'])->name('index');
		Route::post('/stote', [App\Http\Controllers\OfferController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [App\Http\Controllers\OfferController::class, 'edit'])->name('edit');
		Route::post('/update/', [App\Http\Controllers\OfferController::class, 'update'])->name('update');
		Route::delete('/destroy/', [App\Http\Controllers\OfferController::class, 'destroy'])->name('destroy');
	});

	// Brand Routes
	Route::group(['prefix' => 'brand', 'as' => 'brand.'], function(){
	    Route::get('/', [App\Http\Controllers\BrandController::class, 'index'])->name('index');
		Route::post('/stote', [App\Http\Controllers\BrandController::class, 'store'])->name('store');
		Route::post('/update/{id}', [App\Http\Controllers\BrandController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\BrandController::class, 'destroy'])->name('destroy');
	});

	// Variation Routes
	Route::group(['prefix' => 'variation', 'as' => 'variation.'], function(){
	    Route::get('/', [App\Http\Controllers\VariationController::class, 'index'])->name('index');
	    Route::get('/create', [App\Http\Controllers\VariationController::class, 'create'])->name('create');
		Route::post('/stote', [App\Http\Controllers\VariationController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [App\Http\Controllers\VariationController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [App\Http\Controllers\VariationController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\VariationController::class, 'destroy'])->name('destroy');
	});

	// Product Routes
	Route::group(['prefix' => 'product', 'as' => 'product.'], function(){
	    Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
	    Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');
		Route::post('/stote', [App\Http\Controllers\ProductController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');

        Route::post('/stote-1', [App\Http\Controllers\ProductController::class, 'productStore'])->name('store-1');
        Route::post('/stote-2', [App\Http\Controllers\ProductController::class, 'productUpdate1'])->name('store-2');
        Route::post('/stote-3', [App\Http\Controllers\ProductController::class, 'productUpdate2'])->name('store-3');
        Route::post('/stote-4', [App\Http\Controllers\ProductController::class, 'productServiceUpdate'])->name('store-4');
        Route::post('/stote-5', [App\Http\Controllers\ProductController::class, 'productUpdate4'])->name('store-5');

        Route::post('/update-1', [App\Http\Controllers\ProductController::class, 'editUpdate1'])->name('update-1');
        Route::post('/update-2', [App\Http\Controllers\ProductController::class, 'editUpdate2'])->name('update-2');
        Route::post('/update-3', [App\Http\Controllers\ProductController::class, 'editServiceUpdate'])->name('update-3');
        Route::post('/update-4', [App\Http\Controllers\ProductController::class, 'edit_update4'])->name('update-4');

        Route::post('/variant-stote', [App\Http\Controllers\ProductController::class, 'variantStore'])->name('variant-store');

        Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');
        Route::post('/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');
		//vendor product request
		Route::get('/vendor/list', [App\Http\Controllers\ProductController::class, 'vendorlist'])->name('vendor.list');
		Route::get('/vendor/show/{id}/{slug}', [App\Http\Controllers\ProductController::class, 'vendorShow'])->name('vendor.show');
		Route::get('/vendor/request', [App\Http\Controllers\ProductController::class, 'productRequest'])->name('vendor.request');
		Route::get('/vendor/approved', [App\Http\Controllers\ProductController::class, 'productApprovedList'])->name('vendor.approved');
		Route::post('/vendor/product/approved/{id}', [App\Http\Controllers\ProductController::class, 'productApproved'])->name('vendor.update');
		Route::get('/catactive/{id}', [App\Http\Controllers\ProductController::class, 'Active'])->name('vendoractive');
        Route::get('/cat/deactive/{id}', [App\Http\Controllers\ProductController::class, 'Deactive'])->name('vendorDeactive');
		Route::get('/vendor/active/{id}', [App\Http\Controllers\ProductController::class, 'vendorActive'])->name('vendor.active');
        Route::get('/vendor/deactive/{id}', [App\Http\Controllers\ProductController::class, 'vendorDeactive'])->name('vendor.deactive');
	});

	// Order Routes
	Route::group(['prefix' => 'order', 'as' => 'order.'], function(){
	    Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('index');
	    Route::get('/status/{id}', [App\Http\Controllers\OrderController::class, 'orders_by_status'])->name('status.filter');
		Route::get('/ventor/status/{id}', [App\Http\Controllers\OrderController::class, 'orders_by_ventor_status'])->name('ventor.status.filter');
	    //Route::get('/create', [App\Http\Controllers\OrderController::class, 'create'])->name('create');
		Route::post('/stote', [App\Http\Controllers\OrderController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [App\Http\Controllers\OrderController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('destroy');
		Route::post('/change-status/{id}', [App\Http\Controllers\OrderController::class, 'change_status'])->name('status.change');
		Route::post('/change-payment-status/{id}', [App\Http\Controllers\OrderController::class, 'change_payment_status'])->name('payment.status.change');
		// Invoice route
		Route::get('/generate-invoice/{id}', [App\Http\Controllers\OrderController::class, 'generate_invoice'])->name('invoice.generate');

		// Report routes
		Route::get('/current-year', [App\Http\Controllers\OrderController::class, 'current_year'])->name('current.year');
		Route::get('/current-month', [App\Http\Controllers\OrderController::class, 'current_month'])->name('current.month');
		Route::get('/today', [App\Http\Controllers\OrderController::class, 'today'])->name('today');
		Route::get('/today-order', [App\Http\Controllers\OrderController::class, 'todayOrder'])->name('today.order');
		Route::get('/this-week-order', [App\Http\Controllers\OrderController::class, 'thisWeek'])->name('this-week');
		Route::get('/shipped-order', [App\Http\Controllers\OrderController::class, 'shipped'])->name('shipped');
		Route::get('/most-ordered', [App\Http\Controllers\OrderController::class, 'mostOrdered'])->name('most-ordered');
        Route::get('/order-overview', [App\Http\Controllers\OrderController::class, 'orderedOverView'])->name('order-view');
		Route::get('/search', [App\Http\Controllers\OrderController::class, 'search'])->name('search');
	});

	// Coupone Routes
	Route::group(['prefix' => 'coupon', 'as' => 'coupon.'], function(){
	    Route::get('/', [App\Http\Controllers\CouponController::class, 'index'])->name('index');
	    Route::get('/create', [App\Http\Controllers\CouponController::class, 'create'])->name('create');
		Route::post('/stote', [App\Http\Controllers\CouponController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [App\Http\Controllers\CouponController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [App\Http\Controllers\CouponController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\CouponController::class, 'destroy'])->name('destroy');

        Route::get('/tutorial', [App\Http\Controllers\CouponController::class, 'couponTutorial'])->name('tutorial');
	});
	// Coupone Routes
	Route::group(['prefix' => 'tutorial', 'as' => 'tutorial.'], function(){
	    Route::get('/', [App\Http\Controllers\TutorialController::class, 'index'])->name('index');
	    Route::get('/create', [App\Http\Controllers\TutorialController::class, 'create'])->name('create');
		Route::post('/stote', [App\Http\Controllers\TutorialController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [App\Http\Controllers\TutorialController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [App\Http\Controllers\TutorialController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\TutorialController::class, 'destroy'])->name('destroy');
	});

	// RegistrationPoint Routes
	Route::group(['prefix' => 'registration-point', 'as' => 'registration.point.'], function(){
	    Route::get('/', [App\Http\Controllers\RegistrationPointController::class, 'index'])->name('index');
	    Route::get('/create', [App\Http\Controllers\RegistrationPointController::class, 'create'])->name('create');
		Route::post('/stote', [App\Http\Controllers\RegistrationPointController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [App\Http\Controllers\RegistrationPointController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [App\Http\Controllers\RegistrationPointController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\RegistrationPointController::class, 'destroy'])->name('destroy');
	});

	// Slider Routes
	Route::group(['prefix' => 'slider', 'as' => 'slider.'], function(){
	    Route::get('/', [App\Http\Controllers\SliderController::class, 'index'])->name('index');
	    Route::get('/create', [App\Http\Controllers\SliderController::class, 'create'])->name('create');
		Route::post('/stote', [App\Http\Controllers\SliderController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [App\Http\Controllers\SliderController::class, 'edit'])->name('edit');
		Route::post('/update', [App\Http\Controllers\SliderController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\SliderController::class, 'destroy'])->name('destroy');
	});

	// Pages in Admin
	Route::group(['prefix' => 'page', 'as' => 'page.'], function(){

	    Route::get('/', [App\Http\Controllers\AdminPageController::class, 'index'])->name('index');
	    Route::get('/edit/{id}', [App\Http\Controllers\AdminPageController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [App\Http\Controllers\AdminPageController::class, 'update'])->name('update');
	});

	// Setting Routes
	Route::group(['prefix' => 'setting', 'as' => 'setting.'], function(){
	    Route::get('/', [App\Http\Controllers\SettingController::class, 'index'])->name('index');
		Route::post('/update/{id}', [App\Http\Controllers\SettingController::class, 'update'])->name('update');
		Route::get('/reward-point', [App\Http\Controllers\SettingController::class, 'reward_point'])->name('reward.point');
		Route::post('/reward-point/update/{id}', [App\Http\Controllers\SettingController::class, 'reward_point_update'])->name('reward.point.update');
	});

	// Affiliate Routes
	Route::group(['prefix' => 'affiliate', 'as' => 'affiliate.'], function(){
	    Route::get('/configuration', [App\Http\Controllers\SettingController::class, 'config'])->name('config');
	    Route::post('/config/update/{id}', [App\Http\Controllers\SettingController::class, 'config_update'])->name('config.update');
	    Route::get('/request', [App\Http\Controllers\SettingController::class, 'affiliate_request'])->name('request');
	    Route::get('/status/{id}/{status}', [App\Http\Controllers\SettingController::class, 'affiliate_status'])->name('status');
	    Route::get('/payment-request', [App\Http\Controllers\PaymentController::class, 'payment_request'])->name('payment.request');
	    Route::post('/payment-transfer/{id}', [App\Http\Controllers\PaymentController::class, 'payment_transfer'])->name('payment.transfer');
	    Route::post('/payment-reject/{id}', [App\Http\Controllers\PaymentController::class, 'payment_reject'])->name('payment.reject');
	});

	// Referral Link Generate
	Route::group(['prefix' => 'referral-link', 'as' => 'referral.link.'], function(){

	    Route::get('/', [App\Http\Controllers\SettingController::class, 'referral_link'])->name('index');
	});

	// Profile Routes
	Route::group(['prefix' => 'profile', 'as' => 'user.'], function(){

	    Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
	    Route::post('/update', [App\Http\Controllers\ProfileController::class, 'profile_update'])->name('profile.update');
	    Route::post('/change-password', [App\Http\Controllers\ProfileController::class, 'change_password'])->name('password.change');
	});

	//Subscribers in admin
	Route::get('/subscribers', [App\Http\Controllers\SubscriberController::class, 'index'])->name('admin.subscribers');

	// Gallery Routes
	Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function(){
	    Route::get('/', [App\Http\Controllers\GalleryController::class, 'index'])->name('index');
		Route::post('/stote', [App\Http\Controllers\GalleryController::class, 'store'])->name('store');
		Route::post('/destroy/{id}', [App\Http\Controllers\GalleryController::class, 'destroy'])->name('destroy');
	});

	// District Routes
	Route::group(['prefix' => 'district', 'as' => 'district.'], function(){
	    Route::get('/', [App\Http\Controllers\DistrictController::class, 'index'])->name('index');
		Route::post('/stote', [App\Http\Controllers\DistrictController::class, 'store'])->name('store');
		Route::post('/update/{id}', [App\Http\Controllers\DistrictController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\DistrictController::class, 'destroy'])->name('destroy');
	});

	// Area Routes
	Route::group(['prefix' => 'area', 'as' => 'area.'], function(){
	    Route::get('/', [App\Http\Controllers\AreaController::class, 'index'])->name('index');
		Route::post('/stote', [App\Http\Controllers\AreaController::class, 'store'])->name('store');
		Route::post('/update/{id}', [App\Http\Controllers\AreaController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [App\Http\Controllers\AreaController::class, 'destroy'])->name('destroy');
	});

});
