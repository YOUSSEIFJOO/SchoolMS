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

Route::prefix('dashboard/classAcademic')->group(function() {

    Route::get('/', 'ClassAcademicController@index')->name("classAcademic.index");

    Route::get('create', 'ClassAcademicController@create')->name("classAcademic.create");

    Route::post('store', 'ClassAcademicController@store')->name("classAcademic.store");

    Route::get('edit/{id}', 'ClassAcademicController@edit')->name("classAcademic.edit");

    Route::post('update/{id}', 'ClassAcademicController@update')->name("classAcademic.update");

    Route::delete('delete/{id}', 'ClassAcademicController@destroy')->name("classAcademic.delete");
});
