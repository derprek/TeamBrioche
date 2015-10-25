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

Route::get('profile', 'ProfileController@show');
Route::post('updatepassword', 'PasswordController@update');

Route::get('', 'GeneralController@homepage');

Route::get('/unauthorizedaccess', 'GeneralController@authorizedaccess');

Route::get('mailbox', 'MessengerController@index');
Route::get('practitioner/inbox/showthread/{conv_id}', 'MessengerController@show');
Route::get('getMyMail', 'MessengerController@getMail');
Route::get('getMySentbox', 'MessengerController@getSentbox');

Route::get('getMyMessages', 'MessengerController@getAllMessages');
Route::get('getUnreadMessages', 'MessengerController@getUnread');
Route::get('getAllRecipients', 'MessengerController@getAllRecipients');

Route::post('newMessage', 'MessengerController@store');
Route::post('practitioner/readmessages', 'MessengerController@markasread');


/**
 * Client Account routes
 *
 * @return Response
 */
Route::get('home', 'ClientsController@index');
Route::get('client/reportarchives', 'ClientsReportController@index');
Route::get('client/overview/{report_id}', 'ClientsReportController@overview');
Route::post('client/login', 'ClientAuthController@login');


/**
 * Report routes
 *
 * @return Response
 */

Route::get('reports/assessment/new', 'ReportAssessmentController@index');
Route::get('reports/assessment/view/{assessment_id}', 'ReportAssessmentController@show');

Route::get('reports/typology/new/{report_id}', 'ReportTypologyController@index');
Route::get('reports/typology/view/{typology_id}', 'ReportTypologyController@show');

Route::get('reports/evaluation/overview/{report_id}', 'ReportEvaluationController@overview');
Route::get('reports/evaluation/new/{report_id}', 'ReportEvaluationController@index');
Route::get('reports/evaluation/view/{evaluation_id}', 'ReportEvaluationController@show');

Route::get('reports/overview/{report_id}', 'ReportOverviewController@index');

Route::post('reports/selection/delete', 'ReportEvaluationController@delete');
Route::post('reports/overview/update', 'ReportOverviewController@update');
Route::post('reports', 'ReportAssessmentController@store');
Route::post('reports/stepAssessment/checkhistory', 'ReportAssessmentController@checkhistory');
Route::post('reports/Typology/update', 'ReportTypologyController@update');
Route::post('reports/evaluation/update', 'ReportEvaluationController@update');
Route::post('reports/Typology', 'ReportTypologyController@store');
Route::post('reports/evaluation/new', 'ReportEvaluationController@store');


/**
 * Practitioner Account Routes
 *
 * @return Response
 */
Route::get('practitioner/dashboard', 'PractitionersController@index');
Route::get('practitioner/clientmanager', 'ClientManagerController@index');
Route::get('practitioner/reportmanager', 'ReportManagerController@index');

Route::get('practitioner/client/{report_id}', 'PractitionersController@viewclient');

Route::post('practitioner/add', 'PractitionersController@store');
Route::post('practitioner/update', 'PractitionersController@update');
Route::post('practitioner/createUser', 'ClientManagerController@store');
Route::post('reports/removeSharer', 'SharingController@removeSharer');
Route::post('reports/shareReport', 'SharingController@addNewSharer');

Route::get('practitioner/reportpdf/{report_id}', 'ReportManagerController@generatereport');
Route::get('practitioner/Typology/reportpdf/{report_id}', 'ReportTypologyController@generatereport');
Route::get('practitioner/selection/reportpdf/{select_id}', 'ReportSelectionController@generatereport');

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

Route::get('admin/chooseaccount', 'PractitionersAuthController@chooseaccount');
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

Route::get('getThisClient', 'ClientManagerController@getThisClient');
Route::get('getClientReports', 'ClientManagerController@getClientReports');

Route::post('admin/updatePractitioner', 'PersonnelController@updatePractitioner');
Route::post('practitioner/updateClient', 'ClientManagerController@update');
Route::post('admin/deleteClient', 'PersonnelController@deleteClient');
Route::post('admin/deletePractitioner', 'PersonnelController@deletePractitioner');

Route::get('admin/questionmanager', 'QuestionManagerController@index');
Route::get('admin/reportmanager', 'AdminReportManagerController@index');
Route::get('getAllReports', 'AdminReportManagerController@getAllReports');

Route::get('getUnsharedPractitioners', 'SharingController@getUnsharedPractitioners');

Route::get('admin/loginAsAdmin', 'PractitionersAuthController@loginAsAdmin');
Route::get('admin/loginAsPractitioner', 'PractitionersAuthController@loginAsPractitioner');

Route::post('assessment/update', 'ReportAssessmentController@update');
Route::get('assessment/newversion', 'ReportAssessmentController@storeNewVersion');

Route::get('assessment/setcurrentversion/{ids}', 'ReportAssessmentController@setCurrentVersion');

Route::get('reports/printsummary/{report_id}', 'ReportManagerController@printSummary');
