<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::model('resources', 'Resource');
Route::model('actions', 'Action');
Route::model('elements', 'Element');
Route::model('nodes', 'Node');

Route::resource('resources', 'ResourceController');
Route::resource('actions', 'ActionController');
Route::resource('elements', 'ElementController');
Route::resource('nodes', 'NodeController');