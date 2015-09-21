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
Route::get('reports/createAssessment', 'ReportAssessmentController@index');
Route::get('reports/selection/overview/{report_id}', 'ReportSelectionController@overview');
Route::get('reports/Assessment/{report_id}', 'ReportAssessmentController@show');
Route::get('reports/createTypology/{report_id}', 'ReportTypologyController@index');
Route::get('reports/Typology/{report_id}', 'ReportTypologyController@show');
Route::get('reports/createSelection/{report_id}', 'ReportSelectionController@index');
Route::get('reports/Selection/{report_id}', 'ReportSelectionController@show');

Route::post('reports/selection/delete', 'ReportSelectionController@delete');
Route::post('reports/overview/update', 'ReportOverviewController@update');
Route::post('reports', 'ReportAssessmentController@store');
Route::post('reports/stepAssessment/update', 'ReportAssessmentController@update');
Route::post('reports/Typology/update', 'ReportTypologyController@update');
Route::post('reports/Selection/update', 'ReportSelectionController@update');
Route::post('reports/Typology', 'ReportTypologyController@store');
Route::post('reports/Selection', 'ReportSelectionController@store');


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