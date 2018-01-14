<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => '/auth', 'namespace' => 'Auth'], function () {
   Route::post('/login', 'LoginController@login');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => '/timeline', 'namespace' => 'Timeline'], function () {
        Route::get('/', 'TimelineController@get');
    });

    Route::group(['prefix' => '/posts', 'namespace' => 'Posts'], function () {
        Route::post('/', 'PostController@create');
//        Route::get('/{post}', 'PostDetailController@forId');

        Route::put('/{post}/like', 'PostDetailController@like');
        Route::post('/{post}/comments', 'PostDetailController@createComment');
    });

    Route::group(['prefix' => '/comments', 'namespace' => 'Comments'], function () {
        Route::post('/{comment}/child-comments', 'CommentDetailController@replyToComment');
        Route::put('/{comment}/like', 'CommentDetailController@like');

    });
});


