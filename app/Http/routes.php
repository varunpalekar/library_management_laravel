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

Route::group(['middleware' => ['web']], function () {

    Route::auth();
    Route::get('/home', 'HomeController@index');

    /**
     * For Books Show
     */
    Route::get('/book/add', 'BookController@showAdd');
    Route::get('/book/edit/{id}', 'BookController@showEdit');
    Route::get('/book/search', 'BookController@showSearch');
    Route::get('/book/issue', 'BookController@showIssue');

    /**
     * For Books Forms
     */
    Route::post('/book/add', 'BookController@add');
    Route::post('/book/search', 'BookController@search');
    Route::post('/book/issue', 'BookController@issue');
    Route::post('/book/update', 'BookController@update');


    /**
     * For Members Show
     */
    Route::get('/member/add', 'MemberController@showAdd');
    Route::get('/member/search', 'MemberController@showSearch');
    Route::get('/member/edit/{id}', 'MemberController@showEdit');
    Route::get('/member/books/{id}', 'MemberController@showIssue');

    /**
     * For Members Form
     */
    Route::post('/member/add', 'MemberController@add');
    Route::post('/member/search', 'MemberController@search');
    Route::post('/member/update', 'MemberController@update');




});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

});

/**
 * Authentication Routes
 */
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');
//
//// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');