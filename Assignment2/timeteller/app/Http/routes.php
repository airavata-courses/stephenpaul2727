<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', array('middleware'=>'cors','uses'=>'HomeController@index'));

Route::get('/time',array('middleware'=>'cors','uses'=>'HomeController@getTime'));

Route::get('/getjavadataphp',array('middleware'=>'cors','uses'=>'HomeController@getUserInfo'));

Route::get('/postUserThroughRabbit',array('middleware'=>'cors','uses'=>'HomeController@saveUserRabbit'));

Route::get('/PhpListener',array('middleware'=>'cors','uses'=>'HomeController@listenUserRabbit'));

Route::get('/sendrabbittime',array('middleware'=>'cors','uses'=>'HomeController@sendTimeRabbit'))->name('sendrabbittime');

