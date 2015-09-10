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

Route::post('client/login', 'ClientAuthController@login');

// Reports

/* Report Get Requests */
Route::get('reports/create', 'ReportStepOneController@index');
Route::get('reports/stepone/{report_id}', 'ReportStepOneController@show');

    /* Report Wild Cards */
    Route::get('reports/createsteptwo/{report_id}', 'ReportStepTwoController@index');
    Route::get('reports/{report_id}', 'ReportStepOneController@edit');
    /* End Report Wild cards */

/* End Report Get Requests */


/* Report Post Requests */

    Route::post('reports/overview/update', 'ReportOverviewController@update');

    /* Step One */
    Route::post('reports', 'ReportStepOneController@store');
    Route::post('reports/stepone/update', 'ReportStepOneController@update');
    /* End Step Two */

    /* Step Two */
    Route::post('reports/createsteptwo', 'ReportStepTwoController@store');
    /* End Step Two */

/* End Report Post Requests */

// End Reports



// registration 

// login 
Route::get('login/login', 'PractitionersAuthController@showlogin');

Route::get('prac/logout', 'PractitionersAuthController@logout');

Route::get('practitioner', 'PractitionersAuthController@index');
Route::post('practitioner/login', 'PractitionersAuthController@login');
//

Route::post('practitioner/createUser', 'PractitionersController@createClient');


Route::get('practitioner/dashboard', 'PractitionersController@index');

Route::get('practitioner/reports', 'PractitionersController@history');

Route::get('practitioner/questions', 'PractitionersController@questionspage');
Route::get('practitioner/practitioner/questions', 'PractitionersController@questionspage');

Route::get('practitioner/generatereport', 'PractitionersController@generatereport');

Route::get('practitioner/productsmanager', 'PractitionersController@productsmanager');

Route::get('practitioner/generate/{id}', 'PractitionersController@generatereport');


Route::get('practitioner/overview/{report_id}', 'PractitionersController@reportOverview');
Route::get('practitioner/client/{report_id}', 'PractitionersController@viewclient');

Route::post('practitioner/addquestion', 'PractitionersController@addquestion');
Route::post('practitioner/add', 'PractitionersController@store');
Route::post('practitioner/update', 'PractitionersController@update');

Route::post('reports/removeSharer', 'SharingController@removeSharer');
Route::post('reports/shareReport', 'SharingController@addNewSharer');

Route::controllers([

    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    //'client' =>'Auth\ClientAuthController',

]);
