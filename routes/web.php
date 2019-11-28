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

Auth::routes();

// Route::prefix('employee')->group(function() {
Route::get('/login','Employee\LoginController@showLoginForm')->name('employee.login');
Route::post('/login', 'Employee\LoginController@login')->name('employee.login.submit');
Route::get('/register','Employee\LoginController@showRegisterForm')->name('employee.register');
Route::post('/register','Employee\LoginController@register')->name('employee.register.submit');
Route::get('/reset','Employee\LoginController@showResetForm')->name('employee.reset');
Route::post('/reset','Employee\LoginController@reset')->name('employee.reset.submit');
Route::get('logout/', 'Employee\LoginController@logout')->name('employee.logout');
Route::middleware(['auth.user'])->group(function () {
    Route::get('/home', function() {
        return view('home');
    })->name('home');
});
// });

Route::prefix('admin')->group(function() {
    Route::get('/login','Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@login')->name('admin.login.submit');
    Route::get('/register','Auth\LoginController@showRegisterForm')->name('admin.register');
    Route::post('/register','Auth\LoginController@register')->name('admin.register.submit');
    Route::get('/reset','Auth\LoginController@showResetForm')->name('admin.reset');
    Route::post('/reset','Auth\LoginController@reset')->name('admin.reset.submit');
    Route::post('logout/', 'Auth\LoginController@logout')->name('admin.logout');
    Route::middleware(['auth.admin'])->group(function () {
        Route::get('/', 'Admin\HomeController@index')->name('admin.home');
        Route::get('/home', 'Admin\HomeController@index')->name('admin.home');
        Route::resource('employee', 'Admin\EmployeeController');
        Route::resource('task', 'Admin\TaskController');
        Route::resource('customer', 'Admin\CustomerController');
    });
});

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth.user');
