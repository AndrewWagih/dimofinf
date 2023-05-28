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
    Route::resource('posts','PostController');


    /** notifications routes **/
    Route::post('/save-token', 'NotificationController@saveToken')->name('save-token');
    Route::post('/send-notification', 'NotificationController@sendNotification')->name('send.notification');
    Route::get('notifications/{id}/mark_as_read', 'NotificationController@markAsRead')->name('notifications.mark_as_read');
    Route::get('notifications/{type}/load-more/{next}', 'NotificationController@loadMore')->name('notifications.load_more');
    Route::get('notifications/mark-all-as-read', 'NotificationController@markAllAsRead')->name('notifications.mark_all_as_read');
    Route::post('notifications/change-status-sound' , 'NotificationController@changeSoundStatus')->name('notifications.change-sound-status');

});
