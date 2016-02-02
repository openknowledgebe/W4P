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

    /*
    Route::get('/design', function(){
        return View::make('design');
    });
    */

    Route::get('/', ['as' => 'home', 'middleware' => 'env.ready', 'uses' => 'HomeController@index']);

    /*
    |--------------------------------------------------------------------------
    | Posts
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'post', 'as' => 'post::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'PostController@index']);
        Route::get('/{id}', ['as' => 'detail', 'uses' => 'PostController@detail']);
    });

    /*
    |--------------------------------------------------------------------------
    | Backing
    |--------------------------------------------------------------------------
    */

    Route::get('/donate', [
        'as' => 'donate',
        'uses' => 'DonationController@newDonation'
    ]);

    Route::post('/donate/details', [
        'as' => 'donate',
        'uses' => 'DonationController@continueDonation'
    ]);

    Route::post('/donate/confirm', [
        'as' => 'donate::confirm',
        'uses' => 'DonationController@confirmDonation',
    ]);

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
    Route::get(
        '/admin/login',
        ['as' => 'admin::login', 'middleware' => 'env.ready', 'uses' => 'AdminAuthController@login']
    );
    Route::post(
        '/admin/login',
        ['as' => 'admin::login', 'middleware' => 'env.ready', 'uses' => 'AdminAuthController@doLogin']
    );

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
            // Posts
            Route::get('/posts', ['as' => 'posts', 'uses' => 'AdminPostController@index']);
            Route::get('/posts/create', ['as' => 'createPost', 'uses' => 'AdminPostController@create']);
            Route::post('/posts/create', ['as' => 'storePost', 'uses' => 'AdminPostController@store']);
            Route::get('/posts/{id}', ['as' => 'editPost', 'uses' => 'AdminPostController@edit']);
            Route::post('/posts/{id}', ['as' => 'updatePost', 'uses' => 'AdminPostController@update']);
            Route::delete('/posts/{id}', ['as' => 'deletePost', 'uses' => 'AdminPostController@delete']);
            // Email
            Route::get('/email', ['as' => 'email', 'uses' => 'AdminController@email']);
            Route::post('/email', ['as' => 'email', 'uses' => 'AdminController@updateEmail']);
            // Goals
            Route::get('/goals', ['as' => 'goals', 'uses' => 'AdminGoalController@index']);
            Route::get('/goals/{kind}', ['as' => 'goalsDetail', 'uses' => 'AdminGoalController@kind']);

            // Currency goal
            Route::get('/currency', ['as' => 'goalsCurrency', 'uses' => 'AdminGoalController@currency']);
            Route::post('/currency', ['as' => 'goalsCurrency', 'uses' => 'AdminGoalController@updateCurrency']);

            // Assets
            Route::get('/assets', ['as' => 'assets', 'uses' => 'AdminController@assets']);
            Route::get('/assets/{filename}/delete', ['as' => 'deleteAsset', 'uses' => 'AdminController@deleteAsset']);

            // Create a new goal type
            Route::get(
                '/goals/{kind}/new',
                ['as' => 'goalsTypeCreate', 'uses' => 'AdminGoalController@createType']
            );
            Route::post(
                '/goals/{kind}/new',
                ['as' => 'goalsTypeCreate', 'uses' => 'AdminGoalController@storeType']
            );

            // Edit an existing goal type
            Route::get(
                '/goals/{kind}/{id}/edit',
                ['as' => 'goalsTypeEdit', 'uses' => 'AdminGoalController@editType']
            );
            Route::post(
                '/goals/{kind}/{id}/edit',
                ['as' => 'goalsTypeEdit', 'uses' => 'AdminGoalController@updateType']
            );

            // Delete an existing goal type
            Route::delete(
                '/goals/{kind}/{id}/delete',
                ['as' => 'goalsTypeDelete', 'uses' => 'AdminGoalController@deleteType']
            );
        }
    );

});

/*
|--------------------------------------------------------------------------
| Simple drag and drop upload
|--------------------------------------------------------------------------
|
*/

Route::post('inline-attach', ['uses' => 'UploadController@inlineAttach', 'as' => 'postAttachment']);
