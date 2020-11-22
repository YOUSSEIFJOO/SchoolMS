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

Route::group(["prefix" => "dashboard/permissions", "middleware" => "assign.guard"], function() {

    Route::get('/', 'PermissionsSettingsController@index')->name("permissions.index");

    Route::get('search', 'PermissionsSettingsController@search')->name("permissions.search");

    Route::get('create', 'PermissionsSettingsController@create')->name("permissions.create");

    Route::post('store', 'PermissionsSettingsController@store')->name("permissions.store");

    Route::get('edit/{id}', 'PermissionsSettingsController@edit')->name("permissions.edit");

    Route::post('update/{id}', 'PermissionsSettingsController@update')->name("permissions.update");

    Route::delete('delete/{id}', 'PermissionsSettingsController@destroy')->name("permissions.delete");

});
