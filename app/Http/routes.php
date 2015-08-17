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
Route::get('home', 'ReportsController@index');
Route::get('reports/reports/create/products', 'ReportsController@newproducts');

Route::get('reports', 'ReportsController@index');
Route::get('reports/reports', 'ReportsController@index');

Route::get('reports/create', 'ReportsController@create');
Route::get('reports/reports/create', 'ReportsController@create');

Route::get('reports/create/products', 'ReportsController@newproducts');
Route::get('reports/reports/create/products', 'ReportsController@newproducts');

Route::get('reports/userhistory', 'ReportsController@userhistory');
Route::get('reports/reports/userhistory', 'ReportsController@userhistory');

Route::get('reports/create/producthistory', 'ReportsController@previousproducts');
Route::get('reports/reports/create/producthistory', 'ReportsController@previousproducts');

Route::get('reports/summary', 'ReportsController@summary');
Route::get('reports/reports/summary', 'ReportsController@summary');

Route::get('reports/{report_id}', 'ReportsController@edit');
Route::get('reports/reports/{report_id}', 'ReportsController@edit');

Route::post('reports/summary', 'ReportsController@summary');
Route::post('reports', 'ReportsController@store');
Route::post('reports/update', 'ReportsController@update');
Route::post('reports/newproducts', 'ReportsController@addnewproducts');

Route::get('practitioner/register', 'PractitionersAuthController@showregisterpage');
Route::get('prac/logout', 'PractitionersAuthController@logout');
Route::post('practitioner/register', 'PractitionersAuthController@register');

Route::get('practitioner', 'PractitionersAuthController@index');
Route::post('practitioner/login', 'PractitionersAuthController@login');



Route::get('practitioner/dashboard', 'PractitionersController@index');
Route::get('practitioner/practitioner/dashboard', 'PractitionersController@index');

Route::get('practitioner/questions', 'PractitionersController@questionspage');
Route::get('practitioner/practitioner/questions', 'PractitionersController@questionspage');

Route::get('practitioner/generatereport', 'PractitionersController@generatereport');
Route::get('practitioner/practitioner/generatereport', 'PractitionersController@generatereport');

Route::get('practitioner/productsmanager', 'PractitionersController@productsmanager');
Route::get('practitioner/practitioner/productsmanager', 'PractitionersController@productsmanager');

Route::get('practitioner/generate/{id}', 'PractitionersController@generatereport');
Route::get('practitioner/practitioner/generate/{id}', 'PractitionersController@generatereport');

Route::get('practitioner/{report_id}', 'PractitionersController@show');
Route::get('practitioner/practitioner/{report_id}', 'PractitionersController@show');

Route::post('practitioner/products', 'PractitionersController@addproductspage');
Route::post('practitioner/addquestion', 'PractitionersController@addquestion');
Route::post('practitioner/addproduct', 'PractitionersController@addproduct');
Route::post('practitioner/add', 'PractitionersController@store');
Route::post('practitioner/update', 'PractitionersController@update');


Route::controllers([

		'auth'=>'Auth\AuthController',
		'password' =>'Auth\PasswordController',
		//'client' =>'Auth\ClientAuthController',

	]);