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

            Route::get('contents/', 'ContentController@index');
            Route::put('contents/{contentId}', 'ContentController@update');
            Route::delete('contents/{contentId}', 'ContentController@destroy');
            Route::post('contents/{contentId}/publish', 'ContentController@publish');
            Route::post('contents/{contentId}/metas', 'ContentMetaController@createMeta');
            Route::put('contents/{contentId}/metas', 'ContentMetaController@updateMeta');
            Route::put('contents/{contentId}/metas/sync', 'ContentMetaController@syncMetas');
            Route::put('contents/{contentId}/metas/attach', 'ContentMetaController@attachMetas');
            Route::put('contents/{contentId}/metas/detach', 'ContentMetaController@detachMetas');
            Route::delete('contents/{contentId}/metas', 'ContentMetaController@deleteMeta');
            Route::post('/contents/{contentId}/medias', 'ContentController@attachMedias');
            Route::post('/contents/{contentId}/medias/delete', 'ContentController@detachMedias');
            Route::post('/contents/{contentId}/doc', 'ContentController@attachDoc');

            Route::prefix('users')->group(function () {
                Route::get('', 'UserController@index')->name('ajax.users.index');
                Route::post('', 'UserController@store')->name('ajax.users.store');
                Route::put('{user}', 'UserController@update')->name('ajax.users.update');
                Route::delete('{user}', 'UserController@destroy')->name('ajax.users.destroy');
            });
        });
    });
});

Route::prefix('ajax')->group(function () {
    Route::namespace('Ajax')->group(function () {
        Route::post('contents/', 'ContentController@store')->name('ajax.contents.store');
    });
});
Route::get('/', [
    'uses' => 'PublicController@homepage',
    'as' => 'home',
]);
Route::any('{uri}', [
    'uses' => 'PublicController@uri',
    'as' => 'page',
])->where('uri', '.*');
