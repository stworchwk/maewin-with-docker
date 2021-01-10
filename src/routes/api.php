<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Traveler;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', 'API\V1\AuthController@login');
    Route::post('signup', 'API\V1\AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'API\V1\AuthController@logout');
        Route::get('profile', 'API\V1\AuthController@profile');
        Route::put('profileUpdate', 'API\V1\AuthController@profileUpdate');

        Route::resource('nationalities', 'API\V1\NationalityController', ['only' => ['index']]);
        Route::resource('prefixPhoneNumbers', 'API\V1\PrefixPhoneNumberController', ['only' => ['index']]);
        Route::resource('locationCategories', 'API\V1\LocationCategoryAPIController', ['only' => ['index']]);
        Route::resource('locations', 'API\V1\LocationAPIController', ['only' => ['index']]);
    });
});
