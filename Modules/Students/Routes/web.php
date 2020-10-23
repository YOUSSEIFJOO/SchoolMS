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

Route::prefix('dashboard/students')->group(function() {

    Route::get('/', 'StudentsController@index')->name("students.index");

    Route::get('create', 'StudentsController@create')->name("students.create");

    Route::get('create/section', 'StudentsController@selectSection')->name("students.select_section");

    Route::post('store', 'StudentsController@store')->name("students.store");

    Route::get('show/{id}', 'StudentsController@show')->name("students.show");

    Route::get('edit/{id}', 'StudentsController@edit')->name("students.edit");

    Route::post('update/{id}', 'StudentsController@update')->name("students.update");

    Route::delete('delete/{id}', 'StudentsController@destroy')->name("students.delete");

});
