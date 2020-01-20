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
Route::middleware(['auth'])->group(function () {
    Route::prefix('ajax')->group(function () {
        Route::namespace('Ajax')->group(function () {

            Route::resource('transactions', 'TransactionController')->names([
                'store' => 'ajax.modules.payment.transactions.store',
                'update' => 'ajax.modules.payment.transactions.update',
                'destroy' => 'ajax.modules.payment.transactions.destroy'
            ]);
        });
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin/modules')->group(function () {
        Route::namespace('Admin')->group(function () {

            Route::prefix('payment')->group(function () {
                Route::resource('payment_methods', 'PaymentMethodController')->names([
                    'index' => 'admin.modules.payment.payment_methods.index',
                    'create' => 'admin.modules.payment.payment_methods.create',
                    'store' => 'admin.modules.payment.payment_methods.store',
                    'show' => 'admin.modules.payment.payment_methods.show',
                    'edit' => 'admin.modules.payment.payment_methods.edit',
                    'update' => 'admin.modules.payment.payment_methods.update',
                    'destroy' => 'admin.modules.payment.payment_methods.destroy'
                ]);
                Route::resource('transactions', 'TransactionController')->names([
                    'index' => 'admin.modules.payment.transactions.index',
                    'create' => 'admin.modules.payment.transactions.create',
                    'store' => 'admin.modules.payment.transactions.store',
                    'show' => 'admin.modules.payment.transactions.show',
                    'edit' => 'admin.modules.payment.transactions.edit',
                    'update' => 'admin.modules.payment.transactions.update',
                    'destroy' => 'admin.modules.payment.transactions.destroy'
                ]);
            });
        });
    });
});
