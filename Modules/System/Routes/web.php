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

use Illuminate\Http\Request;

if (!file_exists(base_path('.env')) && config('app.env_install')) {
    \Artisan::call('env:install');
}

Route::prefix('ajax')->group(function () {
    Route::namespace('Ajax')->group(function () {

        Route::get('user_exists', function (Request $request) {
            return response()->json([
                'status' => \App\User::where('email', $request->input('email'))->count() > 0 ? true : false
            ]);
        });

    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::namespace('Admin')->group(function () {

            Route::get('', function () {
                return redirect()->route('admin.dashboard');
            });

            Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
            Route::get('changelog', 'ChangelogController@index')->name('admin.changelog');

            Route::get('databaseRestore','BackupController@databaseRestore')->name('admin.backups.databaseRestore');

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
                Route::get('maintenance', 'ConfigController@maintenance')->name('admin.configs.maintenance');
                Route::post('maintenance', 'ConfigController@setMaintenance')->name('admin.configs.maintenance.set');
                Route::get('base', 'ConfigController@base')->name('admin.configs.base');
                Route::put('base', 'ConfigController@updateBase')->name('admin.configs.base.update');
            });

            Route::prefix('logs')->group(function () {
                Route::get('ajax/list', 'LogController@ajaxLogsList')->name('admin.logs.ajax.list');
                Route::get('ajax/{id}', 'LogController@ajaxLogDetails')->name('admin.logs.ajax.details');

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

            Route::prefix('menus')->group(function () {
                Route::get('tree', 'MenuController@tree')->name('admin.menus.tree');
                Route::put('tree', 'MenuController@updateTree')->name('admin.menus.tree.update');

                Route::get('', 'MenuController@index')->name('admin.menus.index');
                Route::get('create', 'MenuController@create')->name('admin.menus.create');
                Route::post('', 'MenuController@store')->name('admin.menus.store');
                Route::get('{menu}', 'MenuController@show')->name('admin.menus.show');
                Route::get('{menu}/edit', 'MenuController@edit')->name('admin.menus.edit');
                Route::put('{menu}', 'MenuController@update')->name('admin.menus.update');
                Route::delete('{menu}', 'MenuController@destroy')->name('admin.menus.destroy');
            });

            Route::prefix('users')->group(function () {
                Route::get('administrators', 'UserController@administrators')->name('admin.users.administrators');
                Route::get('operators', 'UserController@operators')->name('admin.users.operators');
                Route::get('guests', 'UserController@guests')->name('admin.users.guests');

                Route::get('{user}/permissions', 'UserPermissionController@index')->name('admin.users.permissions.index');
                Route::get('{user}/permissions/create', 'UserPermissionController@create')->name('admin.users.permissions.create');
                Route::post('{user}/permissions', 'UserPermissionController@store')->name('admin.users.permissions.store');
                Route::get('{user}/permissions/{permission}/edit', 'UserPermissionController@edit')->name('admin.users.permissions.edit');
                Route::put('{user}/permissions/{permission}', 'UserPermissionController@update')->name('admin.users.permissions.update');
                Route::delete('{user}/permissions/{permission}', 'UserPermissionController@destroy')->name('admin.users.permissions.destroy');

                Route::get('{user}/groups', 'UserGroupController@index')->name('admin.users.groups.index');
                Route::get('{user}/groups/create', 'UserGroupController@create')->name('admin.users.groups.create');
                Route::post('{user}/groups', 'UserGroupController@store')->name('admin.users.groups.store');
                Route::get('{user}/groups/{group}/edit', 'UserGroupController@edit')->name('admin.users.groups.edit');
                Route::put('{user}/groups/{group}', 'UserGroupController@update')->name('admin.users.groups.update');
                Route::delete('{user}/groups/{group}', 'UserGroupController@destroy')->name('admin.users.groups.destroy');

                Route::get('{user}/contents', 'UserContentController@index')->name('admin.users.contents.index');
                Route::get('{user}/contents/{content}', 'UserContentController@show')->name('admin.users.contents.show');

                Route::get('', 'UserController@index')->name('admin.users.index');
                Route::get('create', 'UserController@create')->name('admin.users.create');
                Route::post('', 'UserController@store')->name('admin.users.store');
                Route::get('{user}', 'UserController@show')->name('admin.users.show');
                Route::get('{user}/edit', 'UserController@edit')->name('admin.users.edit');
                Route::put('{user}', 'UserController@update')->name('admin.users.update');
                Route::delete('{user}', 'UserController@destroy')->name('admin.users.destroy');
            });

            Route::prefix('permissions')->group(function () {
                Route::get('', 'PermissionController@index')->name('admin.permissions.index');
                Route::get('create', 'PermissionController@create')->name('admin.permissions.create');
                Route::post('', 'PermissionController@store')->name('admin.permissions.store');
                Route::get('{permission}', 'PermissionController@show')->name('admin.permissions.show');
                Route::get('{permission}/edit', 'PermissionController@edit')->name('admin.permissions.edit');
                Route::put('{permission}', 'PermissionController@update')->name('admin.permissions.update');
                Route::delete('{permission}', 'PermissionController@destroy')->name('admin.permissions.destroy');
            });

            Route::prefix('backups')->group(function () {
                Route::get('', 'BackupController@index')->name('admin.backups.index');
                Route::get('create', 'BackupController@create')->name('admin.backups.create');
                Route::post('', 'BackupController@store')->name('admin.backups.store');
                Route::get('{backup}', 'BackupController@show')->name('admin.backups.show');
                Route::get('{backup}/edit', 'BackupController@edit')->name('admin.backups.edit');
                Route::put('{backup}', 'BackupController@update')->name('admin.backups.update');
                Route::delete('{backup}', 'BackupController@destroy')->name('admin.backups.destroy');
            });

            Route::prefix('themes')->group(function () {
                Route::get('{theme}/layouts/{name}', 'ThemeController@editLayout')->name('admin.themes.layouts.edit');
                Route::put('{theme}/layouts/{name}', 'ThemeController@updateLayout')->name('admin.themes.layouts.update');
                Route::get('{theme}/includes/{name}', 'ThemeController@editInclude')->name('admin.themes.includes.edit');
                Route::put('{theme}/includes/{name}', 'ThemeController@updateInclude')->name('admin.themes.includes.update');
                Route::post('{theme}/activate', 'ThemeController@activate')->name('admin.themes.activate');
                Route::post('{theme}/deactivate', 'ThemeController@deactivate')->name('admin.themes.deactivate');

                Route::get('', 'ThemeController@index')->name('admin.themes.index');
                Route::get('create', 'ThemeController@create')->name('admin.themes.create');
                Route::post('', 'ThemeController@store')->name('admin.themes.store');
                Route::get('{theme}', 'ThemeController@show')->name('admin.themes.show');
                Route::get('{theme}/edit', 'ThemeController@edit')->name('admin.themes.edit');
                Route::put('{theme}', 'ThemeController@update')->name('admin.themes.update');
                Route::delete('{theme}', 'ThemeController@destroy')->name('admin.themes.destroy');
            });

            Route::prefix('groups')->group(function () {
                Route::get('{group}/menus/showMenuGroup', 'GroupController@showMenuGroup')->name('admin.groups.showMenuGroup');
                Route::get('{group}/menus/createMenu/{menu}', 'GroupController@createMenu')->name('admin.groups.createMenu');
                Route::get('{group}/menus/removeMenu/{menu}', 'GroupController@removeMenu')->name('admin.groups.removeMenu');

                Route::get('{group}/users/showUserGroup', 'GroupController@showUserGroup')->name('admin.groups.showUserGroup');
                Route::get('{group}/users/createUser/{user}', 'GroupController@createUser')->name('admin.groups.createUser');
                Route::get('{group}/users/removeUser/{user}', 'GroupController@removeUser')->name('admin.groups.removeUser');

                Route::get('{group}/permissions/showPermissionGroup', 'GroupController@showPermissionGroup')->name('admin.groups.showPermissionGroup');
                Route::get('{group}/permissions/createPermission/{permission}', 'GroupController@createPermission')->name('admin.groups.createPermission');
                Route::get('{group}/permissions/removePermission/{permission}', 'GroupController@removePermission')->name('admin.groups.removePermission');

                Route::get('', 'GroupController@index')->name('admin.groups.index');
                Route::get('create', 'GroupController@create')->name('admin.groups.create');
                Route::post('', 'GroupController@store')->name('admin.groups.store');
                Route::get('{group}', 'GroupController@show')->name('admin.groups.show');
                Route::get('{group}/edit', 'GroupController@edit')->name('admin.groups.edit');
                Route::put('{group}', 'GroupController@update')->name('admin.groups.update');
                Route::delete('{group}', 'GroupController@destroy')->name('admin.groups.destroy');
            });

            Route::prefix('contents')->group(function () {
                Route::get('{content}/revisions/{revision}/revert', 'ContentController@revert')->name('admin.contents.revisions.revert');
                Route::get('{content}/revisions/{revision}', 'ContentController@viewRevision')->name('admin.contents.revisions.show');
                Route::put('{content}/revisions', 'ContentController@updateRevision')->name('admin.contents.revisions.update');

                Route::get('{content}/metas', 'ContentMetaController@index')->name('admin.contents.metas.index');
                Route::get('{content}/metas/create', 'ContentMetaController@create')->name('admin.contents.metas.create');
                Route::post('{content}/metas', 'ContentMetaController@store')->name('admin.contents.metas.store');
                Route::get('{content}/metas/{meta}/edit', 'ContentMetaController@edit')->name('admin.contents.metas.edit');
                Route::put('{content}/metas/{meta}', 'ContentMetaController@update')->name('admin.contents.metas.update');
                Route::delete('{content}/metas/{meta}', 'ContentMetaController@destroy')->name('admin.contents.metas.destroy');

                Route::get('', 'ContentController@index')->name('admin.contents.index');
                Route::get('create', 'ContentController@create')->name('admin.contents.create');
                Route::post('', 'ContentController@store')->name('admin.contents.store');
                Route::get('{content}', 'ContentController@show')->name('admin.contents.show');
                Route::get('{content}/edit', 'ContentController@edit')->name('admin.contents.edit');
                Route::put('{content}', 'ContentController@update')->name('admin.contents.update');
                Route::delete('{content}', 'ContentController@destroy')->name('admin.contents.destroy');
            });

            Route::prefix('banners')->group(function () {
                Route::prefix('locations')->group(function () {
                    Route::get('', 'BannerLocationController@index')->name('admin.banners.locations.index');
                    Route::get('create', 'BannerLocationController@create')->name('admin.banners.locations.create');
                    Route::post('', 'BannerLocationController@store')->name('admin.banners.locations.store');
                    Route::get('{location}', 'BannerLocationController@show')->name('admin.banners.locations.show');
                    Route::get('{location}/edit', 'BannerLocationController@edit')->name('admin.banners.locations.edit');
                    Route::put('{location}', 'BannerLocationController@update')->name('admin.banners.locations.update');
                    Route::delete('{location}', 'BannerLocationController@destroy')->name('admin.banners.locations.destroy');
                });

                Route::get('', 'BannerController@index')->name('admin.banners.index');
                Route::get('create', 'BannerController@create')->name('admin.banners.create');
                Route::post('', 'BannerController@store')->name('admin.banners.store');
                Route::get('{banner}', 'BannerController@show')->name('admin.banners.show');
                Route::get('{banner}/edit', 'BannerController@edit')->name('admin.banners.edit');
                Route::put('{banner}', 'BannerController@update')->name('admin.banners.update');
                Route::delete('{banner}', 'BannerController@destroy')->name('admin.banners.destroy');
            });

            Route::prefix('comments')->group(function () {
                Route::get('{comment}/metas', 'CommentMetaController@index')->name('admin.comments.metas.index');
                Route::get('{comment}/metas/create', 'CommentMetaController@create')->name('admin.comments.metas.create');
                Route::post('{comment}/metas', 'CommentMetaController@store')->name('admin.comments.metas.store');
                Route::get('{comment}/metas/{meta}/edit', 'CommentMetaController@edit')->name('admin.comments.metas.edit');
                Route::put('{comment}/metas/{meta}', 'CommentMetaController@update')->name('admin.comments.metas.update');
                Route::delete('{comment}/metas/{meta}', 'CommentMetaController@destroy')->name('admin.comments.metas.destroy');

                Route::get('', 'CommentController@index')->name('admin.comments.index');
                Route::get('create', 'CommentController@create')->name('admin.comments.create');
                Route::post('', 'CommentController@store')->name('admin.comments.store');
                Route::get('{comment}', 'CommentController@show')->name('admin.comments.show');
                Route::get('{comment}/edit', 'CommentController@edit')->name('admin.comments.edit');
                Route::put('{comment}', 'CommentController@update')->name('admin.comments.update');
                Route::delete('{comment}', 'CommentController@destroy')->name('admin.comments.destroy');
            });

            Route::prefix('taxonomy')->group(function () {
                Route::get('{taxonomy}/metas', 'TermMetaController@index')->name('admin.taxonomy.metas.index');
                Route::get('{taxonomy}/metas/create', 'TermMetaController@create')->name('admin.taxonomy.metas.create');
                Route::post('{taxonomy}/metas', 'TermMetaController@store')->name('admin.taxonomy.metas.store');
                Route::get('{taxonomy}/metas/{meta}/edit', 'TermMetaController@edit')->name('admin.taxonomy.metas.edit');
                Route::put('{taxonomy}/metas/{meta}', 'TermMetaController@update')->name('admin.taxonomy.metas.update');
                Route::delete('{taxonomy}/metas/{meta}', 'TermMetaController@destroy')->name('admin.taxonomy.metas.destroy');

                Route::get('', 'TaxonomyController@index')->name('admin.taxonomy.index');
                Route::get('create', 'TaxonomyController@create')->name('admin.taxonomy.create');
                Route::post('', 'TaxonomyController@store')->name('admin.taxonomy.store');
                Route::get('{taxonomy}', 'TaxonomyController@show')->name('admin.taxonomy.show');
                Route::get('{taxonomy}/edit', 'TaxonomyController@edit')->name('admin.taxonomy.edit');
                Route::put('{taxonomy}', 'TaxonomyController@update')->name('admin.taxonomy.update');
                Route::delete('{taxonomy}', 'TaxonomyController@destroy')->name('admin.taxonomy.destroy');
            });

            Route::prefix('localizations')->group(function () {
                Route::get('', 'LocalizationController@index')->name('admin.localizations.index');
                Route::get('create', 'LocalizationController@create')->name('admin.localizations.create');
                Route::post('', 'LocalizationController@store')->name('admin.localizations.store');
                Route::get('{localization}', 'LocalizationController@show')->name('admin.localizations.show');
                Route::get('{localization}/edit', 'LocalizationController@edit')->name('admin.localizations.edit');
                Route::put('{localization}', 'LocalizationController@update')->name('admin.localizations.update');
                Route::delete('{localization}', 'LocalizationController@destroy')->name('admin.localizations.destroy');
            });

            Route::prefix('notifications')->group(function () {
                Route::get('', 'NotificationController@index')->name('admin.notifications.index');
                Route::get('create', 'NotificationController@create')->name('admin.notifications.create');
                Route::post('', 'NotificationController@store')->name('admin.notifications.store');
                Route::get('{menu}', 'NotificationController@show')->name('admin.notifications.show');
                Route::get('{menu}/edit', 'NotificationController@edit')->name('admin.notifications.edit');
                Route::put('{menu}', 'NotificationController@update')->name('admin.notifications.update');
                Route::delete('{menu}', 'NotificationController@destroy')->name('admin.notifications.destroy');
            });

            Route::prefix('company')->group(function () {
                Route::get('', 'CompanyController@index')->name('admin.company.index');
                Route::get('create', 'CompanyController@create')->name('admin.company.create');
                Route::post('', 'CompanyController@store')->name('admin.company.store');
                Route::get('{company}', 'CompanyController@show')->name('admin.company.show');
                Route::get('{company}/edit', 'CompanyController@edit')->name('admin.company.edit');
                Route::put('{company}', 'CompanyController@update')->name('admin.company.update');
                Route::delete('{company}', 'CompanyController@destroy')->name('admin.company.destroy');
            });

        });
    });
});
