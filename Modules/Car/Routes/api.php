<?php

use Illuminate\Http\Request;

use Modules\Car\Transformers\InterestedCars as InterestedCarsCollection;

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

Route::prefix('v1')->group(function () {
    Route::namespace('API\v1')->group(function () {
        Route::middleware('auth:api')->group(function () {

            Route::get('/user/interested_cars', 'InterestedCarController@interestedCars');
            Route::get('/user/interested_cars/{contentId}', 'InterestedCarController@interestedCar');
            Route::post('/user/interested_cars', 'InterestedCarController@createInterested');
            Route::delete('/user/interested_cars', 'InterestedCarController@removeInterested');
            Route::put('/user/interested_cars', 'InterestedCarController@toggleInterested');

            Route::post('/car/{car}/metas', 'CarController@syncMetas');
            Route::post('/car/{car}/medias', 'CarController@attachMedias');
            Route::post('/car/{car}/doc', 'CarController@attachDoc');
            Route::apiResources([
                'car' => 'CarController',
            ]);
        });
    });
});
