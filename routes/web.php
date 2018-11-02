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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'Admin\AdminLoginController@login');

Auth::routes();

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');


Route::post('/admin/authenticate', 'admin\AdminLoginController@authenticate');
Route::get('/logout', 'Admin\AdminLoginController@logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::get('','Admin\DashboardController@index')->name('admin.dashboard')->middleware(['permission:admin']);

    Route::group(['prefix' => 'user'], function () {
        Route::get('list','Admin\UserController@index')->name('admin.user.list')->middleware(['permission:admin|manage_user']);
        Route::get('create','Admin\UserController@create')->name('admin.user.create')->middleware(['permission:admin|add_user']);
        Route::post('store','Admin\UserController@store')->name('admin.user.store')->middleware(['permission:admin|add_user']);
        Route::get('edit/{id}','Admin\UserController@edit')->name('admin.user.edit')->middleware(['permission:admin|edit_user'])->where('id', '[0-9]+');
        Route::put('update','Admin\UserController@update')->name('admin.user.update')->middleware(['permission:admin|edit_user']);
        Route::delete('delete/{id}','Admin\UserController@destroy')->name('admin.user.delete')->middleware(['permission:admin|delete_user'])->where('id', '[0-9]+');
    });


    Route::group(['prefix' => 'role'], function () {
        Route::get('list','Admin\RoleController@list')->name('admin.role.list')->middleware(['permission:admin|manage_role']);
        Route::get('create','Admin\RoleController@create')->name('admin.role.create')->middleware(['permission:admin|add_role']);
        Route::post('save','Admin\RoleController@store')->name('admin.role.store')->middleware(['permission:admin']);
        Route::get('edit/{id}','Admin\RoleController@edit')->name('admin.role.edit')->middleware(['permission:admin|edit_role'])->where('id', '[0-9]+');
        Route::put('update','Admin\RoleController@update')->name('admin.role.update')->middleware(['permission:admin']);
        Route::delete('delete/{id}','Admin\RoleController@destroy')->name('admin.role.delete')->middleware(['permission:admin|delete_role'])->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'equipment'], function () {
        Route::get('list','Admin\EquipmentController@list')->name('admin.equipment.list')->middleware(['permission:admin|manage_equipment']);
        Route::get('create','Admin\EquipmentController@create')->name('admin.equipment.create')->middleware(['permission:admin|add_equipment']);
        Route::post('save','Admin\EquipmentController@store')->name('admin.equipment.store')->middleware(['permission:admin|add_equipment']);
        Route::get('edit/{id}','Admin\EquipmentController@edit')->name('admin.equipment.edit')->middleware(['permission:admin|edit_equipment'])->where('id', '[0-9]+');
        Route::put('update','Admin\EquipmentController@update')->name('admin.equipment.update')->middleware(['permission:admin|edit_equipment']);
        Route::delete('delete/{id}','Admin\EquipmentController@destroy')->name('admin.equipment.delete')->middleware(['permission:admin|delete_equipment'])->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'area'], function () {
        Route::get('list','Admin\AreaController@list')->name('admin.area.list')->middleware(['permission:admin|manage_area']);
        Route::get('create','Admin\AreaController@create')->name('admin.area.create')->middleware(['permission:admin|add_area']);
        Route::post('save','Admin\AreaController@store')->name('admin.area.store')->middleware(['permission:admin|add_area']);
        Route::get('edit/{id}','Admin\AreaController@edit')->name('admin.area.edit')->middleware(['permission:admin|edit_area'])->where('id', '[0-9]+');
        Route::put('update','Admin\AreaController@update')->name('admin.area.update')->middleware(['permission:admin|edit_area']);
        Route::delete('delete/{id}','Admin\AreaController@destroy')->name('admin.area.delete')->middleware(['permission:admin|delete_area'])->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'worktypes'], function () {
        Route::get('list','Admin\WorktypesController@list')->name('admin.worktypes.list')->middleware(['permission:admin']);
        Route::get('create','Admin\WorktypesController@create')->name('admin.worktypes.create')->middleware(['permission:admin']);
        Route::post('save','Admin\WorktypesController@store')->name('admin.worktypes.store')->middleware(['permission:admin']);
        Route::get('edit/{id}','Admin\WorktypesController@edit')->name('admin.worktypes.edit')->middleware(['permission:admin'])->where('id', '[0-9]+');
        Route::put('update','Admin\WorktypesController@update')->name('admin.worktypes.update')->middleware(['permission:admin']);
        Route::delete('delete/{id}','Admin\WorktypesController@destroy')->name('admin.worktypes.delete')->middleware(['permission:admin'])->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('list','Admin\SettingsController@list')->name('admin.settings.list')->middleware(['permission:admin']);
        Route::post('store', 'Admin\SettingsController@store')->name('admin.settings.store')->middleware(['permission:admin']);
        Route::get('create/{type}', 'Admin\SettingsController@createForm')->name('admin.settings.createform')->middleware(['permission:admin']);
        Route::get('download/{settings}', 'Admin\SettingsController@fileDownload')->name('admin.settings.download')->middleware(['permission:admin']);
        Route::get('create', 'Admin\SettingsController@create')->name('admin.settings.create')->middleware(['permission:admin']);
        Route::get('edit/{id}', 'Admin\SettingsController@edit')->name('admin.settings.edit')->middleware(['permission:admin'])->where('id', '[0-9]+');
        Route::put('update/{id}', 'Admin\SettingsController@update')->name('admin.settings.update')->middleware(['permission:admin'])->where('id', '[0-9]+');
        Route::delete('delete/{id}', 'Admin\SettingsController@destroy')->name('admin.settings.delete')->middleware(['permission:admin'])->where('id', '[0-9]+');
    });


    Route::group(['prefix' => 'datatable'], function () {
        Route::any('users', 'Admin\DataTableController@getUsers')->name('admin.datatable.users')->middleware(['permission:admin']);
        Route::any('role', 'Admin\DataTableController@getRole')->name('admin.datatable.role')->middleware(['permission:admin']);
        Route::any('equipment', 'Admin\DataTableController@getEquipment')->name('admin.datatable.equipment')->middleware(['permission:admin']);
        Route::any('area', 'Admin\DataTableController@getArea')->name('admin.datatable.area')->middleware(['permission:admin']);
        Route::any('worktypes', 'Admin\DataTableController@getWorktypes')->name('admin.datatable.worktypes')->middleware(['permission:admin']);
        Route::any('settings', 'Admin\DataTableController@getSettings')->name('admin.datatable.settings')->middleware(['permission:admin']);
    });
});

Route::group(['prefix' => 'applicant', 'middleware' => ['auth']], function () {
    Route::get('','Frontend\ApplicantController@applications')->name('frontend.applicant.applications')->middleware(['permission:admin|applicant']);
    Route::get('add_apply','Frontend\ApplicantController@applyForm')->name('frontend.applicant.applyform')->middleware(['permission:admin|applicant']);
    Route::post('apply','Frontend\ApplicantController@apply')->name('frontend.applicant.apply')->middleware(['permission:admin|applicant']);
    Route::get('edit_apply/{id}','Frontend\ApplicantController@editForm')->name('frontend.applicant.edit')->middleware(['permission:admin|applicant'])->where('id', '[0-9]+');
    Route::put('update','Frontend\ApplicantController@update')->name('frontend.applicant.update')->middleware(['permission:admin|applicant']);
    Route::any('applications', 'Frontend\DataTableController@getApplications')->name('frontend.datatable.applications')->middleware(['permission:admin|applicant']);
});

Route::group(['prefix' => 'performer', 'middleware' => ['auth']], function () {
    Route::get('','Frontend\PerformerController@applications')->name('frontend.performer.applications')->middleware(['permission:admin|performer']);
});


