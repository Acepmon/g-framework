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

if (!file_exists(base_path('.env')) && config('app.env_install')) {
    \Artisan::call('env:install');
}

Route::get('redirect/{driver}', 'Auth\RegisterController@redirectToProvider')->name('login.provider')->where('driver', 'google|facebook');
Route::get('callback/{driver}', 'Auth\RegisterController@handleProviderCallback')->name('login.callback')->where('driver', 'google|facebook');

Route::middleware(['installed'])->group(function () {

    Route::middleware(['auth'])->group(function () {
        Route::prefix('ajax')->group(function () {
            Route::namespace('Ajax')->group(function () {

                Route::apiResource('users', 'UserController')->names([
                    'index' => 'ajax.users.index',
                    'store' => 'ajax.users.store',
                    'show' => 'ajax.users.show',
                    'update' => 'ajax.users.update',
                    'destroy' => 'ajax.users.destroy'
                ]);

                Route::apiResource('contents', 'ContentController')->names([
                    'index' => 'ajax.contents.index',
                    'store' => 'ajax.contents.store',
                    'show' => 'ajax.contents.show',
                    'update' => 'ajax.contents.update',
                    'destroy' => 'ajax.contents.destroy'
                ]);

            });
        });
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::namespace('Admin')->group(function () {
                Route::get('/', function () {
                    return redirect()->route('admin.dashboard');
                });

                Route::get('ajax/logs/list', 'LogController@ajaxLogsList')->name('admin.ajax.logs.list');
                Route::get('ajax/logs/{id}', 'LogController@ajaxLogDetails')->name('admin.ajax.logs.details');

                Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
                Route::get('changelog', 'ChangelogController@index')->name('admin.changelog.index');

                Route::get('install','PluginController@installPlugin')->name('admin.plugins.install');
                Route::get('installTheme','ThemeController@installTheme')->name('admin.themes.install');

                Route::get('databaseRestore','BackupController@databaseRestore')->name('admin.backups.databaseRestore');

                Route::get('/menus/tree', 'MenuController@tree')->name('admin.menus.tree');
                Route::put('/menus/tree', 'MenuController@updateTree')->name('admin.menus.tree.update');

                Route::prefix('profile')->group(function () {
                    Route::get('/', 'ProfileController@index')->name('admin.profile.index');
                    Route::put('/', 'ProfileController@update')->name('admin.profile.update');
                    Route::get('contents', 'ProfileController@contents')->name('admin.profile.contents.index');
                    Route::get('permissions', 'ProfileController@permissions')->name('admin.profile.permissions.index');
                    Route::get('notifications', 'ProfileController@notifications')->name('admin.profile.notifications.index');
                    Route::get('notifications/read', 'ProfileController@readNotifications')->name('admin.profile.notifications.read');
                    Route::get('edit', 'ProfileController@edit')->name('admin.profile.edit');
                });

                Route::prefix('configs')->group(function () {
                    Route::get('', 'ConfigController@index')->name('admin.configs.index');
                    Route::get('maintenance', 'ConfigController@maintenance')->name('admin.configs.maintenance');
                    Route::post('maintenance', 'ConfigController@setMaintenance')->name('admin.configs.maintenance.set');
                    Route::get('base', 'ConfigController@base')->name('admin.configs.base');
                    Route::put('base', 'ConfigController@updateBase')->name('admin.configs.base.update');
                });

                Route::prefix('logs')->group(function () {
                    Route::get('/', 'LogController@reader')->name('admin.logs.index');
                    Route::get('/downloadAll', 'LogController@downloadAll')->name('admin.logs.downloadAll');
                    Route::delete('/', 'LogController@deleteAll')->name('admin.logs.deleteAll');
                    Route::delete('{log}', 'LogController@delete')->name('admin.logs.delete');
                });

                Route::prefix('media')->group(function () {
                    Route::get('/', 'MediaController@index')->name('admin.media.index');
                    Route::get('medias', 'MediaController@medias')->name('admin.media.medias');
                    Route::get('avatars', 'MediaController@avatars')->name('admin.media.avatars');
                    Route::delete('delete', 'MediaController@delete')->name('admin.media.delete');
                    Route::get('thumbnails', 'MediaController@thumbnails')->name('admin.media.thumbnails');
                    Route::get('assets', 'MediaController@assets')->name('admin.media.assets');
                    Route::get('upload', 'MediaController@upload')->name('admin.media.upload');
                });

                Route::resource('menus', 'MenuController')->names([
                    'index' => 'admin.menus.index',
                    'create' => 'admin.menus.create',
                    'store' => 'admin.menus.store',
                    'show' => 'admin.menus.show',
                    'edit' => 'admin.menus.edit',
                    'update' => 'admin.menus.update',
                    'destroy' => 'admin.menus.destroy',
                ]);
                Route::get('/users/administrators', 'UserController@administrators')->name('admin.users.administrators');
                Route::get('/users/operators', 'UserController@operators')->name('admin.users.operators');
                Route::resource('users', 'UserController')->names([
                    'index' => 'admin.users.index',
                    'create' => 'admin.users.create',
                    'store' => 'admin.users.store',
                    'show' => 'admin.users.show',
                    'edit' => 'admin.users.edit',
                    'update' => 'admin.users.update',
                    'destroy' => 'admin.users.destroy'
                ]);
                Route::resource('permissions', 'PermissionController')->names([
                    'index' => 'admin.permissions.index',
                    'create' => 'admin.permissions.create',
                    'store' => 'admin.permissions.store',
                    'show' => 'admin.permissions.show',
                    'edit' => 'admin.permissions.edit',
                    'update' => 'admin.permissions.update',
                    'destroy' => 'admin.permissions.destroy'
                ]);
                Route::resource('backups', 'BackupController')->names([
                    'index' => 'admin.backups.index',
                    'create' => 'admin.backups.create',
                    'store' => 'admin.backups.store',
                    'show' => 'admin.backups.show',
                    'edit' => 'admin.backups.edit',
                    'update' => 'admin.backups.update',
                    'destroy' => 'admin.backups.destroy'
                ]);
                Route::resource('plugins', 'PluginController')->names([
                    'index' => 'admin.plugins.index',
                    'create' => 'admin.plugins.create',
                    'store' => 'admin.plugins.store',
                    'show' => 'admin.plugins.show',
                    'edit' => 'admin.plugins.edit',
                    'update' => 'admin.plugins.update',
                    'destroy' => 'admin.plugins.destroy'
                ]);
                Route::get('themes/{id}/layouts/{name}', 'ThemeController@editLayout')->name('admin.themes.layouts.edit');
                Route::put('themes/{id}/layouts/{name}', 'ThemeController@updateLayout')->name('admin.themes.layouts.update');
                Route::get('themes/{id}/includes/{name}', 'ThemeController@editInclude')->name('admin.themes.includes.edit');
                Route::put('themes/{id}/includes/{name}', 'ThemeController@updateInclude')->name('admin.themes.includes.update');
                Route::resource('themes', 'ThemeController')->names([
                    'index' => 'admin.themes.index',
                    'create' => 'admin.themes.create',
                    'store' => 'admin.themes.store',
                    'show' => 'admin.themes.show',
                    'edit' => 'admin.themes.edit',
                    'update' => 'admin.themes.update',
                    'destroy' => 'admin.themes.destroy'
                ]);

                Route::post('plugins/{plugin}/activate', 'PluginController@activate')->name('admin.plugins.activate');
                Route::post('plugins/{plugin}/deactivate', 'PluginController@deactivate')->name('admin.plugins.deactivate');
                Route::post('themes/{theme}/activate', 'ThemeController@activate')->name('admin.themes.activate');
                Route::post('themes/{theme}/deactivate', 'ThemeController@deactivate')->name('admin.themes.deactivate');
                Route::resource('groups', 'GroupController')->names([
                    'index' => 'admin.groups.index',
                    'create' => 'admin.groups.create',
                    'store' => 'admin.groups.store',
                    'show' => 'admin.groups.show',
                    'edit' => 'admin.groups.edit',
                    'update' => 'admin.groups.update',
                    'destroy' => 'admin.groups.destroy'
                ]);

                Route::get('/groups/{group}/menus/showMenuGroup', 'GroupController@showMenuGroup')->name('admin.groups.showMenuGroup');
                Route::get('/groups/{group}/menus/createMenu/{menu}', 'GroupController@createMenu')->name('admin.groups.createMenu');
                Route::get('/groups/{group}/menus/removeMenu/{menu}', 'GroupController@removeMenu')->name('admin.groups.removeMenu');

                Route::get('/groups/{group}/users/showUserGroup', 'GroupController@showUserGroup')->name('admin.groups.showUserGroup');
                Route::get('/groups/{group}/users/createUser/{user}', 'GroupController@createUser')->name('admin.groups.createUser');
                Route::get('/groups/{group}/users/removeUser/{user}', 'GroupController@removeUser')->name('admin.groups.removeUser');

                Route::get('/groups/{group}/permissions/showPermissionGroup', 'GroupController@showPermissionGroup')->name('admin.groups.showPermissionGroup');
                Route::get('/groups/{group}/permissions/createPermission/{permission}', 'GroupController@createPermission')->name('admin.groups.createPermission');
                Route::get('/groups/{group}/permissions/removePermission/{permission}', 'GroupController@removePermission')->name('admin.groups.removePermission');

                Route::resource('contents', 'ContentController')->names([
                    'index' => 'admin.contents.index',
                    'create' => 'admin.contents.create',
                    'store' => 'admin.contents.store',
                    'show' => 'admin.contents.show',
                    'edit' => 'admin.contents.edit',
                    'update' => 'admin.contents.update',
                    'destroy' => 'admin.contents.destroy'
                ]);
                Route::resource('cars/options', 'CarOptionController')->names([
                    'index' => 'admin.cars.options.index',
                    'create' => 'admin.cars.options.create',
                    'store' => 'admin.cars.options.store',
                    'show' => 'admin.cars.options.show',
                    'edit' => 'admin.cars.options.edit',
                    'update' => 'admin.cars.options.update',
                    'destroy' => 'admin.cars.options.destroy'
                ]);
                Route::resource('cars', 'CarController')->names([
                    'index' => 'admin.cars.index',
                    'create' => 'admin.cars.create',
                    'store' => 'admin.cars.store',
                    'show' => 'admin.cars.show',
                    'edit' => 'admin.cars.edit',
                    'update' => 'admin.cars.update',
                    'destroy' => 'admin.cars.destroy'
                ]);
                Route::resource('banners/locations', 'BannerLocationController')->names([
                    'index' => 'admin.banners.locations.index',
                    'create' => 'admin.banners.locations.create',
                    'store' => 'admin.banners.locations.store',
                    'show' => 'admin.banners.locations.show',
                    'edit' => 'admin.banners.locations.edit',
                    'update' => 'admin.banners.locations.update',
                    'destroy' => 'admin.banners.locations.destroy'
                ]);
                Route::resource('banners', 'BannerController')->names([
                    'index' => 'admin.banners.index',
                    'create' => 'admin.banners.create',
                    'store' => 'admin.banners.store',
                    'show' => 'admin.banners.show',
                    'edit' => 'admin.banners.edit',
                    'update' => 'admin.banners.update',
                    'destroy' => 'admin.banners.destroy'
                ]);
                Route::get('/contents/{id}/revisions/{revision}/revert', 'ContentController@revert')->name('admin.contents.revisions.revert');
                Route::get('/contents/{id}/revisions/{revision}', 'ContentController@viewRevision')->name('admin.contents.revisions.show');
                Route::put('/contents/{id}/revisions', 'ContentController@updateRevision')->name('admin.contents.revisions.update');
                Route::resource('comments', 'CommentController')->names([
                    'index' => 'admin.comments.index',
                    'create' => 'admin.comments.create',
                    'store' => 'admin.comments.store',
                    'show' => 'admin.comments.show',
                    'edit' => 'admin.comments.edit',
                    'update' => 'admin.comments.update',
                    'destroy' => 'admin.comments.destroy'
                ]);
                Route::resource('taxonomy', 'TaxonomyController')->names([
                    'index' => 'admin.taxonomy.index',
                    'create' => 'admin.taxonomy.create',
                    'store' => 'admin.taxonomy.store',
                    'show' => 'admin.taxonomy.show',
                    'edit' => 'admin.taxonomy.edit',
                    'update' => 'admin.taxonomy.update',
                    'destroy' => 'admin.taxonomy.destroy'
                ]);

                Route::get('/contents/{content}/metas', 'ContentMetaController@index')->name('admin.contents.metas.index');
                Route::get('/contents/{content}/metas/create', 'ContentMetaController@create')->name('admin.contents.metas.create');
                Route::post('/contents/{content}/metas', 'ContentMetaController@store')->name('admin.contents.metas.store');
                Route::get('/contents/{content}/metas/{meta}/edit', 'ContentMetaController@edit')->name('admin.contents.metas.edit');
                Route::put('/contents/{content}/metas/{meta}', 'ContentMetaController@update')->name('admin.contents.metas.update');
                Route::delete('/contents/{content}/metas/{meta}', 'ContentMetaController@destroy')->name('admin.contents.metas.destroy');

                // Route::get('/cars/{car}/metas', 'CarMetaController@index')->name('admin.cars.metas.index');
                // Route::get('/cars/{car}/metas/create', 'CarMetaController@create')->name('admin.cars.metas.create');
                // Route::post('/cars/{car}/metas', 'CarMetaController@store')->name('admin.cars.metas.store');
                // Route::get('/cars/{car}/metas/{meta}/edit', 'CarMetaController@edit')->name('admin.cars.metas.edit');
                // Route::put('/cars/{car}/metas/{meta}', 'CarMetaController@update')->name('admin.cars.metas.update');
                // Route::delete('/cars/{car}/metas/{meta}', 'CarMetaController@destroy')->name('admin.cars.metas.destroy');

                Route::get('/comments/{comment}/metas', 'CommentMetaController@index')->name('admin.comments.metas.index');
                Route::get('/comments/{comment}/metas/create', 'CommentMetaController@create')->name('admin.comments.metas.create');
                Route::post('/comments/{comment}/metas', 'CommentMetaController@store')->name('admin.comments.metas.store');
                Route::get('/comments/{comment}/metas/{meta}/edit', 'CommentMetaController@edit')->name('admin.comments.metas.edit');
                Route::put('/comments/{comment}/metas/{meta}', 'CommentMetaController@update')->name('admin.comments.metas.update');
                Route::delete('/comments/{comment}/metas/{meta}', 'CommentMetaController@destroy')->name('admin.comments.metas.destroy');

                Route::get('/taxonomy/{taxonomy}/metas', 'TermMetaController@index')->name('admin.taxonomy.metas.index');
                Route::get('/taxonomy/{taxonomy}/metas/create', 'TermMetaController@create')->name('admin.taxonomy.metas.create');
                Route::post('/taxonomy/{taxonomy}/metas', 'TermMetaController@store')->name('admin.taxonomy.metas.store');
                Route::get('/taxonomy/{taxonomy}/metas/{meta}/edit', 'TermMetaController@edit')->name('admin.taxonomy.metas.edit');
                Route::put('/taxonomy/{taxonomy}/metas/{meta}', 'TermMetaController@update')->name('admin.taxonomy.metas.update');
                Route::delete('/taxonomy/{taxonomy}/metas/{meta}', 'TermMetaController@destroy')->name('admin.taxonomy.metas.destroy');

                Route::get('/users/{user}/permissions', 'UserPermissionController@index')->name('admin.users.permissions.index');
                Route::get('/users/{user}/permissions/create', 'UserPermissionController@create')->name('admin.users.permissions.create');
                Route::post('/users/{user}/permissions', 'UserPermissionController@store')->name('admin.users.permissions.store');
                Route::get('/users/{user}/permissions/{permission}/edit', 'UserPermissionController@edit')->name('admin.users.permissions.edit');
                Route::put('/users/{user}/permissions/{permission}', 'UserPermissionController@update')->name('admin.users.permissions.update');
                Route::delete('/users/{user}/permissions/{permission}', 'UserPermissionController@destroy')->name('admin.users.permissions.destroy');

                Route::get('/users/{user}/groups', 'UserGroupController@index')->name('admin.users.groups.index');
                Route::get('/users/{user}/groups/create', 'UserGroupController@create')->name('admin.users.groups.create');
                Route::post('/users/{user}/groups', 'UserGroupController@store')->name('admin.users.groups.store');
                Route::get('/users/{user}/groups/{group}/edit', 'UserGroupController@edit')->name('admin.users.groups.edit');
                Route::put('/users/{user}/groups/{group}', 'UserGroupController@update')->name('admin.users.groups.update');
                Route::delete('/users/{user}/groups/{group}', 'UserGroupController@destroy')->name('admin.users.groups.destroy');

                Route::get('/users/{user}/contents', 'UserContentController@index')->name('admin.users.contents.index');
                Route::get('/users/{user}/contents/{content}', 'UserContentController@show')->name('admin.users.contents.show');

                Route::resource('localizations', 'LocalizationController')->names([
                    'index' => 'admin.localizations.index',
                    'create' => 'admin.localizations.create',
                    'store' => 'admin.localizations.store',
                    'show' => 'admin.localizations.show',
                    'edit' => 'admin.localizations.edit',
                    'update' => 'admin.localizations.update',
                    'destroy' => 'admin.localizations.destroy'
                ]);
            });
        });

    });

    Auth::routes(['verify' => true]);

    Route::get('/{any}', 'HomeController@content')->where('any', '.*');

});
