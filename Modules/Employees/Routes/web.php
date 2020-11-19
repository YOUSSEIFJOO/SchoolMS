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

Route::group(["prefix" => "dashboard/employees", "middleware" => "assign.guard"], function() {

    Route::get('/', 'EmployeesController@index')->name("employees.index");

    Route::get('create', 'EmployeesController@create')->name("employees.create");

    Route::post('store', 'EmployeesController@store')->name("employees.store");

    Route::get('show/{id}', 'EmployeesController@show')->name("employees.show");

    Route::get('edit/{id}', 'EmployeesController@edit')->name("employees.edit");

    Route::post('update/{id}', 'EmployeesController@update')->name("employees.update");

    Route::delete('delete/{id}', 'EmployeesController@destroy')->name("employees.delete");

});
