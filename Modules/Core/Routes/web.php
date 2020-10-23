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


Route::get('dashboard/attendance', 'CoreController@attendance')->name("attendance.index");

Route::get('dashboard/academic', 'CoreController@academic')->name("academic.index");
