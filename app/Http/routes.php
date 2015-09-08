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

Route::get('home', 'ClientsController@index');


Route::get('reports/create', 'ReportsController@create');
Route::get('reports/createstepthree', 'ReportsController@createstepthree');

Route::get('reports/create/products', 'ReportsController@newproducts');
Route::get('reports/reports/create/products', 'ReportsController@newproducts');

Route::get('reports/userhistory', 'ReportsController@userhistory');
Route::get('reports/reports/userhistory', 'ReportsController@userhistory');

Route::get('reports/create/producthistory', 'ReportsController@previousproducts');
Route::get('reports/reports/create/producthistory', 'ReportsController@previousproducts');

Route::get('reports/summary', 'ReportsController@summary');
Route::get('reports/reports/summary', 'ReportsController@summary');

Route::get('reports/createsteptwo/{report_id}', 'ReportsController@createsteptwo');
Route::get('reports/{report_id}', 'ReportsController@edit');

Route::post('reports/summary', 'ReportsController@summary');
Route::post('reports/createsteptwo', 'ReportsController@storeStepTwo');
Route::post('reports', 'ReportsController@store');
Route::post('reports/update', 'ReportsController@update');
Route::post('reports/newproducts', 'ReportsController@addnewproducts');


// registration 

// login 
Route::get('login/login', 'PractitionersAuthController@showlogin');



Route::get('prac/logout', 'PractitionersAuthController@logout');


Route::get('practitioner', 'PractitionersAuthController@index');
Route::post('practitioner/login', 'PractitionersAuthController@login');

Route::post('reports/pracAnswersUpdate', 'ReportsController@pracAnswersUpdate');
Route::post('reports/pracSubUpdate', 'ReportsController@pracSubUpdates');


Route::get('practitioner/dashboard', 'PractitionersController@index');

Route::get('practitioner/reports', 'PractitionersController@history');


Route::get('practitioner/questions', 'PractitionersController@questionspage');
Route::get('practitioner/practitioner/questions', 'PractitionersController@questionspage');

Route::get('practitioner/generatereport', 'PractitionersController@generatereport');
Route::get('practitioner/practitioner/generatereport', 'PractitionersController@generatereport');

Route::get('practitioner/productsmanager', 'PractitionersController@productsmanager');

Route::get('practitioner/generate/{id}', 'PractitionersController@generatereport');

Route::get('practitioner/{report_id}', 'PractitionersController@showreport');
Route::get('practitioner/overview/{report_id}', 'PractitionersController@reportOverview');
Route::get('practitioner/client/{report_id}', 'PractitionersController@viewclient');
Route::post('practitioner/addquestion', 'PractitionersController@addquestion');
Route::post('practitioner/add', 'PractitionersController@store');
Route::post('practitioner/update', 'PractitionersController@update');


Route::controllers([

		'auth'=>'Auth\AuthController',
		'password' =>'Auth\PasswordController',
		//'client' =>'Auth\ClientAuthController',

	]);
