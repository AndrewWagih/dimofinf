<?php

use Illuminate\Support\Facades\Route;
use Twilio\Rest\Client;

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

Route::group(['namespace' => 'Dashboard' ] , function () {
    Route::get('','AuthController@loginForm')->name('admin.login-form');
    Route::post('admin/login','AuthController@login')->name('admin.login');
    // Route::post('employee/logout','EmployeeAuthController@logout')->name('employee.logout');
});

Route::group([ 'prefix' => 'export' , 'namespace' => 'General', 'as' => 'export.' ] , function (){

   Route::get('users-daily-report','ExportController@exportUsers')->name('users.daily-report');
   Route::get('posts-daily-report','ExportController@exportPosts')->name('posts.daily-report');

});
