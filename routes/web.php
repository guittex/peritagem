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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/carros', ['uses' => 'ControllerCarros@index', 'as' => 'carros.index']);
Route::get('/carros/adicionar', ['uses' =>'ControllerCarros@adicionar', 'as' => 'carros.adicionar']);
Route::post('/carros/salvar', ['uses' =>'ControllerCarros@salvar', 'as' => 'carros.salvar']);
Route::get('/sair', ['uses' => 'HomeController@sair', 'as' => 'user.sair']);
Route::get('carros/editar/{id}', ['uses' => 'ControllerCarros@editar', 'as' => 'carros.editar']);
Route::post('carros/atualizar/{id}', ['uses' => 'ControllerCarros@atualizar', 'as' => 'carros.atualizar']);
Route::get('carros/deletar/{id}', ['uses' => 'ControllerCarros@deletar', 'as' => 'carros.deletar']);

