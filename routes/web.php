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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', 'ContactsController@getAll');

Route::post('/contacts/delete','ContactsController@delete');

Route::post('/contacts','ContactsController@create');

Route::post('/contacts/update','ContactsController@update');

Route::get('/{id}', function () {
    return view('welcome');
});