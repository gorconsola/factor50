<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Backoffice')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::get('forgot-password', 'AuthController@sendResetLinkEmail');
        Route::get('reset-password', 'AuthController@resetPasswordRedirect')->name('password.reset');

        Route::group(['middleware' => 'auth:api'], function(){
            Route::get('me', 'AuthController@user');
            Route::post('logout', 'AuthController@logout');
        });
    });

    // AUTHENTICATED ROUTES
    Route::group(['middleware' => 'auth:api'], function(){

        Route::get('users', 'UserController@index')
            ->middleware('isAdmin');
        Route::get('users/{id}', 'UserController@show')
            ->middleware('isAdminOrSelf');

        Route::resource('projects', 'ProjectController');
        Route::resource('projects/{id}/tasks', 'TaskController');
        Route::post('documents/upload', 'DocumentController@upload');
    });

    //UNAUTHENTICATED ROUTES
    Route::get('documents/download/{folder}/{fileName}', 'DocumentController@download');
    Route::resource('projects/{productId}/documents', 'ProjectDocumentController');
});