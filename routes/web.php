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


Route::get('state/{state}/notes', 'StateNotesController@index')->name('state.notes.index');

Route::post('/state/{state}/notes', 'StateNotesController@store')->name('state.notes.store');
