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

Route::get('/', 'GeneralController@homepage');

Route::get('/unauthorizedaccess', 'GeneralController@authorizedaccess');

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

Route::get('angular', 'PractitionersController@angular');

Route::get('getMyReports', 'ReportManagerController@getMyReports');
Route::get('getProgressReports', 'ReportManagerController@getProgressReports');
Route::get('getFinishedReports', 'ReportManagerController@getFinishedReports');
Route::get('getSharedReports', 'ReportManagerController@getSharedReports');

Route::get('getAllClients', 'ClientManagerController@getAllClients');

Route::post('admin/registerpractitioner', 'PersonnelController@storePractitioner');
Route::post('admin/registerclient', 'PersonnelController@storeClient');

Route::get('createTest', 'ReportAssessmentController@test');
Route::get('showtest', 'ReportAssessmentController@showtest');

Route::get('practitioner/inbox', 'MessengerController@index');
Route::get('practitioner/inbox/showthread/{conv_id}', 'MessengerController@show');
Route::get('getMyInbox', 'MessengerController@getInbox');
Route::get('getMySentbox', 'MessengerController@getSentbox');

Route::get('getMyMessages', 'MessengerController@getAllMessages');
Route::get('getUnreadMessages', 'MessengerController@getUnread');
Route::get('getAllRecipients', 'MessengerController@getAllRecipients');

Route::post('newMessage', 'MessengerController@store');
Route::post('practitioner/readmessages', 'MessengerController@markasread');

Route::get('practitioner/chooseaccount', 'PractitionersAuthController@chooseaccount');
Route::get('admin/dashboard', 'AdminsController@index');

Route::get('admin/personnelmanager', 'PersonnelController@index');
Route::get('admin/getAllPractitioners', 'PersonnelController@getAllPractitioners');
Route::get('admin/getAllClients', 'PersonnelController@getAllClients');
Route::get('admin/viewpractitioner/{prac_id}', 'PersonnelController@showPractitioner');
Route::get('admin/viewclient/{client_id}', 'PersonnelController@showClient');
Route::get('practitioner/viewclient/{client_id}', 'ClientManagerController@show');

Route::get('admin/getThisPractitioner', 'PersonnelController@getThisPractitioner');
Route::get('admin/getPractitionerReports', 'PersonnelController@getPractitionerReports');
Route::get('admin/getPractitionerClients', 'PersonnelController@getPractitionerClients');

Route::get('admin/getThisClient', 'PersonnelController@getThisClient');
Route::get('admin/getClientReports', 'PersonnelController@getClientReports');

Route::post('admin/updatePractitioner', 'PersonnelController@updatePractitioner');
Route::post('practitioner/updateClient', 'ClientManagerController@update');
Route::post('admin/deleteClient', 'PersonnelController@deleteClient');
Route::post('admin/deletePractitioner', 'PersonnelController@deletePractitioner');

Route::get('admin/questionmanager', 'QuestionManagerController@index');
Route::get('admin/reportmanager', 'AdminReportManagerController@index');
Route::get('getAllReports', 'AdminReportManagerController@getAllReports');