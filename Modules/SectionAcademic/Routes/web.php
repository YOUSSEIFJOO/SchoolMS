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

Route::group(["prefix" => "dashboard/sectionAcademic", "middleware" => "assign.guard"], function() {

    Route::get('/', 'SectionAcademicController@index')->name("sectionAcademic.index");

    Route::get('create', 'SectionAcademicController@create')->name("sectionAcademic.create");

    Route::post('store', 'SectionAcademicController@store')->name("sectionAcademic.store");

    Route::get('edit/{id}', 'SectionAcademicController@edit')->name("sectionAcademic.edit");

    Route::post('update/{id}', 'SectionAcademicController@update')->name("sectionAcademic.update");

    Route::delete('delete/{id}', 'SectionAcademicController@destroy')->name("sectionAcademic.delete");
    
});
