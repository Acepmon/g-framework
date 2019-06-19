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
    Route::prefix('admin')->group(function () {
        Route::namespace('Admin')->group(function () {
            Route::get('/', function () {
                return redirect()->route('admin.dashboard');
            });
            Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
            Route::get('changelog', 'ChangelogController@index')->name('admin.changelog.index');
            Route::get('install','PluginController@installPlugin')->name('admin.plugins.install');

            Route::prefix('profile')->group(function () {
                Route::get('/', 'ProfileController@index')->name('admin.profile.index');
                Route::put('/', 'ProfileController@update')->name('admin.profile.update');
                Route::get('pages', 'ProfileController@pages')->name('admin.profile.pages.index');
                Route::get('permissions', 'ProfileController@permissions')->name('admin.profile.permissions.index');
                Route::get('settings', 'ProfileController@settings')->name('admin.profile.settings.index');
                Route::get('notifications', 'ProfileController@notifications')->name('admin.profile.notifications.index');
                Route::get('notifications/read', 'ProfileController@readNotifications')->name('admin.profile.notifications.read');
                Route::get('edit', 'ProfileController@edit')->name('admin.profile.edit');
            });

            Route::resource('menus', 'MenuController')->names([
                'index' => 'admin.menus.index',
                'create' => 'admin.menus.create',
                'store' => 'admin.menus.store',
                'show' => 'admin.menus.show',
                'edit' => 'admin.menus.edit',
                'update' => 'admin.menus.update',
                'destroy' => 'admin.menus.destroy'
            ]);
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
            Route::resource('plugins', 'PluginController')->names([
                'index' => 'admin.plugins.index',
                'create' => 'admin.plugins.create',
                'store' => 'admin.plugins.store',
                'show' => 'admin.plugins.show',
                'edit' => 'admin.plugins.edit',
                'update' => 'admin.plugins.update',
                'destroy' => 'admin.plugins.destroy',
                //'install' => 'admin.plugins.install'

            ]);
            Route::resource('groups', 'GroupController')->names([
                'index' => 'admin.groups.index',
                'create' => 'admin.groups.create',
                'store' => 'admin.groups.store',
                'show' => 'admin.groups.show',
                'edit' => 'admin.groups.edit',
                'update' => 'admin.groups.update',
                'destroy' => 'admin.groups.destroy'
            ]);
            Route::resource('pages', 'PageController')->names([
                'index' => 'admin.pages.index',
                'create' => 'admin.pages.create',
                'store' => 'admin.pages.store',
                'show' => 'admin.pages.show',
                'edit' => 'admin.pages.edit',
                'update' => 'admin.pages.update',
                'destroy' => 'admin.pages.destroy'
            ]);
            Route::resource('configs', 'ConfigController')->names([
                'index' => 'admin.configs.index',
                'create' => 'admin.configs.create',
                'store' => 'admin.configs.store',
                'show' => 'admin.configs.show',
                'edit' => 'admin.configs.edit',
                'update' => 'admin.configs.update',
                'destroy' => 'admin.configs.destroy'
            ]);

            Route::get('/users/{user}/settings', 'UserSettingController@index')->name('admin.users.settings.index');
            Route::get('/users/{user}/settings/create', 'UserSettingController@create')->name('admin.users.settings.create');
            Route::post('/users/{user}/settings', 'UserSettingController@store')->name('admin.users.settings.store');
            Route::get('/users/{user}/settings/{setting}/edit', 'UserSettingController@edit')->name('admin.users.settings.edit');
            Route::put('/users/{user}/settings/{setting}', 'UserSettingController@update')->name('admin.users.settings.update');
            Route::delete('/users/{user}/settings/{setting}', 'UserSettingController@destroy')->name('admin.users.settings.destroy');

            Route::get('/pages/{page}/metas', 'PageMetaController@index')->name('admin.pages.metas.index');
            Route::get('/pages/{page}/metas/create', 'PageMetaController@create')->name('admin.pages.metas.create');
            Route::post('/pages/{page}/metas', 'PageMetaController@store')->name('admin.pages.metas.store');
            Route::get('/pages/{page}/metas/{meta}/edit', 'PageMetaController@edit')->name('admin.pages.metas.edit');
            Route::put('/pages/{page}/metas/{meta}', 'PageMetaController@update')->name('admin.pages.metas.update');
            Route::delete('/pages/{page}/metas/{meta}', 'PageMetaController@destroy')->name('admin.pages.metas.destroy');


            Route::get('/users/{user}/permissions', 'UserPermissionController@index')->name('admin.users.permissions.index');
            Route::get('/users/{user}/permissions/create', 'UserPermissionController@create')->name('admin.users.permissions.create');
            Route::post('/users/{user}/permissions', 'UserPermissionController@store')->name('admin.users.permissions.store');
            Route::get('/users/{user}/permissions/{permission}/edit', 'UserPermissionController@edit')->name('admin.users.permissions.edit');
            Route::put('/users/{user}/permissions/{permission}', 'UserPermissionController@update')->name('admin.users.permissions.update');
            Route::delete('/users/{user}/permissions/{permission}', 'UserPermissionController@destroy')->name('admin.users.permissions.destroy');

            Route::get('/users/{user}/pages', 'UserPageController@index')->name('admin.users.pages.index');
            Route::get('/users/{user}/pages/{page}', 'UserPageController@show')->name('admin.users.pages.show');

//            Route::get('/admin/plugins/install','DataController@installPlugin');
//            Route::get('extract','DataController@index');
        });
    });

});



Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/{slug}', 'HomeController@page')->name('page');
