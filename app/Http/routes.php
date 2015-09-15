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
Route::controllers([

    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',

]);

Route::get('/', function () {
    return view('homepage');
});


/**
 * Client Account routes
 *
 * @return Response
 */
Route::get('home', 'ClientsController@index');
Route::get('client/reportarchives', 'ClientsReportController@index');
Route::post('client/login', 'ClientAuthController@login');


/**
 * Report routes
 *
 * @return Response
 */
Route::get('reports/createstepone', 'ReportStepOneController@index');
Route::get('reports/stepone/{report_id}', 'ReportStepOneController@show');
Route::get('reports/createsteptwo/{report_id}', 'ReportStepTwoController@index');
Route::get('reports/{report_id}', 'ReportStepOneController@edit');

Route::post('reports/overview/update', 'ReportOverviewController@update');
Route::post('reports', 'ReportStepOneController@store');
Route::post('reports/stepone/update', 'ReportStepOneController@update');
Route::post('reports/createsteptwo', 'ReportStepTwoController@store');


/**
 * Practitioner Account Routes
 *
 * @return Response
 */
Route::get('practitioner/dashboard', 'PractitionersController@index');
Route::get('practitioner/clientmanager', 'ClientManagerController@index');
Route::get('practitioner/reportmanager', 'ReportManagerController@index');
Route::get('practitioner/questionmanager', 'QuestionManagerController@index');
Route::get('practitioner/overview/{report_id}', 'ReportManagerController@overview');
Route::get('practitioner/client/{report_id}', 'PractitionersController@viewclient');

Route::post('practitioner/add', 'PractitionersController@store');
Route::post('practitioner/update', 'PractitionersController@update');
Route::post('practitioner/createUser', 'ClientManagerController@store');
Route::post('reports/removeSharer', 'SharingController@removeSharer');
Route::post('reports/shareReport', 'SharingController@addNewSharer');


/**
 * Authentication routes
 *
 * @return Response
 */
Route::get('prac/logout', 'PractitionersAuthController@logout');
Route::get('practitioner', 'PractitionersAuthController@index');
Route::post('practitioner/login', 'PractitionersAuthController@login');