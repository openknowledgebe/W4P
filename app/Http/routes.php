<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', ['as' => 'home', 'middleware' => 'env.ready', 'uses' => 'HomeController@index']);

    /*
    |--------------------------------------------------------------------------
    | Setup routes
    |--------------------------------------------------------------------------
    | Routes for the application setup (on the first go).
    |
    */

    Route::group(['prefix' => 'setup', 'as' => 'setup::', 'middleware' => 'setup.restricted'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'SetupController@index']);
        Route::get('/{id}', ['as' => 'step', 'uses' => 'SetupController@showStep']);
        Route::post('/{id}', ['as' => 'handleStep', 'uses' => 'SetupController@handleStep']);
    });

    /*
    |--------------------------------------------------------------------------
    | Administrator routes
    |--------------------------------------------------------------------------
    |
    */

    // Login does not require auth middleware
    Route::get('/admin/login', ['as' => 'admin::login', 'middleware' => 'env.ready', 'uses' => 'AdminAuthController@login']);
    Route::post('/admin/login', ['as' => 'admin::login', 'middleware' => 'env.ready', 'uses' => 'AdminAuthController@doLogin']);

    // All other admin routes require admin middleware
    Route::group(
        [
            'prefix' => 'admin',
            'as' => 'admin::',
            'middleware' => ['auth', 'env.ready'],
        ],
        function () {
            // Dashboard
            Route::get('/', ['as' => 'index', 'uses' => 'AdminController@dashboard']);
            // Project
            Route::get('/project', ['as' => 'project', 'uses' => 'AdminController@project']);
            Route::post('/project', ['as' => 'project', 'uses' => 'AdminController@updateProject']);
            // Organisation
            Route::get('/organisation', ['as' => 'organisation', 'uses' => 'AdminController@organisation']);
            Route::post('/organisation', ['as' => 'organisation', 'uses' => 'AdminController@updateOrganisation']);
            // Platform
            Route::get('/platform', ['as' => 'platform', 'uses' => 'AdminController@platform']);
            Route::post('/platform', ['as' => 'platform', 'uses' => 'AdminController@updatePlatform']);
            // Tiers
            Route::get('/tiers', ['as' => 'tiers', 'uses' => 'AdminTierController@index']);
            Route::get('/tiers/create', ['as' => 'createTier', 'uses' => 'AdminTierController@create']);
            Route::post('/tiers/create', ['as' => 'storeTier', 'uses' => 'AdminTierController@store']);
            Route::get('/tiers/{id}', ['as' => 'editTier', 'uses' => 'AdminTierController@edit']);
            Route::post('/tiers/{id}', ['as' => 'updateTier', 'uses' => 'AdminTierController@update']);
            Route::delete('/tiers/{id}', ['as' => 'deleteTier', 'uses' => 'AdminTierController@delete']);
        }
    );

});

/*
|--------------------------------------------------------------------------
| Simple drag and drop upload
|--------------------------------------------------------------------------
|
*/

Route::post('inline-attach', ['uses' => 'UploadController@inlineAttach']);
