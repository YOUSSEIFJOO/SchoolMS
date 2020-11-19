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

    Route::post('/', 'PermissionsSettingsController@search')->name("permissions.search");

    Route::get('create', 'PermissionsSettingsController@create')->name("permissions.create");

    Route::post('store', 'PermissionsSettingsController@store')->name("permissions.store");

});
