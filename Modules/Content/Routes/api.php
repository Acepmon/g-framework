<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/content', function (Request $request) {
//     return $request->user();
// });

// Public API
Route::prefix('v1')->group(function () {
    Route::namespace('API\v1')->group(function () {
        Route::post('/car/{contentId}/publish', 'ContentController@publish');
        Route::apiResources([
            'banner_locations' => 'BannerLocationController',
            'banners' => 'BannerController',
            'contents' => 'ContentController'
        ]);

        Route::get('taxonomies', 'TaxonomyController@index');
        Route::get('taxonomies/{taxonomy}', 'TaxonomyController@show');
    });
});
