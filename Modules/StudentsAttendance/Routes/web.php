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

    /** This Route For Get Related Sections When I Press A Class In Select Box In Create View **/
    Route::get('create/section_attendance', 'StudentsAttendanceController@selectSection');

    Route::post('store', 'StudentsAttendanceController@store')->name("studentsAttendance.store");

});

