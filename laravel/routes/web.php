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
// INDEX
Route::get('/', 'IndexController@intro');
Route::get('index', 'IndexController@index');

Route::group(['prefix'=>'account', 'as'=>'account.'], function(){
    Route::post('registerAction', ['as'=>'registerAction', 'uses'=>'Account\AccountController@registerAction']);
    Route::post('loginAction', ['as'=>'loginAction', 'uses'=>'Account\AccountController@loginAction']);
    Route::get('logoutAction', ['as'=>'logoutAction', 'uses'=>'Account\AccountController@logoutAction']);
});

Route::group(['prefix'=>'board', 'as'=>'board.'], function(){
    Route::post('createBoard', ['as'=>'createBoard', 'uses'=>'Board\BoardController@createBoard']);
    Route::post('postAction', ['as'=>'postAction', 'uses'=>'Board\BoardController@postAction']);
    Route::post('postMore', ['as'=>'postMore', 'uses'=>'Board\BoardController@postMore']);
});

Route::group(['prefix'=>'func', 'as'=>'func.'], function(){
    Route::post('getSession', ['as'=>'getSession', 'uses'=>'Func\FuncController@getSession']);
});

Route::group(['prefix'=>'chat', 'as'=>'chat.'], function(){
    Route::post('createRoom', ['as'=>'createRoom', 'uses'=>'Chat\ChatController@createRoom']);
    Route::post('chatSave', ['as'=>'chatSave', 'uses'=>'Chat\ChatController@chatSave']);
    Route::post('getLogs', ['as'=>'getLogs', 'uses'=>'Chat\ChatController@getLogs']);
    Route::post('getLogsMore', ['as'=>'getLogsMore', 'uses'=>'Chat\ChatController@getLogsMore']);
});

