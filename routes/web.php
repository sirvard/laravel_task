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

/*Route::get('/', function () {
    return view('welcome');
});*/
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
/*Route::get('/home', function(){
	return view('home');
});*/
/*Facebook login routes*/
Route::get('auth/facebook', 'AuthController@redirect');
Route::get('auth/facebook/callback', 'AuthController@callback');
/*Facebook login routes*/
Route::resource('/user','UserController');
Route::post('/addCategory', 'CategoryController@store');
Route::get('/categories', 'CategoryController@index');
Route::get('/posts', 'PostController@index');
Route::delete('/delete/{id}', 'CategoryController@destroy');
//Route::post('/editCategory', 'CategoryController@edit');
Route::post('/addPost', 'PostController@store'); 
/*Route::delete('/delete/{delete_id}', function($id){
	
});*/
Route::resource('/editCategory', 'CategoryController');
Route::resource('/editPost', 'PostController');
Route::delete('/deletePost/{id}', 'PostController@destroy');



