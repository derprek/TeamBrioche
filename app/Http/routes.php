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

Route::get('/', function () {
    return view('homepage');
});

Route::get('reports', 'ReportsController@index');
Route::get('reports/create', 'ReportsController@create');
Route::get('reports/{report_id}', 'ReportsController@show');
Route::post('reports', 'ReportsController@store');

Route::controllers([

		'auth'=>'Auth\AuthController',
		'password' =>'Auth\PasswordController',
		//'client' =>'Auth\ClientAuthController',

	]);