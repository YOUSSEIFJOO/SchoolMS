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

Route::prefix('dashboard/teachers')->group(function() {

    Route::get('/', 'TeachersController@index')->name("teachers.index");

    Route::get('create', 'TeachersController@create')->name("teachers.create");

    Route::post('store', 'TeachersController@store')->name("teachers.store");

    Route::get('show/{id}', 'TeachersController@show')->name("teachers.show");

    Route::get('edit/{id}', 'TeachersController@edit')->name("teachers.edit");

    Route::post('update/{id}', 'TeachersController@update')->name("teachers.update");

    Route::delete('delete/{id}', 'TeachersController@destroy')->name("teachers.delete");
});
