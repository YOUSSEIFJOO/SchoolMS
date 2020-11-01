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

    /** This Route For Get Related Sections When I Press A Class In Select Box In Create View **/
    Route::get('create/section_students', 'StudentsController@selectSection');

    Route::post('store', 'StudentsController@store')->name("students.store");

    Route::get('show/{id}', 'StudentsController@show')->name("students.show");

    Route::get('edit/{id}', 'StudentsController@edit')->name("students.edit");

    /** This Route For Get Related Sections When I Press A Class In Select Box In Edit View **/
    Route::get('edit/{id}/section_students', 'StudentsController@selectSection');

    Route::post('update/{id}', 'StudentsController@update')->name("students.update");

    Route::delete('delete/{id}', 'StudentsController@destroy')->name("students.delete");

});
