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

Route::group(["prefix" => "dashboard/subjectAcademic", "middleware" => "assign.guard"], function() {

    Route::get('/', 'SubjectAcademicController@index')->name("subjectAcademic.index");

    Route::get('create', 'SubjectAcademicController@create')->name("subjectAcademic.create");

    Route::post('store', 'SubjectAcademicController@store')->name("subjectAcademic.store");

    Route::get('edit/{id}', 'SubjectAcademicController@edit')->name("subjectAcademic.edit");

    Route::post('update/{id}', 'SubjectAcademicController@update')->name("subjectAcademic.update");

    Route::delete('delete/{id}', 'SubjectAcademicController@destroy')->name("subjectAcademic.delete");
    
});
