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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/balance', 'UserController@getBalance')->name('balance');
Route::get('/bets', 'BetController@index')->name('Bets');
Route::get('/addbet', 'BetController@MakeBet')->name('MakeBet');
Route::post('/savebet', 'BetController@savebet')->name('savebet');
Route::get('/history', 'BetController@BetHistory')->name('gameHistory');
Route::get('/gameresult/{id}', 'BetController@gameresult')->name('gameresult');
Route::get('/getjackpot', 'HomeController@getjackpot')->name('getjackpot');
