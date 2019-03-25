<?php

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


Auth::routes(['register' => false]);

Route::get('/', ['as' => 'welcome', 'uses' => 'WelcomeController@index']);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('configurations', 'ConfigurationsController');
    Route::resource('users', 'UsersController');

    Route::get('/settings', ['as' => 'settings.index', 'uses' => 'SettingsController@index']);
    Route::put('/settings', ['as' => 'settings.update', 'uses' => 'SettingsController@update']);

    Route::get('/companies', ['as' => 'companies.index', 'uses' => 'CompaniesController@index']);
    Route::get('/companies/export', ['as' => 'companies.export', 'uses' => 'CompaniesController@export']);
    Route::get('/companies/purge', ['as' => 'companies.purge', 'uses' => 'CompaniesController@purge']);
    Route::delete('/companies/{company}', ['as' => 'companies.destroy', 'uses' => 'CompaniesController@destroy']);

    Route::get('/queries', ['as' => 'queries.index', 'uses' => 'QueriesController@index']);
    Route::post('/queries', ['as' => 'queries.execute', 'uses' => 'QueriesController@execute']);
});
