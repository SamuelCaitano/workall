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

Route::get('login', 'LoginController@index')->name('login');
Route::post('/login/signIn', 'LoginController@signIn');
Route::get('login/signOut', 'LoginController@signOut'); 
Route::get('/', 'HomeController@index'); 