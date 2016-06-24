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
	//return Redirect::route('dashboard');
	return View::make('welcome');
});



Route::group(['middleware' => 'guest'], function(){
	Route::controller('password', 'RemindersController');
	Route::get('login', ['as'=>'login','uses' => 'Auth\AuthController@login']);
	Route::get('user/create', ['as'=>'user.create','uses' => 'UsersController@create']);
	Route::post('user/store', ['as'=>'user.store','uses' => 'UsersController@store']);
	Route::post('login', array('uses' => 'Auth\AuthController@doLogin'));


	// social login route
	Route::get('login/fb', ['as'=>'login/fb','uses' => 'SocialController@loginWithFacebook']);
	Route::get('login/gp', ['as'=>'login/gp','uses' => 'SocialController@loginWithGoogle']);

});



Route::group(array('middleware' => 'auth'), function()
{

	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
	Route::get('profile', ['as' => 'profile', 'uses' => 'UsersController@profile']);
	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'Auth\AuthController@dashboard'));
	Route::get('change-password', array('as' => 'password.change', 'uses' => 'Auth\AuthController@changePassword'));
	Route::post('change-password', array('as' => 'password.doChange', 'uses' => 'Auth\AuthController@doChangePassword'));


});



Route::get('data',function(){
	//return \App\Crawler::all();

	//return ini_get('max_execution_time'); 

	return \App\Crawler::where('overall',1)->count();
});


//carwler divider
Route::get('prothomAloLinks', ['uses' => 'CrawlerController@prothomAloLinks']);
Route::get('prothomAloDetails', ['uses' => 'CrawlerController@prothomAloDetails']);

//all process for news crawling
Route::get('search-women-news', ['uses' => 'CrawlerController@all']);
Route::get('prothomAlo', ['uses' => 'CrawlerController@prothomAlo']);


//Divide women news form all news 
Route::get('womenNews', ['uses' => 'AnalyzeController@areWomenNews']);













