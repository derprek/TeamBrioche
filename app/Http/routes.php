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


/**
 * General routes
 *
 */
Route::get('', 'GeneralController@homepage');
Route::get('/unauthorizedaccess', 'GeneralController@authorizedaccess');


/**
 * Password routes
 *
 */
Route::get('login/{password}', 'PasswordController@validateuser');
Route::get('setpassword', 'PasswordController@firstpassword');

Route::post('validateuser', 'PasswordController@newuser');
Route::post('setfirstpassword', 'PasswordController@storefirstpassword');
Route::post('updatepassword', 'PasswordController@update');


/**
 * Client Authentication routes
 *
 */
Route::post('client/login', 'ClientAuthController@login');


/**
 * Client Account routes
 *
 */
Route::get('home', 'ClientsController@index');
Route::get('client/reportarchives', 'ClientsReportController@index');
Route::get('client/overview/{report_id}', 'ClientsReportController@overview');


/**
 * Practitioner Authentication routes
 *
 */
Route::get('prac/logout', 'PractitionersAuthController@logout');
Route::get('practitioner', 'PractitionersAuthController@index');
Route::get('admin/loginAsAdmin', 'PractitionersAuthController@loginAsAdmin');
Route::get('admin/loginAsPractitioner', 'PractitionersAuthController@loginAsPractitioner');
Route::get('admin/chooseaccount', 'PractitionersAuthController@chooseaccount');

Route::post('practitioner/login', 'PractitionersAuthController@login');


/**
 * Practitioner Account Routes
 *
 */
Route::get('practitioner/dashboard', 'PractitionersController@index');
Route::get('practitioner/reportmanager', 'ReportManagerController@index');

Route::post('reports/removeSharer', 'SharingController@removeSharer');
Route::post('reports/shareReport', 'SharingController@addNewSharer');


/**
 * Admin Account Routes
 *
 */
Route::get('admin/dashboard', 'AdminsController@index');
Route::get('admin/reportmanager', 'AdminReportManagerController@index');


/**
 * Profile routes
 *
 */
Route::get('profile', 'ProfileController@show');

Route::post('updateprofile', 'ProfileController@update');


/**
 * Mailbox routes
 *
 */
Route::get('mailbox', 'MessengerController@index');
Route::get('practitioner/inbox/showthread/{conv_id}', 'MessengerController@show');

Route::post('practitioner/readmessages', 'MessengerController@markasread');
// this 'newMessage' can be fired off on any page
Route::post('newMessage', 'MessengerController@store');


/**
 * Report (Assessment) routes
 *
 */
Route::get('reports/assessment/new', 'ReportAssessmentController@index');
Route::get('reports/assessment/view/{assessment_id}', 'ReportAssessmentController@show');
Route::get('assessment/newversion', 'ReportAssessmentController@storeNewVersion');

Route::post('assessment/update', 'ReportAssessmentController@update');
Route::post('assessment/setcurrentversion', 'ReportAssessmentController@setCurrentVersion');
Route::post('reports', 'ReportAssessmentController@store');
Route::post('reports/stepAssessment/checkhistory', 'ReportAssessmentController@checkhistory');


/**
 * Report (Typology) routes
 *
 */
Route::get('reports/typology/new/{report_id}', 'ReportTypologyController@index');
Route::get('reports/typology/view/{typology_id}', 'ReportTypologyController@show');

Route::post('reports/Typology/update', 'ReportTypologyController@update');
Route::post('reports/Typology', 'ReportTypologyController@store');


/**
 * Report (Evaluation) routes
 *
 */
Route::get('reports/evaluation/overview/{report_id}', 'ReportEvaluationController@overview');
Route::get('reports/evaluation/new/{report_id}', 'ReportEvaluationController@index');
Route::get('reports/evaluation/view/{evaluation_id}', 'ReportEvaluationController@show');

Route::post('reports/evaluation/update', 'ReportEvaluationController@update');
Route::post('reports/evaluation/new', 'ReportEvaluationController@store');


/**
 * Report (overview) routes
 *
 */
Route::get('reports/overview/{report_id}', 'ReportOverviewController@index');

Route::post('reports/overview/update', 'ReportOverviewController@update');


/**
 * Get client manager routes
 *
 */
Route::get('practitioner/clientmanager', 'ClientManagerController@index');
Route::get('practitioner/viewclient/{client_id}', 'ClientManagerController@show');

Route::post('practitioner/updateClient', 'ClientManagerController@update');
Route::post('practitioner/createUser', 'ClientManagerController@store');
Route::post('deleteClient', 'ClientManagerController@deleteClient');



/**
 * Get personnel manager routes
 *
 */
Route::get('admin/personnelmanager', 'PersonnelController@index');
Route::get('admin/viewpractitioner/{prac_id}', 'PersonnelController@showPractitioner');
Route::get('admin/viewclient/{client_id}', 'PersonnelController@showClient');

Route::post('admin/updatePractitioner', 'PersonnelController@updatePractitioner');
Route::post('admin/deletePractitioner', 'PersonnelController@deletePractitioner');


/**
 * Get messages Routes (For angularjs)
 *
 */
Route::get('getMyMail', 'MessengerController@getMail');
Route::get('getMySentbox', 'MessengerController@getSentbox');
Route::get('getMyMessages', 'MessengerController@getAllMessages');
Route::get('getUnreadMessages', 'MessengerController@getUnread');
Route::get('getAllRecipients', 'MessengerController@getAllRecipients');

/**
 * Get Report info Routes (For angularjs)
 *
 */
Route::get('getMyReports', 'ReportManagerController@getMyReports');
Route::get('getProgressReports', 'ReportManagerController@getProgressReports');
Route::get('getFinishedReports', 'ReportManagerController@getFinishedReports');
Route::get('getSharedReports', 'ReportManagerController@getSharedReports');


/**
 * Get Personnel info Routes (For angularjs)
 *
 */
Route::get('getAllClients', 'ClientManagerController@getAllClients');
Route::get('getThisClient', 'ClientManagerController@getThisClient');
Route::get('getClientReports', 'ClientManagerController@getClientReports');

Route::get('admin/getAllPractitioners', 'PersonnelController@getAllPractitioners');
Route::get('admin/getAllClients', 'PersonnelController@getAllClients');
Route::get('admin/getThisPractitioner', 'PersonnelController@getThisPractitioner');
Route::get('admin/getPractitionerReports', 'PersonnelController@getPractitionerReports');
Route::get('admin/getPractitionerClients', 'PersonnelController@getPractitionerClients');

Route::post('admin/registerpractitioner', 'PersonnelController@storePractitioner');
Route::post('admin/registerclient', 'PersonnelController@storeClient');
