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
Route::resource('/editCategory', 'CategoryController');
Route::resource('/editPost', 'PostController');
Route::delete('/deletePost/{id}', 'PostController@destroy');

//Route::resource('posts', 'PostsController');

//Route::resource('posts.categories', 'PostsCategoriesController');

Route::get('/api/index', 'HomeController@getData');
Route::post('/api/user', 'UserController@update');
Route::post('/api/add-category', 'CategoryController@store');
Route::post('/api/add-post', 'PostController@store');
Route::get('/api/categories', "CategoryController@index");
Route::get('/api/categories/{id}', "CategoryController@getCategory");
Route::get('/api/posts/{id}', "PostController@getPost");
Route::delete('/api/delete-category/{id}', "CategoryController@destroy");
Route::get('/api/posts', "PostController@index");
Route::get('/api/logout', "HomeController@logout");
Route::delete('/api/delete-post/{id}', "PostController@destroy");
Route::post('/api/categories/{id}/edit', 'CategoryController@update');
Route::post('/api/posts/{id}/edit', 'PostController@update');
//Route::get('/api/posts', 'PostController@index');
