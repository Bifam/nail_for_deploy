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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function() {
    Route::get('/login','Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@login')->name('admin.login.submit');
    Route::get('logout/', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('/', 'Admin\HomeController@index')->name('admin.home');
    Route::get('', 'Admin\HomeController@index')->name('admin.home');
    Route::get('/home', 'Admin\HomeController@index')->name('admin.home');
    // Route::get('/employee', 'Admin\EmployeeController@index')->name('admin.employee.list');
    Route::resource('employee', 'Admin\EmployeeController');
}) ;

Route::get('/home', 'HomeController@index')->name('employee.home');

Auth::routes();
