<?php

use Illuminate\Http\Request;

use Modules\System\Transformers\User as UserResource;
use Modules\System\Transformers\UserNotificationCollection;
use Modules\System\Transformers\UserGroupCollection;
use Modules\System\Transformers\UserMenuCollection;
use Modules\System\Transformers\UserCommentCollection;
use Modules\System\Transformers\UserContentCollection;

use App\Entities\ContentManager;
use App\UserMeta;

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

// Private API
Route::prefix('v1')->group(function () {
    Route::namespace('API\v1')->group(function () {
        Route::get('user/{id}', 'UserController@show');
        
        Route::get('/user', function (Request $request) {
            return new UserResource($request->input);
        });

        Route::middleware('auth:api')->group(function () {

            Route::get('/user', function () {
                return new UserResource(Auth::user());
            });

            Route::put('/user', function (Request $request) {
                $user = Auth::user();

                if ($request->has('username')) {
                    $user->username = $request->input('username');
                    $user->save();
                }

                if ($request->has('email')) {
                    $user->email = $request->input('email');
                    $user->save();
                }

                if ($request->has('name')) {
                    $user->name = $request->input('name');
                    $user->save();
                }

                if ($request->has('password')) {
                    $user->password = Hash::make($request->input('password'));
                    $user->save();
                }

                if ($request->has('language')) {
                    $user->language = $request->input('language');
                    $user->save();
                }

                if ($request->has('social_id') && $request->has('social_provider') && $request->has('social_token')) {
                    $user->social_id = $request->input('social_id');
                    $user->social_provider = $request->input('social_provider');
                    $user->social_token = $request->input('social_token');
                    $user->save();
                }

                $except = ['username', 'email', 'name', 'password', 'password_confirmation', 'emailVerifiedAt', 'password', 'language', 'avatar', 'group', 'social_id', 'social_provider', 'social_token', 'remember_token', '_token'];
                $except = array_filter($request->input(), function ($key) use ($except) {
                    return !in_array($key, $except);
                }, ARRAY_FILTER_USE_KEY);
                foreach ($except as $index=>$value) {
                    $meta = UserMeta::where('key', $index)->where('user_id', $user->id)->first();

                    if (isset($value) && $meta == null) {
                        $meta = new UserMeta();
                        $meta->key = $index;
                        $meta->user_id = $user->id;
                        $meta->value = $value;
                        $meta->save();
                    } else if (!isset($value) && $meta != null) {
                        $meta->delete();
                    } else {
                        $meta->value = $value;
                        $meta->save();
                    }
                }

                return new UserResource($user);
            });

            Route::get('/user/notifications', 'NotificationController@userAll');

            Route::get('/user/notifications/unread', 'NotificationController@userUnread');

            Route::post('/user/notifications/read', 'NotificationController@userRead');

            Route::get('/user/groups', function () {
                return new UserGroupCollection(Auth::user()->groups);
            });

            Route::get('/user/menus', function () {
                return new UserMenuCollection(Auth::user()->menus);
            });

            Route::get('/user/comments', function () {
                return new UserCommentCollection(Auth::user()->comments);
            });

            Route::get('/user/contents', function () {
                $authUser = Auth::user();
                $contents = ContentManager::serializeRequest(request(), $authUser->id);

                $contents->getCollection()->transform(function ($content) use ($authUser) {
                    if (isset($authUser)) {
                        $interested = $authUser->metas()->where('key', 'interestedCars')->where('value', $content->id)->count();
                        return ContentManager::contentToArray($content, [
                            "authInterested" => $interested ? true : false,
                        ]);
                    } else {
                        return ContentManager::contentToArray($content);
                    }
                });

                return response()->json($contents);
            });

            Route::post('/user/avatar', 'UserController@attachAvatar');
        });
    });
});
