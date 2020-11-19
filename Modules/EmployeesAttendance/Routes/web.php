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

Route::group(["prefix" => "dashboard/employeesAttendance", "middleware" => "assign.guard"], function() {

    Route::get('/', 'EmployeesAttendanceController@index')->name("employeesAttendance.index");

    Route::get('create', 'EmployeesAttendanceController@create')->name("employeesAttendance.create");

    Route::post('store', 'EmployeesAttendanceController@store')->name("employeesAttendance.store");

});
