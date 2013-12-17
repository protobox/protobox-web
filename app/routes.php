<?php

// Home
Route::get('/', ['as' => 'builder', 'uses' => 'BuilderController@index']);
Route::post('/', ['as' => 'builder.create', 'uses' => 'BuilderController@create']);

// Upload + Share
Route::post('upload', ['as' => 'upload', 'uses' => 'ShareController@create']);
Route::get('share/{id}', ['as' => 'share', 'uses' => 'ShareController@show']);

// About
Route::get('about', ['as' => 'about', 'uses' => 'HomeController@about']);

// Auth
Route::get('login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::get('signup', ['as' => 'signup', 'uses' => 'AuthController@signup']);
Route::get('confirm', 'AuthController@signupConfirm');
Route::post('confirm', 'AuthController@signupCreate');
Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
Route::get('oauth', 'AuthController@oauth');

// Contributors
Route::get('contributors', ['as' => 'contributors', 'uses' => 'ContributorsController@index']);

// Explore
Route::get('explore', ['as' => 'explore', 'uses' => 'ExploreController@index']);

// Paste Bin
Route::get('bin', ['as' => 'bin', 'uses' => 'PastesController@create']);
Route::post('bin', ['as' => 'bin.store', 'uses' => 'PastesController@store']);
Route::get('bin/{id}', ['as' => 'bin.show', 'uses' => 'PastesController@show']);
Route::get('bin/{id}/fork', ['as' => 'bin.fork', 'uses' => 'PastesController@edit']);
Route::post('bin/{id}/fork', ['as' => 'bin.update', 'uses' => 'PastesController@update']);
//Route::delete('bin/{id}', ['as' => 'bin.delete', 'uses' => 'PastesController@delete']);
Route::get('bin/{id}/raw', ['as' => 'bin.raw', 'uses' => 'PastesController@raw']);

// Docs
Route::get('docs/{path?}', ['as' => 'docs', 'uses' => 'DocsController@index'])->where('path', '.+');

// Account Area
Route::group(['before' => 'auth', 'prefix' => 'account'], function()
{
	// Dashboard
	Route::get('/', ['as' => 'account.dashboard', 'uses' => 'Account/UserController@index']);

	// Profile
	Route::get('profile', ['as' => 'account.profile', 'uses' => 'Account/ProfileController@index']);
	Route::post('profile', ['uses' => 'Account/ProfileController@create']);

	// Configs
	Route::get('config', ['as' => 'account.config', 'uses' => 'Account/ConfigController@index']);
	Route::post('config', ['uses' => 'Account/ConfigController@create']);
});
