<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
})->name('web');

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {

    // Auth
    Route::get('authProfile', 'AuthController@authProfile')->name('authProfile');
    Route::get('authProfileEdit', 'AuthController@authProfileEdit')->name('authProfileEdit');
    Route::post('authProfileUpdate', 'AuthController@authProfileUpdate')->name('authProfileUpdate');
    Route::get('authPassword', function () {
        return view('pages.auth.password');
    })->name('authPassword');
    Route::post('authPasswordUpdate', 'AuthController@authPasswordUpdate')->name('authPasswordUpdate');
    // End Auth

    //Location
    Route::group(['prefix' => 'monitor'], function () {
        Route::get('/', 'MonitorController@index')->name('monitor');
        Route::group(['prefix' => 'API'], function () {
            Route::get('/callLocations', 'MonitorController@callLocations')->name('monitorAPICallLocations');
            Route::get('/callTravelerPlans', 'MonitorController@callTravelerPlans')->name('monitorAPICallTravelerPlans');
        });
    });

    //Location
    Route::group(['prefix' => 'locations'], function () {
        Route::get('/-{filter}', 'LocationController@index')->name('locations');
        Route::get('/create', 'LocationController@create')->name('locationCreate');
        Route::post('/store', 'LocationController@store')->name('locationStore');
        Route::get('/edit-{id}', 'LocationController@edit')->name('locationEdit');
        Route::put('/update-{id}', 'LocationController@update')->name('locationUpdate');
        Route::get('/showAlbums-{id}', 'LocationController@showAlbums')->name('locationShowAlbums');
        Route::post('/albumStore-{id}', 'LocationController@albumStore')->name('locationAlbumStore');
        Route::get('/albumDestroy-{image_id}', 'LocationController@albumDestroy')->name('locationAlbumDestroy');
        Route::get('/showWebview-{id}', 'LocationController@showWebview')->name('locationShowWebView');
        Route::put('/webviewUpdate-{id}', 'LocationController@webviewUpdate')->name('locationWebViewUpdate');
        Route::get('/active-{id}', 'LocationController@active')->name('locationActive');
        Route::get('/destroy-{id}', 'LocationController@destroy')->name('locationDestroy');
    });
    //End Location

    //Traveler
    Route::group(['prefix' => 'travelers'], function () {
        Route::get('/', 'TravelerController@index')->name('travelers');
        Route::get('/create', 'TravelerController@create')->name('travelerCreate');
        Route::post('/store', 'TravelerController@store')->name('travelerStore');
        Route::get('/edit-{id}', 'TravelerController@edit')->name('travelerEdit');
        Route::put('/update-{id}', 'TravelerController@update')->name('travelerUpdate');
        Route::get('/password-{id}', function ($id) {
            return view('pages.travelers.components.password', ['id' => $id]);
        })->name('travelerPassword');
        Route::post('/passwordUpdate-{id}', 'TravelerController@passwordUpdate')->name('travelerPasswordUpdate');
        Route::get('/active-{id}', 'TravelerController@active')->name('travelerActive');
        Route::get('/destroy-{id}', 'TravelerController@destroy')->name('travelerDestroy');
    });
    //End Traveler

    //Traveler Plan
    Route::group(['prefix' => 'travelerPlans'], function () {
        Route::get('/', 'TravelerPlanController@index')->name('travelerPlans');
        Route::get('/achievement-{id}', 'TravelerPlanController@achievement')->name('travelerPlanAchievement');
        Route::get('/logs-{id}', 'TravelerPlanController@logs')->name('travelerPlanLogs');
        Route::get('/messages-{id}', 'TravelerPlanController@messages')->name('travelerPlanMessages');
        Route::get('/callPlanLocations-{id}', 'TravelerPlanController@callPlanLocations')->name('travelerPlanCallPlanLocations');
        Route::get('/callPlanTracking-{id}', 'TravelerPlanController@callPlanTracking')->name('travelerPlanCallPlanTracking');
    });
    //End Traveler Plan

    //Check Request
    Route::group(['prefix' => 'checkRequests'], function () {
        Route::get('/', 'CheckRequestController@index')->name('checkRequests');
        Route::get('/create', 'CheckRequestController@create')->name('checkRequestCreate');
        Route::post('/store', 'CheckRequestController@store')->name('checkRequestStore');
        Route::get('/edit-{id}', 'CheckRequestController@edit')->name('checkRequestEdit');
        Route::put('/update-{id}', 'CheckRequestController@update')->name('checkRequestUpdate');
        Route::get('/destroy-{id}', 'CheckRequestController@destroy')->name('checkRequestDestroy');
    });
    //End Check Request

    //Check Response
    Route::group(['prefix' => 'checkResponses'], function () {
        Route::get('/-{checkRequest_id}', 'CheckResponseController@index')->name('checkResponses');
        Route::get('/create-{checkRequest_id}', 'CheckResponseController@create')->name('checkResponseCreate');
        Route::post('/store-{checkRequest_id}', 'CheckResponseController@store')->name('checkResponseStore');
        Route::get('/edit-{id}', 'CheckResponseController@edit')->name('checkResponseEdit');
        Route::put('/update-{id}', 'CheckResponseController@update')->name('checkResponseUpdate');
        Route::get('/destroy-{id}', 'CheckResponseController@destroy')->name('checkResponseDestroy');
    });
    //End Check Response

//Manage
    Route::group(['prefix' => 'manages'], function () {

        //User
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'Manage\UserController@index')->name('manageUsers');
            Route::get('/create', 'Manage\UserController@create')->name('manageUserCreate');
            Route::post('/store', 'Manage\UserController@store')->name('manageUserStore');
            Route::get('/edit-{id}', 'Manage\UserController@edit')->name('manageUserEdit');
            Route::put('/update-{id}', 'Manage\UserController@update')->name('manageUserUpdate');
            Route::get('/password-{id}', function ($id) {
                return view('pages.manages.users.components.password', ['id' => $id]);
            })->name('manageUserPassword');
            Route::post('/passwordUpdate-{id}', 'Manage\UserController@passwordUpdate')->name('manageUserPasswordUpdate');
            Route::get('/active-{id}', 'Manage\UserController@active')->name('manageUserActive');
            Route::get('/destroy-{id}', 'Manage\UserController@destroy')->name('manageUserDestroy');

        });
        //End User

        //Location Categories
        Route::group(['prefix' => 'locationCategories'], function () {
            Route::get('/', 'Manage\LocationCategoryController@index')->name('manageLocationCategories');
            Route::get('/create', 'Manage\LocationCategoryController@create')->name('manageLocationCategoryCreate');
            Route::post('/store', 'Manage\LocationCategoryController@store')->name('manageLocationCategoryStore');
            Route::get('/edit-{id}', 'Manage\LocationCategoryController@edit')->name('manageLocationCategoryEdit');
            Route::put('/update-{id}', 'Manage\LocationCategoryController@update')->name('manageLocationCategoryUpdate');
            Route::get('/destroy-{id}', 'Manage\LocationCategoryController@destroy')->name('manageLocationCategoryDestroy');
        });
        //End Location Categories

        //Prefix PhoneNumber
        Route::group(['prefix' => 'prefixPhoneNumbers'], function () {
            Route::get('/', 'Manage\PrefixPhoneNumberController@index')->name('managePrefixPhoneNumbers');
            Route::get('/create', 'Manage\PrefixPhoneNumberController@create')->name('managePrefixPhoneNumberCreate');
            Route::post('/store', 'Manage\PrefixPhoneNumberController@store')->name('managePrefixPhoneNumberStore');
            Route::get('/edit-{id}', 'Manage\PrefixPhoneNumberController@edit')->name('managePrefixPhoneNumberEdit');
            Route::put('/update-{id}', 'Manage\PrefixPhoneNumberController@update')->name('managePrefixPhoneNumberUpdate');
            Route::get('/destroy-{id}', 'Manage\PrefixPhoneNumberController@destroy')->name('managePrefixPhoneNumberDestroy');
        });
        //End Prefix PhoneNumber


        //Nationality
        Route::group(['prefix' => 'nationalities'], function () {
            Route::get('/', 'Manage\NationalityController@index')->name('manageNationalities');
            Route::get('/create', 'Manage\NationalityController@create')->name('manageNationalityCreate');
            Route::post('/store', 'Manage\NationalityController@store')->name('manageNationalityStore');
            Route::get('/edit-{id}', 'Manage\NationalityController@edit')->name('manageNationalityEdit');
            Route::put('/update-{id}', 'Manage\NationalityController@update')->name('manageNationalityUpdate');
            Route::get('/destroy-{id}', 'Manage\NationalityController@destroy')->name('manageNationalityDestroy');
        });
        //End Nationality
    });
    //End Manage
});
