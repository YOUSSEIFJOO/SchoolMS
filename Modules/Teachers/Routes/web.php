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

    /** This Route For Get Related Sections When I Press A Class In Select Box In Create View **/
    Route::get('create/section_teachers', 'TeachersController@selectSection');

    /** This Route For Get Related Subjects When I Press A Class In Select Box In Create View **/
    Route::get('create/subject_teachers', 'TeachersController@selectSubject');

    Route::post('store', 'TeachersController@store')->name("teachers.store");

    Route::get('show/{id}', 'TeachersController@show')->name("teachers.show");

    Route::get('edit/{id}', 'TeachersController@edit')->name("teachers.edit");

    /** This Route For Get Related Section When I Press A Class In Select Box In Edit View **/
    Route::get('edit/{id}/section_teachers', 'TeachersController@selectSection');

    /** This Route For Get Related Subjects When I Press A Class In Select Box In Edit View **/
    Route::get('edit/{id}/subject_teachers', 'TeachersController@selectSubject');

    Route::post('update/{id}', 'TeachersController@update')->name("teachers.update");

    Route::delete('delete/{id}', 'TeachersController@destroy')->name("teachers.delete");
});
