<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminProductCoverController;
use App\Http\Controllers\AdminProductImageController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderSuccessController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\UserProfileController;
use App\Http\Livewire\AdminOrderProducts;
use App\Http\Livewire\Dashboard;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;


//\DB::listen(function ($query){
//    logger($query->sql);
//    logger($query->bindings);
//});


Route::get('/', function () {
    return view('home.index');
})->name('home');

require __DIR__.'/auth.php';

Route::get('/products', [ProductsController::class,'index'])->name('product.index');
Route::get('/products/{slug}', [ProductsController::class,'show'])->name('product.show');


Route::middleware(['auth',])->group(function () {

    Route::get('/user/profile', [UserProfileController::class,'show'])->name('user.profile.show');
    Route::resource('/address', AddressController::class);

    Route::get('/shopping-carts', [ShoppingCartController::class,'index'])->name('shoppingCart.index');
    Route::get('/orders', [OrderController::class,'index'])->name('order.index');
    Route::get('/orders/success', [OrderSuccessController::class,'store'])
        ->name('order.success')
        ->middleware(['valid.payment.vendor', 'validate.paypal.redirect']);


    Route::middleware(['must.have.cart',])->group(function () {

        Route::get('/checkout', [CheckOutController::class,'index'])->name('checkout.index')->middleware('has.address');
        Route::post('/charge', [ChargeController::class,'store'])->name('charge.store');

    });

});



Route::name('admin.')->middleware(['auth', 'admin.only'])->group(function () {


    Route::get('/admin/category', AdminCategoryController::class)->name('category.index');
    Route::resource('/admin/product', AdminProductController::class);
    Route::get('/admin/product/{id}/cover/edit', AdminProductCoverController::class)->name('product.cover.edit');
    Route::get('/admin/product/{id}/image/edit', AdminProductImageController::class)->name('product.image.edit');
    Route::get('/admin/user', [AdminUserController::class,'index'])->name('user.index');
    Route::get('/admin/user/{id}', [AdminUserController::class,'edit'])->name('user.edit');

    Route::get('/admin/order', [AdminOrderController::class,'index'])->name('order.index');
    Route::get('/admin/order/products', AdminOrderProducts::class)->name('order.product.index');



    Route::get('/dashboard', Dashboard::class)->name('dashboard');

});


Route::any('/stripe/webhook', function () {

//    whsec_eDgXpSVIMYNbC6Hjdtf552fk4g6qEhtZ
    logger('stripe webhook');
    logger(request()->all());
//    return view('dashboard');
});

Route::get('/test/queue', function ( ) {

    Bus::dispatch(New \App\Jobs\test());
});

Route::get('/test', function ( ) {

    return "testing deployment with bash script";

});


//buyer account
//sb-ecm791616497@personal.example.com
//Svm4@5]H
//
//
//seller account
//sb-ye947u1618056@business.example.com
//F{98|i&O


//seller account hello world
//sb-u43qid1616566@personal.example.com
//asdf1234
