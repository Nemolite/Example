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


Route::get('/cont','FirstController@display_user');

Route::get('/adm','FirstController@display_admin');

Route::get('/method','FirstController@display_method');


Route::get('/second', 'SecondController@second_show');

Route::get('/three/{param}', ['uses'=>'dir\ThreeController@dir_show','as'=>'three','middleware'=>'mymiddle']);


Route::get('/arts',['as'=>'arts','uses'=>'HomeController@index']);

Route::get('/about',['as'=>'about','uses'=>'AboutController@show']);

Route::match(['get','post'],'/contactform',['as'=>'contactform','uses'=>'ContController@showform']);

Route::get('/', ['as'=>'home','uses'=>'Admin\IndexController@show']);


