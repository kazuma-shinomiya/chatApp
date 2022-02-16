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
Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'ChatController@index');
    Route::get('/chats/{receiver}', 'ChatController@show');
    Route::get('/chats/{receiver}/fetch', 'MessageController@fetch');
    Route::post('/chats/{receiver}/send', 'MessageController@send');
});

Auth::routes();
