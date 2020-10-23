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

Route::prefix('dashboard/studentsAttendance')->group(function() {

    Route::get('/', 'StudentsAttendanceController@index')->name("studentsAttendance.index");

    Route::get('create', 'StudentsAttendanceController@create')->name("studentsAttendance.create");

    Route::post('store', 'StudentsAttendanceController@store')->name("studentsAttendance.store");

});

