<?php

// Builder
Route::get('/', ['as' => 'builder', 'uses' => 'BuilderController@index']);
Route::post('/', ['as' => 'builder.create', 'uses' => 'BuilderController@create']);
Route::post('upload', ['as' => 'builder.upload', 'uses' => 'BuilderController@upload']);
Route::get('share/{id}', ['as' => 'builder.show', 'uses' => 'BuilderController@show']);
Route::get('share/{id}/edit', ['as' => 'builder.edit', 'uses' => 'BuilderController@edit']);
Route::get('share/{id}/raw', ['as' => 'builder.raw', 'uses' => 'BuilderController@raw']);
Route::get('share/{id}/download', ['as' => 'builder.download', 'uses' => 'BuilderController@download']);
Route::get('share/{id}/delete', ['as' => 'builder.delete', 'uses' => 'BuilderController@delete']);

// Auth
Route::get('login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::post('login', 'AuthController@loginCreate');
Route::get('register', ['as' => 'register', 'uses' => 'AuthController@register']);
Route::post('register', 'AuthController@registerCreate');
Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
Route::get('oauth', 'AuthController@oauth');

// Account
Route::get('account', ['as' => 'account', 'uses' => 'AccountController@dashboard']);

// Contributors
Route::get('contributors', ['as' => 'contributors', 'uses' => 'ContributorsController@index']);

// Explore
Route::get('explore', ['as' => 'explore', 'uses' => 'ExploreController@index']);
Route::get('box/{id}', ['as' => 'explore.show', 'uses' => 'ExploreController@show']);
Route::get('box/{id}/edit', ['as' => 'explore.edit', 'uses' => 'ExploreController@edit']);
Route::get('box/{id}/raw', ['as' => 'explore.raw', 'uses' => 'ExploreController@raw']);
Route::get('box/{id}/download', ['as' => 'explore.download', 'uses' => 'ExploreController@download']);

// Paste Bin
//Route::get('bin', ['as' => 'bin', 'uses' => 'PastesController@create']);
//Route::post('bin', ['as' => 'bin.store', 'uses' => 'PastesController@store']);
//Route::get('bin/{id}', ['as' => 'bin.show', 'uses' => 'PastesController@show']);
//Route::get('bin/{id}/fork', ['as' => 'bin.fork', 'uses' => 'PastesController@edit']);
//Route::post('bin/{id}/fork', ['as' => 'bin.update', 'uses' => 'PastesController@update']);
//Route::delete('bin/{id}', ['as' => 'bin.delete', 'uses' => 'PastesController@delete']);
//Route::get('bin/{id}/raw', ['as' => 'bin.raw', 'uses' => 'PastesController@raw']);

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
