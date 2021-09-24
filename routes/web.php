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

Route::group(['prefix' => 'gerenciar'], function () {
    Route::group(['prefix' => 'medicos'], function () {
        Route::get('/', 'MedicoController@index');
        Route::get('/list', 'MedicoController@list');
        Route::get('/novo', 'MedicoController@create');
        Route::post('/', 'MedicoController@store');
        Route::get('{id}/editar', 'MedicoController@edit');
        Route::patch('{id}', 'MedicoController@update');
    });

    Route::group(['prefix' => 'pacientes'], function () {
        Route::get('/', 'PacienteController@index');
        Route::get('/list', 'PacienteController@list');
        Route::get('/novo', 'PacienteController@create');
        Route::post('/', 'PacienteController@store');
        Route::get('{id}/editar', 'PacienteController@edit');
        Route::patch('{id}', 'PacienteController@update');
    });

    Route::group(['prefix' => 'especialidades'], function () {
        Route::get('/', 'EspecialidadeController@index');
        Route::get('/list', 'EspecialidadeController@list');
        Route::get('/novo', 'EspecialidadeController@create');
        Route::post('/', 'EspecialidadeController@store');
        Route::get('{id}/editar', 'EspecialidadeController@edit');
        Route::patch('{id}', 'EspecialidadeController@update');
    });

    Route::group(['prefix' => 'administradores'], function () {
        Route::get('/', 'AdministradorController@index');
        Route::get('/list', 'AdministradorController@list');
        Route::get('/novo', 'AdministradorController@create');
        Route::post('/', 'AdministradorController@store');
        Route::get('{id}/editar', 'AdministradorController@edit');
        Route::patch('{id}', 'AdministradorController@update');
    });

    Route::group(['prefix' => 'agenda'], function () {
        Route::get('/', 'MedicoAgendaController@index');
        Route::get('/novo', 'MedicoAgendaController@create');
        Route::post('/', 'MedicoAgendaController@store');
    });
});

Route::get('/medicos', 'MedicoController@listForPatients');
