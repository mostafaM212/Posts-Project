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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register','Auth\RegisterController@register') ;

Route::post('login','Auth\LoginController@login') ;

Route::post('/logout','Auth\LoginController@logout');

Route::get('/user','Auth\LoginController@getUser');

Route::resource('profile','Profile\ProfileController')->middleware('myAuth') ;

Route::resource('post','Post\PostController') ;

Route::resource('category','Category\CategoryController');

Route::resource('like','Like\LikesController') ;

Route::resource('admin','Auth\AdminController')->parameter('admin','user') ;

Route::post('/profile-edit','Auth\AuthController@profile') ;
