<?php

use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => 'dashboard' , 'namespace' => 'Dashboard', 'as' => 'dashboard.' , 'middleware' => ['web', 'auth:admin'] ] , function (){

    Route::get('/change-theme-mode/{mode}', function ($mode) {

        session()->put('theme_mode', $mode);
        return redirect()->back();

    });

    Route::get('/' , 'DashboardController@index')->name('index');
    Route::resource('admins','AdminController');
    Route::resource('users','UserController');

});
