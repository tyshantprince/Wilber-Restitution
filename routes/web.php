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

Route::get('/', 'RestitutionController@index');
Route::get('state/{state}', 'RestitutionController@show');


Route::get('state/{state}/notes',           'StateNotesController@index')->name('state.notes.index');
Route::post('/state/{state}/notes',         'StateNotesController@store')->name('state.notes.store');
Route::patch('/state/{state}/notes/{note}', 'StateNotesController@update')->name('state.notes.update');
Route::delete('/state/{state}/notes/{note}', 'StateNotesController@destroy')->name('state.notes.destroy');


Route::get('county/{county}/contacts', 'CountyContactsController@index')->name('county.contacts.index');
Route::post('county/{county}/contacts/', 'CountyContactsController@store')->name('county.contacts.store');
Route::patch('county/{county}/contacts/{contact}', 'CountyContactsController@update')->name('county.contacts.update');
Route::delete('county/{county}/contacts/{contact}', 'CountyContactsController@destroy')->name('county.contacts.destroy');


Route::get('state/{state}/counties',           'StateCountiesController@index')->name('state.counties.index');
Route::post('/state/{state}/counties',         'StateCountiesController@store')->name('state.counties.store');
Route::patch('/state/{state}/counties/{county}', 'StateCountiesController@update')->name('state.counties.update');
Route::delete('/state/{state}/counties/{county}', 'StateCountiesController@destroy')->name('state.counties.destroy');





