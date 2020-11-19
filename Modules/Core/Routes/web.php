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

Route::prefix("dashboard")->group(function () {

    Route::get('login', 'CoreController@showLoginForm')->name("dashboard.showLoginForm");

    Route::post('login', 'CoreController@login')->name("dashboard.login");

    Route::get('logout', 'CoreController@logout')->name("dashboard.logout");

});


Route::group(["prefix" => "dashboard", "middleware" => "assign.guard"], function() {

    Route::get('attendance', 'CoreController@attendance')->name("attendance.index");

    Route::get('academic', 'CoreController@academic')->name("academic.index");

    Route::get('settings', 'CoreController@setting')->name("settings.index");

});
