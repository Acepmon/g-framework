<?php

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

Route::prefix('ajax')->group(function () {
    Route::namespace('Ajax')->group(function () {

        Route::get('/cars/count', 'CarController@count');
        Route::get('/cars/filter', 'CarController@filter');
        Route::get('/cars/taxonomy/{taxonomy}', 'CarController@getTaxonomy');

        Route::get('/cars/leasing', 'CarController@leasing');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::prefix('ajax')->group(function () {
        Route::namespace('Ajax')->group(function () {

            Route::get('/user/interested_cars', 'InterestedCarController@interestedCars');
            Route::get('/user/interested_cars/{contentId}', 'InterestedCarController@interestedCar');
            Route::post('/user/interested_cars', 'InterestedCarController@createInterested');
            Route::delete('/user/interested_cars', 'InterestedCarController@removeInterested');
            Route::put('/user/interested_cars', 'InterestedCarController@toggleInterested');

        });
    });
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin/modules')->group(function () {
        Route::namespace('Admin')->group(function () {

            Route::resource('car/wishlist', 'CarWishlistController')->names([
                'index' => 'admin.modules.car.wishlist.index',
                'create' => 'admin.modules.car.wishlist.create',
                'store' => 'admin.modules.car.wishlist.store',
                'show' => 'admin.modules.car.wishlist.show',
                'edit' => 'admin.modules.car.wishlist.edit',
                'update' => 'admin.modules.car.wishlist.update',
                'destroy' => 'admin.modules.car.wishlist.destroy'
            ]);
            Route::resource('car/auction', 'CarAuctionController')->names([
                'index' => 'admin.modules.car.auction.index',
                'create' => 'admin.modules.car.auction.create',
                'store' => 'admin.modules.car.auction.store',
                'show' => 'admin.modules.car.auction.show',
                'edit' => 'admin.modules.car.auction.edit',
                'update' => 'admin.modules.car.auction.update',
                'destroy' => 'admin.modules.car.auction.destroy'
            ]);
            Route::resource('car/options', 'CarOptionController')->names([
                'index' => 'admin.modules.car.options.index',
                'create' => 'admin.modules.car.options.create',
                'store' => 'admin.modules.car.options.store',
                'show' => 'admin.modules.car.options.show',
                'edit' => 'admin.modules.car.options.edit',
                'update' => 'admin.modules.car.options.update',
                'destroy' => 'admin.modules.car.options.destroy'
            ]);
            Route::resource('car/loan-check', 'CarLoanCheckController')->names([
                'index' => 'admin.modules.car.loancheck.index',
                'create' => 'admin.modules.car.loancheck.create',
                'store' => 'admin.modules.car.loancheck.store',
                'show' => 'admin.modules.car.loancheck.show',
                'edit' => 'admin.modules.car.loancheck.edit',
                'update' => 'admin.modules.car.loancheck.update',
                'destroy' => 'admin.modules.car.loancheck.destroy'
            ]);
            Route::resource('car/verifications', 'CarVerificationController')->names([
                'index' => 'admin.modules.car.verifications.index',
                'create' => 'admin.modules.car.verifications.create',
                'store' => 'admin.modules.car.verifications.store',
                'show' => 'admin.modules.car.verifications.show',
                'edit' => 'admin.modules.car.verifications.edit',
                'update' => 'admin.modules.car.verifications.update',
                'destroy' => 'admin.modules.car.verifications.destroy'
            ]);
            Route::resource('car/free', 'CarFreeController')->names([
                'index' => 'admin.modules.car.free.index',
                'create' => 'admin.modules.car.free.create',
                'store' => 'admin.modules.car.free.store',
                'show' => 'admin.modules.car.free.show',
                'edit' => 'admin.modules.car.free.edit',
                'update' => 'admin.modules.car.free.update',
                'destroy' => 'admin.modules.car.free.destroy'
            ]);
            Route::resource('car/premium', 'CarPremiumController')->names([
                'index' => 'admin.modules.car.premium.index',
                'create' => 'admin.modules.car.premium.create',
                'store' => 'admin.modules.car.premium.store',
                'show' => 'admin.modules.car.premium.show',
                'edit' => 'admin.modules.car.premium.edit',
                'update' => 'admin.modules.car.premium.update',
                'destroy' => 'admin.modules.car.premium.destroy'
            ]);
            Route::resource('car/best_premium', 'CarBestPremiumController')->names([
                'index' => 'admin.modules.car.best_premium.index',
                'create' => 'admin.modules.car.best_premium.create',
                'store' => 'admin.modules.car.best_premium.store',
                'show' => 'admin.modules.car.best_premium.show',
                'edit' => 'admin.modules.car.best_premium.edit',
                'update' => 'admin.modules.car.best_premium.update',
                'destroy' => 'admin.modules.car.best_premium.destroy'
            ]);
            Route::resource('car', 'CarController')->names([
                'index' => 'admin.modules.car.index',
                'create' => 'admin.modules.car.create',
                'store' => 'admin.modules.car.store',
                'show' => 'admin.modules.car.show',
                'edit' => 'admin.modules.car.edit',
                'update' => 'admin.modules.car.update',
                'destroy' => 'admin.modules.car.destroy'
            ]);

        });
    });
});
