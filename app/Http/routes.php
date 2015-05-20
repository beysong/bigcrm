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

//Route::get('/', 'WelcomeController@index');
Route::get('/', 'Auth\AuthController@getLogin');

Route::get('home', 'HomeController@index');
Route::get('books/outstore', 'Admin\BooksController@outstore');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function()
{
  Route::get('/', 'AdminHomeController@index');
  Route::get('books/heji', 'BooksController@heji');
  Route::get('books/compare', 'BooksController@compare');
  Route::get('books/chart', 'BooksController@chart');
  Route::get('member/editself', 'UsersController@editself');
  Route::put('member/editself', 'UsersController@editself');
  
  Route::post('books/modify_status', 'BooksController@modifyStatus');
  Route::post('books/modify_lixing', 'BooksController@modifyLixing');
  Route::post('books/modify_not', 'BooksController@modifyNot');
  
  Route::resource('products', 'ProductController');
  
  Route::resource('books', 'BooksController');
  
  Route::resource('users', 'UsersController');
  
  Route::resource('roles', 'RolesController');
  
  Route::resource('permissions', 'PermissionsController');
  
});

Route::filter('manage_users', function()
{
    // check the current user
    if (!Entrust::can('users-manager')) {
        return Redirect::to('admin');
    }
});
Route::when('admin/users*', 'manage_users');

Route::filter('manage_roles', function()
{
    // check the current user
    if (!Entrust::can('users-manager')) {
        return Redirect::to('admin');
    }
});
Route::when('admin/roles*', 'manage_roles');

Route::filter('manage_permissions', function()
{
    // check the current user
    if (!Entrust::can('users-manager')) {
        return Redirect::to('admin');
    }
});
Route::when('admin/permissions*', 'manage_permissions');

