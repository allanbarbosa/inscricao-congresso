<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function()
{
	return View::make('home');
});

//Route::get('/inscricao', function(){
//	return View::make('Inscricao.form');
//});

Route::get('/municipios', '\Congresso\ModuloAdministrativo\Municipios\Controllers\MunicipiosController@getMunicipios');
Route::get('/instituicoes', '\Congresso\ModuloAdministrativo\Instituicao\Controllers\InstituicaoController@getInstituicoes');

Route::controller('/inscricao', '\Congresso\ModuloInscricao\Participante\Controllers\ParticipanteController');