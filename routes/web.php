<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

  Route::get('/', function () {
      return view('welcome');
  });

  Route::post('/students/import','StudentsController@import');

  Route::get('downloadJSONFile', array('as'=> 'downloadJSONFile', 'uses' => 'JSONFileController@downloadJSONFile'));

  Route::resource('students', 'StudentsController');

  Route::get('/search/{text}', 'StudentsController@search');

  Route::post('/undo/{student}', 'StudentsController@undo');

  Route::get('/records', 'StudentsController@records');

  Route::get('/home', 'HomeController@index')->name('home');

  Route::get('/logout', 'UsersController@logout');

});
