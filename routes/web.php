<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contai ns the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PostsController@index');

Route::get('/about', function () {
    return view('pages.about');
});



Route::resource('posts','PostsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('comments', 'CommentsController');

Route::get('/comment/vote/{id}', function($id){
	return view('posts/forms/vote')->with("comment_id", $id);
});

Route::get('/jstest', function(){
	return view('js');
});