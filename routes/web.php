<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'medicos', 'middleware' => 'tipo:admin'], function() {
    Route::get('/', 'MedicoController@index');
    Route::get('/list', 'MedicoController@list');
    Route::get('/novo', 'MedicoController@create');
    Route::post('/', 'MedicoController@store');
    Route::get('{id}/editar', 'MedicoController@edit');
    Route::patch('{id}', 'MedicoController@update');
});

Route::group(['prefix' => 'pacientes', 'middleware' => 'tipo:admin'], function() {
    Route::get('/', 'PacienteController@index');
    Route::get('/list', 'PacienteController@list');
    Route::get('/novo', 'PacienteController@create');
    Route::post('/', 'PacienteController@store');
    Route::get('{id}/editar', 'PacienteController@edit');
    Route::patch('{id}', 'PacienteController@update');
});
