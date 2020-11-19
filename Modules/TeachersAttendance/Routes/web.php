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

Route::group(["prefix" => "dashboard/teachersAttendance", "middleware" => "assign.guard"], function() {

    Route::get('/', 'TeachersAttendanceController@index')->name("teachersAttendance.index");

    Route::get('create', 'TeachersAttendanceController@create')->name("teachersAttendance.create");

    Route::post('store', 'TeachersAttendanceController@store')->name("teachersAttendance.store");
});
