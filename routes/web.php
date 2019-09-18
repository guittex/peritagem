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

//Route::get('/home', 'HomeController@index')->name('home');

//----------------------Peritagem-------------------------------------------------------
Route::get('/peritagem', ['uses' => 'PeritagemController@index', 'as' => 'peritagem.index']);
Route::get('/peritagem/adicionar',['uses' => 'PeritagemController@create', 'as' => 'peritagem.adicionar']);
Route::post('/peritagem/salvar',['uses' => 'PeritagemController@store', 'as' => 'peritagem.salvar']);
Route::get('/peritagem/pesquisar',['uses' => 'PeritagemController@show', 'as' => 'peritagem.pesquisar']);
Route::get('/peritagem/deletar/{id}',['uses' => 'PeritagemController@destroy', 'as' => 'peritagem.deletar']);
Route::get('/pendente',['uses' => 'PeritagemController@Pendente', 'as' => 'peritagem.pendente']);
Route::get('/processo',['uses' => 'PeritagemController@Processo', 'as' => 'peritagem.processo']);
Route::get('/revisado',['uses' => 'PeritagemController@Revisado', 'as' => 'peritagem.revisado']);
Route::post('/peritagem/editar',['uses' => 'PeritagemController@update', 'as' => 'peritagem.editar']);


//----Rotas teste
Route::get('/teste',['uses' => 'ItensController@teste', 'as' => 'teste']);

Route::post('/peritagem/pesquisar/ajax', 'PeritagemController@PesquisarAjax');
Route::post('test', function()
{
    echo 'oi';
});
//---------------

//----------------------Itens-----------------------------------------------------------
Route::get('/itens/index/{id}',['uses' => 'ItensController@show', 'as' => 'itens.index']);
Route::get('/itens/pesquisar',['uses' => 'ItensController@pesquisar', 'as' => 'itens.pesquisar']);
Route::get('/itens/ParCilindricoPinhao/{id}',['uses' => 'ItensController@ParCilindricoPinhaoIndex', 'as' => 'index.ParCilindricoPinhao']);
Route::get('/itens/ParCilindricoEngrenagem/{id}',['uses' => 'ItensController@ParCilindricoEngrenagemIndex', 'as' => 'index.ParCilindricoEngrenagem']);
Route::get('/itens/EngrenagemInterna/{id}',['uses' => 'ItensController@EngrenagemInternaIndex', 'as' => 'index.EngrenagemInterna']);
Route::get('/itens/ParConicoPinhao/{id}',['uses' => 'ItensController@ParConicoPinhaoIndex', 'as' => 'index.ParConicoPinhao']);
Route::post('itens/adicionar/{id}',['uses' => 'ItensController@store', 'as' => 'adicionar.itens']);


//Route::get('/itens/deletar/{id}',['uses' => 'ItensController@destroy', 'as' => 'itens.deletar']);

//----------------------Imagens---------------------------------------------------------
Route::post('/imagens/adicionar',['uses' => 'ImagensController@store', 'as' => 'imagens.salvar']);
Route::get('/imagens/principal/{id}', ['uses' => 'ImagensController@setImagePrincipal', 'as' => 'imagens.principal']);


//------------------------TESTE---------------------------------------------------------
Route::get('/carros', ['uses' => 'ControllerCarros@index', 'as' => 'carros.index']);
Route::get('/carros/adicionar', ['uses' =>'ControllerCarros@adicionar', 'as' => 'carros.adicionar']);
Route::post('/carros/salvar', ['uses' =>'ControllerCarros@salvar', 'as' => 'carros.salvar']);
Route::get('/sair', ['uses' => 'HomeController@sair', 'as' => 'user.sair']);
Route::get('carros/editar/{id}', ['uses' => 'ControllerCarros@editar', 'as' => 'carros.editar']);
Route::post('carros/atualizar/{id}', ['uses' => 'ControllerCarros@atualizar', 'as' => 'carros.atualizar']);
Route::get('carros/deletar/{id}', ['uses' => 'ControllerCarros@deletar', 'as' => 'carros.deletar']);
Route::get('carros/pesquisar',['uses' => 'ControllerCarros@pesquisar', 'as' => 'carros.pesquisar']);
