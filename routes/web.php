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
});

/*Route::get('/hello', function () {
    return 'hello world';
});
Route::get('/hgo', function () {
    return view('about');
});
Route::get('/user/{id}', function ($id) {
    return view('about').' '.$id;
});
Route::get('/user/{id}/{name}', function ($id,$name) {
    return view('about').' '.$id.",$name";
});*/
//Route::get('/','aboutcontroller@index');
//Route::get('/','aboutcontroller@about');
Route::get('/posts/{id}/vote', 'PostController@vote');
Route::get('/posts/{id}/change_visibilty', 'PostController@change_visibilty');
Route::get('/unvisible', 'PostController@get_unvisible');
Route::resource('posts','PostController');  //from cmd 'php artisan route:list'
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
