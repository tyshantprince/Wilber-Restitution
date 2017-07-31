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


Route::get('state/{state}/notes',           'StateNotesController@index')->name('state.notes.index');
Route::post('/state/{state}/notes',         'StateNotesController@store')->name('state.notes.store');
Route::patch('/state/{state}/notes/{note}', 'StateNotesController@update')->name('state.notes.update');
Route::delete('/state/{state}/notes/{note}', 'StateNotesController@destroy')->name('state.notes.destroy');


Route::get('state/{state}/{county}/contacts', 'CountyContactsController@index')->name('county.contacts.index');
Route::post('state/{state}/{county}/contacts/', 'CountyContactsController@store')->name('county.contacts.store');
Route::patch('state/{state}/{county}/contacts/{contact}', 'CountyContactsController@update')->name('county.contacts.update');
Route::delete('state/{state}/{county}/contacts/{contact}', 'CountyContactsController@destroy')->name('county.contacts.destroy');





