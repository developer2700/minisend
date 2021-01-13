<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Api'], function () {

    Route::apiResource('emails', 'EmailsController');
    Route::post('upload-file', 'UploadController@upload');
    Route::get('uploads/{filename}', 'UploadController@download');

/* we won't use use login in this project */
//    Route::post('users/login', 'AuthController@login');
//    Route::post('users', 'AuthController@register');
//    Route::get('user', 'UserController@index');
//    Route::match(['put', 'patch'], 'user', 'UserController@update');
});
