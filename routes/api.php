<?php

use App\Http\Requests\TestRequest;
use App\Models\Post;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['namespace' => 'Api', 'prefix' => 'users'], function(){
    Route::POST('register', 'UserController@register');
    Route::POST('login', 'UserController@login');
    Route::get('post', 'UserController@photo');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admins'], function(){
    Route::POST('login', 'AdminController@login');
});

Route::group(['namespace' => 'Api', 'middleware' => 'auth:users'], function(){
    Route::POST('posts', 'PostController@createPost')->middleware('can:create,App\Models\Post');
    Route::POST('posts/{post}/comments', 'PostController@createComment')->where('post', '[0-9]+');
    Route::get('collection', 'PostController@collection');
});

Route::group(['namespace' => 'Api'], function(){
    Route::get('collection', 'PostController@collection');
});


